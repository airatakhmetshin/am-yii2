<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\UserStatusEnum;
use Yii;

class UserStatusTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            UserStatusEnum::STATUS_ACTIVE  => Yii::t('app', 'Active'),
            UserStatusEnum::STATUS_DELETED => Yii::t('app', 'Deleted'),
            UserStatusEnum::STATUS_HIDDEN  => Yii::t('app', 'Hidden'),
        ];
    }
}
