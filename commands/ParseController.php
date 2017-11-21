<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use ZipArchive;



class ParseController extends Controller {

    public function actionInit()
    {
        echo " yii parse/manual-parse     - parsit zadavaemiy url. Rezultat sohranyaet v papku '/parse/parseURL'" . PHP_EOL;
        echo " yii parse/postal-index     - sozdaet v baze tabliczu indeksov pocht`i Rossii."  . PHP_EOL;
    }

    public function actionManualParse ()
    {
        $url = $this->prompt('Enter the site URL:', ['required' => true]);
        $filename = $this->prompt('Enter name the target file:', ['required' => true]);
        $data = $this->getSite($url);
        file_put_contents(Yii::$app->basePath.'/parse/'.$filename, $data);
        $this->stdout('Mission completed!', PHP_EOL);    //Выводим в консоли сообщение о завершении команды
    }

    private function getSite ($url, $referer = 'http://www.google.com'){
        //Функция getSite принимает первым параметром URL страницы сайта, которую нам нужно спарсить.
        // Вторым необязательным параметром идёт рефёрер, то есть, если не загрузить реферер, то по умолчанию будет, то что
        // браузер со своим запросом пришел с Гугла.
        //Создаём объект содержащий все настройки библиотеки curl в переменную $ch вызовом функции curl_init
        $ch = curl_init();
        //Устанавливаем URL страницы, которую нужно спарсить
        curl_setopt($ch, CURLOPT_URL, $url);
        //Устанавливаем опцию, о том что нам не нужны заголовки
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //Прикидываемся браузером мозилла
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; ry:38.0) Gecko/20100101 Firefox/38.0");
        //Устанавливаем реферер, как будто мы пришли из гугла
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        //Устанавливаем опцию означающую что нам не нужно выдавать полученные данные сразу в браузер
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Получаем и сливаем спарсеные данные в переменную $data
        $data = curl_exec($ch);
        //Закрываем соединение с сайтом
        curl_close($ch);
        //Возвращаем полученные данные
        return $data;
    }

    private function unZip($archive, $folder) {
        $zip = new ZipArchive();
        if (!file_exists($archive)) {
            throw new Exception('Архив не найден');
        }
        $zip->open($archive);
        $zip->extractTo($folder);
        $zip->close();
    }

    public function actionPostalIndex (){
        //Загружаем спарсеный файл
        $body = file_get_contents(Yii::$app->basePath.'/parse/parseURL');
        //TODO: нужно реализовать онлайн парсинг страницы вместо загрузки из файла
        //Создаем объект phpQuery
        $htmltext = \phpQuery::newDocument($body);
        //Выбираем, то что нам нужно
        $htmltext = $htmltext->find('table:eq(4) .link')->text();
        //Регулярным выражением создаем массив из всех вхождений в html строке нашего паттерна
        $count = preg_match_all('/[^N]PIndx([0-9]{1,2}).zip/',$htmltext, $massiv);
        //TODO: нужно реализовать проверку => если последняя база - актуальна, то выходим из экшена
        //Получаем и загружаем спарсеные данные html в переменную
        $data = $this->getSite('http://vinfo.russianpost.ru/database/'.trim($massiv[0][$index = $count - 1]).'');
        //Сохраняем данные в файл
        file_put_contents(Yii::$app->basePath.'/parse/'.$massiv[0][$index], $data);
        //Разархивируем архив zip и сохраним полученные данные в папке parse
        $this->unZip(Yii::$app->basePath.'/parse/'.$massiv[0][$index], Yii::$app->basePath.'/parse/');
        //Удаляем zip архив. Получили базу данных PIndx21.dbf в папке parse
        unlink (Yii::$app->basePath.'/parse/'.$massiv[0][$index]);
        // Путь к файлу PIndx21.dbf в папке parse
        $db_path = Yii::$app->basePath.'/parse/PIndx'.$massiv[1][$index].'.dbf';
        // Открываем файл БД
        $dbh = dbase_open($db_path, 0)
        or die("Ошибка! Не получается открыть файл ''.");
        //TODO: нужно по всему экшену реализовать логирование по времени в файл
        //Узнаём количество столбцов в таблице
        $column_quantity = dbase_numfields($dbh);
        //Получаем массив имён столбцов таблицы
        $column_name = dbase_get_header_info($dbh);
        //Узнаём количество записей в таблице
        $string_quantity = dbase_numrecords($dbh);
        //построчный обход таблицы, создание и сохранение
        for ($j = 1;  $j < $string_quantity;  $j++) {
            //Если указатель на первой строчке, то
            if ($j == 1) {
                //Создаем экземпляр подключения к базе данных
                $db = Yii::$app->db;
                //Создаем таблицу "indextable" с полем "id"
                $db->createCommand('CREATE TABLE index_table (id INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (id))')
                    ->execute();
                //Добавляем все поля в таблицу в цикле
                for ($i = 0; $i < $column_quantity; $i++) {
                    $db->createCommand('ALTER TABLE index_table ADD `' .$column_name[$i]['name']. '` VARCHAR(255)')
                        ->execute();

                }
            }
            //TODO: здесь нужно реализовать сохранение версии базы в таблице
            //Создаём строки в таблице и заполняем их значениями в цикле
            for ($i = 0; $i < $column_quantity; $i++) {
                //получение строки со значениями столбцов по номеру строки
                $rec = dbase_get_record($dbh, $j);
                //Приводим строку в порядок. Удаляем лишние пробелы, недопустимые символы, меняем кодировку на UTF-8
                $data = preg_replace("/[\"]{1,}|\s\s+/","",iconv('CP866', 'UTF-8', $rec[$i]));
                //При $i равной нулю
                if ($i == 0){
                    //Создаем строку в базе данных со значением в первом столбце
                    $db->createCommand('INSERT INTO index_table (`'.$column_name[$i]['name'].'`) VALUES ("'.$data.'")')
                        ->execute();
                }
                //Дальше заполняем строку оставшимися значениями последующих столбцов
                $db->createCommand('UPDATE index_table SET `'.$column_name[$i]['name'].'` = "'.$data.'" WHERE `id` = "'.$j. '" ')
                    ->execute();
                //Ворачиваемся на начало цикла для заполнения следующего столбца текущей строки или, если последний
                //столбец строки был заполнен, выходим из цикла заполнения строки
            }
            //Ворачиваемся на начало цикла для перехода к следующей строке базы данных, или если последняя
            //строка была заполнена, выходим из этого цикла
        }
        //Закрываем соединение с базой данных
        dbase_close($dbh);
        //TODO: Здесь реализуем резервирование старой базы до момента создания новой через переименование старой и новой баз

        //Выводим в консоль сообщение о завершении создания таблицы индексов
        $this->stdout('Mission completed!', PHP_EOL);    //Выводим в консоли сообщение о завершении команды
    }


}


