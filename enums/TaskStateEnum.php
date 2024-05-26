<?php

declare(strict_types=1);

namespace app\enums;

use Yii;

class TaskStateEnum
{
    public const STATE_INBOX = 'inbox';
    public const STATE_DONE = 'done';
    public const STATE_FUTURE = 'future';

    public static function getStateTexts(): array
    {
        return [
            self::STATE_INBOX  => Yii::t('app', 'Inbox'),
            self::STATE_DONE   => Yii::t('app', 'Done'),
            self::STATE_FUTURE => Yii::t('app', 'Future')
        ];
    }
}
