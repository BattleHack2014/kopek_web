<?php

namespace Tool;

class DateRange {

    public $start = null;
    public $end = null;

    public function __construct($range) {
        $this->start = current($range);
        $this->end = end($range);
    }
}