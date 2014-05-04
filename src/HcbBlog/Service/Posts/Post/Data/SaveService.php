<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use HcbBlog\Data\Posts\Post\Data\SaveInterface;
use HcbBlog\Entity\Post;
use HcbBlog\Stdlib\Service\Response\Posts\Post\SaveResponse;
use Doctrine\ORM\EntityManager;

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
     * @param EntityManager $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param SaveResponse $saveResponse
     */
    public function __construct(EntityManager $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                SaveResponse $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
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

            $this->imageBinderService->bind($saveData, $postDataEntity);
            $this->pageBinderService->bind($saveData, $postDataEntity);

            $this->entityManager->persist($postDataEntity);

            $postEntity = $postDataEntity->getPost();
            $title = $saveData->getTitle();
            if (preg_match('/^news/', $title)) {
                $title = str_replace('news', '', $title);
                $postEntity->setType($this->entityManager->getReference('HcbBlog\Entity\Post\Type', 1));
            } else {
                $postEntity->setType($this->entityManager->getReference('HcbBlog\Entity\Post\Type', 2));
            }

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
