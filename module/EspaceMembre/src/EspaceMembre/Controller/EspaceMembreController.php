<?php
namespace EspaceMembre\Controller;

use EspaceMembre\Model\Membre;
use Zend\Mvc\Controller\AbstractActionController;
use EspaceMembre\Form\MembreForm;
use EspaceMembre\Form\addchampsForm;

class EspaceMembreController extends AbstractActionController
{
    public function indexAction()
    {
        $filepath = \EspaceMembre\Module::$ModuleLocation."/ressources/Json/membreForm.config.json";
        $form = new MembreForm($filepath);
        $form->get('submit')->setValue("S'inscrire");
        $request = $this->getRequest();
        if ($request->isPost()) {
            $membre = new Membre();
            $form->setInputFilter($membre->getInputFilter());
            $form->setData($request->getPost());
            $form->isValid();
        }
        return array('form' => $form);
    }

    public function addchampsAction()
    {

        $form = new addchampsForm();
        $form->get('submit')->setValue("Ajouter");
        $request = $this->getRequest();
        if ($request->isPost()) {
            $membre = new Membre();
            $form->setInputFilter($membre->getInputFilter());
            $form->setData($request->getPost());
            $form->isValid();
        }
        return array('form' => $form);
    }
}