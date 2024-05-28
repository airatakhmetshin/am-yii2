<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\SmsDirectionEnum;
use Yii;

class SmsDirectionTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            SmsDirectionEnum::DIRECTION_INCOMING => Yii::t('app', 'Incoming'),
            SmsDirectionEnum::DIRECTION_OUTGOING => Yii::t('app', 'Outgoing'),
        ];
    }
}
