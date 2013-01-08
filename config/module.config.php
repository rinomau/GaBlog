<?php
return array(
    'router' => array(
        'routes' => array(
            'base' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'idCategory' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'blog' => 'GaBlog\Controller\IndexController',
            'article' => 'GaBlog\Controller\BackendController',
            'category' => 'GaBlog\Controller\CategoryController',
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