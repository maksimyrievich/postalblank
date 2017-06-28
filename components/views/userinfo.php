<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 22.11.2016
 * Time: 17:00
 */


$this->title = 'Личная информация';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Групповой список -->

        <a class="list-group-item" style="padding: 5px 3px 5px 3px"><b>Логин :</b> <span class="pull-right"><?= Yii::$app->user->identity->username;?></span></a>
        <a class="list-group-item" style="padding: 5px 3px 5px 3px"><b>ID пользователя :</b><span class="pull-right"><?= Yii::$app->user->getId(); ?></span></a>
        <a class="list-group-item" style="padding: 5px 3px 5px 3px"><b>Баланс (руб) :</b><span class="pull-right"><?= Yii::$app->user->identity->balance;?></span></a>
        <a class="list-group-item" style="padding: 5px 3px 5px 3px"><b>Key:</b><span class="pull-right"><?= Yii::$app->user->identity->key_secret;?></span></a>
    

