<?php
namespace HcbBlog\Data\Posts\Post\Data;

use HcBackend\Data\ImageInterface;
use HcBackend\Data\PageInterface;
use HcbBlogTag\Data\TagInterface;

interface SaveInterface extends PageInterface, ImageInterface, TagInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getPreview();

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface
     */
    public function getThumbnail();

    /**
     * @return number
     */
    public function getType();

    /**
     * @return string
     */
    public function getLang();
}
