<?php
return array(
    'router' => array(
        'routes' => array(
            'post-rest' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/post[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'post',
                    ),
                ),
            ),
            'category-rest' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/category[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'CategoryRest',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'post' => 'GaBlog\Controller\PostRestController',
            'CategoryRest' => 'GaBlog\Controller\CategoryRestController',
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
    ),
    'myRest' => function(){
        return new GaBlog\Http\Restful();
    }
);