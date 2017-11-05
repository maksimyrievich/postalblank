<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 05.01.2017
 * Time: 23:49
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;


class FooterController extends Controller
{

    public function actionAboutMe()
    {
        return $this->render('aboutme');
    }

}
