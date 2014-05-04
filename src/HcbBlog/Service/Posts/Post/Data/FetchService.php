<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcCore\Service\FetchServiceInterface;
use Doctrine\ORM\EntityManager;

class FetchService implements FetchServiceInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $entityName;

    public function __construct(EntityManager $entityManager,
                                $entityName)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $id
     * @return object
     */
    public function fetch($id)
    {
        return $this->entityManager->find($this->entityName, $id);
    }
}
