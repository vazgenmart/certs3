<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Protocol */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'sds',
                'value' => implode(",", $model->sds)
            ],
            'number_protocol',
            'issue_date',
            'testing_laboratory_info:ntext',
            'product_information:ntext',
            'manufacturer_information:ntext',
            'applicant_information:ntext',
            'is_valid',
        ],
    ]) ?>

</div>
