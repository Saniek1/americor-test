<?php

namespace app\models\history\events\call;

use app\models\history\events\EventsInterface;
use app\models\history\History;
use Yii;

/**
 * This is the model class for table "{{%call}}".
 *
 *
 * @property Customer $customer
 * @property User $user
 */
class IncomingCall extends \app\models\Call implements EventsInterface
{

    public function renderFileName() : string
    {
        return 'call/call';
    }

    public function renderParams(History $model) : array
    {
        return [
            'user' => $model->user,
            'content' => $this->comment ?? '',
            'body' => $this->getBody($model),
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
        ];
    }

    public function getBody(History $model) : string
    {
        return (
            $this->totalStatusText ?
                $this->totalStatusText .
                ($this->getTotalDisposition(false) ?
                    " <span class='text-grey'>" . $this->getTotalDisposition(false) . "</span>" : ""
                ) : '<i>Deleted</i> '
        );
    }

    public function getEventText() : string
    {
        return Yii::t('app', 'Incoming call');
    }

}
