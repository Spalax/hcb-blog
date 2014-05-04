<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use HcbBlog\Data\Posts\Post\Data\SaveInterface;
use HcbBlog\Entity\Post;
use Doctrine\ORM\EntityManager;
use HcbBlog\Stdlib\Service\Response\Posts\Post\CreateResponse;

class CreateService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var CreateResponse
     */
    protected $createResponse;

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
     * @param ImageBinderServiceInterface $imageBinderService
     * @param CreateResponse $saveResponse
     */
    public function __construct(EntityManager $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                CreateResponse $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
        $this->entityManager = $entityManager;
        $this->createResponse = $saveResponse;
    }

    /**
     * @param Post $postEntity
     * @param SaveInterface $createData
     * @return CreateResponse
     */
    public function save(Post $postEntity, SaveInterface $createData)
    {
        try {
            $this->entityManager->beginTransaction();

            $postDataEntity = new Post\Data();
            $postEntity->setEnabled(1);

            $postDataEntity->setPost($postEntity);
            $postDataEntity->setLang($createData->getLang());

            $this->imageBinderService->bind($createData, $postDataEntity);
            $this->pageBinderService->bind($createData, $postDataEntity);

            $this->entityManager->persist($postDataEntity);

            $title = $createData->getTitle();

            if (preg_match('/^news/', $title)) {
                $title = str_replace('news', '', $title);
                $postEntity->setType($this->entityManager->getReference('HcbBlog\Entity\Post\Type', 1));
            } else {
                $postEntity->setType($this->entityManager->getReference('HcbBlog\Entity\Post\Type', 2));
            }

            $postDataEntity->setTitle($title);
            $postDataEntity->setPreview($createData->getPreview());
            $postDataEntity->setContent($createData->getContent());

            $this->entityManager->flush();

            $this->createResponse->setPostId($postDataEntity->getId());

            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->createResponse->error($e->getMessage())->failed();
            return $this->createResponse;
        }

        $this->createResponse->success();
        return $this->createResponse;
    }
}
