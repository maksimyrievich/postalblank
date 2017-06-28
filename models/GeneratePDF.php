<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 07.02.2017
 * Time: 22:51
 */

namespace app\models;

use Yii;
use yii\base\Model;
use TCPDF;


class GeneratePDF extends Model {

    //Строковая Функция. Преобразует числа (int) в числа прописью
    public function num_propis($num) // $num - цело число
    {
        // Все варианты написания чисел прописью от 0 до 999 скомпонуем в один небольшой массив
        $m=array(
            array('ноль'),
            array('-','один','два','три','четыре','пять','шесть','семь','восемь','девять'),
            array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'),
            array('-','-','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'),
            array('-','сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'),
            array('-','одна','две')
        );
        // Все варианты написания разрядов прописью скомпануем в один небольшой массив
        $r=array(
            array('...ллион','','а','ов'), // используется для всех неизвестно больших разрядов
            array('тысяч','а','и',''),
            array('миллион','','а','ов'),
            array('миллиард','','а','ов'),
            array('триллион','','а','ов'),
            array('квадриллион','','а','ов'),
            array('квинтиллион','','а','ов')
            // ,array(... список можно продолжить
        );
        if($num == 0)return $m[0][0]; // Если число ноль, сразу сообщить об этом и выйти
        $o=array(); // Сюда записываем все получаемые результаты преобразования
        // Разложим исходное число на несколько трехзначных чисел и каждое полученное такое число обработаем отдельно
        foreach(array_reverse(str_split(str_pad($num,ceil(strlen($num)/3)*3,'0',STR_PAD_LEFT),3))as$k=>$p){
            $o[$k]=array();
            // Алгоритм, преобразующий трехзначное число в строку прописью
            foreach($n=str_split($p)as$kk=>$pp)
                if(!$pp)continue;else
                    switch($kk){
                        case 0:$o[$k][]=$m[4][$pp];break;
                        case 1:if($pp==1){$o[$k][]=$m[2][$n[2]];break 2;}else$o[$k][]=$m[3][$pp];break;
                        case 2:if(($k==1)&&($pp<=2))$o[$k][]=$m[5][$pp];else$o[$k][]=$m[1][$pp];break;
                    }$p*=1;if(!$r[$k])$r[$k]=reset($r);
            // Алгоритм, добавляющий разряд, учитывающий окончание руского языка
            if($p&&$k)switch(true){
                case preg_match("/^[1]$|^\\d*[0,2-9][1]$/",$p):$o[$k][]=$r[$k][0].$r[$k][1];break;
                case preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/",$p):$o[$k][]=$r[$k][0].$r[$k][2];break;
                default:$o[$k][]=$r[$k][0].$r[$k][3];break;
            }$o[$k]=implode(' ',$o[$k]);
        }
        return implode(' ',array_reverse($o));
    }

    //Ниже в переменной $setblank показан макет структуры этой переменной
    //$setblank->blankF7P = $settings[0];
    //$setblank->blankF112P = $settings[1];
    //$setblank->obiavlenncennost = $settings[2];
    //$setblank->nalogennplatege = $settings[3];
    //$setblank->typ_posilki = $settings[4];
    //$setblank->jde_blank = $settings[5];
    //$setblank->pek_blank = $settings[6];
    //$setblank->dellin_blank = $settings[7];

    public function GeneratePDF($datablank, &$setblank)
    {
        $pdf = new TCPDF('P','mm','A4',true, 'UTF-8');

        if(!empty($setblank[0])) {                                      //Если в настройках включена выдача бланка ф-7п
            $pdf = $this->GenerateF7P($pdf, $datablank, $setblank);     //Генерируем Бланк Почты России Ф-7п - почтовый ярлык
        }
        if(!empty($setblank[1])) {                                      //Если в настройках включена выдача бланка Ф-112ап
            $pdf = $this->GenerateF112AP($pdf, $datablank, $setblank);  //Генерируем Бланк Почты России Ф-112ап - бланк наложенного платежа
        }
        if(!empty($setblank[5])) {                                      //Если в настройках включена выдача бланка JelDor
            $pdf = $this->GenerateJelDor($pdf, $datablank, $setblank);     //Генерируем Бланк транспортной компании JelDor бланк сдачи товара
        }
        $pdf->Output( Yii::getAlias('@blank/file.pdf'),'F');
    }

    private function GenerateF7P($pdf, $datablank, &$setblank)
    {
        //ниже генерируем бланки
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('freesans', '', 8);
        //Создаём новую страницу
        $pdf->startPage(['P']);
        //Выводим форму бланка
        $pdf->Image(Yii::getAlias('@blank_image/postalblank_F7P.jpg'), -2.3, 14, 216, 155);
        //Ставим галочку на отметке "посылка"
        $pdf->Image(Yii::getAlias('@blank_image/postalblank_GAL.jpg'), 68, 17.2, 3, 3);
        //Заполняем поле формы "от кого"
        $pdf->SetTextColor($pdf->pdfcolors[0][0], $pdf->pdfcolors[0][1], $pdf->pdfcolors[0][2]);
        $pdf->SetXY(29,52.5);
        $pdf->setfontsize(9);
        $pdf->MultiCell(76,3, $datablank->out_f_name." ".$datablank->out_l_name." ".$datablank->out_m_name,0,'L');
        //Заполняем поле формы "откуда"
        $pdf->SetXY(22.4,68.8);
        $pdf->setfontsize(9);
        $pdf->setCellHeightRatio(1.5);
        $pdf->MultiCell(83,3, $datablank->out_street.", ".$datablank->out_city.", ".$datablank->out_state,0,'L');
        //Заполняем поле "индекс отправителя"
        $pdf->setfontsize(11);
        $simbol = str_split($datablank->out_zip);
        $align = 0;
        for($i = 0; $i < strlen($datablank->out_zip); $i++){
            $pdf->SetXY(78.2 + $align,85.6);
            $pdf->MultiCell(76,3, $simbol[$i],0,'L');
            $align = $align + 4.35;}
        //Заполняем поле формы "кому"
        $pdf->SetXY(112,78.8);
        $pdf->setfontsize(9);
        $pdf->MultiCell(76,3, $datablank->f_name." ".$datablank->l_name." ".$datablank->m_name,0,'L');
        //Заполняем поле формы "куда"
        $pdf->SetXY(105.5,94.3);
        $pdf->setfontsize(9);
        $pdf->setCellHeightRatio(1.6);
        $pdf->MultiCell(83,3, $datablank->street.", ".$datablank->city.", ".$datablank->state,0,'L');
        //Заполняем поле "индекс получателя
        $pdf->setfontsize(11);
        $simbol = str_split($datablank->zip);
        $align = 0;
        for($i = 0; $i < strlen($datablank->zip); $i++) {
            $pdf->SetXY(160.7 + $align,112);
            $pdf->MultiCell(76,3, $simbol[$i],0,'L');
            $align = $align + 4.35;
        }
            //Заполняем поле объявленная ценность
            if(!empty($setblank[2]|$setblank[3])){
                $pdf->SetXY(106, 46);
                $pdf->setfontsize(9);
                $pdf->setCellHeightRatio(1.2);
                $pdf->MultiCell(81, 3, round($datablank->order_total)." (".$this->num_propis(round($datablank->order_total)).")", 0, 'L');
                $pdf->Image(Yii::getAlias('@blank_image/postalblank_GAL.jpg'), 106.7, 17.2, 1.5, 1.5);
            }
            //Заполняем поле сумма наложенного платежа
            if(!empty($setblank[3])) {
                $pdf->SetXY(106, 57.5);
                $pdf->setfontsize(9);
                $pdf->setCellHeightRatio(1.2);
                $pdf->MultiCell(81, 3, round($datablank->order_total)." (".$this->num_propis(round($datablank->order_total)).")", 0, 'L');
                $pdf->Image(Yii::getAlias('@blank_image/postalblank_GAL.jpg'), 106.7, 20.3, 1.5, 1.5);
            }
            $pdf->endPage();
            return $pdf;
    }

    private function GenerateF112AP($pdf, $datablank, &$setblank)
    {
        //ниже генерируем бланки
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('freesans', '', 8);
        //Создаём новую страницу
        $pdf->startPage(['P']);
        //Выводим форму бланка
        $pdf->Image(Yii::getAlias('@blank_image/postalblank_F112AP.jpg'), 10, 10, 194, 273);

        //Заполняем поле объявленная ценность цифрами
        if(!empty($setblank[3])){
            $pdf->SetXY(18.4, 57.9);
            $pdf->setfontsize(10);
            $pdf->MultiCell(20, 3, round($datablank->order_total), 0, 'C');
        }
        //Заполняем поле объявленная ценность прописью
        if(!empty($setblank[3])) {
            $pdf->SetXY(62, 53.6);
            $pdf->setfontsize(9);
            $pdf->MultiCell(137, 3, $this->num_propis(round($datablank->order_total)) .' руб.', 0, 'L');
        }
        //Заполняем поле формы "Кому"
        $pdf->SetTextColor($pdf->pdfcolors[0][0], $pdf->pdfcolors[0][1], $pdf->pdfcolors[0][2]);
        $pdf->SetXY(29,73.5);
        $pdf->setfontsize(9);
        $pdf->MultiCell(76,3, $datablank->out_f_name." ".$datablank->out_l_name." ".$datablank->out_m_name,0,'L');
        //Заполняем поле формы "Куда"
        $pdf->SetXY(17,78.4);
        $pdf->setfontsize(9);
        $pdf->setCellHeightRatio(1.9);
        ////Пробелы не удалять - это настройка! 15 пробелов должно быть!
        $pdf->MultiCell(177,2, "               ".$datablank->out_street.", ".$datablank->out_city.", ".$datablank->out_state,0,'L');
        //Заполняем поле "Индекс получателя" Настроено!
        $pdf->setfontsize(11);
        $simbol = str_split($datablank->out_zip);
        $align = 0;
        for($i = 0; $i < strlen($datablank->out_zip); $i++){
            $pdf->SetXY(166.5 + $align,83);
            $pdf->MultiCell(76,3, $simbol[$i],0,'L');
            $align = $align + 4.7;}
        //Заполняем поле формы "От кого" Настроено!
        $pdf->SetXY(37,123);
        $pdf->setfontsize(9);
        $pdf->MultiCell(157,1, $datablank->f_name." ".$datablank->l_name." ".$datablank->m_name,0,'L');
        //Заполняем поле формы "Адрес отправителя" Настроено!
        $pdf->SetXY(17,129.5);
        $pdf->setfontsize(9);
        $pdf->setCellHeightRatio(1.6);
        //Пробелы не удалять - это настройка! 50 пробелов должно быть!
        $pdf->MultiCell(176,2, "                                                  ".$datablank->street.", ".$datablank->city.", ".$datablank->state,0,'L');
        //Заполняем поле "Индекс отправителя" Настроено!
        $pdf->setfontsize(11);
        $simbol = str_split($datablank->zip);
        $align = 0;
        for($i = 0; $i < strlen($datablank->zip); $i++) {
            $pdf->SetXY(166.7 + $align,134);
            $pdf->MultiCell(76,3, $simbol[$i],0,'L');
            $align = $align + 4.65;
        }
        $pdf->endPage();
        return $pdf;
    }

    private function GenerateJelDor($pdf, $datablank, &$setblank)
    {
        //ниже генерируем бланки
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('freesans', '', 8);
        //Создаём новую страницу
        $pdf->startPage(['P']);
        //Выводим форму бланка
        $pdf->Image(Yii::getAlias('@blank_image/postalblank_JelDor.jpg'), 10, 10, 194, 273);

        //Заполняем поле объявленная ценность цифрами
        if(!empty($setblank[3])){
            $pdf->SetXY(18.4, 57.9);
            $pdf->setfontsize(10);
            $pdf->MultiCell(20, 3, round($datablank->order_total), 0, 'C');
        }
        //Заполняем поле объявленная ценность прописью
        if(!empty($setblank[3])) {
            $pdf->SetXY(62, 53.6);
            $pdf->setfontsize(9);
            $pdf->MultiCell(137, 3, $this->num_propis(round($datablank->order_total)) .' руб.', 0, 'L');
        }
        //Заполняем поле формы "Кому"
        $pdf->SetTextColor($pdf->pdfcolors[0][0], $pdf->pdfcolors[0][1], $pdf->pdfcolors[0][2]);
        $pdf->SetXY(29,73.5);
        $pdf->setfontsize(9);
        $pdf->MultiCell(76,3, $datablank->out_f_name." ".$datablank->out_l_name." ".$datablank->out_m_name,0,'L');
        //Заполняем поле формы "Куда"
        $pdf->SetXY(17,78.4);
        $pdf->setfontsize(9);
        $pdf->setCellHeightRatio(1.9);
        ////Пробелы не удалять - это настройка! 15 пробелов должно быть!
        $pdf->MultiCell(177,2, "               ".$datablank->out_street.", ".$datablank->out_city.", ".$datablank->out_state,0,'L');
        //Заполняем поле "Индекс получателя" Настроено!
        $pdf->setfontsize(11);
        $simbol = str_split($datablank->out_zip);
        $align = 0;
        for($i = 0; $i < strlen($datablank->out_zip); $i++){
            $pdf->SetXY(166.5 + $align,83.5);
            $pdf->MultiCell(76,3, $simbol[$i],0,'L');
            $align = $align + 4.7;}
        //Заполняем поле формы "От кого" Настроено!
        $pdf->SetXY(37,123);
        $pdf->setfontsize(9);
        $pdf->MultiCell(157,1, $datablank->f_name." ".$datablank->l_name." ".$datablank->m_name,0,'L');
        //Заполняем поле формы "Адрес отправителя" Настроено!
        $pdf->SetXY(17,129.5);
        $pdf->setfontsize(9);
        $pdf->setCellHeightRatio(1.6);
        //Пробелы не удалять - это настройка! 50 пробелов должно быть!
        $pdf->MultiCell(176,2, "                                                  ".$datablank->street.", ".$datablank->city.", ".$datablank->state,0,'L');
        //Заполняем поле "Индекс отправителя" Настроено!
        $pdf->setfontsize(11);
        $simbol = str_split($datablank->zip);
        $align = 0;
        for($i = 0; $i < strlen($datablank->zip); $i++) {
            $pdf->SetXY(166.7 + $align,134);
            $pdf->MultiCell(76,3, $simbol[$i],0,'L');
            $align = $align + 4.65;
        }
        $pdf->endPage();
        return $pdf;
    }


}