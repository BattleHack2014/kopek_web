<?php
namespace Crm\Model\Feedback;

use Crm\Model\User\UserCollection;

use Crm\Model\Feedback\Feedback;
use Crm\Model\Feedback\Vote;
use Crm\Model\Feedback\Like;
use Crm\Model\Feedback\Comment;
use Crm\Model\CollectionModel;

class FeedbackCollection extends CollectionModel {

    protected function newModel($type = null) {
        switch ($type) {
            case Like::FEEDBACK_TYPE_ID:
                return new Like();

            case Comment::FEEDBACK_TYPE_ID:
                return new Comment();

            case Vote::FEEDBACK_TYPE_ID:
                return new Vote();
        }

        return new Feedback();
    }

    public function loadRelated($object_name) {
        if ($this->isEmpty())
            return $this;

        $userIds = array();
        foreach ($this as $object)
            $userIds[] = $object->campaign_user_id;

        $collection = new UserCollection();
        $collection->loadBy(array('id' => $userIds));

        foreach ($this as $object)
            foreach ($collection as $user)
                if ($object->campaign_user_id == $user->id)
                    $object->_user = $user;

        return $this;
    }

}