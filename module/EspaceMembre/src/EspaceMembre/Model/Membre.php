<?php
namespace EspaceMembre\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Membre implements InputFilterAwareInterface
{
    public $civilite;
    public $sexe;
    public $pseudo;
    public $mdp;
    public $mail;
    public $pays;
    public $age;
    public $description;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->pseudo = (isset($data['pseudo'])) ? $data['pseudo'] : null;
        $this->mdp  = (isset($data['mdp']))  ? $data['mdp']  : null;
        $this->mail = (isset($data['mail'])) ? $data['mail'] : null;
        $this->civilite = (isset($data['civilite'])) ? $data['civilite'] : null;
        $this->sexe = (isset($data['sexe'])) ? $data['sexe'] : null;
        $this->age = (isset($data['age'])) ? $data['age'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->pays  = (isset($data['pays']))  ? $data['pays']  : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    // Add content to this method:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'pseudo',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 30,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'mdp',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 20,
                        ),
                    ),
                ),
            )));
            $inputFilter->add(array(
                'name'       => 'mdpconfirm',
                'validators' => array(
                    array(
                        'name'    => 'Identical',
                        'options' => array(
                            'token' => 'mdp',
                        ),
                    ),
                ),
            ));


            $inputFilter->add($factory->createInput(array(
                'name'     => 'mail',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress'),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 30,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'sexe',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'description',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 200,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'civilite',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'pays',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'age',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                    'name'    => 'digits'),
                ),
            )));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}