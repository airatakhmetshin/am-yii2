<?php

namespace app\models;

use app\enums\CallDirectionEnum;
use app\enums\CallStatusEnum;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%call}}".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $direction
 * @property integer $user_id
 * @property integer $customer_id
 * @property integer $status
 * @property string $phone_from
 * @property string $phone_to
 * @property string $comment
 *
 * -- magic properties
 * @property string $statusText
 * @property string $directionText
 * @property string $totalStatusText
 * @property string $totalDisposition
 * @property string $durationText
 * @property string $fullDirectionText
 * @property string $client_phone
 *
 * @property Customer $customer
 * @property User $user
 */
class Call extends ActiveRecord
{
    public $duration = 720;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%call}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_ts'], 'safe'],
            [['direction', 'phone_from', 'phone_to', 'type', 'status', 'viewed'], 'required'],
            [['direction', 'user_id', 'customer_id', 'type', 'status'], 'integer'],
            [['phone_from', 'phone_to', 'outcome'], 'string', 'max' => 255],
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
            'ins_ts' => Yii::t('app', 'Date'),
            'direction' => Yii::t('app', 'Direction'),
            'directionText' => Yii::t('app', 'Direction'),
            'user_id' => Yii::t('app', 'User ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'status' => Yii::t('app', 'Status'),
            'statusText' => Yii::t('app', 'Status'),
            'phone_from' => Yii::t('app', 'Caller Phone'),
            'phone_to' => Yii::t('app', 'Dialed Phone'),
            'user.fullname' => Yii::t('app', 'User'),
            'customer.name' => Yii::t('app', 'Client'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getClient_phone(): string
    {
        return $this->direction === CallDirectionEnum::DIRECTION_INCOMING
            ? $this->phone_from
            : $this->phone_to;
    }

    /**
     * @return mixed|string
     */
    public function getTotalStatusText()
    {
        if (
            $this->status === CallStatusEnum::STATUS_NO_ANSWERED
            && $this->direction === CallDirectionEnum::DIRECTION_INCOMING
        ) {
            return Yii::t('app', 'Missed Call');
        }

        if (
            $this->status === CallStatusEnum::STATUS_NO_ANSWERED
            && $this->direction === CallDirectionEnum::DIRECTION_OUTGOING
        ) {
            return Yii::t('app', 'Client No Answer');
        }

        $msg = $this->getFullDirectionText();

        if ($this->duration) {
            $msg .= ' (' . $this->getDurationText() . ')';
        }

        return $msg;
    }

    public function getTotalDisposition(bool $hasComment = true): string
    {
        $t = [];

        if ($hasComment && $this->comment) {
            $t[] = $this->comment;
        }

        return implode(': ', $t);
    }

    /**
     * @return mixed|string
     */
    public function getFullDirectionText()
    {
        return CallDirectionEnum::getFullDirectionTexts()[$this->direction] ?? $this->direction;
    }

    public function getDurationText(): string
    {
        if (!is_null($this->duration)) {
            return $this->duration >= 3600
                ? gmdate("H:i:s", $this->duration)
                : gmdate("i:s", $this->duration);
        }

        return '00:00';
    }
}
