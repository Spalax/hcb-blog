<?php
return array(
    'router' => include __DIR__ . '/module/router.config.php',

    'doctrine' => array(
        'driver' => array(
            'app_driver' => array(
                'paths' => array(__DIR__ . '/../src/HcbBlog/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'HcbBlog\Entity' => 'app_driver'
                )
            )
        )
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'HcbBlog' => __DIR__ . '/../public',
            )
        )
    ),

    'di' => include __DIR__ . '/module/di.config.php'
);
