<?php
namespace Crm\Logic;
use Crm\Model\Goal\Goal;
use Crm\Model\Goal\GoalMember;
use Tool\AdaptivePayments;

class Pay extends Logic {
    public function actionIndex() {
        if (!$this->getRequest()->get("goal_id", false)) {
            header("Location: ".$this->getConfig('config')->get('base_url')."/dashboard");
            exit;
        }

        $goal = new Goal();
        $goal->loadBy(['id'=> $this->getRequest()->get('goal_id')]);

        return array('goal'=>$goal);
    }

    public function actionProcess() {
        if (!$this->getRequest()->get("amount", false)) {
            header("Location: ".$this->getConfig('config')->get('base_url')."/pay?goal_id=".$this->getRequest()->get('goal_id'));
            exit;
        }

        $goalMember = new GoalMember();
        $goalMember->amount = $this->getRequest()->get("amount");
        $goalMember->date = date('Y-m-d H:i:s');
        $goalMember->goal_id = $this->getRequest()->get('goal_id');
        $goalMember->bid = GoalMember::BID_UNKNOWN;
        $goalMember->vote = GoalMember::VOTE_UNKNOWN;
        $goalMember->user_id = null; ///TODO: !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $goalMember->save();
        $goalMember->setLoaded();

        $paypal = new AdaptivePayments($this->getConfig('paypal')->get('conf'));
        $result = $paypal->call(
            array(
                'startingDate' => date('Y-m-d\TH:i:s\Z'),
                'maxTotalAmountOfAllPayments' => $this->getRequest()->get('amount', false),
                'currencyCode'  => 'EUR',
                'memo'  => 'Preapproval of '.$this->getRequest()->get('amount', false).' EUR',
                'cancelUrl' => '/pay/cancel?pay_id=' . $goalMember->id,
                'returnUrl' => '/pay/confirm?pay_id=' . $goalMember->id,
            ), "Preapproval"
        );

        if ($result['responseEnvelope']['ack'] == 'Success' ) {
            $goalMember->preapproval_key = $result['preapprovalKey'];
            $goalMember->save();
            $paypal->redirect($result);
        } else {
            header('Location: /goal/cancel');
        }
        exit;
    }

    public function actionCancel() {
        $goalMember = new GoalMember();
        $goalMember->loadBy(['id'=> $this->getRequest()->get('pay_id')]);
        $goalMember->bid = GoalMember::BID_NO;
        header('Location: /goal/list?pay=error');
        exit;
    }

    public function actionConfirm () {
        $goalMember = new GoalMember();
        $goalMember->loadBy(['id'=> $this->getRequest()->get('pay_id')]);
        $goalMember->bid = GoalMember::BID_YES;
        $goalMember->save();
        header('Location: /goal/list?pay=ok');
        exit;
    }
} 