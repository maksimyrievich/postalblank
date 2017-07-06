<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

if(\Yii::$app->language == 'ru'):
    echo Url::to("@web/web/AssetsSmarty/images/flags/ru.png");
else:
    echo Url::to("@web/web/AssetsSmarty/images/flags/us.png");

endif;