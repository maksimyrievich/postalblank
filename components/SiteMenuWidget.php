<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 22.11.2016
 * Time: 17:08
 */

// подключаем пространство имен
namespace app\components;
// импортируем класс Windget и Html хелпер
use yii\base\Widget;
use yii\helpers\Html;

// расширяем класс Widget
class SiteMenuWidget extends Widget {

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('sitemenu');
    }
}

?>