<?php
namespace Chanson\Model;


use Album\Model\Album;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Platform\Mysql\Mysql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Album\Model\AlbumTable;


class ChansonTable
{
    protected $tableGateway;
    protected $albumTable;

    public function __construct(TableGateway $tableGateway, AlbumTable $albumTable)
    {
        $this->tableGateway = $tableGateway;
        $this->albumTable = $albumTable;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
/*
    public function getChansonAlbum($id){
        $select = New Select('Chanson');

        return $select->columns(array('id', 'id_album','titre'))
                      ->join('Album','Chanson.id_album = Album.id',array())
                      ->where('Album.id = '. (int) $id);
    }
*/
    public function getChansonAlbumByID($id)
    {
        //$data = $this->getChansonAlbum($id);
        //$rowset = $this->tableGateway->selectWith($data);
        $rowset = $this->tableGateway->select(array('id_album' => (int) $id));
        $result = array();
        while($row = $rowset->current()) {
            $result []= $row->getArrayCopy();
            $rowset->next();
        }
        return $result;
    }

    public function getNbChansonByAlbum($album_id)
    {
        $rowset = $this->tableGateway->select(array('id_album' => (int) $album_id));
        $result = $rowset->count();
        return $result;
    }

    public function saveChanson(Chanson $chanson)
    {
        $data = array(
            'id_album' => $chanson->album_id,
            'titre' => $chanson->titre,
        );

        $id = (int)$chanson->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getChanson($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}