<?php
namespace Ers\Reader\Handler;

use Ers\Reader\AbstractReader;

use Crm\Logic\Client\Like;
use Crm\Model\Feedback\Feedback;
use Ers\EventParser as EP;
use Crm\Logic\Logic;
use Crm\Model\User\User;

class TestsResults extends AbstractHandler {

    const RESULT_0_10 = '0-10 правильных ответов';
    const RESULT_11_30 = '11-30 правильных ответов';
    const RESULT_31_50 = '31-50 правильных ответов';

    private $_results = array(
        self::RESULT_0_10 => 11,
        self::RESULT_11_30 => 31,
        self::RESULT_31_50 => 51,
    );

    const TABLE = 'stat_report_tests_results';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach ($this->_available_periods as $period)
            $this->_data[$period] = array();
    }

    public function handleRow($row) {
    }

    public function pushData() {
    }

    public function aggregate($period) {
    }

    protected function getTable() { return self::TABLE; }

}