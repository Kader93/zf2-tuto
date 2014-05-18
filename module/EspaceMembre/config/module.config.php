<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'EspaceMembre\Controller\EspaceMembre' => 'EspaceMembre\Controller\EspaceMembreController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'espacemembre' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/membre[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'EspaceMembre\Controller\EspaceMembre',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'espace-membre' => __DIR__ . '/../view',
        ),
    ),
);