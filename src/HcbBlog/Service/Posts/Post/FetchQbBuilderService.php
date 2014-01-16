<?php
namespace HcbBlog\Service\Posts\Post;

use Doctrine\Common\Collections\ArrayCollection;
use HcBackend\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use Doctrine\ORM\QueryBuilder;
use HcbBlog\Entity\Post;
use HcbBlog\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements ResourceDataServiceInterface
{
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
        return new ArrayCollection($collection->toArray());
    }
}
