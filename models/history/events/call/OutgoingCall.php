<?php

namespace app\models\history\events\call;

use Yii;

/**
 * This is the model class for table "{{%call}}".
 *
 *
 * @property Customer $customer
 * @property User $user
 */
class OutgoingCall extends IncomingCall
{

    public function getEventText() : string
    {
        return Yii::t('app', 'Outgoing call');
    }

}
