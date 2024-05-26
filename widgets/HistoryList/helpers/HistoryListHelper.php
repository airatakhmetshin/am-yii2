<?php

namespace app\widgets\HistoryList\helpers;

use app\enums\HistoryEventEnum;
use app\models\Call;
use app\models\Customer;
use app\models\History;

class HistoryListHelper
{
    public static function getBodyByModel(History $model)
    {
        switch ($model->event) {
            case HistoryEventEnum::EVENT_CREATED_TASK:
            case HistoryEventEnum::EVENT_COMPLETED_TASK:
            case HistoryEventEnum::EVENT_UPDATED_TASK:
                $task = $model->task;
                return "$model->eventText: " . ($task->title ?? '');
            case HistoryEventEnum::EVENT_INCOMING_SMS:
            case HistoryEventEnum::EVENT_OUTGOING_SMS:
                return $model->sms->message ? $model->sms->message : '';
            case HistoryEventEnum::EVENT_OUTGOING_FAX:
            case HistoryEventEnum::EVENT_INCOMING_FAX:
                return $model->eventText;
            case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_TYPE:
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_QUALITY:
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
            case HistoryEventEnum::EVENT_INCOMING_CALL:
            case HistoryEventEnum::EVENT_OUTGOING_CALL:
                /** @var Call $call */
                $call = $model->call;
                return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
            default:
                return $model->eventText;
        }
    }
}