<?php

namespace app\models\history\events;

use app\models\Customer;
use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property string $isInbox
 * @property string $statusText
 */
class Type implements EventsInterface
{

    public function renderFileName() : string
    {
        return '_item_common';
    }

    public function renderParams($model) : array
    {
        return [
            'user' => $model->user,
            'body' => $this->getBody($model),
            'bodyDatetime' => $model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }

    public function getBody($model) : string
    {
         return
             "$model->eventText " .
             "<span class='tag'>" .
             (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "<i>not set</i>") .
             "</span>" .
             "<span class='arrow'></span>" .
             "<span class='tag'>" .
             (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "<i>not set</i>") .
             "</span>";
    }
}
