<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'language'=> 'ru-RU',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'C2h8lc0XOJIm5WSRniR0tan8pVu7l6ZI',
            //'enableCsrfValidation' => false,
            'baseUrl'=> '',

        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'viewPath' => '@app/mail',  // - путь по которому будут находиться шаблоны писем
            'htmlLayout' => 'layouts/main-html',   // - макеты писем (layouts), HTML и текстовая версия ниже соответственно
            'textLayout' => 'layouts/main-text',
            'messageConfig' => [
                'charset' => 'UTF-8',  // - кодировка писем UTF-8
                'from' => ['support@postalblank.ru' => 'Postalblank.ru'],  //- задаем e-mail адрес и имя отправителя по умолчанию
            ],
            'useFileTransport' => true, // - флаг указывающий на то, что бы письма не отправлялись а сохранялись в папку \runtime\mail
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.beget.com', // SMTP сервер почтовика
                'username' => 'support@postalblank.ru', // Логин (адрес электронной почты)
                'password' => 'support12345', // Пароль
                'port' => '2525', // Порт
                'encryption' => 'tls', // Шифрование
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /**/
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' => '.html',
            'rules' => [
                //'account/<id:\d+>' => 'account/view',
                [
                    'pattern' => '/plaginsbody/plgJshoppPostalBlank.zip',
                    'route' => 'plaginsbody/plgJshoppPostalBlank.zip',
                    'suffix' => '',
                ],
                [
                    'pattern' => '/',
                    'route' => 'site/index',
                    'suffix' => '',
                ],
                
                '<action:(index|signup|plagins|contact|download)>' => 'site/<action>',//любой из этих экшенов после http://postalblank.ru/<action> будет идти на http://postalblank.ru/site/<action> или \w+
            ],
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'GMT+3',
            'dateFormat' => 'd MMMM yyyy',
            'datetimeFormat' => 'd-M-Y H:i:s',
            'timeFormat' => 'H:i:s',
        ],
    ],

    'params' => $params,

//    'modules' => [
//        'account'=>[
//            'class'=>'\app\modules\account\AccountModule'
//        ]
//    ]


];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}  

Yii::setAlias('@blank', dirname(__DIR__) . '/views/tranzaction/blanks');
Yii::setAlias('@blank_image', dirname(__DIR__) . '/lib/tcpdf/examples/images');
return $config;
