<?php

namespace app\controllers;

use Yii;
use yii\base\Controller;


class ParsingController extends Controller
{
    public function actionInit()
    {
//        //Загружаем объект содержащий все настройки библиотеки curl в переменную $ch вызовом функции curl_init
//        $ch = curl_init();
//        //Устанавливаем URL на который будет производится запрос выдачи страницы
//        curl_setopt($ch, CURLOPT_URL, 'http://vinfo.russianpost.ru/database/ops.html');
//        //Устанавливаем опцию, о том что нам не нужны заголовки
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        //Прикидываемся браузером мозилла
//        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; ry:38.0) Gecko/20100101 Firefox/38.0");
//        //Устанавливаем реферер, как будто мы пришли из гугла
//        curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
//        //Устанавливаем опцию означающую что нам не нужно выдавать полученные данные сразу в браузер
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        //Получаем и загружаем спарсеные данные html в переменную
//        $body = curl_exec($ch);
//        //Закрываем соединение с сайтом
//        curl_close($ch);

        $body = file_get_contents(Yii::$app->basePath.'/runtime/parse/parseURL');



        return $this->render('parsing',['body' => $body]);
    }






}