<?php
return array(
    'Collection-Blog-Posts' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbBlog\Service\Posts\FetchQbBuilderService',
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Extractor'
        )
    ),

    'Collection-Blog-Post-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbBlog\Service\Posts\CreateService',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'Collection-Blog-Post-Data-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbBlog\Data\Posts\Post\Data\Create',
            'fetchService' => 'HcbBlog\Service\Posts\Post\FetchService',
            'serviceCommand' => 'HcbBlog\Service\Posts\Post\CreateCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Uploader\Specific\StatusMessageDataModelFactory'
        )
    )
);
