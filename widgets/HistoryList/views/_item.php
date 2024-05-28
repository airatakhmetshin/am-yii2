<?php

use app\enums\HistoryEventEnum;
use app\models\History;
use app\models\search\HistorySearch;
use app\widgets\HistoryList\helpers\PrepareEventHelper;

/** @var $model HistorySearch|History */

switch ($model->event) {
    case HistoryEventEnum::EVENT_CREATED_TASK:
    case HistoryEventEnum::EVENT_COMPLETED_TASK:
    case HistoryEventEnum::EVENT_UPDATED_TASK:
        $itemBuilder = PrepareEventHelper::prepareTask($model);

        echo $this->render('_item_common', $itemBuilder->toRender());
        break;

    case HistoryEventEnum::EVENT_INCOMING_SMS:
    case HistoryEventEnum::EVENT_OUTGOING_SMS:
        $itemBuilder = PrepareEventHelper::prepareSms($model);

        echo $this->render('_item_common', $itemBuilder->toRender());
        break;

    case HistoryEventEnum::EVENT_OUTGOING_FAX:
    case HistoryEventEnum::EVENT_INCOMING_FAX:
        $itemBuilder = PrepareEventHelper::prepareFax($model);

        echo $this->render('_item_common', $itemBuilder->toRender());
        break;

    case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_TYPE:
        $itemBuilder = PrepareEventHelper::prepareCustomerType($model);

        echo $this->render('_item_statuses_change', $itemBuilder->toRender());
        break;
    case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_QUALITY:
        $itemBuilder = PrepareEventHelper::prepareCustomerQuality($model);

        echo $this->render('_item_statuses_change', $itemBuilder->toRender());
        break;

    case HistoryEventEnum::EVENT_INCOMING_CALL:
    case HistoryEventEnum::EVENT_OUTGOING_CALL:
        $itemBuilder = PrepareEventHelper::prepareCall($model);

        echo $this->render('_item_common', $itemBuilder->toRender());
        break;

    default:
        $itemBuilder = PrepareEventHelper::prepareDefault($model);

        echo $this->render('_item_common', $itemBuilder->toRender());
        break;
}
