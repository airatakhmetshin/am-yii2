<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class TaskStatusEnum
{
    public const STATUS_NEW = 0;
    public const STATUS_DONE = 1;
    public const STATUS_CANCEL = 3;

    public static function getStatusTexts(): array
    {
        return [
            self::STATUS_NEW    => Yii::t('app', 'New'),
            self::STATUS_DONE   => Yii::t('app', 'Complete'),
            self::STATUS_CANCEL => Yii::t('app', 'Cancel'),
        ];
    }
}
