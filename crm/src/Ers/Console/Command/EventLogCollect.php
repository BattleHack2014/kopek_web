<?php
namespace Ers\Console\Command;

use Symfony\Component\Console\Input\InputInterface,
	Symfony\Component\Console\Output\OutputInterface,
	Symfony\Component\Console\Command\Command,
	Ers\Loger\AbstractLoger,
    Crm\Logic\Logic;

/**
 * Класс реализует задачу ETL-сборки событий из лог-файлов ERS-системы
 */
class EventLogCollect extends Command {

	private $_readers = array();

	/**
	 * (non-PHPdoc)
	 * @see Symfony\Component\Console\Command.Command::configure()
	 */
	protected function configure() {
		$this->setName('eventLogCollect');
		$this->setDescription('Collect events from log file');
	}

	/**
	 * (non-PHPdoc)
	 * @see Symfony\Component\Console\Command.Command::execute()
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
	    if(!defined('PROJECT')) define('PROJECT', $input->getOption('project'));
	    if(!defined('ENV')) define('ENV', $input->getOption('environment'));
	    // Парсим reader-ы из командной строки
	    $readers = array();
	    foreach($input->getArguments() as $type => $arg)
	        if (strpos($type, 'reader') !== false)
	            $readers[] = $arg;

		// Инициализация reader-ов заданных в командной строке
		$this->initReaders($readers, $input->getOption('date'));
	    // Прогоняем ридеры
		foreach ($this->_readers as $reader) {
		    $reader->doRead();
		}
	}

	private function initReaders($readers, $date) {
	    foreach ($readers as $reader) {
	        if ($config = Logic::getConfig('ers')->get('reader.' . $reader, null)) {
    	        $reader_class = '\\Ers\\Reader\\' . $config['class'];
    	        if ($date)
    	            $config['date'] = $date;

                $this->_readers[] = new $reader_class($config);
	        }
	    }
	}
}