<?php
namespace Crm\Model\Feedback;

use \Crm\Model\Model;

class Vote extends Feedback {

    const FEEDBACK_TYPE_ID = 3;

    public function __construct(Storage $storage = null) {
        parent::__construct($storage);
        $this->feedback_type_id = self::FEEDBACK_TYPE_ID;
    }

}