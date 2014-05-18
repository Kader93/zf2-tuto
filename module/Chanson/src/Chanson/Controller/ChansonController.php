<?php

namespace Chanson\Controller;

use Chanson\Form\ChansonForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Chanson\Model\Chanson;

class ChansonController extends AbstractActionController
{
    protected $chansonTable;
    protected $albumTable;

    public function indexAction()
    {
        $albums = array();
        $nbChanson = array();
        foreach($this->getAlbumTable()->fetchAll() as $album) {
            $albums []= $album;
            $nbChanson[$album->id] = $this->getChansonTable()
                                          ->getNbChansonByAlbum($album->id);
        }
        return new ViewModel(array(
            'albums'     => $albums,
            'nbchansons' => $nbChanson,
        ));
    }

    public function displayAction()
    {
        $id_album = (int) $this->params()->fromRoute('id', null);
        return new ViewModel(array(
            'chanson' => $this->getChansonTable()->getChansonAlbumByID($id_album),
            'id_album' => $id_album,
        ));
    }

    public function addAction()
    {
        $id_album = (int) $this->params()->fromRoute('id', null);
        if (!$id_album) {
            return $this->redirect()->toRoute('chanson', array(
                'action' => 'index'
            ));
        }
        $form = new ChansonForm();
        $form->get('submit')->setValue('Add');
        $form->get('id_album')->setValue($id_album);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $chanson = new Chanson();
            $form->setInputFilter($chanson->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $chanson->exchangeArray($form->getData());
                $this->getChansonTable()->saveChanson($chanson);
                return $this->redirect()->toRoute('chanson', array(
                    'action' => 'display',
                    'id' => $id_album,
                ));
            }
        }
        return array(
            'id_album' => $id_album,
            'form' => $form,
        );
    }


    public function editAction()
    {
    }

    public function deleteAction()
    {
        $id_ablbum = (int) $this->params()->fromRoute('id', 0);
        if (!$id_ablbum) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id_ablbum = (int) $request->getPost('id');
                $this->getChansonTable()->deleteChanson($id_ablbum);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('chanson');
        }

        return array(
            'id'    => $id_ablbum,
            'chanson' => $this->getAlbumTable()->getAlbum($id_ablbum)
        );
    }

    public function getChansonTable()
    {
        if (!$this->chansonTable) {
            $sm = $this->getServiceLocator();
            $this->chansonTable = $sm->get('Chanson\Model\ChansonTable');
        }
        return $this->chansonTable;
    }

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}