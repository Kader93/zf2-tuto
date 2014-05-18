<?php
return array(
    array(
        'name' => 'pseudo',
        'type'  => 'text',
        'options' => array(
            'label' => 'Pseudonyme',
                     ),
    ),

    array(
        'name' => 'mdp',
        'type'  => 'password',
        'options' => array(
            'label' => 'Password',
                    ),
    ),

    array(
        'name' => 'mdpconfirm',
        'type'  => 'password',
        'options' => array(
            'label' => 'Confirm Password',
                    ),
    ),

    array(
        'name' => 'mail',
        'type'  => 'Email',
        'options' => array(
            'label' => 'Email',
                    ),
    ),

    array(
        'name' => 'sexe',
        'type'  => 'Radio',
        'options' => array(
            'label' => 'Sexe',
            'value_options' => array(
                '0' => 'Homme',
                '1' => 'Femme',
                              ),
                 ),
    ),

    array(
        'name' => 'famille',
        'type'  => 'Zend\Form\Element\MultiCheckbox',
        'options' => array(
            'label' => 'Situation familiale',
            'value_options' => array(
                '0' => 'Célibataire',
                '1' => 'Marié',
                              ),
                    ),
    ),

    array(
        'name' => 'description',
        'type'  => 'textarea',
        'options' => array(
            'label' => 'Description à ajouter',
                      ),
    ),

    array(
        'name' => 'pays',
        'type'  => 'Zend\Form\Element\Select',
        'options' => array(
            'label' => 'Selection Pays',
            'value_options' => array(
                '0' => 'France',
                '1' => 'Allemagne',
                '2' => 'Italie',
                                ),
                      ),
    ),

    array(
        'name' => 'age',
        'type'  => 'text',
        'options' => array(
            'label' => 'Age',
                    ),
    ),
    array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ),
);