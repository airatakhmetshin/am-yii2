<?php

namespace app\widgets\HistoryList\helpers;

use app\enums\HistoryEventEnum;
use app\models\Call;
use app\models\Customer;
use app\models\History;

class HistoryListHelper
{
    public static function getBodyByModel(History $model): string
    {
        switch ($model->event) {
            case HistoryEventEnum::EVENT_CREATED_TASK:
            case HistoryEventEnum::EVENT_COMPLETED_TASK:
            case HistoryEventEnum::EVENT_UPDATED_TASK:
                return self::formatTask($model);

            case HistoryEventEnum::EVENT_INCOMING_SMS:
            case HistoryEventEnum::EVENT_OUTGOING_SMS:
                return self::formatSms($model);

            case HistoryEventEnum::EVENT_OUTGOING_FAX:
            case HistoryEventEnum::EVENT_INCOMING_FAX:
                return self::formatFax($model);

            case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_TYPE:
                return self::formatCustomerType($model);

            case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_QUALITY:
                return self::formatCustomerQuality($model);

            case HistoryEventEnum::EVENT_INCOMING_CALL:
            case HistoryEventEnum::EVENT_OUTGOING_CALL:
                return self::formatCall($model);

            default:
                return self::formatDefault($model);
        }
    }

    protected static function formatTask(History $model): string
    {
        return "$model->eventText: " . ($model->task->title ?? '');
    }

    protected static function formatSms(History $model): string
    {
        return $model->sms->message ?: '';
    }

    protected static function formatFax(History $model): string
    {
        return $model->eventText;
    }

    protected static function formatCustomerType(History $model): string
    {
        return "$model->eventText " .
            (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
            (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
    }

    protected static function formatCustomerQuality(History $model): string
    {
        return "$model->eventText " .
            (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
            (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
    }

    protected static function formatCall(History $model): string
    {
        /** @var Call $call */
        $call = $model->call;
        return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
    }

    protected static function formatDefault(History $model): string
    {
        return $model->eventText;
    }
}
