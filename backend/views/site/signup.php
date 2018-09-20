<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

//$this->title = 'Signup';
//$this->params['breadcrumbs'][] = $this->title;
$action = $model->username ? 'update' : 'insert';
$this->title = $model->username ? 'Update User: ' . $model->username : 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users-list']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'validationUrl' => ['ajax-validation'],
                    'enableAjaxValidation' => true
            ]); ?>

                <?= $form->field($model, 'action')->hiddenInput(['value'=> $action])->label(false)?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'surname')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?=
                    $form->field($model, 'active_from')->widget(DateTimePicker::classname(), [
                        'options' => [
                            'placeholder' => 'Enter event time ...',
                            'value' => $model->active_from ? date('d-m-Y H:i:s', $model->active_from) : '',
                        ],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy H:i:s',
                        ]
                    ]);
                ?>

                <?=
                    $form->field($model, 'active_to')->widget(DateTimePicker::classname(), [
                        'options' => [
                            'placeholder' => 'Enter event time ...',
                            'value' => $model->active_to ? date('d-m-Y H:i:s', $model->active_to) : '',
                        ],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy H:i:s',
                        ]
                    ]);
                ?>

                <?= $form->field($model, 'authority_certificate')->textarea(['rows' => 6])?>

                <?= $form->field($model, 'body_data')->textarea(['rows' => 6])?>

                <?= $form->field($model, 'type')->dropDownList([30 => 'Клиент', 20 => 'Администратор'])?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
