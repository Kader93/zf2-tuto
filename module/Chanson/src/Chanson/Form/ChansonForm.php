<?php

namespace Chanson\Form;


use Zend\Form\Form;


class ChansonForm extends Form
{
    public function __construct($name = null)
    {
//        $sm = $this->getServiceLocator();
//        $tableGateway = $sm->get('AlbumTableGateway');
//        $AlbumTable = new AlbumTable($tableGateway);
        parent::__construct('chanson');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
            'filter' => array(
                'required' => true,
                'filters'  => array(
                array('name' => 'Int'),
            )),
        ));
        $this->add(array(
          'name' => 'id_album',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
//          'attributes' => array(
//             'type'  => 'select',
//              'name' => 'Album'),
//              'options' => array(
//                    'value_options' => array(
//                      'albums' => $AlbumTable->getAlbumTable()->fetchAll()),
//       )
//  ));
        $this->add(array(
            'name' => 'titre',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Titre',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}