<?php
namespace MembreTest\Model;

use EspaceMembre\Form\MembreForm;
use PHPUnit_Framework_TestCase;

class MembreFormTest extends PHPUnit_Framework_TestCase
{
    protected static $membreform;
    protected static $filepath;

    public static function setUpBeforeClass()
    {
        self::$filepath = \EspaceMembre\Module::$ModuleLocation . "/ressources/Json/membreForm.config.json";
        self::$membreform = new MembreForm(self::$filepath);
    }

    public function testFormHasSubmit()
    {
        $this->assertNotNull(self::$membreform->get('submit'), "Pas de submit dans le formulaire");
    }

    public function testFormExist()
    {
        $this->assertNotNull(self::$membreform->getElements(), "Pas d'élement dans le formulaire");
    }

    public static function tearDownAfterClass()
    {
        self::$membreform = NULL;
    }

    /**
 * @expectedException Exception
 * @expectedExceptionMessage Le fichier n'existe pas
 */
    public function testExistConfig()
    {
        $filepath= "";
        MembreForm::get_exstention_filepath($filepath);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Le fichier n'existe pas
     */
    public function testExtensionConfig1()
    {
        $filepath= "";
        MembreForm::createFormByConfig($filepath);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Le fichier n'est pas au bon format
     */
    public function testExtensionConfig2()
    {
        $filepath= \EspaceMembre\Module::$ModuleLocation . "/ressources/Json/membreForm.config.txt";
        MembreForm::createFormByConfig($filepath);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Le fichier n'est pas au bon format
     */
    public function testConstruct()
    {
        $filepath= \EspaceMembre\Module::$ModuleLocation . "/ressources/Json/membreForm.config.txt";
        $membreform = new MembreForm($filepath);

    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Le parsing a échoué
     */
    public function testConstruct2()
    {
        $filepath= \EspaceMembre\Module::$ModuleLocation . "/ressources/Json/noconfig.json";
        $membreform = new MembreForm($filepath);

    }

    public function testConstruct3()
    {
        $filepath= \EspaceMembre\Module::$ModuleLocation . "/ressources/Json/membreForm.config.json";
        $membreform = new MembreForm($filepath);
        $this->assertNotNull($membreform->getElements(), "Pas d'élement dans le formulaire");
    }

}