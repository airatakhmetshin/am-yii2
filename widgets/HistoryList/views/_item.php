<?php

use app\enums\CallDirectionEnum;
use app\enums\CallStatusEnum;
use app\enums\HistoryEventEnum;
use app\enums\SmsDirectionEnum;
use app\models\Call;
use app\models\Customer;
use app\models\search\HistorySearch;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use yii\helpers\Html;

/** @var $model HistorySearch */

switch ($model->event) {
    case HistoryEventEnum::EVENT_CREATED_TASK:
    case HistoryEventEnum::EVENT_COMPLETED_TASK:
    case HistoryEventEnum::EVENT_UPDATED_TASK:
        $task = $model->task;

        echo $this->render('_item_common', [
            'user' => $model->user,
            'body' => HistoryListHelper::getBodyByModel($model),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
        break;
    case HistoryEventEnum::EVENT_INCOMING_SMS:
    case HistoryEventEnum::EVENT_OUTGOING_SMS:
        echo $this->render('_item_common', [
            'user' => $model->user,
            'body' => HistoryListHelper::getBodyByModel($model),
            'footer' => $model->sms->direction === SmsDirectionEnum::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $model->sms->direction === SmsDirectionEnum::DIRECTION_INCOMING,
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
        break;
    case HistoryEventEnum::EVENT_OUTGOING_FAX:
    case HistoryEventEnum::EVENT_INCOMING_FAX:
        $fax = $model->fax;

        echo $this->render('_item_common', [
            'user' => $model->user,
            'body' => HistoryListHelper::getBodyByModel($model) .
                ' - ' .
                (isset($fax->document) ? Html::a(
                    Yii::t('app', 'view document'),
                    $fax->document->getViewUrl(),
                    [
                        'target' => '_blank',
                        'data-pjax' => 0
                    ]
                ) : ''),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ]);
        break;
    case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_TYPE:
        echo $this->render('_item_statuses_change', [
            'model' => $model,
            'oldValue' => Customer::getTypeTextByType($model->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($model->getDetailNewValue('type'))
        ]);
        break;
    case HistoryEventEnum::EVENT_CUSTOMER_CHANGE_QUALITY:
        echo $this->render('_item_statuses_change', [
            'model' => $model,
            'oldValue' => Customer::getQualityTextByQuality($model->getDetailOldValue('quality')),
            'newValue' => Customer::getQualityTextByQuality($model->getDetailNewValue('quality')),
        ]);
        break;
    case HistoryEventEnum::EVENT_INCOMING_CALL:
    case HistoryEventEnum::EVENT_OUTGOING_CALL:
        /** @var Call $call */
        $call = $model->call;
        $answered = $call && $call->status === CallStatusEnum::STATUS_ANSWERED;

        echo $this->render('_item_common', [
            'user' => $model->user,
            'content' => $call->comment ?? '',
            'body' => HistoryListHelper::getBodyByModel($model),
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction === CallDirectionEnum::DIRECTION_INCOMING
        ]);
        break;
    default:
        echo $this->render('_item_common', [
            'user' => $model->user,
            'body' => HistoryListHelper::getBodyByModel($model),
            'bodyDatetime' => $model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
        break;
}
