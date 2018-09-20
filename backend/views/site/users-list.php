<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dialog\DialogAsset;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create-user'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'label' => 'Имя пользователя'
            ],
            [
                'attribute' => 'username',
                'label' => 'Имя'
            ],
            [
                'attribute' => 'username',
                'label' => 'Фамилия'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a('', "/c_admin/site/update-user/".$model->id, ['class' => 'glyphicon glyphicon-pencil']);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a('', '/c_admin/site/delete-user/'.$model->id, ['class' => 'glyphicon glyphicon-trash delete-user']);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
<?php
DialogAsset::register($this);
$this->registerJs("\$('.delete-user').on('click', function() {
    if(!confirm('Are you sure you want to delete this user?')){
        return false;
    }
});");
?>