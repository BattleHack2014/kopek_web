<?php

namespace Ers\Reader;

use Ers\EventParser;
use Ers\Writer\FileWriter;
use Crm\Logic\Logic;

/**
 * Считывание событий из файла
 */
class FileReader extends AbstractReader {

	const PIPE_BUFF = 4096; // bytes

	public function read($date_range) {
	    $file_path = array();

	    // Определяем список файлов
	    foreach ($date_range as $date)
	        $file_path[] = Logic::getConfig('ers')->get('writer.FileWriter.path') . DIRECTORY_SEPARATOR . PROJECT . DIRECTORY_SEPARATOR . $date;

	    // Читаем файлы применяя все handler-ы
	    foreach ($file_path as $path) {
	        if (!file_exists($path))
	            continue;

	        $file_pointer = fopen($path, 'r');
    	    while ($row = fgetcsv($file_pointer, null, ';')) {
    	        $row = EventParser::parseFileRow($row);
	            foreach ($this->_handlers as $handler)
	                $handler->handleRow($row);
    	    }
    	    fclose($file_pointer);
	    }

	    // Сохраняем результат
	    foreach ($this->_handlers as $handler) {
	        $handler->pushData();

	        $handler->aggregate(self::PERIOD_DAY);

            // Если воскресенье
            if (date('N', $this->getStartTime()) == 7)
                $handler->aggregate(self::PERIOD_WEEK);

            // Если последний день месяца
            if (date('Y-m-t', $this->getStartTime()) == $this->getToday())
                $handler->aggregate(self::PERIOD_MONTH);
	    }

	}
}
