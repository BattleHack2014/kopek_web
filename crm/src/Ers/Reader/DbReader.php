<?php

namespace Ers\Reader;

use Symfony\Component\Console\Helper\HelperSet;
use Crm\Logic\Logic;
use Crm\Logic\Client\Vote;

/**
 * Считывание события из БД
 */
class DbReader extends AbstractReader {

	public function read($date_range) {
	    // Нет промежутка дат, нет мультиков
	    if (!$date_range)
	        return;

	    sort($date_range);

        foreach ($this->_handlers as $handler) {
            foreach ($rows = $handler->getDbData(current($date_range), end($date_range)) as $row) {
                $handler->handleDbRow($row);
            }

            $handler->pushDbData();
        }
	}
}
