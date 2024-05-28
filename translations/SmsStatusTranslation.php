<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\SmsStatusEnum;
use Yii;

class SmsStatusTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            SmsStatusEnum::STATUS_NEW      => Yii::t('app', 'New'),
            SmsStatusEnum::STATUS_READ     => Yii::t('app', 'Read'),
            SmsStatusEnum::STATUS_ANSWERED => Yii::t('app', 'Answered'),

            SmsStatusEnum::STATUS_DRAFT     => Yii::t('app', 'Draft'),
            SmsStatusEnum::STATUS_WAIT      => Yii::t('app', 'Wait'),
            SmsStatusEnum::STATUS_SENT      => Yii::t('app', 'Sent'),
            SmsStatusEnum::STATUS_DELIVERED => Yii::t('app', 'Delivered'),
        ];
    }
}
