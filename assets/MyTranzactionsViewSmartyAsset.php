<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
//Подключаем локально в файле views/account/mytransactions.php
class MyTranzactionsViewSmartyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //Этот ресурс подключается для отображения таблицы "Tranzaction"
        'AssetsSmarty/css/layout-datatables.css',
    ];
    public $js = [
        //Эти ресурсы подключаются для отображения таблицы "Tranzaction"
        'AssetsSmarty/plugins/datatables/js/jquery.dataTables.min.js',
        'AssetsSmarty/plugins/datatables/dataTables.bootstrap.js',
        'AssetsSmarty/plugins/select2/js/select2.full.min.js',
        'AssetsSmarty\js\view\TranzactionsTableSettings.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}