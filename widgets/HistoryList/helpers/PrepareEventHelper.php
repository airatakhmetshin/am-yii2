<?php

declare(strict_types=1);

namespace app\widgets\HistoryList\helpers;

use app\enums\CallDirectionEnum;
use app\enums\CallStatusEnum;
use app\enums\SmsDirectionEnum;
use app\models\Customer;
use app\models\History;
use app\widgets\HistoryList\builders\ItemBuilderInterface;
use app\widgets\HistoryList\builders\ItemCommonBuilder;
use app\widgets\HistoryList\builders\ItemStatusesChangeBuilder;
use Yii;
use yii\helpers\Html;

class PrepareEventHelper
{
    public static function prepareTask(History $model): ItemBuilderInterface
    {
        $user = $model->user;
        $task = $model->task;

        return (new ItemCommonBuilder())
            ->setUser($user)
            ->setBody(HistoryListHelper::getBodyByModel($model))
            ->setIconClass('fa-check-square bg-yellow')
            ->setFooterDatetime($model->ins_ts)
            ->setFooter(isset($task->customerCreditor->name) ? 'Creditor: ' . $task->customerCreditor->name : '');
    }

    public static function prepareSms(History $model): ItemBuilderInterface
    {
        $footer = $model->sms->direction === SmsDirectionEnum::DIRECTION_INCOMING
            ? Yii::t('app', 'Incoming message from {number}', ['number' => $model->sms->phone_from ?? ''])
            : Yii::t('app', 'Sent message to {number}', ['number' => $model->sms->phone_to ?? '']);

        return (new ItemCommonBuilder())
            ->setUser($model->user)
            ->setBody(HistoryListHelper::getBodyByModel($model))
            ->setFooter($footer)
            ->setIconIncome($model->sms->direction === SmsDirectionEnum::DIRECTION_INCOMING)
            ->setFooterDatetime($model->ins_ts)
            ->setIconClass('icon-sms bg-dark-blue');
    }

    public static function prepareFax(History $model): ItemBuilderInterface
    {
        $user = $model->user;
        $fax  = $model->fax;

        $body = HistoryListHelper::getBodyByModel($model) .
            ' - ' .
            (isset($fax->document) ? Html::a(
                Yii::t('app', 'view document'),
                $fax->document->getViewUrl(),
                [
                    'target' => '_blank',
                    'data-pjax' => 0
                ]
            ) : '');

        $footer = Yii::t('app', '{type} was sent to {group}', [
            'type'  => $fax ? $fax->getTypeText() : 'Fax',
            'group' => isset($fax->creditorGroup)
                ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0])
                : ''
        ]);

        return (new ItemCommonBuilder())
            ->setUser($user)
            ->setBody($body)
            ->setFooter($footer)
            ->setFooterDatetime($model->ins_ts)
            ->setIconClass('fa-fax bg-green');
    }

    public static function prepareCustomerType(History $model): ItemBuilderInterface
    {
        return (new ItemStatusesChangeBuilder())
            ->setModel($model)
            ->setOldValue(Customer::getTypeTextByType($model->getDetailOldValue('type')))
            ->setNewValue(Customer::getTypeTextByType($model->getDetailNewValue('type')));
    }

    public static function prepareCustomerQuality(History $model): ItemBuilderInterface
    {
        return (new ItemStatusesChangeBuilder())
            ->setModel($model)
            ->setOldValue(Customer::getQualityTextByQuality($model->getDetailOldValue('quality')))
            ->setNewValue(Customer::getQualityTextByQuality($model->getDetailNewValue('quality')));
    }

    public static function prepareCall(History $model): ItemBuilderInterface
    {
        $call     = $model->call;
        $answered = $call && $call->status === CallStatusEnum::STATUS_ANSWERED;

        return (new ItemCommonBuilder())
            ->setUser($model->user)
            ->setContent($call->comment ?? '')
            ->setBody(HistoryListHelper::getBodyByModel($model))
            ->setFooterDatetime($model->ins_ts)
            ->setFooter(isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null)
            ->setIconClass($answered ? 'md-phone bg-green' : 'md-phone-missed bg-red')
            ->setIconIncome($answered && $call->direction === CallDirectionEnum::DIRECTION_INCOMING);
    }

    public static function prepareDefault(History $model): ItemBuilderInterface
    {
        return (new ItemCommonBuilder())
            ->setUser($model->user)
            ->setBody(HistoryListHelper::getBodyByModel($model))
            ->setBodyDatetime($model->ins_ts)
            ->setIconClass('fa-gear bg-purple-light');
    }
}
