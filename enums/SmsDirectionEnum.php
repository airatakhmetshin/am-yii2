<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class SmsDirectionEnum
{
    public const DIRECTION_INCOMING = 0;
    public const DIRECTION_OUTGOING = 1;

    public static function getDirectionTexts(): array
    {
        return [
            self::DIRECTION_INCOMING => Yii::t('app', 'Incoming'),
            self::DIRECTION_OUTGOING => Yii::t('app', 'Outgoing'),
        ];
    }
}
