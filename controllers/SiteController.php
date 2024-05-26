<?php

namespace app\controllers;

use app\models\search\HistorySearch;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

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
        $model = new HistorySearch();

        return $this->render('index', [
            'dataProvider' => $model->search(Yii::$app->request->queryParams),
        ]);
    }

    public function actionExport(string $exportType): string
    {
        $model = new HistorySearch();

        return $this->render('export', [
            'dataProvider' => $model->search(Yii::$app->request->queryParams),
            'exportType'   => $exportType,
        ]);
    }
}
