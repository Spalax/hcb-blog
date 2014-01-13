<?php
return array(
    'HcbBlog-Posts' => 'HcBackend\Controller\Collection\CommonListController',
    'HcbBlog-Posts-Post-Create' => 'HcBackend\Controller\Collection\CommonDataController',
    'HcbBlog-Posts-Post-Data-Save' => 'HcBackend\Controller\Collection\CommonResourceDataController',

    'HcbBlog-Posts-Post-DataInput-LoadResourceInput' => 'Zf2FileUploader\Input\Image\LoadResource\FromText',
    'HcbBlog-Posts-Post-DataImages-SaveService' => 'Zf2FileUploader\Service\Image\SaveService'
);
