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
    public function save(Post $postEntity, SaveInterface $saveData)
    {
        try {
            $this->entityManager->beginTransaction();

            $dataCollection = $postEntity->getData();
            $collection = $dataCollection->filter(function (Post\Data $dataEntity) use ($saveData){
                return $dataEntity->getLang() == $saveData->getLang();
            });

            $postDataEntity = $collection->current();
            if (!$postDataEntity instanceof Post\Data) {
                $postDataEntity = new Post\Data();
                $postDataEntity->setPost($postEntity);
                $postDataEntity->setLang($saveData->getLang());
            }

            if (!$postEntity->getEnabled()) {
                $postEntity->setEnabled(1);
                $this->entityManager->persist($postEntity);
            }

            $this->imageBinderService->bind($saveData, $postDataEntity);
            $this->pageBinderService->bind($saveData, $postDataEntity);

            $this->entityManager->persist($postDataEntity);

            $postDataEntity->setTitle($saveData->getTitle());
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
