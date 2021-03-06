<?php

namespace app\controllers;

use app\models\GeneratePDF;
use app\models\ProtocolForm;
use app\models\RulesTable;
use Yii;
use app\models\TranzactionTable;
use app\models\TranzactionTableSearch;
use app\models\PlaginsTable;
use app\models\User;
use yii\bootstrap\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\GeneratedBlank;



/**
 * TranzactionController implements the CRUD actions for TranzactionTable model.
 */
class TranzactionController extends Controller
{
    public function beforeAction($action)
    {
        if($action->id == 'input'){
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    //'input' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TranzactionTableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new TranzactionTable();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = TranzactionTable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInput()
    {
        $model = new ProtocolForm();           //Создаем экземпляр запроса
        if(!$model->load(Yii::$app->request->post(),''))//Загружаем данные в модель
        {
            //print_r($model->Errors);//Если загружены с ошибками - выдаём эти ошибки
        //Проверяем валидны ли полученные данные. Здесь, в том числе, проверяется есть ли такой ключ транзакции в базе данных
        //и если есть то какому юзеру он принадлежит.
        }elseif (!$model->validate())
            {
                print_r($model->Errors);//Если нет, то выводим на экран ошибки.

            } else { //Если да, то начинаем обработку данных из запроса
            $tranzaction = new TranzactionTable(); //Создаем экземпляр и начинаем его заполнять данными  транзакции для последующего их сохранения в таблице транзакций
            $tranzaction->date_tranzaction = (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s'); //Сохраняем дату
            $tranzaction->domen_tranzaction = $model->url; //Yii::$app->request->hostInfo; //Сохраняем имя сайта откуда пришел запрос
            $tranzaction->key_tranzaction = $model->key_tranzaction; //Сохраняем ключ транзакции
            $tranzaction->delivery_type = $model->delivery_type; //Сохраняем тип доставки пришедший из плагина в запросе

            $rules = RulesTable::find() //Выбираем из базы данных правил, все правила созданные юзером который отправил запрос
                //Выбираем из таблицы записи в которых user_id равно id полученной из модели запроса
                ->where(['user_id' => $model->user->id])
                //Выводить данные в виде массива
                ->asArray()
                //Все строки
                ->all();
            //debug($rules);
            foreach ($rules as $key => $value){
                $str = '';
                $perem = $rules[$key]['regular_filter_1'];
                preg_match("~$perem~", $model->delivery_type, $result);
                $str .= $result[0];
                $perem = $rules[$key]['regular_filter_2'];
                preg_match("~$perem~", $model->delivery_type, $result);
                $str .= ' '.$result[0];
                $perem = $rules[$key]['regular_filter_3'];
                preg_match("~$perem~", $model->delivery_type, $result);
                $str .= ' '.$result[0];
                $perem = $rules[$key]['regular_filter_4'];
                preg_match("~$perem~", $model->delivery_type, $result);
                $str .= ' '.$result[0];
                $perem = $rules[$key]['regular_filter_5'];
                preg_match("~$perem~", $model->delivery_type, $result);
                $str .= ' '.$result[0];
                if($rules[$key]['regular_rule'] === $str){
                    $pravilo = $rules[$key];
                    break ;
                }else{$pravilo = 'Правило не задано';}
            }
            //debug($pravilo);
            if(!($pravilo === 'Правило не задано')) {
                $setting = unserialize($pravilo[settings_rule]);
                //debug($setting);
                if (!($model->user->balance <= 0)) {
                    $string = ''; //Строка хранящая информацию о том какие бланки отдавались с запросом
                    $flag = false; //Ни один бланк в настройках не включен
                    $tarif = 1; // 2 рубля за один бланк
                    $summa = 0; // Общая стоимость транзакции
                    if (!empty(($setting[0]) or ($setting[1]))) {
                        $string = 'Почта России:';
                        if (!empty($setting[0])) {
                            $string .= ' (ф.7-п),';
                            $flag = true;
                            $summa = $summa + $tarif;
                        }
                        if (!empty($setting[1])) {
                            $string .= ' (ф.112ЭП),';
                            $flag = true;
                            $summa = $summa + $tarif;
                        }
                    }
                    if (!empty($setting[5])) {
                        $string .= ' Бланк ЖДЭ,';
                        $flag = true;
                        $summa = $summa + $tarif;
                    }
                    if (!empty($setting[6])) {
                        $string .= ' Бланк ПЭК,';
                        $flag = true;
                        $summa = $summa + $tarif;
                    }
                    if (!empty($setting[7])) {
                        $string .= ' Бланк ДелЛин';
                        $flag = true;
                        $summa = $summa + $tarif;
                    }
                    if ($flag === false) {
                        $string = 'Бланки для этого правила не заданы';
                        $summa = 0;
                    }
                    $tranzaction->body_tranzaction = $string;
                    $tranzaction->balance = $model->user->balance - $summa;
                } else {
                    $tranzaction->body_tranzaction = 'На балансе недостаточно средств. Пополните свой баланс';
                    $tranzaction->balance = $model->user->balance;
                }
            }else{
                $tranzaction->body_tranzaction = 'Правило не создано для этого вида доставки';
                $tranzaction->balance = $model->user->balance;
            }
            $tranzaction->userid_tranzaction = $model->user->id;
            $tranzaction->status_tranzaction = 'запрос бланков';    //
            $tranzaction->save();
            $user = User::findOne($model->user->id);
            $user->balance = $tranzaction->balance;
            $user->save();

            $pdf = new GeneratePDF();
            $pdf->GeneratePDF($model, $setting);

           Yii::$app->response->sendFile( Yii::getAlias('@blank/file.pdf') );
        }

    }

    public function actionOutput()
    {
        $url = $_SERVER["SERVER_NAME"];     //Вытягиваем урл с которого будем делать запрос на бланки
        $out_f_name = 'Китайгородский' ;     //Фамилия отправителя
        $out_l_name = 'Максим';     //Имя отправителя
        $out_m_name = 'Юрьевич';     //Отчество отправителя
        $out_street = 'ул. Саратовское Шоссе, д. 91, кв. 21';     //Улица, дом, квартира отправителя
        $out_zip = '413864';        //Индекс отправителя
        $out_city = 'г.Балаково';       //Город отправителя
        $out_state = 'Саратовская область';      //Область отправителя
        $out_country = 'Россия';    //Страна отправителя
        $f_name = 'Петров';         //Фамилия получателя
        $l_name = 'Пётр';         //Имя получателя
        $m_name = 'Петрович';         //Отчество получателя
        $street = 'ул. Петрова, д. 23, кв 45.';         //Улица, дом, квартира получателя
        $zip = '546345';            //Индекс получателя
        $city = 'Петровск';           //Город получателя
        $state = 'Саратовская область ';          //Область получателя
        $country = 172;        //Страна получателя
        $order_total = 3456;    //Сумма счета
        $delivery_type = '17 дней Почта России (наземная посылка со страховкой)Российская Федерация, Архангельская область, ';  //Тип доставки
        $key_tranzaction = '9ff19546573297c9cea40191349bb062';//Ключ транзакции

        $ch = curl_init();                  //инициализируем сессию и возвращаем ее дескриптор
        $_csrf = http_build_query(['_csrf'=>$_COOKIE['_csrf']]);
        $token = http_build_query([
            'out_f_name'=>$out_f_name,'out_l_name'=>$out_l_name,
            'out_m_name'=>$out_m_name,'out_street'=>$out_street,'out_zip'=>$out_zip,
            'out_city'=>$out_city,'out_state'=>$out_state,'out_country'=>$out_country,
            'f_name'=>$f_name,'l_name'=>$l_name,'m_name'=>$m_name,'street'=>$street,
            'zip'=>$zip,'city'=>$city,'state'=>$state,'country'=>$country,
            'order_total'=>$order_total,'delivery_type'=>$delivery_type,
            'key_tranzaction'=>$key_tranzaction, '_csrf'=>Yii::$app->request->getCsrfToken(),'url'=>$_SERVER["SERVER_NAME"]]);
        curl_setopt($ch, CURLOPT_URL, 'http://postalblank.ru/web/tranzaction/input');            //Указываем на какой урл будем передавать данные
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $_csrf);           //Указываем способ передачи данных
        curl_setopt($ch, CURLOPT_POSTFIELDS, $token );   //Указываем данные, которые будем передавать на сервер
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Сохранять полученный ответ от сервера будем в переменную
        curl_setopt($ch, CURLOPT_HEADER, 1);            //Читать заголовки
        $output = curl_exec($ch);
        curl_close($ch);
       //return $output;
        //Сохраняем полученный контент в файл.
       return Yii::$app->getResponse()->sendContentAsFile($output,'385_186e4cda8a0534b7d20db247f07dfbc7.pdf' );
        //Yii::$app->getResponse()->send($output);
    }
}

