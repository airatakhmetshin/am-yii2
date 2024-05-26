<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class CustomerTypeEnum
{
    public const TYPE_LEAD = 'lead';
    public const TYPE_DEAL = 'deal';
    public const TYPE_LOAN = 'loan';

    public static function getTypeTexts(): array
    {
        return [
            self::TYPE_LEAD => Yii::t('app', 'Lead'),
            self::TYPE_DEAL => Yii::t('app', 'Deal'),
            self::TYPE_LOAN => Yii::t('app', 'Loan'),
        ];
    }
}
