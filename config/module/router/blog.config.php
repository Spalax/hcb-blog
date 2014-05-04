<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/blog'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'posts' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/posts'
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
                                    'controller' => 'HcbBlog-Controller-Posts-Post-Data-Image-Create'
                                )
                            )
                        )
                    )
                ),

                'type' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/type'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array (
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' => 'HcbBlog-Controller-Posts-Type-List'
                                )
                            )
                        )
                    )
                ),

                'post' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/:id',
                        'constraints' => array( 'id' => '[0-9]+' )
                    ),
                    'may_terminate' => false,
                    'child_routes' => array(
                        'data' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/polyglot'
                            ),
                            'may_terminate' => false,
                            'child_routes' => array(
                                'show' => array(
                                    'type' => 'method',
                                    'options' => array(
                                        'verb' => 'get',
                                        'defaults' => array(
                                            'controller' => 'HcbBlog-Controller-Posts-Post-Data-List'
                                        )
                                    )
                                ),
                                'create' => array(
                                    'type' => 'method',
                                    'options' => array(
                                        'verb' => 'post',
                                        'defaults' => array(
                                            'controller' => 'HcbBlog-Controller-Posts-Post-Data-Create'
                                        )
                                    )
                                ),
                                'lang' => array(
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
        )
    )
);
