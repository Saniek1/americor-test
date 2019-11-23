<?php

namespace app\models\history\events\fax;

use Yii;

/**
 * This is the model class for table "fax".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $user_id
 * @property integer $document_id
 * @property string $from
 * @property string $to
 * @property integer $status
 * @property integer $direction
 * @property string $error_message
 * @property string $twilio_sid
 * @property string $twilio_account_sid
 * @property string $twilio_direction
 * @property string $twilio_status
 * @property string $twilio_error_code
 * @property string $twilio_error_message
 * @property string $twilio_document_request_date
 * @property string $last_send_ts
 * @property integer $count_attempt_send
 * @property integer $type
 * @property string $typeText
 *
 * @property User $user
 */
class OutgoingFax extends IncomingFax
{

    public function getEventText() : string
    {
        return Yii::t('app', 'Outgoing fax');
    }


}
