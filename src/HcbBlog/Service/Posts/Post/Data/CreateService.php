<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcbBlog\Data\Posts\Post\Data\SaveInterface;
use HcbBlog\Entity\Post;
use Doctrine\ORM\EntityManager;
use HcbBlog\Stdlib\Service\Response\Posts\Post\CreateResponse;
use Zf2Libs\Stdlib\Service\ResponseInterface;

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
     * @var SaveService
     */
    protected $saveService;

    /**
     * @param EntityManager $entityManager
     * @param SaveService $saveService
     * @param CreateResponse $saveResponse
     */
    public function __construct(EntityManager $entityManager,
                                SaveService $saveService,
                                CreateResponse $saveResponse)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $saveResponse;
        $this->saveService = $saveService;
    }

    /**
     * @param Post $postEntity
     * @param SaveInterface $createData
     * @return ResponseInterface
     */
    public function save(Post $postEntity, SaveInterface $createData)
    {
        try {
            $this->entityManager->beginTransaction();

            $postDataEntity = new Post\Data();
            $postEntity->setEnabled(1);

            $postDataEntity->setPost($postEntity);
            $postDataEntity->setLang($createData->getLang());

            $response = $this->saveService->save($postDataEntity, $createData);
            if ($response->isFailed()) {
                return $response;
            }

            $this->entityManager->persist($postDataEntity);
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
