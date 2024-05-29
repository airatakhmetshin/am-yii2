<?php

declare(strict_types=1);

namespace app\exports\HistoryExport;

use app\exceptions\exports\UnsupportedExportTypeException;
use app\exports\Builder\BuilderFactory;
use app\exports\Builder\BuilderInterface;
use app\models\History;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use Yii;

class HistoryExportProcessor
{
    /** @var string[] */
    protected const COLUMNS = [
        'Date',
        'User',
        'Type',
        'Event',
        'Message'
    ];

    /** @var HistoryExportDataSource $dataSource */
    protected $dataSource;

    public function __construct(
        HistoryExportDataSource $dataSource
    ) {
        $this->dataSource = $dataSource;
    }

    /**
     * @throws UnsupportedExportTypeException
     */
    public function process(string $exportType, int $batchSize = 100): BuilderInterface
    {
        $filename = sprintf('history-%s', time());
        $builder = BuilderFactory::createBuilder($exportType, $filename);

        $builder->appendHeader(self::COLUMNS);

        $iterator = $this->dataSource->get($batchSize);

        /** @var History[] $rows */
        foreach ($iterator as $rows) {
            $preparedRows = array_map(static function (History $history): array {
                return self::prepareRow($history);
            }, $rows);

            $builder->appendBody($preparedRows);
        }

        return $builder;
    }

    private static function prepareRow(History $history): array
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $history->ins_ts);

        return [
            'date'    => $date->format('M j, Y, g:i:s A'),
            'user'    => isset($history->user) ? $history->user->username : Yii::t('app', 'System'),
            'type'    => $history->object,
            'event'   => $history->eventText,
            'message' => strip_tags(HistoryListHelper::getBodyByModel($history)),
        ];
    }
}
