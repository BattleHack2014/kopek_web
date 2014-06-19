<?php
namespace Crm\Model\Storage;

abstract class MySqlStorage implements Storage {

    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    protected $_select = array();
    protected $_order = '';
    protected $_limit = null;
    protected $_offset = null;

    /**
     * Будет ли использован SQL_CALC_FOUND_ROWS при запросах с LIMIT
     */
    private $_is_countable = false;

    /**
     * Был ли использован SQL_CALC_FOUND_ROWS при запросах с LIMIT
     */
    private $_was_countable = false;

    public function find(Record $record, array $fields, $isMaster = false) {
        $where_values = array();
        $where = '';
        if ($fields) {
            $parts = array();
            foreach ($fields as $column => $value) {
                if (is_array($value)) {
                    // Если массив id-шников пуст, мы сразу можем вернуть null
                    // т.к. этот метод работает только для WHERE ... AND ...
                    if (!$value)
                        return null;
                    $parts[] = $column . ' IN (' . implode(',', array_fill(0, count($value), '?')) . ') ';
                    $where_values = array_merge($where_values, $value);
                }
                else {
                    if ($value === null) {
                        $parts[] = $column . ' IS NULL ';
//                    } else if (preg_match('/([<>]{1})/i', $value, $match)) {
//                        $parts[] = $column . ' '. $match[1] . ' ? ';
//                        $where_values[] = $value;
                    } else {
                        $parts[] = $column . '= ? ';
                        $where_values[] = $value;
                    }
                }
            }
            $where = 'WHERE '.implode(' AND ', $parts);
        }
        $where_types = array();
        foreach ($where_values as $value) {
            if (is_int($value)) {
                $where_types[] = \PDO::PARAM_INT;
            } elseif (is_null($value)) {
                $where_types[] = \PDO::PARAM_NULL;
            } else {
                $where_types[] = \PDO::PARAM_STR;
            }
        }

        if ($isMaster)
            $connection = $this->getWriter();
        else
            $connection = $this->getReader();

        $stmt = $connection->executeQuery('
            ' . $this->getSelectSql() . '
            FROM ' . $record->getStorageKey() . '
            ' . $where . '
            ' . $this->_order . '
            ' . $this->getLimitSql(),
            $where_values,
            $where_types
        );


        if ($this->_limit && $this->_limit == 1) {
            if ($row = $stmt->fetch(\PDO::FETCH_OBJ))
                return $this->resetAndReturn($row);

        } else {
            if ($rows = $stmt->fetchAll(\PDO::FETCH_OBJ))
                return $this->resetAndReturn($rows);

        }

        return $this->resetAndReturn(null);
    }

    public function select(array $fields) {
        $this->_select = $fields;
        return $this;
    }

    public function order($field, $type = self::ORDER_ASC) {
        $this->_order = '';
        switch ($type) {
            case self::ORDER_ASC:
                $this->_order = 'ORDER BY ' . $field . ' ASC ';
                break;
            case self::ORDER_DESC:
                $this->_order = 'ORDER BY ' . $field . ' DESC ';
                break;
        }
        return $this;
    }

    public function orderMulti($fields) {
        if (!is_array($fields)) {
            return;
        }
        $this->_order = '';
        $sql = '';
        if (count($fields)) {
            $sql = 'ORDER BY ';
        }
        for ($i = 0; $i < count($fields); $i++) {
            $sql .= ($i > 0) ? ', ' : '';
            switch ($fields[$i]['type']) {
                case self::ORDER_ASC:
                    $sql .= $fields[$i]['field'] . ' ASC';
                    break;
                case self::ORDER_DESC:
                    $sql .= $fields[$i]['field'] . ' DESC';
                    break;
            }
        }
        $this->_order = $sql;
        return $this;
    }

    public function group($field) {

    }

    public function limit($limit, $offset = null, $_is_countable = false) {
        $this->_limit = $limit;
        $this->_offset = $offset;
        $this->_is_countable = $_is_countable;

        return $this;
    }

    public function count() {
        if ($this->_was_countable) {
            $this->_was_countable = false;
            return $this->getReader()->executeQuery('SELECT FOUND_ROWS() AS count;')->fetch(\PDO::FETCH_OBJ)->count;
        }

        return null;
    }

    public function insert(Record $record) {
        $columns = array();
        $markers = array();
        $values = array();

        foreach ($record->getStorageFields() as $column => $value) {
            $columns[] = '`' . $column . '`';
            $markers[] = '?';
            $values[] = $value;
        }

        $this->getWriter()->executeQuery('
            INSERT INTO '.$record->getStorageKey().'
            (' . implode(',', $columns) . ')
            VALUES (' . implode(',', $markers) . ')
            ',
            $values
        );

        $stmt = $this->getWriter()->executeQuery('SELECT LAST_INSERT_ID() as last_id');
        return $stmt->fetch(\PDO::FETCH_OBJ)->last_id;
    }

    public function update(Record $record) {
        $markers = array();
        $values = array();

        foreach ($record->getStorageFields() as $column => $value) {
            $markers[] = '`' . $column . '` = ?';
            $values[] = $value;
        }

        $values[] = $record->getPrimaryKey();

        $this->getWriter()->executeQuery('
            UPDATE '.$record->getStorageKey().'
            SET ' . implode(',', $markers) . '
            WHERE id = ?
            LIMIT 1',
            $values
        );

        return true;
    }

    public function delete(Record $record) {
        return $this->getWriter()->executeQuery('
            DELETE FROM '.$record->getStorageKey().'
            WHERE id = ?
            LIMIT 1',
            array($record->getPrimaryKey())
        );
    }

    private function getSelectSql() {
        $select = 'SELECT ';

        if ($this->_is_countable) {
            $select .= 'SQL_CALC_FOUND_ROWS ';
            $this->_was_countable = true;
        }

        if ($this->_select)
            $select .= implode(',', $this->_select);
        else
            $select .= '* ';

        return $select;
    }

    private function getLimitSql() {
        if (!$this->_limit && !$this->_offset)
            return '';

        $limit = 'LIMIT ';

        if ($this->_offset !== null)
            $limit .= $this->_offset . ', ';

        if ($this->_limit !== null)
            $limit .= $this->_limit;

        return $limit;
    }

    private function resetAndReturn($result) {
        $this->_select = array();
        $this->_limit = null;
        $this->_offset = null;
        $this->_is_countable = false;

        return $result;
    }
}