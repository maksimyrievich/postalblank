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

<div class="panel panel-body" >
    <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
            <a class="thumbnail">
                <img  class="img-responsive" alt="<?= Html::encode($model->alt) ?>" src="<?= Html::encode($model->plagin_image) ?>">
            </a>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
            <h1 class="blog-post-title"><?= Html::encode($model->plagin_name) ?></h1>
            <ul class="blog-post-info list-inline">
                <li>
                    <a href="#">
                        <i class="fa fa-clock-o"></i>
                        <span class="font-lato">Версия плагина: 1.0</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-comment-o"></i>
                        <span class="font-lato">Просмотров: <? include(Yii::$app->basePath."/site_content/plaginsbody/previev.txt");?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-download"></i>
                        <span class="font-lato">Скачиваний: <? include(Yii::$app->basePath."/site_content/plaginsbody/plagin".$model->id.".txt");?></span>
                    </a>
                </li>
            </ul>
            <p><?= HtmlPurifier::process($model->description_RU) ?></p>
            <p><?= Html::a('Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-info']) ?></p>
            <p></p>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-body">
            <h3 class="media-heading">Установка</h3>
            <p > 1. Плагин устанавливается стандартным способом через меню "Установка и обновление" JoomShopping. <br>
                2. После установки плагина убедитесь в его включенном состоянии ("Расширения/плагины/JshopPostalBlank" должен быть включен).<br>
                3. Регистрируемся на сайте и скачиваем ключ в личном кабинете в разделе "Настройки аккаунта". Вписываем ключ в настройках плагина ("Расширения/плагины/JshopPostalBlank").<br>
                4. Если всё сделано правильно в колонке "Печать" таблицы заказов (Компоненты/JoomShopping/Заказы) появится кнопка с гербом почты России.<br>
                5. При нажатии на кнопку плагин делает запрос на генерацию бланков на сервер. Должно открыться пустое окно. Установка плагина закончена.<br>
                6. Переходим к настройкам выдачи бланков в личный кабинет.</p>
        </div>
    </div>
</div>
