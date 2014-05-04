<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbBlog\Data\Posts\Post\Data\SaveInterface;
use HcbBlog\Entity\Post;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CreateCommand implements ResourceCommandInterface
{
    /**
     * @var SaveInterface
     */
    protected $data;

    /**
     * @var SaveService
     */
    protected $service;

    public function __construct(SaveInterface $data,
                                CreateService $service)
    {
        $this->data = $data;
        $this->service = $service;
    }

    /**
     * @param Post $postEntity
     *
     * @return Response
     */
    public function execute(EntityInterface $postEntity)
    {
        return $this->service->save($postEntity, $this->data);
    }
}
