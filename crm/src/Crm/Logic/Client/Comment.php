<?php
namespace Crm\Logic\Client;

use Crm\Model\Feedback\Comment as CommentModel;

use Crm\Logic\Logic;
use Crm\Model\Feedback\FeedbackCollection;
use Crm\Model\PaginatedCollectionDecorator;
use Crm\Model\Statistic\Event\UserEvent;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;
use Crm\Model\Moderated;

class Comment extends AuthLogic {

    const EVENT_ADD = 'comment.add';
    const PARAM_COMMENT_TEXT = 'commentText';

    protected function _preExecute() {
        parent::_preExecute();

        $this->initDefaultUserEvent(self::EVENT_ADD);

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_ADD, function (Event $event) {
            Logic::getErs()->doWrite(PROJECT, Comment::EVENT_ADD, $event->user->id, Logic::getSession()->getId(), array(), array(), Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    /**
     * Пользователь голосует за работу
     */
    public function actionAdd() {

        // Оповещаем о событии
        $this->getEventDispatcher()->dispatch(self::EVENT_ADD, $this->_user_event);

        $feedback = new CommentModel();
        $feedback->campaign_id = CAMPAIGN_ID;
        $feedback->object_id = 1;
        $feedback->parent_id = 1;
        $feedback->campaign_user_id = $this->_user->id;
        $feedback->imhonet_user_id = 1;
        $feedback->created_at = date('Y-m-d');
        $feedback->user_key = 'key';
        $feedback->value_text = $this->_param[self::PARAM_COMMENT_TEXT];
        $feedback->save();

        return 'nice';
    }

    public function actionGet() {
        $collection = new PaginatedCollectionDecorator(new FeedbackCollection());
//        $collection->perPage = $this->_param[self::PARAM_PER_PAGE];
//        $collection->currentPage = $this->_param[self::PARAM_CURRENT_PAGE];
        $collection->loadBy(array(
            'campaign_id' => CAMPAIGN_ID,
            'feedback_type_id' => \Crm\Model\Feedback\Comment::FEEDBACK_TYPE_ID,
            'status' => Moderated::APPROVED,
        ));

        return array('comments' => $collection->toArray(), 'totalRecords' => $collection->count(), 'currentPage' => $collection->currentPage);
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionAdd':
                break;
        }
    }
}