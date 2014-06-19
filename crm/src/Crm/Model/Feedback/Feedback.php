<?php
namespace Crm\Model\Feedback;

use \Crm\Model\Model;
use \Crm\Model\Moderated;
use Crm\Model\User\User;

class Feedback extends Model implements Moderated {

    const MODERATION_TYPE = 'feedback';

    const TABLE_PROMO_CAMPAIGN_USER_FEEDBACK = 'promo_campaign_user_feedback';

    public $id;
    public $campaign_id;
    public $object_id;
    public $feedback_type_id;
    public $parent_id;
    public $imhonet_user_id;
    public $user_key;
    public $value_text;
    public $status;
    public $created_at;

    /**
     * @var User
     */
    public $_user;

    public function __construct($storage = null) {
        parent::__construct($storage);

        $this->status = Moderated::PENDING;
    }

    public function approve() {
        if (!isset($this->id))
            return false;

        $this->loadBy(array('id' => $this->id));
        $this->status = Moderated::APPROVED;
        return $this->save();
    }

    public function reject() {
        if (!isset($this->id))
            return false;

        $this->loadBy(array('id' => $this->id));
        $this->status = Moderated::REJECTED;
        return $this->save();
    }

    public function toArray() {
        $result = parent::toArray();

        if (isset($this->_user))
            $result['user'] = $this->_user->toArray();

        return $result;
    }

    protected function _getTable() {
        return self::TABLE_PROMO_CAMPAIGN_USER_FEEDBACK;
    }
}