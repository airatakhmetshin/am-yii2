<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class FaxType
{
    public const TYPE_POA_ATC = 'poa_atc';
    public const TYPE_REVOCATION_NOTICE = 'revocation_notice';

    public static function getTypeTexts(): array
    {
        return [
            self::TYPE_POA_ATC           => Yii::t('app', 'POA/ATC'),
            self::TYPE_REVOCATION_NOTICE => Yii::t('app', 'Revocation'),
        ];
    }
}
