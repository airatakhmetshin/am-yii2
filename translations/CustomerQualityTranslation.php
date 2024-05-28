<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\CustomerQualityEnum;
use Yii;

class CustomerQualityTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            CustomerQualityEnum::QUALITY_ACTIVE     => Yii::t('app', 'Active'),
            CustomerQualityEnum::QUALITY_REJECTED   => Yii::t('app', 'Rejected'),
            CustomerQualityEnum::QUALITY_COMMUNITY  => Yii::t('app', 'Community'),
            CustomerQualityEnum::QUALITY_UNASSIGNED => Yii::t('app', 'Unassigned'),
            CustomerQualityEnum::QUALITY_TRICKLE    => Yii::t('app', 'Trickle'),
        ];
    }
}
