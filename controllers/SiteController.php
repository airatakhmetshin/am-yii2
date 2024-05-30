<?php

namespace app\controllers;

use app\enums\ExportTypeEnum;
use app\exports\HistoryExport\HistoryExportProcessor;
use app\models\search\HistorySearch;
use Yii;
use yii\base\Module;
use yii\validators\RangeValidator;
use yii\web\Controller;

class SiteController extends Controller
{
    /** @var HistorySearch $historySearch */
    protected $historySearch;

    /** @var HistoryExportProcessor $historyExport */
    protected $historyExport;

    public function __construct(
        string                 $id,
        Module                 $module,
        HistorySearch          $historySearch,
        HistoryExportProcessor $historyExport,
        array                  $config = []
    ) {
        $this->historySearch = $historySearch;
        $this->historyExport = $historyExport;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     */
    public function actionIndex(): string
    {
        $dataProvider = $this->historySearch->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportDownload(string $exportType)
    {
        $validator = new RangeValidator(['range' => [ExportTypeEnum::CSV]]);

        if (!$validator->validate($exportType, $error)) {
            return $this->render('error', [
                'name'    => '',
                'message' => 'Selected export type is not supported.',
            ]);
        }

        $file = $this->historyExport->process($exportType);

        return Yii::$app->response->sendFile($file->getFilePath());
    }
}
