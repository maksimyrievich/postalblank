<?php

namespace app\commands;

use Yii;
use yii\console\Controller;



class ParseController extends Controller {

    public function actionInit()
    {
        echo " yii parse/start - parsit URL. Rezultat '/parse/parseURL'" . PHP_EOL;
    }

    public function actionStart ()
    {
        $url = $this->prompt('Enter the site URL:', ['required' => true]);
        $filename = $this->prompt('Enter the create file name:', ['required' => true]);
        $data = $this->getSite($url);
        file_put_contents(Yii::$app->basePath.'/parse/'.$filename, $data);
        $this->stdout('Done!', PHP_EOL);    //Выводим в консоли сообщение о завершении команды
    }

    //Функция getSite принимает первым параметром URL адрес страницы сайта, которую нам нужно скачать.
    // Вторым необязательным параметром идёт рефёрер, то есть, если не загрузить реферер, то по умолчанию будет, то что
    // браузер со своим запросом пришел с Гугла.
    private function getSite ($url, $referer = 'http://www.google.com'){
        //Загружаем объект содержащий все настройки библиотеки curl в переменную $ch вызовом функции curl_init
        $ch = curl_init();
        //Устанавливаем URL на который будет производится запрос выдачи страницы
        curl_setopt($ch, CURLOPT_URL, $url);
        //Устанавливаем опцию, о том что нам не нужны заголовки
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //Прикидываемся браузером мозилла
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; ry:38.0) Gecko/20100101 Firefox/38.0");
        //Устанавливаем реферер, как будто мы пришли из гугла
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        //Устанавливаем опцию означающую что нам не нужно выдавать полученные данные сразу в браузер
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Получаем и загружаем спарсеные данные html в переменную
        $data = curl_exec($ch);
        //Закрываем соединение с сайтом
        curl_close($ch);
        //Возвращаем полученные данные
        return $data;
    }


}


