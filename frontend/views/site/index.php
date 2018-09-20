<?php
use  yii\widgets\ActiveForm;
use yii\bootstrap\Html;
?>
<section class="header">
    <div class="container">
        <div class="logo_div">
            <img src="image/logo1.png" alt="" class="top_logo">
            <p class="logo_text">Lorem ipsum dolor sit amet, consectetur </p>
        </div>
        <div class="input_div">
            <?php $form = ActiveForm::begin(['id' => 'search']); ?>

            <?= $form->field($model, 'term')->textInput(['autofocus' => true]) ?>
            <hr />
            <?= $form->field($model, 'date')->input('date') ?>

            <?= Html::submitButton('Поиск', ['class' => 'btn', 'name' => 'search']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
    <div class="results"></div>
<section class="body">
    <div class="container">
        <?= $text ? $text->value :'';?>
    </div>
</section>
<footer>
    <div class="logo_div_footer">
        <img src="image/logo2.png" alt="" class="footer_logo">
    </div>
    <p class="copyright">All rights reserved <span class="glyphicon glyphicon-copyright-mark"></span> 2018</p>
</footer>