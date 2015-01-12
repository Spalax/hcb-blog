<?php
namespace HcbBlog\Service\Posts;

use HcBackend\Entity\Image as ImageEntity;
use HcCore\Data\Collection\Entities\ByIdsInterface;
use HcCore\Service\CommandInterface;
use HcbBlog\Entity\Post as PostEntity;
use HcbBlog\Entity\Post\Data as PostDataEntity;
use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class DeleteService implements CommandInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Zf2Libs\Stdlib\Service\Response\Messages\Response
     */
    protected $response;

    /**
     * @var ByIdsInterface
     */
    protected $deleteData;

    /**
     * @var RemoverInterface
     */
    protected $removerService;

    /**
     * @param EntityManager $entityManager
     * @param Response $response
     * @param ByIdsInterface $deleteData
     * @param RemoverInterface $removerService
     */
    public function __construct(EntityManager $entityManager,
                                Response $response,
                                ByIdsInterface $deleteData,
                                RemoverInterface $removerService)
    {
        $this->entityManager = $entityManager;
        $this->response = $response;
        $this->deleteData = $deleteData;
        $this->removerService = $removerService;
    }

    /**
     * @return Response
     */
    public function execute()
    {
        return $this->delete($this->deleteData);
    }

    /**
     * @param ByIdsInterface $clientsToBlock
     * @return Response
     */
    protected  function delete(ByIdsInterface $postsToDelete)
    {
        try {
            $this->entityManager->beginTransaction();
            $postEntities = $postsToDelete->getEntities();

            /* @var $postEntities PostEntity[] */
            foreach ($postEntities as $postEntity) {
                /* @var $postDataEntity PostDataEntity */
                foreach ($postEntity->getData() as $postDataEntity) {
                    /* @var $imageEntity ImageEntity */
                    foreach ($postDataEntity->getImage() as $imageEntity) {
                        $this->removerService->remove($imageEntity);
                    }
                }
                $this->entityManager->remove($postEntity);
                $this->entityManager->flush();
            }
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->response->error($e->getMessage())->failed();
            return $this->response;
        }

        $this->response->success();
        return $this->response;
    }
}
