<?php
namespace Crm\Logic\Admin;

use Crm\Model\Statistic\Handler\Handler;

use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Report extends Logic {

    const PARAM_FROM_DATE = 'dateFrom';
    const PARAM_TO_DATE = 'dateTo';
    const PARAM_REPORT_ID = 'report';
    const PARAM_GRANULARITY = 'groupBy';

    const OUTPUT_LIST = 'list';
    const OUTPUT_CUSTOM_GROUP_LABELS = 'customGroupLabels';
    const OUTPUT_REPORT_NAME = 'report'; // Этот параметр необходим для формирования названия csv файла

    const ERROR_NOT_FOUND_DB = 'Report not found';

    public function actionGet() {

        $report = new \Crm\Model\Statistic\Report();

        if (!$report->loadBy(array( 'id' => $this->_param[self::PARAM_REPORT_ID])))
            $this->error(self::STATUS_NOT_FOUND, self::ERROR_NOT_FOUND_DB);

        $report->setHandlerData(
            $this->_param[self::PARAM_FROM_DATE],
            $this->_param[self::PARAM_TO_DATE],
            $this->_param[self::PARAM_GRANULARITY]
        );

        if ($this->_type == 'csv') {
            $output[self::OUTPUT_REPORT_NAME] = $report->title; // Этот параметр необходим для формирования названия csv файла
        }

        $output[self::OUTPUT_LIST] = $report->load();
        $output[self::OUTPUT_CUSTOM_GROUP_LABELS] = $report->getCustomGroupLabels();
        return $output;
    }

    public function actionGetAnswer()
    {
        $report = new \Crm\Model\Statistic\Report();


        if (!$report->loadBy(array( 'id' => $this->_param[self::PARAM_REPORT_ID])))
            $this->error(self::STATUS_NOT_FOUND, self::ERROR_NOT_FOUND_DB);

        $report->setHandlerData(false, false, false);
        if ($this->_type == 'csv') {
            $output[self::OUTPUT_REPORT_NAME] = $report->title; // Этот параметр необходим для формирования названия csv файла
        }

        $output[self::OUTPUT_LIST] = $report->load();
        return $output;
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        $errors = array();
        switch($this->_action) {
            case 'actionGet':
                // Не обязательный параметр
                if (!isset($this->_param[self::PARAM_GRANULARITY]))
                    $this->_param[self::PARAM_GRANULARITY] = Handler::GRANULARITY_DAY;

                $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection(array(
                    self::PARAM_FROM_DATE => array(
                        new Assert\NotBlank(),
                        new Assert\Date(),
                    ),
                    self::PARAM_TO_DATE => array(
                        new Assert\NotBlank(),
                        new Assert\Date(),
                    ),
                    self::PARAM_REPORT_ID => array(
                        new Assert\NotBlank(),
                        new Assert\Type(array('type' => 'numeric')),
                    ),
                    self::PARAM_GRANULARITY => array(
                        new Assert\Choice(array('day', 'week', 'month'))
                    ),
                )));
                break;
            case 'actionGetAnswer':
                $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection(array(
                        self::PARAM_REPORT_ID => array(
                            new Assert\NotBlank(),
                            new Assert\Type(array('type' => 'numeric')),
                        ),
                    )));
                break;
        }
        foreach ($errors as $error)
            $this->error(self::STATUS_VALIDATION_FAILED, $error->getPropertyPath() . ' - ' . $error->getMessage());
    }
}