<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\assets;

use Yii;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@akiraz2/blog/assets/default';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
