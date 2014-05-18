<?php

namespace Chanson;
use Chanson\Model\Chanson;
use Chanson\Model\ChansonTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Chanson\Model\ChansonTable' => function($sm) {
                        $tableGateway = $sm->get('ChansonTableGateway');
                        $albumTable = $sm->get('Album\Model\AlbumTable');
                        $table = new ChansonTable($tableGateway, $albumTable);
                        return $table;
                    },
                'ChansonTableGateway' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $resultSetPrototype = new ResultSet();
                        $resultSetPrototype->setArrayObjectPrototype(new Chanson());
                        return new TableGateway('Chanson', $dbAdapter, null, $resultSetPrototype);
                    },
            ),
        );
    }

}