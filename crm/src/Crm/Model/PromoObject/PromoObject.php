<?php
namespace Crm\Model\PromoObject;

use Crm\Model\Statistic\Event\EventFactory;

use Crm\Model\Statistic\Event\LikeEvent;
use Crm\Model\Statistic\Event\ModerationEvent;

use Crm\Logic\Admin\Moderation;

use Crm\Logic\Logic;

use Crm\Model\Moderated;

use Crm\Model\User\User;

use Crm\Model\Model;

class PromoObject extends Model implements Moderated {

    const MODERATION_TYPE = 'object';

    const TABLE_PROMO_CAMPAIGN_USER_OBJECT = 'promo_campaign_user_object';

    const ERROR_NOT_FOUND = 'Промо работа не найдена';

    public $id;
    public $campaign_id;
    public $campaign_user_id;
    public $type_id;
    public $parent_id;
    public $value_int;
    public $value_string;
    public $value_text;
    public $status;
    public $created_at;
    public $updated_at;
    public $like_vk = 0;
    public $like_fb = 0;
    public $like_total = 0;

    /**
     * @var User
     */
    public $_user = null;

    public function getTypeString() {}

    public function getResource() {}

    public function getPreview() {}

    public function approve() {
        return $this->moderate(Moderated::APPROVED, ModerationEvent::ACTION_APPROVE);
    }

    public function reject() {
        return $this->moderate(Moderated::REJECTED, ModerationEvent::ACTION_REJECT);
    }

    private function moderate($status, $event_action) {
        if (!isset($this->id))
            return false;

        $this->loadBy(array('id' => $this->id));

        // Не стоит вызывать событие, если реально ничего не изменилось
        $dispatchEvent = false;
        if ($this->status != $status) {
            $this->status = $status;
            $dispatchEvent = true;
        }

        if ($this->save()) {
            if ($dispatchEvent) {
                $event = EventFactory::createDefaultEvent(new ModerationEvent());
                $event->action = $event_action;
                Logic::getEventDispatcher()->dispatch($event->getName(), $event);
            }
            return true;
        }
        return false;
    }

    public function incrementLike($social) {
        switch($social) {
            case 'fb':
                $this->_storage->getWriter()->executeQuery('UPDATE ' . $this->_getTable() . ' SET like_fb = like_fb + 1, like_total = like_fb + like_vk WHERE id=' . $this->id);
                break;
            case 'vk':
                $this->_storage->getWriter()->executeQuery('UPDATE ' . $this->_getTable() . ' SET like_vk = like_vk + 1, like_total = like_fb + like_vk WHERE id=' . $this->id);
                break;
        }
    }

    public function decrementLike($social) {
        switch($social) {
            case 'fb':
                $this->_storage->getWriter()->executeQuery('UPDATE ' . $this->_getTable() . ' SET like_fb = like_fb - 1, like_total = like_fb + like_vk WHERE id=' . $this->id);
                break;
            case 'vk':
                $this->_storage->getWriter()->executeQuery('UPDATE ' . $this->_getTable() . ' SET like_vk = like_vk - 1, like_total = like_fb + like_vk WHERE id=' . $this->id);
                break;
        }
    }

    public static function getAvailableTypes(){
        $stmt = Logic::getDbReader()->executeQuery('SELECT type_id FROM ' . self::TABLE_PROMO_CAMPAIGN_USER_OBJECT . ' GROUP BY type_id LIMIT 4');
        $result = array(
            'p' => false,
            'v' => false,
            'a' => false,
            't' => false,
        );
        foreach ($stmt->fetchAll(\PDO::FETCH_OBJ) as $row)
            $result[$row->type_id] = true;

        return $result;
    }

    protected function _getTable() {
        return self::TABLE_PROMO_CAMPAIGN_USER_OBJECT;
    }
}
