<?php
namespace HcbBlog\Stdlib\Provider;

use HcBackend\Stdlib\Provider\JsConfigInterface;
use Zend\Di\Di;

class JsConfig implements JsConfigInterface
{
    /**
     * @return array
     */
    public function getHuskyConfig()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getDojoConfig()
    {
        return array();
    }
}

