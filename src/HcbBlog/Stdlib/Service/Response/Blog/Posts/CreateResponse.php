<?php
namespace HcbBlog\Stdlib\Service\Response\Posts;

use Zend\I18n\Translator\Translator;
use Zf2Libs\Stdlib\Data\DataInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;
use HcbBlog\Stdlib\Response\Exception\InvalidArgumentException;

class CreateResponse extends Response implements DataInterface
{
    /**
     * @var number
     */
    protected $postsId;

    /**
     * @param number $postsId
     */
    public function setPostsId($postsId)
    {
        if (!is_numeric($postsId)) {
            throw new InvalidArgumentException("Invalid type of posts id, must be numeric");
        }
        $this->postsId = $postsId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array('id'=>$this->postsId);
    }
}
