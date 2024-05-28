<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\CustomerTypeEnum;
use Yii;

class CustomerTypeTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            CustomerTypeEnum::TYPE_LEAD => Yii::t('app', 'Lead'),
            CustomerTypeEnum::TYPE_DEAL => Yii::t('app', 'Deal'),
            CustomerTypeEnum::TYPE_LOAN => Yii::t('app', 'Loan'),
        ];
    }
}
