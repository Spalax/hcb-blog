<?php
namespace HcbTranslations\Service\Blog\Posts;

use HcBackend\Service\FetchQbBuilderServiceInterface;
use HcBackend\Service\Sorting\SortingServiceInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements FetchQbBuilderServiceInterface
{
    /**
     * @var SortingServiceInterface
     */
    protected $sortingService;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager,
                                SortingServiceInterface $sortingService)
    {
        $this->entityManager = $entityManager;
        $this->sortingService = $sortingService;
    }

    /**
     * @param Parameters $params
     * @return QueryBuilder
     */
    public function fetch(Parameters $params = null)
    {
        $qb = $this->entityManager
                   ->getRepository('HcbBlog\Entity\Post')
                   ->createQueryBuilder('p');

        if (is_null($params)) return $qb;
        return $this->sortingService->apply($params, $qb, 'p');
    }
}
