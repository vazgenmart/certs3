<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/bootstrap.min.css',
        'css/icons/icons.min.css',
        'css/style.css',
        'css/style.min.css',
        'css/plugins.css',
        'css/colors/color-blue.css',
    ];
    public $js = [
        'plugins/jquery-migrate-1.2.1.min.js',
        'plugins/jquery-ui/jquery-ui-1.11.2.min.js',
        'plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js',
        'plugins/bootstrap-select/bootstrap-select.js',
        'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js',
        'plugins/mmenu/js/jquery.mmenu.min.all.js',
        'plugins/nprogress/nprogress.js',
        'plugins/charts-sparkline/sparkline.min.js',
        'plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js',
        'plugins/breakpoints/breakpoints.js',
        'plugins/numerator/jquery-numerator.js',
        'plugins/jquery.cookie.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
