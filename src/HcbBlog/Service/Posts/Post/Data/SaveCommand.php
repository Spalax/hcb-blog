<?php
namespace HcbBlog\Service\Posts\Post\Data;

use HcBackend\Entity\EntityInterface;
use HcBackend\Service\ResourceCommandInterface;
use HcbBlog\Data\Posts\Post\Data\SaveInterface;
use HcbBlog\Entity\Post;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class SaveCommand implements ResourceCommandInterface
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
                                SaveService $service)
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
