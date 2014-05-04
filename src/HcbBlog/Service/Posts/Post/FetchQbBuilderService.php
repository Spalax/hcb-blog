<?php
namespace HcbBlog\Service\Posts\Post;

use Doctrine\Common\Collections\ArrayCollection;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use HcCore\Service\Filtration\Collection\FiltrationServiceInterface;
use HcbBlog\Entity\Post;
use HcbBlog\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements ResourceDataServiceInterface
{
    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @param FiltrationServiceInterface $filtrationService
     */
    public function __construct(FiltrationServiceInterface $filtrationService)
    {
        $this->filtrationService = $filtrationService;
    }

    /**
     * @param Post $postEntity
     * @param Parameters $params
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch($postEntity, Parameters $params = null)
    {
        if (!$postEntity instanceof Post) {
            throw new InvalidResourceException('postEntity must be compatible with type HcbBlog\Entity\Post');
        }

        $collection = $postEntity->getData();
        $arrayCollection = new ArrayCollection($collection->toArray());
        if (is_null($params)) {
            return $arrayCollection;
        }

        return $this->filtrationService->apply($params, $arrayCollection);
    }
}
