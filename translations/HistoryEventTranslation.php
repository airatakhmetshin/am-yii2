<?php

declare(strict_types=1);

namespace app\translations;

use app\enums\HistoryEventEnum;
use Yii;

class HistoryEventTranslation extends BaseTranslation
{
    public static function map(): array
    {
        return [
            HistoryEventEnum::EVENT_CREATED_TASK   => Yii::t('app', 'Task created'),
            HistoryEventEnum::EVENT_UPDATED_TASK   => Yii::t('app', 'Task updated'),
            HistoryEventEnum::EVENT_COMPLETED_TASK => Yii::t('app', 'Task completed'),

            HistoryEventEnum::EVENT_INCOMING_SMS => Yii::t('app', 'Incoming message'),
            HistoryEventEnum::EVENT_OUTGOING_SMS => Yii::t('app', 'Outgoing message'),

            HistoryEventEnum::EVENT_CUSTOMER_CHANGE_TYPE    => Yii::t('app', 'Type changed'),
            HistoryEventEnum::EVENT_CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Property changed'),

            HistoryEventEnum::EVENT_OUTGOING_CALL => Yii::t('app', 'Outgoing call'),
            HistoryEventEnum::EVENT_INCOMING_CALL => Yii::t('app', 'Incoming call'),

            HistoryEventEnum::EVENT_INCOMING_FAX => Yii::t('app', 'Incoming fax'),
            HistoryEventEnum::EVENT_OUTGOING_FAX => Yii::t('app', 'Outgoing fax'),
        ];
    }
}
