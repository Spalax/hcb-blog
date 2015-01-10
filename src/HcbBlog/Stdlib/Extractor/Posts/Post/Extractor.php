<?php
namespace HcbBlog\Stdlib\Extractor\Posts\Post;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbBlog\Entity\Post as PostEntity;
use HcbBlog\Entity\Post\Data as PostDataEntity;

class Extractor implements ExtractorInterface
{
    /**
     * Extract values from an object
     *
     * @param  PostEntity $post
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($post)
    {
        if (!$post instanceof PostEntity) {
            throw new InvalidArgumentException("Expected HcbBlog\\Entity\\Post object, invalid object given");
        }

        $createdTimestamp = $post->getCreatedTimestamp();

        if ($createdTimestamp) {
            $createdTimestamp = $createdTimestamp->format('Y-m-d H:i:s');
        }

        $filtrated = $post->getData()->filter(function (PostDataEntity $entity) {
            if ($entity->getLang() == 'ru') {
                return true;
            }
        });

        if ($filtrated->count() < 1) {
            $dataEntity = $post->getData()->slice(0,1);
            $dataEntity = array_pop($dataEntity);
        } else {
            $dataEntity = $filtrated->current();
        }



        return array('id'=>$post->getId(),
                     'title'=>$dataEntity->getTitle(),
                     'createdTimestamp'=>$createdTimestamp);
    }
}
