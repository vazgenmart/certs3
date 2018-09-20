<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Protocols';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocol-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Protocol', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'sds',
                'value' => function ($data) {
                    return  implode(",", $data->sds);
                }
            ],
            'number_protocol',
            'issue_date',
            'testing_laboratory_info:ntext',
            //'product_information:ntext',
            //'manufacturer_information:ntext',
            //'applicant_information:ntext',
            //'is_valid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
