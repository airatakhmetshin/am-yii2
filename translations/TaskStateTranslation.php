<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\TaskStateEnum;
use Yii;

class TaskStateTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            TaskStateEnum::STATE_INBOX  => Yii::t('app', 'Inbox'),
            TaskStateEnum::STATE_DONE   => Yii::t('app', 'Done'),
            TaskStateEnum::STATE_FUTURE => Yii::t('app', 'Future')
        ];
    }
}
