<?php
return array(
    'HcbBlog-Posts-PaginatorViewModel' => array(
        'parameters' => array(
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Extractor'
        )
    ),

    'HcbBlog\Data\Posts\Post\Delete' => array(
        'parameters' => array(
            'resourceInputLoader' => 'HcbBlog-Posts-Post-Data-InputLoadResourceInput'
        )
    ),

    'HcbBlog\Data\Posts\Post\Data\Save' => array(
        'parameters' => array(
            'resourceInputLoader' => 'HcbBlog-Posts-Post-Data-InputLoadResourceInput'
        )
    ),

    'HcbBlog-Posts-Post-Data-InputLoadResourceInput' => array(
        'parameters' => array( 'name' => 'content' )
    ),

    'HcbBlog-Posts-Post-Data-ImagesSaveService' => array(
        'parameters' => array(
            'cleaner' => 'HcBackend-Images-Default-CleanerStrategy'
        )
    ),

    'HcbBlog-Posts-Post-Data-PaginatorViewModel' => array(
        'parameters' => array(
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Data\Extractor'
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
    )
);
