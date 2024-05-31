<?php

declare(strict_types=1);

namespace app\exports\HistoryExport;

use app\models\History;

class HistoryExportDataSource
{
    public function get(int $batchSize): \Iterator
    {
        $query = History::find();

        $query->addSelect('history.*');
        $query->with([
            'customer',
            'user',
            'sms',
            'task',
            'call',
            'fax',
        ]);

        $query->addOrderBy([
            'ins_ts' => SORT_DESC,
            'id'     => SORT_DESC,
        ]);

        return $query->batch($batchSize);
    }
}
