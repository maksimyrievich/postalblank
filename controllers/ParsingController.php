<?php

namespace app\controllers;

use Yii;
use yii\base\Controller;





class ParsingController extends Controller
{
    public function actionInit()
    {

    }





    function magistralZone(){
        //Начало. Код ниже преобразует html-данные спарсеной страницы , сохраненной в файле, с магистральными зонами
        //Почты России и сохраняет его в базе данных.
        $body = file_get_contents(Yii::$app->basePath.'/parse/MagistralZone'); //Берём спарсеную страницу сайта
        // сохраненную в файл и помещаем в переменную $body
        $bodyall = \phpQuery::newDocument($body); //Создаем объект phpQuery. Помещаем его в $bodyall
        for($stolbecs = 1; $stolbecs < 100; $stolbecs++){
            $result = ''; //Переменная хранящая имя столбца
            for($bookva = 23; $bookva > -1; $bookva--) {    //$bookva - переменная хранящая количество букв в имени
                // столбца таблицы
                $name = $bodyall->find('table tr:eq(0) th:eq('.$stolbecs.') div:eq('.$bookva.')')->text();
                if($name != '-'){
                    if($name != ' '){
                        $result = $result.$name;
                    }else{
                        $name = '_';
                        $result = $result.$name;
                    }
                }else{
                    $name = '_';
                    $result = $result.$name;
                }
            }
            //Здесь сохраняем имя столбца
            $db = Yii::$app->db;
            if($stolbecs == 1){
                if($result != null){
                    $db->createCommand('CREATE TABLE magistralzone ( id INT(2) NOT NULL AUTO_INCREMENT , PRIMARY KEY (id))')
                        ->execute();
                    $db->createCommand('ALTER TABLE magistralzone ADD town VARCHAR (32)')
                        ->execute();
                    $db->createCommand('ALTER TABLE magistralzone ADD ' . $result . ' integer(1)')
                        ->execute();
                    }
                }else{
                    if($result != null) {
                        $db->createCommand('ALTER TABLE magistralzone ADD ' . $result . ' integer(1)')
                        ->execute();
                }
            }
        }
        for($stolbecs = 0; $stolbecs < 83; $stolbecs++) {
            $result = ''; //Переменная хранящая имя столбца
            for ($bookva = 23; $bookva > -1; $bookva--) {    //$bookva - переменная хранящая количество букв в имени столбца таблицы
                $name = $bodyall->find('table tr:eq(0) th:eq(' . $tmp = 1 + $stolbecs . ') div:eq(' . $bookva . ')')->text();
                if ($name != '-') {
                    if ($name != ' ') {
                        goto finish;
                    } else {
                        $name = '_';
                        goto finish;
                    }
                } else {
                    $name = '_';
                    goto finish;
                }
                finish: $result = $result . $name;
            }
            if($result != NULL){
                //Пишем в базу данных значения текущего столбца
                for ($cifra = 1; $cifra < 84; $cifra++) {
                    //Получили первую цифру второго столюца
                    $name = $bodyall->find('table tr:eq(' . $cifra . ') td:eq('. $stolbecs .')')->text();
                    if ($name != null) {
                        if($stolbecs == 0){
                            $db->createCommand('INSERT INTO magistralzone ('.$result.') VALUES ('.$name.') ')
                                ->execute();
                        }
                        $db->createCommand('UPDATE magistralzone SET '.$result.' = '.$name.' WHERE id = '. $cifra . ' ')
                            ->execute();
                    }else{
                        if($stolbecs == 0) {
                            $db->createCommand('INSERT INTO magistralzone ('.$result.') VALUES (NULL) ')
                                ->execute();
                        }
                        $db->createCommand('UPDATE magistralzone SET '.$result.' = NULL WHERE id = '. $cifra . ' ')
                            ->execute();
                    }
                }
            }
        }
        for($stolbecs = 1; $stolbecs < 84; $stolbecs++) {
            $result = ''; //Переменная хранящая имя столбца
            for ($bookva = 23; $bookva > -1; $bookva--) {    //$bookva - переменная хранящая количество букв в имени столбца таблицы
                $name = $bodyall->find('table tr:eq(0) th:eq(' . $stolbecs . ') div:eq(' . $bookva . ')')->text();
                if ($name != '-') {
                    if ($name != ' ') {
                        goto metka;
                    } else {
                        $name = '_';
                        goto metka;
                    }
                } else {
                    $name = '_';
                    goto metka;
                }
                metka:
                $result = $result . $name;
            }
                $db->createCommand('UPDATE magistralzone SET town = "'.$result.'" WHERE id ='. $stolbecs . ' ')
                    ->execute();
        }
    }   //-----Конец. Код выше преобразует данные из файла в таблицу базы данных. В файле спарсеная страница с магистральными зонами Почты России
}