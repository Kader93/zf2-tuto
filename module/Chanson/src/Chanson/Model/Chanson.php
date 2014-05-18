<?php
namespace Chanson\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Chanson implements InputFilterAwareInterface
{
    public $id;
    public $album_id; // a quelle album est lié cette chanson
    public $titre;
    protected $inputFilter;

    /**
     * Setup the Chanson object with an array of properties
     * @param $array of properties
     */
    public function exchangeArray($array)
    {
        $this->id     = (isset($array['id']))     ? $array['id']     : null;
        $this->album_id = (isset($array['id_album'])) ? $array['id_album'] : null;
        $this->titre  = (isset($array['titre']))  ? $array['titre']  : null;
    }

    /**
     * Return an array of object properties
     * note: contrary of exchangeArray()
     * @return array of properties
     */
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
                'name'     => 'id_album',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array('name'  => 'Int'),
                    array(
                        'name'    => 'GreaterThan',
                        'options' => array( 'min' => 0 ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'titre',
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
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}