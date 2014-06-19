<?php

namespace Ers;

use Crm\Model\Model;
use Ers\EventParser as EP;
use Crm\Logic\Logic;

class UniqueUserEvents {

    /**
     * @var \Ers\UniqueUserEvents
     */
    private static $instance = null;

    private $_events = array();

    const SAVE_STEP = 10;

    const TABLE = 'stat_unique_user_events';

    /**
     * @return \Ers\UniqueUserEvents
     */
	final static public function getInstance()
	{
		if (self::$instance === null)
			self::$instance = new static();

		return self::$instance;
	}

    public function setLast($user_id, $event, $data) {
        if (isset($data[EP::_DATE]))
            $data[EP::_DATE] = date('Y-m-d', strtotime($data[EP::_DATE]));
        $this->_events[$user_id][EventParser::short(EP::_EVENT, $event)] = $data;

    }

    public function get($user_id, $event) {
        $stmt = Logic::getDbReader()->executeQuery('
            SELECT *
            FROM ' .self::TABLE. '
            WHERE user_id = ?
            LIMIT 1',
            array($user_id)
        );

        if (!$row = $stmt->fetch(\PDO::FETCH_OBJ))
            return null;

        $json = json_decode($row->last_events, true);
        $event = EP::short(EP::_EVENT, $event);
        if (isset($json[$event]))
            return $json[$event];

        return null;
    }

    public function save() {
        $isEnd = false;
        while (true) {
            // Запрашиваем юзеров из БД пачками, для уменьшения общего кол-ва запросов к БД
            $i = self::SAVE_STEP;
            $user_ids = array();
            while($i--) {
                if (!$event = each($this->_events)) {
                    $isEnd = true;
                    break;
                }
                $user_ids[] = $event['key'];
            }

            if (!$user_ids)
                break;

            $stm = Logic::getDbReader()->executeQuery("
                SELECT * FROM ".self::TABLE." WHERE user_id IN (".implode(',', $user_ids).");
            ");

            // Обновляем пачку юзеров
            foreach ($stm->fetchAll(\PDO::FETCH_OBJ) as $row) {
                $json = json_decode($row->last_events);
                foreach ($this->_events[$row->user_id] as $event => $data) {
                    $json->{$event} = $data;
                }

                // Формируем UPDATE запрос
                $stmt = Logic::getDbWriter()->prepare('UPDATE '.self::TABLE.' SET last_events = ? WHERE user_id = ?');
                $stmt->bindValue(1, json_encode($json));
                $stmt->bindValue(2, $row->user_id);
                $stmt->execute();

                // Подчищаем события которые существуют в БД и попадут под UPDATE запросы
                unset($this->_events[$row->user_id]);
            }

            if ($isEnd)
                break;
        }

        foreach ($this->_events as $user_id => $event) {
            $stmt = Logic::getDbWriter()->prepare('INSERT INTO '.self::TABLE.'  (`user_id`, `last_events`) VALUES (?,?)');
            $stmt->bindValue(1, $user_id);
            $stmt->bindValue(2, json_encode($event));
            $stmt->execute();
        }
    }
}