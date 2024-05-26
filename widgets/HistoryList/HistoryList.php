<?php

namespace app\widgets\HistoryList;

use app\widgets\Export\Export;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

class HistoryList extends Widget
{
    /** @var ActiveDataProvider */
    public $dataProvider;

    /**
     * @return string
     */
    public function run()
    {
        $params = Yii::$app->request->queryParams;

        return $this->render('main', [
            'linkExport'   => $this->getLinkExport($params),
            'dataProvider' => $this->dataProvider,
        ]);
    }

    private function getLinkExport(array $params): string
    {
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'site/export';

        return Url::to($params);
    }
}
