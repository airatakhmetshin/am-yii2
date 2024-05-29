<?php

namespace app\widgets\HistoryList;

use app\enums\ExportTypeEnum;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class HistoryList extends Widget
{
    /** @var ActiveDataProvider */
    public $dataProvider;

    public function run(): string
    {
        return $this->render('main', [
            'linkExport'   => $this->getLinkExport(),
            'dataProvider' => $this->dataProvider,
        ]);
    }

    private function getLinkExport(): string
    {
        $params[0] = 'site/export-download';
        $params['exportType'] = ExportTypeEnum::CSV;

        return Url::to($params);
    }
}
