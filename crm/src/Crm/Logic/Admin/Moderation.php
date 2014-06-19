<?php
namespace Crm\Logic\Admin;

use Crm\Model\Statistic\Event\ModerationEvent;

use Crm\Model\Admin\User\UserFactory;

use Crm\Model\Feedback\Comment;

use Crm\Model\Feedback\FeedbackCollection;
use Crm\Model\Moderated;

use Crm\Model\Feedback\Feedback;

use Crm\Model\Storage\MySqlStorage;
use Crm\Model\PromoObject\PromoObject;
use Crm\Model\PromoObject\Audio;
use Crm\Model\PromoObject\Photo;
use Crm\Model\PromoObject\Video;
use Crm\Model\PromoObject\Review;
use Crm\Model\PromoObject\PromoObjectCollection;
use Crm\Model\PaginatedCollectionDecorator;

use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Moderation extends AdminLogic {

    const PARAM_PER_PAGE = 'perPage';
    const PARAM_CURRENT_PAGE = 'currentPage';
    const PARAM_SORT_FIELD = 'sortField';
    const PARAM_SORT_DIRECTION = 'sortDirection';

    const PARAM_MEDIA_TYPE = 'mediaType';
    const PARAM_MODERATION_STATUS = 'moderationStatus';

    const PARAM_MODERATION_CONTENT_TYPE = 'moderationContentType';
    const PARAM_ID = 'id';

    protected function _preExecute() {
        parent::_preExecute();

        // Назначаем события
        $this->getEventDispatcher()->addListener(ModerationEvent::NAME, function (ModerationEvent $event) {
            $params = array();
            if ($event->action) $params[1] = $event->action;
            Logic::getErs()->doWrite(PROJECT, $event->getName(), 0, Logic::getSession()->getId(), array(), $params, Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    public function actionApprove() {
        $object = self::createContent($this->_param[self::PARAM_MODERATION_CONTENT_TYPE], $this->_param[self::PARAM_ID]);
        $object->approve();

        return new \stdClass();
    }

    public function actionReject() {
        $object = self::createContent($this->_param[self::PARAM_MODERATION_CONTENT_TYPE], $this->_param[self::PARAM_ID]);
        $object->reject();

        return new \stdClass();
    }

    /**
     * @param string $moderationType
     * @param int $contentId
     * @return \Crm\Model\Moderated
     */
    public static function createContent($moderationType, $contentId) {
        switch ($moderationType) {
            case PromoObject::MODERATION_TYPE:
                $object = new PromoObject();
                break;
            case Feedback::MODERATION_TYPE:
                $object = new Feedback();
                break;
        }

        $object->id = $contentId;
        return $object;
    }

    public function actionObjects() {
        if (!$this->_param[self::PARAM_MEDIA_TYPE])
            return array('items' => array(), 'totalRecords' => 0, 'currentPage' => 1);

        $collection = new PaginatedCollectionDecorator(new PromoObjectCollection());
        $collection->perPage = $this->_param[self::PARAM_PER_PAGE];
        $collection->currentPage = $this->_param[self::PARAM_CURRENT_PAGE];
        $collection->collection->_storage->order($this->_param[self::PARAM_SORT_FIELD], ($this->_param[self::PARAM_SORT_DIRECTION] == 1) ? MySqlStorage::ORDER_ASC : MySqlStorage::ORDER_DESC);
        $collection->loadBy(array(
            'campaign_id' => UserFactory::getInstance()->getCurrentUser()->current_campaign_id,
            'type_id' => $this->_param[self::PARAM_MEDIA_TYPE],
            'status' => Moderated::PENDING)
        );

        $result = array();
        foreach ($collection as $object) {
            /* @var $object PromoObject */
            $result[] = array(
                'id' => $object->id,
                'title' => $object->value_string,
                'text' => $object->value_text,
                'type' => $object->getTypeString(),
                'user' => $object->_user->name,
                'resource' => $object->getResource(),
                'preview' => $object->getPreview(),
                'date' => date('Y-m-d', strtotime($object->updated_at)),
                'status' => $object->status,
            );
        }

        return array('items' => $result, 'totalRecords' => $collection->count(), 'currentPage' => $collection->currentPage, 'mediaType' => $this->_param[self::PARAM_MEDIA_TYPE]);
    }

    public function actionComments() {
        $collection = new PaginatedCollectionDecorator(new FeedbackCollection());
        $collection->perPage = $this->_param[self::PARAM_PER_PAGE];
        $collection->currentPage = $this->_param[self::PARAM_CURRENT_PAGE];
        $collection->collection->_storage->order($this->_param[self::PARAM_SORT_FIELD], ($this->_param[self::PARAM_SORT_DIRECTION] == 1) ? MySqlStorage::ORDER_ASC : MySqlStorage::ORDER_DESC);
        try {
            $collection->loadBy(array(
                'campaign_id' => UserFactory::getInstance()->getCurrentUser()->current_campaign_id,
                'feedback_type_id' => Comment::FEEDBACK_TYPE_ID,
                'status' => $this->_param[self::PARAM_MODERATION_STATUS])
            );
        } catch (\PDOException $e) {
            return array();
        }

        $result = array();
        foreach ($collection as $object) {
            /* @var $object Feedback */
            $result[] = array(
                'id' => $object->id,
                'comment' => $object->value_text,
                'user' => $object->_user->name,
                'date' => date('Y-m-d', strtotime($object->created_at)),
                'status' => $object->status,
            );
        }

        return array('comments' => $result, 'totalRecords' => $collection->count(), 'currentPage' => $collection->currentPage);
    }

    public function actionGetTabs() {

        return array('available' => PromoObject::getAvailableTypes());
    }

    private function setDefaultPaginationParams($current_page, $per_page, $order_by, $sort_direction) {
        if (!isset($this->_param[self::PARAM_CURRENT_PAGE]))
            $this->_param[self::PARAM_CURRENT_PAGE] = $current_page;

        if (!isset($this->_param[self::PARAM_PER_PAGE]))
            $this->_param[self::PARAM_PER_PAGE] = $per_page;

        if (!isset($this->_param[self::PARAM_SORT_FIELD]))
            $this->_param[self::PARAM_SORT_FIELD] = $order_by;

        if (!isset($this->_param[self::PARAM_SORT_DIRECTION]))
            $this->_param[self::PARAM_SORT_DIRECTION] = $sort_direction;
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionComments':
                $this->setDefaultPaginationParams(1, 20, 'created_at', 0);

                switch ($this->_param[self::PARAM_SORT_FIELD]) {
                    case 'date':
                        $this->_param[self::PARAM_SORT_FIELD] = 'created_at';
                        break;
                }

                if (!isset($this->_param[self::PARAM_MODERATION_STATUS]))
                    $this->_param[self::PARAM_MODERATION_STATUS] = Moderated::PENDING;

                break;

            case 'actionObjects':
                // Тип объектов по умолчанию
                if (!isset($this->_param[self::PARAM_MEDIA_TYPE]) || !$this->_param[self::PARAM_MEDIA_TYPE]) {
                    foreach (PromoObject::getAvailableTypes() as $type => $is_available) {
                        if ($is_available) {
                            $this->_param[self::PARAM_MEDIA_TYPE] = $type;
                            break;
                        }
                    }
                } else {
                    $this->_param[self::PARAM_MEDIA_TYPE] = $this->_param[self::PARAM_MEDIA_TYPE];
                }

                $this->setDefaultPaginationParams(1, 8, 'updated_at', 0);
                break;
        }
    }

}