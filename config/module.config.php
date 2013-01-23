<?php
return array(
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]+',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PostRest' => 'GaBlog\Controller\PostRestController',
            'CategoryRest' => 'GaBlog\Controller\CategoryRestController',
            'Category' => 'GaBlog\Controller\CategoryController',
            'Post' => 'GaBlog\Controller\PostController'
        ),
    ),
    'view_manager' => array(
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'websenzafrontiere' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/GaBlog/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'GaBlog\Entity' => 'zfcuser_entity',
                )
            )
        ),
        /*
         * I use this conf into globa.conf
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'username',
                    'password' => 'password',
                    'dbname'   => 'database',
                )
            )
        )
        */
    ),
    'zfcuser' => array(
        'user_entity_class'       => 'GaBlog\Entity\User',
         'enable_registration'     => true,
         'enable_default_entities' => false,
         'enable_username'         => true,
         'enable_display_name'     => true,
         'auth_identity_fields'    => array(
                 'username'
         ),
     ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'subpublic',
            ),
        ),
    ),
);