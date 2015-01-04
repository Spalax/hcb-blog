<?php
namespace HcbBlog\Stdlib\Extractor\Posts\Post\Data;

use Doctrine\ORM\EntityManagerInterface;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbBlog\Entity\Post\Data as PostDataEntity;
use HcBackend\Stdlib\Extractor\Page\Extractor as PageExtractor;

class Extractor implements ExtractorInterface
{
    /**
     * @var PageExtractor
     */
    protected $pageExtractor;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param PageExtractor $pageExtractor
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PageExtractor $pageExtractor,
                                EntityManagerInterface $entityManager)
    {
        $this->pageExtractor = $pageExtractor;
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  PostDataEntity $postData
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($postData)
    {
        if (!$postData instanceof PostDataEntity) {
            throw new InvalidArgumentException("Expected HcbBlog\\Entity\\Post\\Data object, invalid object given");
        }

        $createdTimestamp = $postData->getCreatedTimestamp();
        if ($createdTimestamp) {
            $createdTimestamp = $createdTimestamp->format('Y-m-d H:i:s');
        }

        $updatedTimestamp = $postData->getUpdatedTimestamp();
        if ($updatedTimestamp) {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        $allTags = $this->entityManager
                        ->getRepository( 'HcbBlogTag\Entity\Tag' )
                        ->createQueryBuilder( 't' )
                        ->select()
                        ->join( 't.post', 'p' )
                        ->where( 'p = :post' )
                        ->setParameter( 'post', $postData->getPost() )
                        ->getQuery()->getResult();

        $tags = array();
        foreach ($allTags as $tagEntity) {
            $tags[] = (string)$tagEntity->getId();
        }

        $localData =array('id'=>$postData->getId(),
                          'title'=>$postData->getTitle(),
                          'lang'=>$postData->getLang(),
                          'type'=>$postData->getPost()->getType()->getId(),
                          'tags[]'=>$tags,
                          'preview'=>$postData->getPreview(),
                          'content'=>$postData->getContent(),
                          'createdTimestamp'=>$createdTimestamp,
                          'updatedTimestamp'=>$updatedTimestamp);

        if (!is_null($postData->getPage())) {
            return array_merge($localData, $this->pageExtractor->extract($postData->getPage()));
        } else {
            return $localData;
        }
    }
}
