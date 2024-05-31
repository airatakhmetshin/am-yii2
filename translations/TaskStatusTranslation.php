<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\TaskStatusEnum;
use Yii;

class TaskStatusTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            TaskStatusEnum::STATUS_NEW    => Yii::t('app', 'New'),
            TaskStatusEnum::STATUS_DONE   => Yii::t('app', 'Complete'),
            TaskStatusEnum::STATUS_CANCEL => Yii::t('app', 'Cancel'),
        ];
    }
}
