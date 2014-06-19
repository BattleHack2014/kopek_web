<?php
namespace Crm\Model;

use Crm\Model\Storage\ProjectMySqlStorage;

use Crm\Model\Storage\MySqlStorage;

use Crm\Model\Storage\Storage;

abstract class CollectionModel implements \IteratorAggregate  {

    protected $_objects = array();

    /**
     * @var \Crm\Model\Storage\MySqlStorage
     */
    public $_storage = null;

    public function __construct(Storage $storage = null) {
        if (!$storage)
            $storage = new ProjectMySqlStorage();

        $this->_storage = $storage;
    }

    public function loadBy($fields) {
        if ($this->_storage instanceof MySqlStorage) {
            if ($rows = $this->_storage->find($this->newModel(), $fields)) {
                if (is_object($rows))
                    $rows = array($rows);

                foreach ($rows as $data) {
                    $type = null;
                    if (isset($data->type_id))
                        $type = $data->type_id;
                    $model = $this->newModel($type);

                    $model->initFromData($data);
                    $model->setLoaded(true);
                    $this->_objects[] = $model;
                }
                return $this;
            }
        }

        return null;
    }

    public function loadRelated($object_name) {
        /* @var $object Model */
        foreach ($this as $object)
            $object->loadRelated($object_name);
    }

    public function isEmpty() {
        return !count($this->_objects);
    }

    public function getIterator() {
        return new \ArrayIterator($this->_objects);
    }

    public function toArray() {
        $result = array();
        /* @var $object Model */
        foreach ($this as $object)
            $result[] = $object->toArray();

        return $result;
    }

    public function getIds() {
        $ids = array();
        foreach ($this as $object)
            $ids[] = $object->id;

        return $ids;
    }

    /**
     * @return Model
     */
    abstract protected function newModel($type = null);

}