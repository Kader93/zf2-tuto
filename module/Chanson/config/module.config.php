<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Chanson\Controller\Chanson' => 'Chanson\Controller\ChansonController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'chanson' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/chanson[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Chanson\Controller\Chanson',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'chanson' => __DIR__ . '/../view',
        ),
    ),
);