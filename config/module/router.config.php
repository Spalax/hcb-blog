<?php
return array(
    'routes' => array(
        'hc-backend' => array(
            'child_routes' => array(
                'blog' => include __DIR__ . '/router/blog.config.php'
            )
        )
    )
);
