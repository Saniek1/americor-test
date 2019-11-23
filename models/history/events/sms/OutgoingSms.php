<?php

namespace app\models\history\events\sms;

use Yii;

/**
 * This is the model class for table "{{%sms}}".
 *
 *
 * @property Customer $customer
 * @property User $user
 */
class OutgoingSms extends IncomingSms
{

    public function getEventText() : string
    {
        return Yii::t('app', 'Outgoing message');
    }

}
