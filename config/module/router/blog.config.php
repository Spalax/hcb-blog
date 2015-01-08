<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/blog'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'images' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/images'
            ),
            'may_terminate' => false,
            'child_routes' => array (
                'create' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' =>
                                'HcbBlog-Controller-Posts-Post-Data-Image-Create'
                        )
                    )
                )
            )
        ),
        'resource' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/:id',
                'constraints' => array( 'id' => '[0-9]+' )
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'locale' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/localized'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array(
                        'thumbnail' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/thumbnail'
                            ),
                            'may_terminate' => false,
                            'child_routes' => array (
                                'list' => array(
                                    'type' => 'method',
                                    'options' => array(
                                        'verb' => 'get',
                                        'defaults' => array(
                                            'controller' =>
                                                'HcbBlog-Controller-Posts-Post-Data-Thumbnail-List'
                                        )
                                    )
                                )
                            )
                        ),
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbBlog-Controller-Posts-Post-Data-List'
                                )
                            )
                        ),
                        'create' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'post',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbBlog-Controller-Posts-Post-Data-Create'
                                )
                            )
                        ),
                        'resource' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/:id',
                                'constraints' => array( 'id' => '[0-9]+' )
                            ),
                            'may_terminate' => false,
                            'child_routes' => array(
                                'update' => array(
                                    'type' => 'method',
                                    'options' => array(
                                        'verb' => 'put',
                                        'defaults' => array(
                                            'controller' =>
                                                'HcbBlog-Controller-Posts-Post-Data-Save'
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        ),
        'delete' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/delete'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'delete' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' => 'HcbBlog-Controller-Posts-Delete'
                        )
                    )
                )
            )
        ),
        'list' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'get'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'show' => array(
                    'type' => 'XRequestedWith',
                    'options' => array(
                        'with' => 'XMLHttpRequest',
                        'defaults' => array(
                            'controller' => 'HcbBlog-Controller-Posts-List'
                        )
                    )
                )
            )
        ),
        'create' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'post',
                'defaults' => array(
                    'controller' => 'HcbBlog-Controller-Posts-Post-Create'
                )
            )
        )
    )
);
