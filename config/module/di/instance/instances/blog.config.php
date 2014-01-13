<?php
return array(

    'HcbBlog-Posts' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbBlog\Service\Posts\FetchQbBuilderService',
            'extractor' => 'HcbBlog\Stdlib\Extractor\Posts\Post\Extractor'
        )
    ),

    'HcbBlog-Posts-Post-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbBlog\Service\Posts\CreateService',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'HcbBlog-Posts-Post-Data-Save' => array(
        'parameters' => array(
            'inputData' => 'HcbBlog\Data\Posts\Post\Data\Save',
            'fetchService' => 'HcbBlog\Service\Posts\Post\FetchService',
            'serviceCommand' => 'HcbBlog\Service\Posts\Post\Data\SaveCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Uploader\Specific\StatusMessageDataModelFactory'
        )
    ),

    'HcbBlog-Posts-Post-DataInput-LoadResourceInput' => array(
        'parameters' => array( 'name' => 'content' )
    ),

    'HcbBlog\Data\Posts\Post\Data\Save' => array(
        'parameters' => array(
            'resourceInputLoader' => 'HcbBlog-Posts-Post-DataInput-LoadResourceInput'
        )
    ),

    'HcbBlog-Posts-Post-DataImages-SaveService-CleanerStrategy' => array(
        'parameters' => array(
            'remover' => 'HcBackend-Images-Default-TotalImagesRemover'
        )
    ),

    'HcbBlog-Posts-Post-DataImages-SaveService' => array(
        'parameters' => array(
            'cleaner' => 'HcBackend-Images-Default-CleanerStrategy'
        )
    )
);
