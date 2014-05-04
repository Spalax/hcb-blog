<?php
namespace HcbBlog\Service\Posts\Post\Type;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use HcCore\Service\Fetch\Paginator\ArrayCollection\DataServiceInterface;
use HcbBlog\Entity\Post;
use HcbBlog\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements DataServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Parameters $params
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch(Parameters $params = null)
    {
        $typeRepository = $this->entityManager->getRepository('HcbBlog\Entity\Post\Type');
        return new ArrayCollection($typeRepository->findAll());
    }
}
