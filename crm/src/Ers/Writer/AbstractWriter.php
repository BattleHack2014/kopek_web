<?php

namespace Ers\Writer;

use Symfony\Component\Console\Helper\HelperSet;

/**
 * Абстрактный класс записи событий
 */
abstract class AbstractWriter {

	/**
	 * Количество дополнительных полей у события
	 * @var int
	 */
	protected $numExt = 6;

	/**
	 * Допустимые поля массива request
	 * @var array
	 */
	protected $requestFields = array(
	    'user_agent', 'os_client', 'ip_client',
		'referer', 'page_url', 'utm_source', 'session_referer', 'guest_id',
		'country_code', 'region_code', 'city', 'use_js'
    );

	/**
	 * Подготовка данных для записи события
	 * @param string $project Строковый идентификатор проекта
	 * @param string $event Строковый идентификатор события
	 * @param int $userId Системный идентификатор пользователя
	 * @param string $sessId Идентификатор сеанса пользователя
	 * @param array $request Массив параметров запроса
	 * @param array $params Дополнительные параметры события
	 */
	public function write($project, $event, $userId = NULL, $sessId, $request = array(), $params = array(), $current_date = null) {
		// Подготовка параметров request
		$this->prepareRequest($request);
		// Подготовка дополнительных параметров события
		$this->prepareParams($params);
		return $this->doWrite($project, $event, $userId, $sessId, $request, $params, $current_date);
	}

	/**
	 * Запись события
	 * @param string $project Строковый идентификатор проекта
	 * @param string $event Строковый идентификатор события
	 * @param int $userId Системный идентификатор пользователя
	 * @param string $sessId Идентификатор сеанса пользователя
	 * @param array $request Массив параметров запроса
	 * @param array $params Дополнительные параметры события
	 */
	abstract public function doWrite($project, $event, $userId = NULL, $sessId, $request = array(), $params = array(), $current_date = null);

	/**
	 * Подготовка дополнительных параметров события.
	 * @param array &$inParams
	 */
	protected function prepareParams(&$inParams) {
		$outParams = array();
		for ($i = 0; $i < $this->numExt; $i++) {
			$value = NULL;
			if (isset($inParams[$i]))
				$value = trim($inParams[$i]);

			$outParams[$i] = $value;
		}
		$inParams = $outParams;
	}

	/**
	 * Подготовка параметров request.
	 * @param array &$inRequest
	 */
	protected function prepareRequest(&$inRequest) {
		$outRequest = array();
		foreach ($this->requestFields as $field) {
			$value = NULL;
			if (isset($inRequest[$field])) {
				$value = trim($inRequest[$field]);
			}
			$outRequest[$field] = $value;
		}
		$inRequest = $outRequest;
	}
}