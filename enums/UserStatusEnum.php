<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class UserStatusEnum
{
    public const STATUS_DELETED = 0;
    public const STATUS_HIDDEN = 1;
    public const STATUS_ACTIVE = 10;

    public static function getStatusTexts(): array
    {
        return [
            self::STATUS_ACTIVE  => Yii::t('app', 'Active'),
            self::STATUS_DELETED => Yii::t('app', 'Deleted'),
            self::STATUS_HIDDEN  => Yii::t('app', 'Hidden'),
        ];
    }
}
