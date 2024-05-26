<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class SmsStatusEnum
{
    // incoming
    public const STATUS_NEW = 0;
    public const STATUS_READ = 1;
    public const STATUS_ANSWERED = 2;

    // outgoing
    public const STATUS_DRAFT = 10;
    public const STATUS_WAIT = 11;
    public const STATUS_SENT = 12;
    public const STATUS_DELIVERED = 13;
    public const STATUS_FAILED = 14;
    public const STATUS_SUCCESS = 13;

    public static function getStatusTexts(): array
    {
        return [
            self::STATUS_NEW      => Yii::t('app', 'New'),
            self::STATUS_READ     => Yii::t('app', 'Read'),
            self::STATUS_ANSWERED => Yii::t('app', 'Answered'),

            self::STATUS_DRAFT     => Yii::t('app', 'Draft'),
            self::STATUS_WAIT      => Yii::t('app', 'Wait'),
            self::STATUS_SENT      => Yii::t('app', 'Sent'),
            self::STATUS_DELIVERED => Yii::t('app', 'Delivered'),
        ];
    }
}
