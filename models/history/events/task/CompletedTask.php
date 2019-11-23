<?php

namespace app\models\history\events\task;

use app\models\history\HistoryEventsInterface;
use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 *
 * @property string $isInbox
 * @property string $statusText
 */
class CompletedTask extends CreatedTask
{
    public function getEventText() : string
    {
        return Yii::t('app', 'Task createde');
    }
}
