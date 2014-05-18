<?php
namespace EspaceMembre\Form;

use EspaceMembre\Form\configInterface;
use Zend\Filter\Null;

class configJson implements configFileInterface
{

    public function getContentsFile($file = NULL)
    {
        $filepath = pathinfo($file);
        if(file_exists($file) && $filepath['extension'] = 'json'){
            $contentConfig = file_get_contents($file);
            return $contentConfig;
        }
        else{throw new \Exception("file doesn't exist or hasn't the good extension");}
    }

    public function getArrayConfig($strContentsFile)
    {
        $arrayConfig = json_decode($strContentsFile, TRUE);
        if(!$arrayConfig == Null){
            return $arrayConfig;
        }
        else{throw new \Exception("Parsing failed");}
    }

    public function isValidElement($element)
    {
        if (! is_array($element)) {
            return FALSE;
        }

        $this->loadConfigElement();

        $elementCheck = array_merge(
            array(
                'name'          => NULL,
                'type'          => NULL,
                'options' => array(
                    'label' => NULL,
                    'value_options' => array(),
                ),
                'attributes'    => array(
                    'type'      => NULL,
                    'value'     => NULL,
                    'id'        => NULL,

                ),
            ),
            $element
        );

        if ($elementCheck['name'] === NULL AND $elementCheck['type']) {
            return FALSE;
        }
        return $elementCheck;
    }
}