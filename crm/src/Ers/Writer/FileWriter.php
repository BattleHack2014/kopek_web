<?php

namespace Ers\Writer;

use Ers\EventParser;

use Crm\Model\User\User;

use Crm\Logic\Logic;
use Crm\Model\Statistic\Event\LoginEvent;
use Crm\Logic\Client\Vote;
use Crm\Logic\Client\Auth;

/**
 * Класс реализующий запись событий в файлы
 */
class FileWriter extends AbstractWriter {

	const PIPE_BUFF = 4096; // bytes

	private $_file_handler = null;

	/**
	 * (non-PHPdoc)
	 * @see Ers\Writer.AbstractWriter::doWrite()
	 * @throws \RuntimeException
	 */
	public function doWrite($project, $event, $userId = NULL, $sessId = null, $request = array(), $params = array(), $current_date = null) {
	    if (!$current_date)
	        $current_date = date('Y-m-d');

        // Открываем файл для записи
	    if ($this->_file_handler === null) {
    	    if (!$config = Logic::getConfig('ers')->get('writer.FileWriter')) {
    	        throw new \RuntimeException('ERS: file writer configuration is not specified');
    	    }
    	    if (!isset($config['path']) || !is_dir($config['path']) || !is_writable($config['path'])) {
    	        throw new \RuntimeException('ERS: file writer path is not specified or is not writable');
    	    }
    	    $dir = $config['path'] . DIRECTORY_SEPARATOR . $project;
    	    if (!is_dir($dir)) {
    	        mkdir ($dir, 0777, TRUE);
    	        if (!is_dir($dir))
    	            throw new \RuntimeException ( 'ERS: can`t create project dir for event log writer' );
    	    }
            chmod($dir, 0777);
    	    $this->_file_handler = fopen($dir . DIRECTORY_SEPARATOR . $current_date, 'a');
	    }

        $current_date .= date(' H:i:s');

	    $row = EventParser::createFileRow($project, $event, $userId, $sessId, $request, $params, $current_date);

        if (strlen($row) >= self::PIPE_BUFF)
            throw new \ErrorException ( 'ERS: log data length more then PIPE_BUFF' );

        if (!fwrite($this->_file_handler, $row , self::PIPE_BUFF))
            throw new \ErrorException ( 'ERS: can\'t write log' );

		return true;
	}
}
