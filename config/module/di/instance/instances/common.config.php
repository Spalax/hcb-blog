<?php
return array(
    'HcbBlog-Posts-PaginatorViewModel' => array(
        'parameters' => array(
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Extractor'
        )
    ),

    'HcbBlog\Data\Posts\Post\Data\Save' => array(
        'parameters' => array(
            'resourceInputPreviewLoader' => 'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Preview',
            'resourceInputContentLoader' => 'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Content',
            'resourceInputThumbnailLoader' => 'HcbBlog-Posts-Post-Data-InputCreateResourceInput-Thumbnail'
        )
    ),

    'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Preview' => array(
        'parameters' => array( 'name' => 'preview' )
    ),

    'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Content' => array(
        'parameters' => array( 'name' => 'content' )
    ),

    'HcbBlog-Posts-Post-Data-InputCreateResourceInput-Thumbnail' => array(
        'parameters' => array( 'name' => 'thumbnail' )
    ),

    'HcbBlog-Posts-Post-Data-PaginatorViewModel' => array(
        'parameters' => array(
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Data\Extractor'
        )
    ),

    'HcbBlog-Posts-Post-Type-PaginatorViewModel' => array(
        'parameters' => array(
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Type\Extractor'
        )
    ),

    'HcbBlog-Posts-Post-FetchService' => array(
        'parameters' => array(
            'entityName' => 'HcbBlog\Entity\Post'
        )
    ),

    'HcbBlog-Posts-Post-Data-FetchService' => array(
        'parameters' => array(
            'entityName' => 'HcbBlog\Entity\Post\Data'
        )
    ),

    'HcbBlog-Posts-Collection-Ids' => array(
        'parameters' => array(
            'entityName' => 'HcbBlog\Entity\Post'
        )
    ),

    'HcbBlog-Posts-Collection' => array(
        'parameters' => array(
            'idsCollection' => 'HcbBlog-Posts-Collection-Ids',
            'inputName' => 'posts'
        )
    ),

    'HcbBlog\Service\Posts\DeleteService' => array(
        'parameters' => array(
            'deleteData' => 'HcbBlog-Posts-Collection'
        )
    ),

    'HcbBlog-Posts-Post-Image-CreateResourceData' => array(
        'parameters' => array(
            'resourceInput' => 'HcbBlog-Posts-Post-Image-ResourceInput'
        )
    ),

    'HcbBlog-Posts-Post-Image-ResourceInput' => array(
        'parameters' => array(
            'name' => 'upload'
        )
    )
);
