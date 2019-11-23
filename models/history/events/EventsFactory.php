<?php
namespace app\models\history\events;


use app\models\history\events\call\IncomingCall;
use app\models\history\events\call\OutgoingCall;
use app\models\history\events\fax\IncomingFax;
use app\models\history\events\fax\OutgoingFax;
use app\models\history\events\sms\IncomingSms;
use app\models\history\events\sms\OutgoingSms;
use app\models\history\events\task\CompletedTask;
use app\models\history\events\task\CreatedTask;
use app\models\history\events\task\UpdatedTask;
use app\models\history\History;

class EventsFactory
{

    public static function factory($model)
    {
        switch ($model->event) {
            case History::EVENT_CREATED_TASK:
                return new CreatedTask($model->task);
                break;
            case History::EVENT_COMPLETED_TASK:
                return new CompletedTask($model->task);
                break;
            case History::EVENT_UPDATED_TASK:
                return new UpdatedTask($model->task);
                break;
            case History::EVENT_INCOMING_SMS:
                return new IncomingSms($model->sms);
                break;
            case History::EVENT_OUTGOING_SMS:
                return new OutgoingSms($model->sms);
                break;
            case History::EVENT_OUTGOING_FAX:
                return new OutgoingFax($model->fax);
                break;
            case History::EVENT_INCOMING_FAX:
                return new IncomingFax($model->fax);
                break;
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return new Type();
                break;
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return new Quality();
                break;

            case History::EVENT_INCOMING_CALL:
                return new IncomingCall($model->call);
                break;
            case History::EVENT_OUTGOING_CALL:
                return new OutgoingCall($model->call);
                break;
        }
    }

}