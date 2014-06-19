<?php

namespace Ers;

use Symfony\Component\Console\Input\ArgvInput;

use Crm\Logic\Logic;
use Config\Config;
use Symfony\Component\Console\Helper\HelperSet;
use Ers\Helper\ConfigHelper;
use Ers\Helper\LogHelper;
use Ers\Loger\SysLoger;
use Ers\Console\Console;

/**
 * Базовый класс ERS-библиотеки.
 */
class Ers {

	/**
	 * Экземпляр библиотеки
	 * @var \Ers\Ers
	 */
	private static $instance = null;

	/**
	 * Запись события.
	 *
	 * @param string $project
	 * @param string $event
	 * @param int $userId
	 * @param string $sessId
	 * @param array $request
	 * @param array $params
	 */
	public function doWrite($project, $event, $userId = null, $sessId = null, $request = array(), $params = array(), $current_date = null) {
		if ($this->isEnable()) {
			$writers = Logic::getConfig('ers')->get('writer');
			foreach (array_keys($writers) as $writerName) {
				$writerClass = '\Ers\Writer\\' . ucfirst($writerName);
				if (class_exists($writerClass)) {
					try {
						$writer = new $writerClass();
						$writer->write($project, $event, $userId, $sessId, $request, $params, $current_date);
					} catch (\Exception $e) {
					    throw new \RuntimeException('ERS: error registrate event. Error: ' . $e->getMessage());
					}
				}
			}
		}
	}

	/**
	 * Запуск консоли библиотеки
	 *
	 */
	public function doCli() {
		Console::run();
	}

	/**
	 * Возвращает признак, разрешена запись событий или нет
	 *
	 */
	public function isEnable() {
		return Logic::getConfig('ers')->get('general.enable');
	}

    /**
     * Получение проинициализированного экземпляра библиотеки
     *
     * @return \Ers\Ers
     */
	final static public function getInstance()
	{
		if (self::$instance === null)
			self::$instance = new static();

		return self::$instance;
	}

	/**
	 * Статичная обертка для doWrite
	 *
	 * @param string $project
	 * @param string $event
	 * @param int $userId
	 * @param string $sessId
	 * @param array $request
	 * @param array $params
	 */
	public static function write($project, $event, $userId = NULL, $sessId, $request = array(), $params = array()) {
		return self::getInstance()->doWrite($project, $event, $userId, $sessId, $request, $params);
	}
}