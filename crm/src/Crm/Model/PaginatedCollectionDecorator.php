<?php
namespace Crm\Model;

use \Crm\Logic\Logic;

class PaginatedCollectionDecorator implements \IteratorAggregate {

    /**
     * @var CollectionModel
     */
    public $collection = null;
    public $perPage = 10;
    public $currentPage = 1;

    protected $count = 0;

    public function __construct(CollectionModel $collection) {
        $this->collection = $collection;
    }

    public function loadBy(array $fields) {
        $this->collection->_storage->limit($this->perPage, $this->perPage * ($this->currentPage - 1), true);

        $this->collection->loadBy($fields);

        // Подсчет общего количества для MYSQL возможен только сразу после запроса (SQL_CALC_FOUND_ROWS)
        $this->count = $this->collection->_storage->count();

        // Если была передана неверная currentPage, то ищем верную
        if ($this->currentPage > 1 && $this->collection->isEmpty()) {
            $this->currentPage = ceil($this->count / $this->perPage);
            $this->collection->_storage->limit($this->perPage, $this->perPage * ($this->currentPage - 1), true);
            $this->collection->loadBy($fields);
        }

        $this->collection->loadRelated('user');

        return $this;
    }

    public function toArray() {
        return $this->collection->toArray();
    }

    public function count() {
        return $this->count;
    }

    public function getIterator() {
        return $this->collection->getIterator();
    }
}