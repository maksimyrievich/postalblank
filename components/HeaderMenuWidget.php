<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 11.12.2016
 * Time: 13:19
 */


namespace app\components;



use yii\base\Widget;


// расширяем класс Widget
class HeaderMenuWidget extends Widget {

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {

        return $this->render('headermenu');
    }
}

?>