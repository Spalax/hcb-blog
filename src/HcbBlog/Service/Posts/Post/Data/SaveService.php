<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use HcbBlog\Data\Posts\Post\Data\SaveInterface;
use HcbBlog\Entity\Post;
use HcbBlog\Stdlib\Service\Response\Posts\Post\SaveResponse;
use Doctrine\ORM\EntityManager;
use HcbBlogTag\Service\Post\BinderService as TagBinderService;

class SaveService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var SaveResponse
     */
    protected $saveResponse;

    /**
     * @var PageBinderServiceInterface
     */
    protected $pageBinderService;

    /**
     * @var ImageBinderServiceInterface
     */
    protected $imageBinderService;

    /**
     * @var TagBinderService
     */
    protected $tagBinderService;

    /**
     * @param EntityManager $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param ImageBinderServiceInterface $imageBinderService
     * @param TagBinderService $tagBinderService
     * @param SaveResponse $saveResponse
     */
    public function __construct(EntityManager $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                TagBinderService $tagBinderService,
                                SaveResponse $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
        $this->tagBinderService = $tagBinderService;
        $this->entityManager = $entityManager;
        $this->saveResponse = $saveResponse;
    }

    /**
     * @param Post $postEntity
     * @param SaveInterface $saveData
     * @return SaveResponse
     */
    public function save(Post\Data $postDataEntity, SaveInterface $saveData)
    {
        try {
            $this->entityManager->beginTransaction();

            $postEntity = $postDataEntity->getPost();

            $this->imageBinderService->bind($saveData, $postDataEntity);
            $this->pageBinderService->bind($saveData, $postDataEntity);
            $this->tagBinderService->bind($saveData, $postEntity);

            $this->entityManager->persist($postDataEntity);

            $thumbnail = $saveData->getThumbnail();

            if ($thumbnail) {
                /* @var \HcbBlog\Entity\Post\Data\Image $dataImage */
                foreach ($postDataEntity->getDataImage() as $dataImage ) {
                    if ( $thumbnail->getToken() === $dataImage->getImage()->getToken() ) {
                        $dataImage->setIsPreview( true );
                        break;
                    }
                }
            }

            $title = $saveData->getTitle();

            $postEntity->setType($this->entityManager
                                      ->getReference('HcbBlog\Entity\Post\Type',
                                 (int)$saveData->getType()));

            $postDataEntity->setTitle($title);
            $postDataEntity->setPreview($saveData->getPreview());
            $postDataEntity->setContent($saveData->getContent());

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->saveResponse->error($e->getMessage())->failed();
            return $this->saveResponse;
        }

        $this->saveResponse->success();
        return $this->saveResponse;
    }
}
