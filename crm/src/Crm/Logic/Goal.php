<?php
namespace Crm\Logic;

use Tool\AdaptivePayments;

class Goal extends Logic {
    public function actionIndex() {
        return array();
    }

    public function actionCreate () {
        return array();
    }

    public function actionSave() {
        foreach (['amount','title','description','start','finish','submit'] as $key) {
            if (!$this->getRequest()->get($key, false)) {
                header("Location: ".$this->getConfig('config')->get('base_url')."/goal/create");
                exit;
            }
        }

        $goal = new \Crm\Model\Goal\Goal();
        $goal->title = $this->getRequest()->get('title');
        $goal->description = $this->getRequest()->get('description');
        $goal->start_date = $this->getRequest()->get('start');
        $goal->expiration_date = $this->getRequest()->get('finish');
        $goal->amount = $this->getRequest()->get('amount');
        $goal->status = \Crm\Model\Goal\Goal::STATUS_NEW;
        $goal->user_id = null;//TODO: !11111111111111111111111111111111111111111111111111
        $goal->is_paid = 0;
        if (!$goal->save()) {
            header('Location: /goal/cancel');
            exit;
        }
        $goal->setLoaded();

        $paypal = new AdaptivePayments($this->getConfig('paypal')->get('conf'));
        $result = $paypal->call(
            array(
                'startingDate' => date('Y-m-d\TH:i:s\Z'),
                'maxTotalAmountOfAllPayments' => $this->getRequest()->get('amount', false),
                'currencyCode'  => 'EUR',
                'memo'  => 'Preapproval of '.$this->getRequest()->get('amount', false).' EUR',
                'cancelUrl' => '/goal/cancel?goal_id='.$goal->id,
                'returnUrl' => '/goal/confirm?goal_id='.$goal->id
            ), "Preapproval"
        );

        if ($result['responseEnvelope']['ack'] == 'Success' ) {
            $goal->preapproval_key = $result['preapprovalKey'];
            $goal->save();
            $paypal->redirect($result);
        } else {
            header('Location: /goal/cancel');
        }
        exit;
    }

    public function actionConfirm() {
        //TODO: check user id!!
        $goal = new \Crm\Model\Goal\Goal();
        $goal->loadBy(['id'=> $this->getRequest()->get('goal_id')]);
        $goal->status = \Crm\Model\Goal\Goal::STATUS_DRAFT;
        $goal->save();
        header('Location: /goal/list?create=ok');
        exit;
    }
    public function actionCancel() {
        //TODO: check user id!!
        if ($this->getRequest()->get('goal_id', false)) {
            header('Location: /goal/list?create=error');
            exit;
        }
        $goal = new \Crm\Model\Goal\Goal();
        $goal->loadBy(['id'=> $this->getRequest()->get('goal_id')]);
        $goal->status = \Crm\Model\Goal\Goal::STATUS_CANCELED;
        $goal->save();
        header('Location: /goal/list?create=error');
        exit;
    }

    public function actionList() {

        return array('create'=>$this->getRequest()->get('create', false), 'pay'=>$this->getRequest()->get('pay', false));
    }
}