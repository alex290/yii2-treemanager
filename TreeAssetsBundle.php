<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace alex290\treemanager;

use yii\web\AssetBundle;

/**
 * Description of GalleryAssetsBundle
 *
 * @author art
 */
class TreeAssetsBundle extends AssetBundle {
    
    public $sourcePath  = '@vendor/alex290/yii2-treemanager/scr';
    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/jquery.json.min.js',
        'js/jquery.nestable.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    
}
