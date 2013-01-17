<?php
return array(
    'router' => array(
        'routes' => array(
            'rest' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gablog/ws[/:controller[/:id]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]+',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                    ),
                ),
            ),
            'blog' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog[/:controller[/:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]+',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
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
            'Category' => 'GaBlog\Controller\CategoryController'
        ),
    ),
    'view_manager' => array(
        'doctype'                  => 'HTML5',
        'template_path_stack' => array(
            'websenzafrontiere' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'GaBlog_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/GaBlog/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'GaBlog\Entity' => 'GaBlog_driver'
                )
            )
        ),
    )
);