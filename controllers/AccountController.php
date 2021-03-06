<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 05.01.2017
 * Time: 23:49
 */

namespace app\controllers;

use app\models\BlankMenuForm;
use app\models\CreateRulesForm;
use app\models\EditDataForm;
use app\models\RulesTable;
use app\models\SaveRulesForm;
use app\models\LoginForm;
use app\models\MoneyTransferTable;
use app\models\User;
use app\models\UsersTable;
use app\models\YandexMoneyForm;
use app\models\TranzactionTable;
use yii\filters\VerbFilter;
use Yii;
use yii\web\Controller;


class AccountController extends Controller
{
    public function beforeAction($action)
    {
        if($action->id == 'money'){
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
                    'money' => ['POST'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        //Если юзер не гость то идём в личный кабинет
        if (!Yii::$app->user->isGuest) {
            return $this->render('mytransactions');
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('mytransactions');
        } else {
            return $this->render('login', ['model' => $model,]);

        }
    }

    public function actionLogout()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        Yii::$app->user->logout();
        return $this->goHome();
    }

//    public function actionMytransactions()
//    {
//        //Если юзер гость то идём на страницу входа в личный кабинет
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect('/account/login');}
//        return $this->render('mytransactions');
//    }

    public function actionBalance()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        //Сносим старые данные из базы данных за вчерашнее число
        Yii::$app->db->createCommand()->delete('moneytransfer', 'time_transaction < CURRENT_DATE')->execute();
        //Создаем экземпляр строки таблицы которая будет хранить данные о транзакции
        $datatransfer = new MoneyTransferTable();
        //Заносим в этот экземпляр текущую дату
        $datatransfer->time_transaction = (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s'); //Сохраняем дату
        //Заносим ID юзера
        $datatransfer->user_id = Yii::$app->user->id;
        //Выдергиваем все токены из базы какие сейчас в ней есть
        $token_db = Yii::$app->db->createCommand('SELECT token_transaction FROM moneytransfer')->queryColumn();
        start:
        //Начинаем генерить токен транзакции по определённому алгоритму
        $datatransfer->token_transaction = md5(uniqid(rand(0,32)));
        //Сравниваем все токены из БД со сгенерированным только что
        foreach ($token_db as $key => $value){
            //если такой токен уже есть в БД,
            if($token_db[$key] === $datatransfer->token_transaction){
                // возвращаемся генерить новый токен на метку старт.
                goto start;
            }
        }
        // а если такого токена нет в БД, то сохраняем транзакцию с этим токеном в БД
        $datatransfer->save();
        //Создаем экземпляр модели данных формы для отправки на сервер Яндекс Денег
        $model = new YandexMoneyForm();
        //Грузим в модель токен будущей транзакции
        $model->label = $datatransfer->token_transaction;

        //Рендерим модель вьюхи в браузер пользователя
        return $this->render('balance', ['model'=> $model]);
    }

    public function actionMoney()
    {
        // Параметры, которые мы получаем при HTTP информировании при оплате с карты
        // $_POST['notification_type'] - Для переводов из кошелька — p2p-incoming. Для переводов с произвольной карты — card-incoming.
        // $_POST['amount'] - количество денег, которые поступят на счет получателя
        // $_POST['datetime'] - дата и время оплаты
        // $_POST['codepro'] - для переводов из кошелька — перевод защищен кодом протекции. Для переводов с произвольной карты — всегда false.
        // $_POST['withdraw_amount'] - количество денег, которые будут списаны со счета покупателя
        // $_POST['sender'] - если оплата производится через Яндекс Деньги, то этот параметр содержит номер кошелька покупателя
        // $_POST['sha1_hash'] - SHA-1 hash параметров уведомления.
        // $_POST['unaccepted'] - дата и время оплаты
        // $_POST['operation_label'] - дата и время оплаты
        // $_POST['operation_id'] - номер операции (огромное число, в БД советую создать поле varchar 255)
        // $_POST['currency'] - код валюты — всегда '643' (рубль РФ согласно ISO 4217).
        // $_POST['label'] - лейбл, который мы указывали в форме оплаты
        $secret_key = 'yTmZUObYpBvOnJV7Iyd8THcx'; // секретное слово, которое мы получили в в настройках http-уведомлений на сайте Яндекс Денег.
        $sha1 = sha1($_POST['notification_type'] . '&' . $_POST['operation_id'] . '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&' . $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key . '&' . $_POST['label']);
        if ($sha1 != $_POST['sha1_hash']) {
            // тут содержится код на случай, если верификация не пройдена
            $dump = '';
            $f = fopen('notify.txt', 'w+');
            foreach ($_POST as $k => $row) $dump .= "$k => $row\n";
            fwrite($f, $dump);
            fclose($f);
            exit();
        }
        // тут код на случай, если проверка прошла успешно
        $dump = '';
        $f=fopen('notify.txt','w+');
        foreach($_POST as $k=>$row) $dump .="$k => $row\n";
        fwrite($f,$dump);
        fclose($f);
        //exit();
        $datatransfer = Yii::$app->db->createCommand('SELECT user_id FROM moneytransfer WHERE token_transaction = :token ')
            ->bindValue(':token', $_POST['label'])
            ->queryOne();
        $user_id = $datatransfer['user_id'];
        $datauser = UsersTable::findOne(['id' => $user_id]);
        $datauser->balance = $datauser->balance + $_POST['withdraw_amount'];
        $datauser->save();
    }

    public function actionMydata()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        $user = User::findIdentity(Yii::$app->user->id);
        //$id = Yii::$app->request->get('id');
        return $this->render('mydata',['user' => $user]);
    }

    public function actionGenerateKey()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $user->generateKeySecret();
        $user->save();
        return $this->render('mydata', ['user' => $user]);
    }

    public function actionEditData()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        $model = new EditDataForm();
        $user = User::findIdentity(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->firstname = $model->firstname;
            $user->lastname = $model->lastname;
            $user->telephone = $model->telephone;
            $user->save();
            return $this->render('mydata', ['user' => $user]);
        } else {
            $model->firstname = $user->firstname;
            $model->lastname = $user->lastname;
            $model->telephone = $user->telephone;
            return $this->render('editdata',['model' => $model,'user' => $user]);
        }
    }


    public function actionDataTransaction()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }

        return $this->render('datatransaction');
    }

    public function actionCreaterule()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }

        $model = new CreateRulesForm(['scenario' => 'resultfilter']);
        $id = Yii::$app->request->get('id');
        return $this->render('createrule', ['id'=>$id, 'rulesform'=>$model]);
    }



    public function actionSaverule()
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        $model = new CreateRulesForm(['scenario' => 'resultsave']);

        //Если модель загружена то
        if ($model->load(Yii::$app->request->post())) {

            if($model->validate()){
            $rule = new RulesTable();
            $rule->user_id = Yii::$app->user->id;
            $rule->delivery_type = $model->delivery_type;
            $rule->regular_filter_1 = $model->regular_filter_1;
            $rule->regular_filter_2 = $model->regular_filter_2;
            $rule->regular_filter_3 = $model->regular_filter_3;
            $rule->regular_filter_4 = $model->regular_filter_4;
            $rule->regular_filter_5 = $model->regular_filter_5;
            $rule->regular_rule = $model->regular_rule;
            $rule->settings_rule_decode = 'Бланки для этого правила не заданы';
            $rule->save();
            $model = RulesTable::find();
            return $this->render('saverule', ['model' => $model, 'rulesform'=>$model]);

            }else{
                $model = new CreateRulesForm(['scenario' => 'resultfilter']);
                $id = Yii::$app->request->get('id');
                return $this->render('createrule', ['id'=>$id, 'rulesform'=>$model]);
            }
        //иначе если модель не загружена
        } else {
            //debug(Yii::$app->request->post());
            return $this->render('saverule');
        }
        //debug($id);
    }

    /**
     * Displays a single RulesTable model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        return $this->render('/rules-table/view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Updates an existing RulesTable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            $model = new CreateRulesForm(['scenario' => 'resultfilter']);
//            $id = Yii::$app->request->get('id');
//            return $this->render('createrule', ['id'=>$id, 'rulesform'=>$model]);
//        }
//    }

    /**
     * Deletes an existing RulesTable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['saverule']);
    }

    /**
     * Finds the RulesTable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RulesTable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        if (($model = RulesTable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSaveBlanks(){
        //Если юзер гость то идём на страницу входа в личный кабинет
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/account/login.html');
        }
        $model = new BlankMenuForm();

        //Если модель загружена то
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $id = Yii::$app->request->get('id');
                $rule = RulesTable::findOne($id);
                $rule->settings_rule = serialize(array($model->blankF7P,$model->blankF112P,$model->obiavlenncennost,
                    $model->nalogennplatege,$model->typ_posilki,$model->jde_blank,$model->pek_blank,$model->dellin_blank));

                    $setting = unserialize($rule->settings_rule);
                    $string = ''; //Строка хранящая информацию о том какие бланки отдавались с запросом
                    $flag = false; //Ни один бланк в настройках не включен
                if ((!empty($setting[0])) or (!empty($setting[1]))) {
                        $string = 'Почта России:';
                        if (!empty($setting[0])) {
                            $string .= ' (ф.7-п),';
                            $flag = true;
                        }
                        if (!empty($setting[1])) {
                            $string .= ' (ф.112ЭП),';
                            $flag = true;
                        }
                    }
                    if (!empty($setting[5])) {
                        $string .= ' Бланк ЖДЭ,';
                        $flag = true;
                    }
                    if (!empty($setting[6])) {
                        $string .= ' Бланк ПЭК,';
                        $flag = true;
                    }
                    if (!empty($setting[7])) {
                        $string .= ' Бланк ДелЛин';
                        $flag = true;
                    }
                    if ($flag === false) {
                        $string = 'Бланки для этого правила не заданы';
                    }

                $rule->settings_rule_decode = $string;
                $rule->save();
                $model = RulesTable::find();
                return $this->render('saverule', ['model' => $model, 'rulesform'=>$model]);
            }else{
                $model = new CreateRulesForm(['scenario' => 'resultfilter']);
                $id = Yii::$app->request->get('id');
                return $this->render('/rules-table/view', ['id'=>$id]);
            }
            //иначе если модель не загружена
        } else {
            //debug(Yii::$app->request->post());
            return $this->render('saverule');
        }
        //debug($id);
    }



}