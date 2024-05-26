<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class CallDirectionEnum
{
    public const DIRECTION_INCOMING = 0;
    public const DIRECTION_OUTGOING = 1;

    public static function getFullDirectionTexts(): array
    {
        return [
            self::DIRECTION_INCOMING => Yii::t('app', 'Incoming Call'),
            self::DIRECTION_OUTGOING => Yii::t('app', 'Outgoing Call'),
        ];
    }
}
