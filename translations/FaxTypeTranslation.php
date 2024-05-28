<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\FaxTypeEnum;
use Yii;

class FaxTypeTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            FaxTypeEnum::TYPE_POA_ATC           => Yii::t('app', 'POA/ATC'),
            FaxTypeEnum::TYPE_REVOCATION_NOTICE => Yii::t('app', 'Revocation'),
        ];
    }
}
