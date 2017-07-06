<?php


use yii\bootstrap\Html;
use Yii;

if(\Yii::$app->language == 'ru'):
    echo Yii::t('translate','NAV_LANG_RUSSIAN');
else:
    echo Yii::t('translate','NAV_LANG_ENGLISH');

endif;