<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 14.12.2016
 * Time: 23:22
 */


use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="panel panel-default">
    <div class="panel-body">
        <a class="thumbnail pull-left">
            <img  class="media-object" data-src="holder.js/100x100" alt="<?= Html::encode($model->alt) ?>" src="<?= Html::encode($model->plagin_image) ?>">
        </a>
        <div class="media-body" style="padding-left: 20px">
            <h3 class="media-heading"><?= Html::encode($model->plagin_name) ?></h3>
            <p><?= HtmlPurifier::process($model->description_RU) ?></p>
            <p><?= Html::a('Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>
            Количество скачиваний: <? include(Yii::$app->basePath."/plaginsbody/plagin".$model->id.".txt");?>
        </div>
    </div>
</div>
