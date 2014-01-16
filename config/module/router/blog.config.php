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
                        ),
                        'delete' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'delete',
                                'defaults' => array(
                                    'controller' => 'HcbBlog-Controller-Posts-Post-Delete'
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
