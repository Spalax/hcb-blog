<?php
namespace HcbBlog\Service\Posts;

use HcCore\Service\CommandInterface;
use Doctrine\ORM\EntityManager;
use HcbBlog\Entity\Post;
use HcbBlog\Stdlib\Service\Response\Posts\CreateResponse as CreateResponse;

class CreateService implements CommandInterface
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
     * @param EntityManager $entityManager
     * @param CreateResponse $createResponse
     */
    public function __construct(EntityManager $entityManager,
                                CreateResponse $createResponse)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $createResponse;
    }

    /**
     * @return CreateResponse
     */
    public function execute()
    {
        try {
            $this->entityManager->beginTransaction();

            $post = new Post();
            $post->setType($this->entityManager->getReference('HcbBlog\Entity\Post\Type', 1));
            $post->setCreatedTimestamp(new \DateTime());

            $this->entityManager->persist($post);

            $this->entityManager->flush();

            $this->createResponse->setPostsId($post->getId());
            
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
