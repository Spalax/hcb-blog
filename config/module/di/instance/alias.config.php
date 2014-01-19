<?php
return array(
    //Controllers
    'HcbBlog-Controller-Posts-List' => 'HcBackend\Controller\Common\Collection\ListController',
    'HcbBlog-Controller-Posts-Delete' => 'HcBackend\Controller\Common\Collection\DataController',
    'HcbBlog-Controller-Posts-Post-Create' => 'HcBackend\Controller\Common\Collection\DataController',
    'HcbBlog-Controller-Posts-Post-Data-Save' => 'HcBackend\Controller\Common\Collection\ResourceDataController',
    'HcbBlog-Controller-Posts-Post-Data-Create' =>
        'HcBackend\Controller\Common\Collection\ResourceDataController',
    'HcbBlog-Controller-Posts-Post-Data-List' => 'HcBackend\Controller\Common\Collection\ResourceListController',
    'HcbBlog-Controller-Posts-Post-Data-Image-Create' =>
        'HcbBlog\Controller\Images\CreateController',

    //Common
    'HcbBlog-Posts-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',
    'HcbBlog-Posts-Post-Data-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',
    'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Preview' =>
        'Zf2FileUploader\Input\Image\LoadResource\FromText',
    'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Content' =>
        'Zf2FileUploader\Input\Image\LoadResource\FromText',
    'HcbBlog-Posts-Post-Data-ImagesSaveService' => 'Zf2FileUploader\Service\Image\SaveService',

    'HcbBlog-Posts-Post-FetchService' => 'HcBackend\Service\FetchService',
    'HcbBlog-Posts-Post-Data-FetchService' => 'HcBackend\Service\FetchService',
    'HcbBlog-Posts-Collection-Ids' => 'HcBackend\Service\Collection\IdsService',
    'HcbBlog-Posts-Collection' => 'HcBackend\Data\Collection\Entities\ByIds',

    'HcbBlog-Posts-Post-Data-Image-UploaderModel' => 'Zf2FileUploader\View\Model\UploaderModel',
    'HcbBlog-Posts-Post-Image-CreateResourceData' => 'Zf2FileUploader\InputFilter\Image\CreateResource',
    'HcbBlog-Posts-Post-Image-ResourceInput' => 'Zf2FileUploader\Input\Image\CreateResource'
);
