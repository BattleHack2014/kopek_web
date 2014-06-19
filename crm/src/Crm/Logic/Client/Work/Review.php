<?php
namespace Crm\Logic\Client\Work;

use Crm\Logic\Client;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;

class Review extends Client\Work
{

    const PARAM_TITLE = 'title';
    const PARAM_TEXT = 'text';

    const TITLE_MIN_LENGTH = 1;
    const TITLE_MAX_LENGTH = 30;
    const TEXT_MIN_LENGTH = 1;
    const TEXT_MAX_LENGTH = 3000;

    public function actionAdd()
    {
        if (!$this->_user)
            $this->error(self::STATUS_FORBIDDEN, 'Только зарегистрированный пользователь может оставить отзыв');

        $review = new \Crm\Model\PromoObject\Review();
        if ($review->loadBy(array(
            'campaign_id'=>CAMPAIGN_ID,
            'campaign_user_id' => $this->_user->id
        ))) {
            $this->error(self::STATUS_ALREADY_EXISTS, 'Вы уже отправили отзыв');
        }

        $review->campaign_id = CAMPAIGN_ID;
        $review->campaign_user_id = $this->_user->id;
        $review->parent_id = 1;

        //TODO ?
        $review->value_int = 0;
        $review->value_string = $this->_param[self::PARAM_TITLE];
        $review->value_text = $this->_param[self::PARAM_TEXT];
        $review->status = \Crm\Model\Moderated::PENDING;
        $review->created_at = date('Y-m-d H:i:s');
        $review->updated_at = date('Y-m-d H:i:s');
        $review->save();

        Logic::getErs()->doWrite(PROJECT, 'send_essay', $this->_user->id, Logic::getSession()->getId(), array(), array($review->id));

        // ratings
//        foreach(array(1,2,3) as $productId){
//            if($request->has('product_rating_' . $productId)){
//                $rating = $request->get('product_rating_' . $productId);
//                if(!empty($rating)){
//                    $this->addRating($productId, $rating);
//                }
//                unset($rating);
//            }
//        }

        return true;
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch ($this->_action) {
            case 'actionAdd':

                $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection(array(
                    self::PARAM_TITLE => array(
                        new Assert\NotBlank(array(
                            'message' => 'Значение не должно быть пустым'
                        )),
                        new Assert\Length(
                            array(
                                'min' => self::TITLE_MIN_LENGTH,
                                'max' => self::TITLE_MAX_LENGTH,
                                'maxMessage' => 'Тема должна быть не более {{ limit }} символов',
                                'minMessage' => 'Тема должна быть не менее {{ limit }} символа',
                            )
                        )
                    ),
                    self::PARAM_TEXT => array(
                        new Assert\NotBlank(array(
                            'message' => 'Значение не должно быть пустым'
                        )),
                        new Assert\Length(
                            array(
                                'min' => self::TITLE_MIN_LENGTH,
                                'max' => self::TITLE_MAX_LENGTH,
                                'maxMessage' => 'Текст должен быть не более {{ limit }} символов',
                                'minMessage' => 'Текст должен быть не менее {{ limit }} символа',
                            )
                        )
                    ),
                )));

                foreach ($errors as $error)
                    $this->error(self::STATUS_VALIDATION_FAILED, $error->getPropertyPath() . ' - ' . $error->getMessage());
                break;
        }
    }

}