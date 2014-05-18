<?php


namespace EspaceMembre\Form;


use Zend\Form\Form;


class MembreForm extends Form
{
    protected $filepath;
    protected $allowedElement = NULL;
    public const DEFAULT_CONFIG = \EspaceMembre\Module::$ModuleLocation."/ressources/Json/membreForm.config.json";

    public function __construct($filepath = null, $name = null)
    {
        parent::__construct('membre');
        $this->setAttribute('method', 'post');
        $this->filepath = $filepath;

        echo $this->filepath;

        if($filepath == NULL or ! file_exists($filepath)) {
            $this->filepath = MembreForm::DEFAULT_CONFIG;
        }

        $formconfig = self::createFormByConfig($this->filepath);
        $phpconfig = json_decode($formconfig, true);
        if($phpconfig !== NULL){
            foreach($phpconfig as $element){
                var_dump($element);
                var_dump($this->isValidElement($element));
                if($this->isValidElement($element))
                {
                    $this->add($element);
                }
            }
        }
        else{throw new \Exception("Le parsing a échoué");}
    }

    /**
     * read config file and setup internal variables, like php representation of the configuration
     */
    private function loadConfigElement() {

        if ($this->allowedElement == NULL) {
            $typeEltJson = self::createFormByConfig(\EspaceMembre\Module::$ModuleLocation."/ressources/Json/typeconfig.json");
            $this->allowedElement = json_decode($typeEltJson, true);
        }
    }

    public static  function createFormByConfig($filepath)
    {
                return $formconfig = file_get_contents($filepath);
            else{throw new \Exception("Le fichier n'est pas au bon format");}
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