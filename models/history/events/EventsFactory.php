<?php
namespace app\models\history\events;


use app\models\history\History;

class EventsFactory
{

    public static function factory($model)
    {
        switch ($model->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                return new Task($model->task);
                break;
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return new Sms($model->sms);
                break;
            case History::EVENT_OUTGOING_FAX:
            case History::EVENT_INCOMING_FAX:
                return new Fax($model->fax);
                break;
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return new Type();
                break;
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return new Quality();
                break;

            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                return new Call($model->call);
                break;
        }
    }

}