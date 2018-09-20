<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
$this_user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="no-js sidebar-large">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="font-size: 13px;">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php if (!Yii::$app->user->isGuest): ?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="z-index: 222;">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a id="menu-medium" class="sidebar-toggle tooltips">

                    </a>
                    <a class="domain" href="<?php \yii\helpers\Url::base(); ?>">Certs</a>
                </div>
                <div class="navbar-center">
                </div>
                <div class="navbar-collapse collapse">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <ul class="nav navbar-nav pull-right header-menu">


                        <!-- BEGIN USER DROPDOWN -->
                        <li class="dropdown" id="user-header">
                            <a href="#" class="dropdown-toggle c-white" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="true">
                                <img src="<?= \yii\helpers\Url::base() . "/images/avatar2.png" ?>" alt="user avatar"
                                     width="30" class="p-r-5">
                                <span class="username"><?= Yii::$app->user->identity['username'] ?></span>
                                <i class="fa fa-angle-down p-r-10"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a>
                                        <?php
                                        echo Html::beginForm(['/site/logout'], 'post')
                                            . Html::submitButton(
                                                '<i class="fa fa-power-off"></i>' . Yii::t('app', 'logout'),
                                                ['class' => 'btn btn-link']
                                            )
                                            . Html::endForm();
                                        ?></a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER DROPDOWN -->
                    </ul>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
        </nav>
        <!-- BEGIN MAIN SIDEBAR -->
        <div id="wrapper">
            <nav id="sidebar">
                <div id="main-menu">
                    <ul class="sidebar-nav">

                        <?php if (Yii::$app->user->identity->can('User', 'read')): ?>
                            <li class="<?php echo Yii::$app->controller->id == "user" ? "current" : ""; ?>">
                                <a href="<?php echo Url::to(['site/users-list']) ?>"><i class="fa fa-list-ul"></i>
                                    <span class="sidebar-text"> <?php echo Yii::t('app', 'User') ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (Yii::$app->user->identity->can('Settings', 'read')): ?>
                            <li class="<?php echo Yii::$app->controller->id == "user" ? "current" : ""; ?>">
                                <a href="<?php echo Url::to(['settings/index']) ?>"><i class="fa fa-cog"></i>
                                    <span class="sidebar-text"> <?php echo Yii::t('app', 'Settings') ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (Yii::$app->user->identity->can('Protocol', 'read')): ?>
                            <li class="<?php echo Yii::$app->controller->id == "protocol" ? "current" : ""; ?>">
                                <a href="<?php echo Url::to(['protocol/index']) ?>"><i class="fa fa-cog"></i>
                                    <span class="sidebar-text"> <?php echo Yii::t('app', 'Protocol') ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- END MAIN SIDEBAR -->
    <?php endif; ?>
    <div class="<?= !Yii::$app->user->isGuest ? "col-md-offset-3 container-admin" : 'container' ?>">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<audio id="audio" src="/uploads/definite.ogg"></audio>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
