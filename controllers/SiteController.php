<?php

namespace app\controllers;


use app\models\CreateRulesForm;


use app\models\TranzactionTable;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use app\models\LoginForm;
use app\models\ContactForm;
use app\models\DownloadForm;
use app\models\PlaginsTable;
use app\models\UsersTable;
use app\models\GenerateMail;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->view->title = 'JoomShopping заполнение почтовых бланков';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'Joomla, Joomshopping, заполнение почтовых бланков,
         бланки Почты России, почтовые бланки, заполнить почтовые бланки']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Скачать плагин для Joomla, Joomshopping.
         Заполнение почтовых бланков в один клик. Бланки Почты России.']);

        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $this->view->title = 'Написать нам';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'Joomla, Joomshopping, заполнение почтовых бланков,
         бланки Почты России, почтовые бланки, заполнить почтовые бланки']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Скачать плагин для Joomla, Joomshopping.
         Бланки Почты России. Заполнение почтовых бланков в один клик.']);

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['email'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionPlagins(){

        $this->view->title = 'Плагины для CMS';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'Joomla, Joomshopping, заполнение почтовых бланков,
         бланки Почты России, почтовые бланки, заполнить почтовый бланк']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Плагин для Joomla, Joomshopping.
         Плагин для почтовых бланков. Заполнение почтовых бланков в один клик.']);


        $query = PlaginsTable::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('plagins', ['listDataProvider' => $dataProvider]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionDownload($id = 0, $d = 0)
    {

        $model = new DownloadForm(); //Объявляем переменную $model экземпляром модели DownloadForm
        $user = new UsersTable();
        $plagin = PlaginsTable::findOne($id);
        if($d != 0){
            goto download;
        }

        if(Yii::$app->user->isGuest) //Если юзер гость, то
        {
            //попадаем сюда:
            //Если DownloadForm загружена успешно, и ...
            if ($model->load(Yii::$app->request->post()) && $model->download(Yii::$app->params['email']))
            {
                Yii::$app->session->setFlash('downloadFormSubmitted'); //Устанавливаем сессию "downloadFormSubmitted"
                $user->firstusername = $model->firstname;
                $user->lastusername = $model->lastname;
                //Выдергиваем все usermame из базы какие сейчас в ней есть
                $username_array = Yii::$app->db->createCommand('SELECT username FROM users')->queryColumn();
                //Сравниваем все usermame из БД с введённым юзером в форму только что
                foreach ($username_array as $key => $value){
                    //если такой токен уже есть в БД, если пользователь с таким емайлом уже зарегистрирован
                    if($username_array[$key] === $model->email){
                        // выдаем въюху с информированием о том, что такой username уже есть
                        Yii::$app->session->destroy();
                        Yii::$app->session->setFlash('ErrorLogin');
                        goto view;
                    }
                }
                $user->username = $model->email;
                $user->password = md5($model->password);
                $user->balance = 10;
                //Выдергиваем все токены из базы какие сейчас в ней есть
                $token_db = Yii::$app->db->createCommand('SELECT key_secret FROM users')->queryColumn();
                start:
                //Начинаем генерить токен транзакции по определённому алгоритму
                $user->key_secret = md5(uniqid(rand(0,32)));
                //Сравниваем все токены из БД со сгенерированным только что
                foreach ($token_db as $key => $value){
                    //если такой токен уже есть в БД,
                    if($token_db[$key] === $user->key_secret){
                        // возвращаемся генерить новый токен на метку старт.
                        goto start;
                    }
                }
                // а если такого токена нет в БД, то сохраняем транзакцию с этим токеном в БД
                if ($user->validate() && $user->save())
                {
                    //Высылаем юзеру емайл сообщение с логином и паролем. Что бы он не забыл их.
                    $mail = new GenerateMail();
                    $mail->sendMail('example','Регистрация на сайте',['paramExample' => '123'],  $user->username);
                    return $this->refresh();
                }
            }
            view:
            return $this->render('download',['model' => $model, 'plagin' => $plagin, 'id' => $id]);

        }
        download:
        //Блок кода учёта количества скачиваний.
        $file=fopen("plaginsbody/plagin".$id.".txt","a+");
        flock($file,LOCK_EX);
        $count=fread($file,100);
        $count++;
        ftruncate($file,0);
        fwrite($file,$count);
        flock($file,LOCK_UN);
        fclose($file);
        return $this->redirect($plagin->plagin_path);
    }
}



































