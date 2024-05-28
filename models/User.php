<?php

namespace app\models;

use app\enums\UserStatusEnum;
use app\translations\UserStatusTranslation;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $statusText
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'created_at', 'updated_at'], 'required'],
            [[
                'status',
                'created_at',
                'updated_at',
            ], 'integer'],
            [[
                'username',
                'email',
            ], 'string', 'max' => 255],

            [['username'], 'unique'],

            ['status', 'default', 'value' => UserStatusEnum::STATUS_ACTIVE],
            ['status', 'in', 'range' => [UserStatusEnum::STATUS_ACTIVE, UserStatusEnum::STATUS_DELETED, UserStatusEnum::STATUS_HIDDEN]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'username'   => Yii::t('app', 'Username (login)'),
            'statusText' => Yii::t('app', 'Status'),
        ];
    }

    public function getStatusText(): string
    {
        return UserStatusTranslation::getText($this->status) ?? (string) $this->status;
    }
}
