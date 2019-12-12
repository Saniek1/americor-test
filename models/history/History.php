<?php

namespace app\models\history;

use app\models\Customer;
use app\models\history\events\Quality;
use app\models\history\events\Type;
use app\models\traits\ObjectNameTrait;
use app\models\User;
use app\models\history\events\call\IncomingCall;
use app\models\history\events\call\OutgoingCall;
use app\models\history\events\fax\IncomingFax;
use app\models\history\events\fax\OutgoingFax;
use app\models\history\events\sms\IncomingSms;
use app\models\history\events\sms\OutgoingSms;
use app\models\history\events\task\CompletedTask;
use app\models\history\events\task\CreatedTask;
use app\models\history\events\task\UpdatedTask;
use Yii;

/**
 * This is the model class for table "{{%history}}".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $customer_id
 * @property string $event
 * @property string $object
 * @property integer $object_id
 * @property string $message
 * @property string $detail
 * @property integer $user_id
 *
 * @property string $eventText
 *
 * @property Customer $customer
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    use ObjectNameTrait;

    const EVENT_CREATED_TASK = 'created_task';
    const EVENT_UPDATED_TASK = 'updated_task';
    const EVENT_COMPLETED_TASK = 'completed_task';

    const EVENT_INCOMING_SMS = 'incoming_sms';
    const EVENT_OUTGOING_SMS = 'outgoing_sms';

    const EVENT_INCOMING_CALL = 'incoming_call';
    const EVENT_OUTGOING_CALL = 'outgoing_call';

    const EVENT_INCOMING_FAX = 'incoming_fax';
    const EVENT_OUTGOING_FAX = 'outgoing_fax';

    const EVENT_CUSTOMER_CHANGE_TYPE = 'customer_change_type';
    const EVENT_CUSTOMER_CHANGE_QUALITY = 'customer_change_quality';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_ts'], 'safe'],
            [['customer_id', 'object_id', 'user_id'], 'integer'],
            [['event'], 'required'],
            [['message', 'detail'], 'string'],
            [['event', 'object'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ins_ts' => Yii::t('app', 'Ins Ts'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'event' => Yii::t('app', 'Event'),
            'object' => Yii::t('app', 'Object'),
            'object_id' => Yii::t('app', 'Object ID'),
            'message' => Yii::t('app', 'Message'),
            'detail' => Yii::t('app', 'Detail'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }



    /**
     * @param $attribute
     * @return null
     */
    public function getDetailChangedAttribute($attribute)
    {
        $detail = json_decode($this->detail);
        return isset($detail->changedAttributes->{$attribute}) ? $detail->changedAttributes->{$attribute} : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailOldValue($attribute)
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return isset($detail->old) ? $detail->old : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailNewValue($attribute)
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return isset($detail->new) ? $detail->new : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailData($attribute)
    {
        $detail = json_decode($this->detail);
        return isset($detail->data->{$attribute}) ? $detail->data->{$attribute} : null;
    }

    public function getEventFactory()
    {
        switch ($this->event) {
            case History::EVENT_CREATED_TASK:
                return new CreatedTask($this->task);
                break;
            case History::EVENT_COMPLETED_TASK:
                return new CompletedTask($this->task);
                break;
            case History::EVENT_UPDATED_TASK:
                return new UpdatedTask($this->task);
                break;
            case History::EVENT_INCOMING_SMS:
                return new IncomingSms($this->sms);
                break;
            case History::EVENT_OUTGOING_SMS:
                return new OutgoingSms($this->sms);
                break;
            case History::EVENT_OUTGOING_FAX:
                return new OutgoingFax($this->fax);
                break;
            case History::EVENT_INCOMING_FAX:
                return new IncomingFax($this->fax);
                break;
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return new Type();
                break;
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return new Quality();
                break;

            case History::EVENT_INCOMING_CALL:
                return new IncomingCall($this->call);
                break;
            case History::EVENT_OUTGOING_CALL:
                return new OutgoingCall($this->call);
                break;
        }
    }

}
