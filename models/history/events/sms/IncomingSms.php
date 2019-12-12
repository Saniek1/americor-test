<?php

namespace app\models\history\events\sms;

use app\models\history\events\EventsInterface;
use app\models\history\History;
use app\models\Sms;
use Yii;

/**
 * This is the model class for table "{{%sms}}".
 *
 *
 * @property Customer $customer
 * @property User $user
 */
class IncomingSms extends \app\models\Sms implements EventsInterface
{

    public function renderFileName() : string
    {
        return 'sms/sms';
    }

    public function renderParams(History $model) : array
    {
        return [
            'user' => $model->user,
            'body' => $this->getBody($model),
            'footer' => $this->direction == self::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $this->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $this->phone_to ?? ''
                ]),
            'iconIncome' => $this->direction == Sms::DIRECTION_INCOMING,
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];
    }

    public function getBody(History $model) : string
    {
        return $this->message ?? '';
    }

    public function getEventText() : string
    {
        return Yii::t('app', 'Incoming message');
    }

}
