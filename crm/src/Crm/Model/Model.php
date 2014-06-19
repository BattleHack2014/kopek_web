<?php
namespace Crm\Model;

use Crm\Model\Storage\ProjectMySqlStorage;

use Crm\Model\Storage\Record;
use Crm\Model\Storage\MySqlStorage;
use Crm\Model\Storage\DefaultMySqlStorage;
use Crm\Model\Storage\Storage;

abstract class Model implements Record {

    /**
     * @var \Crm\Model\Storage\MySqlStorage
     */
    public $_storage = null;

    protected $_isLoaded = false;

    public function __construct(Storage $storage = null) {
        if (!$storage)
            $storage = new ProjectMySqlStorage();

        $this->_storage = $storage;
    }

    /**
     * Инициализируем объект из массива или из stdClass
     *
     * @return \Crm\Model\Model
     */
    public function initFromData($data) {
        if (is_object($data))
            $data = (array) $data;

        foreach ($data as $key => $value)
            $this->{$key} = $value;

        return $this;
    }

    /**
     * public интерфейс для работы со свойствами
     * в дочернем классе можно переопределить для
     * ввода специальной логики
     *
     * @return NULL
     */
    public function __get($name) {
        if (isset($this->{$name}))
            return $this->{$name};

        return null;
    }

    /**
     * Загрузить объект из базы данных по id-шнику
     *
     * @return Model
     */
    public function loadBy(array $fields, $isMaster = false) {
        if ($this->_storage instanceof MySqlStorage) {
            if ($data = $this->_storage->limit(1)->find($this, $fields, $isMaster)) {
                $this->setLoaded(true);
                return $this->initFromData($data);
            }
        }

        return null;
    }

    public function setLoaded($is = true) {
        $this->_isLoaded = $is;
        return $this;
    }

    public function save() {
        if ($this->_isLoaded)
            return $this->_storage->update($this);

        if ($this->id = $this->_storage->insert($this))
            return true;

        return false;
    }

    public function delete() {
        return $this->_storage->delete($this);
    }

    public function getStorageFields() {
        $fields = array();
        foreach ($this as $column => $value)
            if (strpos($column, '_') !== 0)
                $fields[$column] = $value;

        return $fields;
    }

    public function getStorageKey() {
        if ($this->_storage instanceof MySqlStorage)
            return $this->_getTable();

        return null;
    }

    public function getPrimaryKey() {
        return $this->id;
    }

    public function toArray() {
        return $this->getStorageFields();
    }

    /*
     * Загрузка связанных сущностей
     */
    public function loadRelated($object_name) {}

    protected abstract function _getTable();

}