<?php
namespace HcbBlog\Stdlib\Extractor\Blog\Posts\Post;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbBlog\Entity\Post as PostEntity;

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

        $updatedTimestamp = $post->getUpdatedTimestamp();
        $createdTimestamp = $post->getCreatedTimestamp();

        if ($updatedTimestamp) {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }
        if ($createdTimestamp) {
            $createdTimestamp = $createdTimestamp->format('Y-m-d H:i:s');
        }

        return array('id'=>$post->getId(),
                     'title'=>$post->getTitle(),
                     'content'=>$post->getContent(),
                     'updatedTimestamp'=>$updatedTimestamp,
                     'createdTimestamp'=>$createdTimestamp);
    }
}
