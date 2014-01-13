<?php
namespace HcbBlog\Data\Posts\Post\Data;

use HcBackend\Data\ImageInterface;
use HcBackend\Data\PageInterface;

interface SaveInterface extends PageInterface, ImageInterface
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
     * @return string
     */
    public function getLang();
}
