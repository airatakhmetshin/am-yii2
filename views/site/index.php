<?php

/**
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use app\widgets\HistoryList\HistoryList;

$this->title = 'Americor Test';
?>

<div class="site-index">
    <?= HistoryList::widget(['dataProvider' => $dataProvider]) ?>
</div>
