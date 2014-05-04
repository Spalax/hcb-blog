<?php
namespace HcbBlog\Stdlib\Extractor\Posts\Post\Type;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbBlog\Entity\Post\Type as TypeEntity;

class Extractor implements ExtractorInterface
{
    /**
     * Extract values from an object
     *
     * @param  TypeEntity $type
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($type)
    {
        if (!$type instanceof TypeEntity) {
            throw new InvalidArgumentException("Expected HcbBlog\\Entity\\Post\\Type object, invalid object given");
        }

        return array('id'=>$type->getId(),
                     'name'=>$type->getName());
    }
}
