<?php

namespace app\models\history\events;

use Yii;

/**
 * This is the model class for table "{{%call}}".
 *
 *
 * @property Customer $customer
 * @property User $user
 */
class Call extends \app\models\Call implements EventsInterface
{

    public function renderFileName() : string
    {
        return '_item_common';
    }

    public function renderParams($model) : array
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

    public function getBody($model) : string
    {
        return (
            $this->totalStatusText ?
                $this->totalStatusText .
                ($this->getTotalDisposition(false) ?
                    " <span class='text-grey'>" . $this->getTotalDisposition(false) . "</span>" : ""
                ) : '<i>Deleted</i> '
        );
    }

}
