<?php

namespace app\models\history\events\task;

use app\models\history\events\EventsInterface;
use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 *
 * @property string $isInbox
 * @property string $statusText
 */
class CreatedTask extends \app\models\Task implements EventsInterface
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
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($this->customerCreditor->name) ? "Creditor: " . $this->customerCreditor->name : ''
        ];
    }

    public function getBody($model) : string
    {
         return "$this->eventText: " . ($this->title ?? '');
    }

    public function getEventText() : string
    {
        return Yii::t('app', 'Task createde');
    }
}
