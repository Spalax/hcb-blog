<?php
namespace HcbBlog\Stdlib\Service\Response\Posts\Post;

use Zend\I18n\Translator\Translator;
use Zf2Libs\Stdlib\Response\DataInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;
use HcbBlog\Stdlib\Response\Exception\InvalidArgumentException;

class CreateResponse extends Response implements DataInterface
{
    /**
     * @var number
     */
    protected $postsId;

    /**
     * @param number $postId
     */
    public function setPostId($postId)
    {
        if (!is_numeric($postId)) {
            throw new InvalidArgumentException("Invalid type of post id, must be numeric");
        }

        $this->postId = $postId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array('id'=>$this->postId);
    }
}
