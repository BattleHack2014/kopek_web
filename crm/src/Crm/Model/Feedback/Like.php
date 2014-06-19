<?php
namespace Crm\Model\Feedback;

use \Crm\Model\Model;

class Like extends Feedback {

    const FEEDBACK_TYPE_ID = 1;

    public function __construct($storage = null) {
        parent::__construct($storage);

        $this->feedback_type_id = self::FEEDBACK_TYPE_ID;
    }

}