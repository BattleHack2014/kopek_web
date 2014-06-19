<?php
namespace Crm\Logic\Client;

use Crm\Model\Moderated;

use Crm\Model\PromoObject\PromoObject;
use Crm\Model\PromoObject\PromoObjectCollection;
use Crm\Model\PaginatedCollectionDecorator;

use Crm\Model\Storage\MySqlStorage;
use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Work extends AuthLogic {

    const EVENT_ADD = 'work.add';

    const PARAM_PER_PAGE = 'perPage';
    const PARAM_CURRENT_PAGE = 'currentPage';
    const PARAM_SORT_FIELD = 'sortField';
    const PARAM_SORT_FIELDS = 'sortFields';
    const PARAM_SORT_DIRECTION = 'sortDirection';

    protected function _preExecute() {
        parent::_preExecute();

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_ADD, function (Event $event) {
            Logic::getErs()->doWrite(PROJECT, Work::EVENT_ADD, $event->user->id, Logic::getSession()->getId(), array(), array(), Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    protected function preSave() {}

    public function actionAdd() {
        $object = new PromoObject();
        $object->campaign_id = CAMPAIGN_ID;
        $object->campaign_user_id = $this->_user->id;
        $object->parent_id = 1;
        if ($type_id = $this->_param['type_id']) {
            $object->type_id = $type_id;
        } else {
            //TODO: продумать схему кодов exceptions
            $this->error(1);
        }
        if ($value_int = $this->_param['value_int']) {
            $object->value_int = (int)$value_int;
        }
        if ($value_string = $this->_param['value_string']) {
            $object->value_string = $value_string;
        }
        if ($value_text = $this->_param['value_text']) {
            $object->value_text = $value_text;
        }
        $object->status = Moderated::PENDING;
        $object->created_at = date('Y-m-d H:i:s');
        $object->updated_at = date('Y-m-d H:i:s');
        $this->preSave($object);
        $object->save();

        return 'nice';
    }

    public function actionGet() {
        $collection = new PaginatedCollectionDecorator(new PromoObjectCollection());
        $collection->perPage = $this->_param[self::PARAM_PER_PAGE] ? $this->_param[self::PARAM_PER_PAGE] : $collection->perPage;
        $collection->currentPage = $this->_param[self::PARAM_CURRENT_PAGE] ? $this->_param[self::PARAM_CURRENT_PAGE] : $collection->currentPage;

        if (isset($this->_param[self::PARAM_SORT_FIELD])) {
            $collection->collection->_storage->order($this->_param[self::PARAM_SORT_FIELD], ($this->_param[self::PARAM_SORT_DIRECTION] == 1) ? MySqlStorage::ORDER_ASC : MySqlStorage::ORDER_DESC);
        }
        if (isset($this->_param[self::PARAM_SORT_FIELDS])) {
            $collection->collection->_storage->orderMulti($this->_param[self::PARAM_SORT_FIELDS]);
        }
        $collection->loadBy(array(
                'campaign_id' => CAMPAIGN_ID,
                'status' => array(Moderated::APPROVED, Moderated::PENDING))
        );
        $result = array();
        foreach ($collection as $object) {
            /* @var $object PromoObject */
            $result[] = array(
                'id' => $object->id,
                'title' => $object->value_string,
                'type' => $object->getTypeString(),
                'user' => $object->_user->name,
                'user_id' => $object->_user->id,
                'imhonet_user_id' => $object->_user->imhonet_user_id,
                'avatar' => ($object->_user->avatar == '') ? \Crm\Model\User\User::AVATAR_DEFAULT : $object->_user->avatar,
                'rating' => $object->value_int,
                'text' => $object->value_text,
                'resource' => $object->getResource(),
                'preview' => $object->getPreview(),
                'date' => date('Y-m-d', strtotime($object->updated_at)),
                'status' => $object->status,
            );
        }

        return array('items' => $result, 'totalRecords' => $collection->count(), 'currentPage' => $collection->currentPage);

    }
}