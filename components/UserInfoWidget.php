<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 21.11.2016
 * Time: 21:22
 */

// подключаем пространство имен
namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\User;


// расширяем класс Widget
class UserInfoWidget extends Widget {

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        /** @var TYPE_NAME $nameUser */

        return $this->render('userinfo',[
                'nameUser' => $nameUser
        ]);
    }
}

?>