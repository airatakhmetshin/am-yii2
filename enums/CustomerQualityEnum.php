<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class CustomerQualityEnum
{
    public const QUALITY_ACTIVE = 'active';
    public const QUALITY_REJECTED = 'rejected';
    public const QUALITY_COMMUNITY = 'community';
    public const QUALITY_UNASSIGNED = 'unassigned';
    public const QUALITY_TRICKLE = 'trickle';

    public static function getQualityTexts(): array
    {
        return [
            self::QUALITY_ACTIVE     => Yii::t('app', 'Active'),
            self::QUALITY_REJECTED   => Yii::t('app', 'Rejected'),
            self::QUALITY_COMMUNITY  => Yii::t('app', 'Community'),
            self::QUALITY_UNASSIGNED => Yii::t('app', 'Unassigned'),
            self::QUALITY_TRICKLE    => Yii::t('app', 'Trickle'),
        ];
    }
}
