<?php
return array(
    //Controllers
    'HcbBlog-Controller-Posts-List' => 'HcCore\Controller\Common\Rest\Collection\ListController',
    'HcbBlog-Controller-Posts-Delete' => 'HcCore\Controller\Common\Rest\Collection\DataController',
    'HcbBlog-Controller-Posts-Post-Create' => 'HcCore\Controller\Common\Rest\Collection\DataController',
    'HcbBlog-Controller-Posts-Post-Data-Save' => 'HcCore\Controller\Common\Rest\Collection\ResourceDataController',
    'HcbBlog-Controller-Posts-Post-Data-Create' =>
        'HcCore\Controller\Common\Rest\Collection\ResourceDataController',
    'HcbBlog-Controller-Posts-Post-Data-List' => 'HcCore\Controller\Common\Rest\Collection\ResourceListController',
    'HcbBlog-Controller-Posts-Post-Data-Image-Create' =>
        'HcbBlog\Controller\Images\CreateController',
    'HcbBlog-Controller-Posts-Type-List' => 'HcCore\Controller\Common\Rest\Collection\ListController',

    //Common
    'HcbBlog-Posts-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',
    'HcbBlog-Posts-Post-Data-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',
    'HcbBlog-Posts-Post-Type-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',
    'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Preview' =>
        'Zf2FileUploader\Input\Image\LoadResource\FromText',
    'HcbBlog-Posts-Post-Data-InputLoadResourceInput-Content' =>
        'Zf2FileUploader\Input\Image\LoadResource\FromText',
    'HcbBlog-Posts-Post-Data-ImagesSaveService' => 'Zf2FileUploader\Service\Image\SaveService',

    'HcbBlog-Posts-Post-FetchService' => 'HcCore\Service\FetchService',
    'HcbBlog-Posts-Post-Data-FetchService' => 'HcCore\Service\FetchService',
    'HcbBlog-Posts-Collection-Ids' => 'HcCore\Service\Collection\IdsService',
    'HcbBlog-Posts-Collection' => 'HcCore\Data\Collection\Entities\ByIds',

    'HcbBlog-Posts-Post-Data-Image-UploaderModel' => 'Zf2FileUploader\View\Model\UploaderModel',
    'HcbBlog-Posts-Post-Image-CreateResourceData' => 'Zf2FileUploader\InputFilter\Image\CreateResource',
    'HcbBlog-Posts-Post-Image-ResourceInput' => 'Zf2FileUploader\Input\Image\CreateResource'
);
