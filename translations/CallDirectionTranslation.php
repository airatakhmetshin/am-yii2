<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\CallDirectionEnum;
use Yii;

class CallDirectionTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            CallDirectionEnum::DIRECTION_INCOMING => Yii::t('app', 'Incoming Call'),
            CallDirectionEnum::DIRECTION_OUTGOING => Yii::t('app', 'Outgoing Call'),
        ];
    }
}
