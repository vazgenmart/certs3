<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Protocol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="protocol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sds')->dropDownList(['ФЕДЕРАЛЬНО БЮРО СЕРТИФИКАЦИИ' => 'ФЕДЕРАЛЬНО БЮРО СЕРТИФИКАЦИИ', 'ЭКОЛОГИЧЕСКИЙ КОНТРОЛЬ ОРГАНИЗАЦИЙ' => 'ЭКОЛОГИЧЕСКИЙ КОНТРОЛЬ ОРГАНИЗАЦИЙ', '100% ОРГАНИЧЕСКИЙ ПРОДУКТ' => '100% ОРГАНИЧЕСКИЙ ПРОДУКТ', 'ПОЖАРНЫЙ КОНТРОЛЬ ОРГАНИЗАЦИЙ' => 'ПОЖАРНЫЙ КОНТРОЛЬ ОРГАНИЗАЦИЙ',], ['prompt' => '', 'multiple' => 'multiple']) ?>

    <?= $form->field($model, 'number_protocol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issue_date')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Дата выдачи протокола   ...',
            'value' => $model->issue_date ? $model->issue_date : date('Y-m-d'),
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])  ?>

    <?= $form->field($model, 'testing_laboratory_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_information')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'manufacturer_information')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'applicant_information')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_valid')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
