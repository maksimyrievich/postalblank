<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 22.11.2016
 * Time: 17:09
 */

//В начале представления sitemenu.php указываем, что будем
// использовать в нем виджет Nav фреймворка bootstrap.
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;



    NavBar::begin([
        //'brandLabel' => '
                          // <img   src="/web/images/logo.png" alt="logo">
                        // ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse', //navbar-fixed-bottom navbar-fixed-top
            'style' => 'margin: 0px 0px 0px 0px',
        ],
    ]);
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '<i class = "glyphicon glyphicon-home"></i> Главная', 'url' => '/'],
            ['label' => '<i class = "glyphicon glyphicon-download-alt"></i> Плагины для CMS','url' => Url::to (['/plagins']),
              /*'items' =>[
                    [
                        'label' => '<i class = "glyphicon glyphicon-download-alt "></i>  Плагин для JoomShopping',
                        'url' => ['/site/plagins']
                    ],
                    [
                        'label' => '<i class = "glyphicon glyphicon-download-alt"></i>  Плагин для OpenCart 2.0',
                        'url' => ['/site/plagins']
                    ],
                    [
                        'label' => '<i class = "glyphicon glyphicon-download-alt "></i>  Плагин для WordPress',
                        'url' => ['/site/plagins']
                    ],
                    [
                        'label' => '<i class = "glyphicon glyphicon-download-alt"></i>  Плагин для VirtueMart',
                        'url' => ['/site/plagins']
                    ],
                ], */
            ],
            ['label' => '<i class = "glyphicon glyphicon-envelope"></i> Написать нам', 'url' => Url::to (['/contact'])],

            ['label' => '<i class = "glyphicon glyphicon-th-list"></i> Личный кабинет','url' => Url::to (['/account/login']),
               /* 'items' =>[
                    [
                        'label' => '<i class = "glyphicon glyphicon glyphicon-cog"></i>  Настройки для правил',
                        'items' =>[
                            [
                                'label' => 'Последние запросы',
                                'url' => ['/account/mytransactions']
                            ],
                            [
                                'label' => 'Настройки доставки',
                                'url' => ['/account/saverule']
                            ],
                        ],
                    ],
                    [
                        'label' => '<i class = "glyphicon glyphicon-cog"></i>  Настройки аккаунта',
                        'items' =>[
                            [
                                'label' => 'Личная информация',
                                'url' => ['/account/mydata']
                            ],
                        ],
                    ],
                    [
                        'label' => '<i class = "glyphicon glyphicon-euro"></i>  Оплата',
                        'items' =>[
                            [
                                'label' => 'Движение по счёту',
                                'url' => ['/account/balance']
                            ],
                            [
                                'label' => 'Пополнить счёт',
                                'url' => ['/account/balance']
                            ],
                        ]
                    ],
                    Yii::$app->user->isGuest ?  (
                    ['label' => '<i class = "glyphicon glyphicon-log-in"></i>  Вход','url' => ['/account/login']]
                    ): (
                    ['label' => '<i class = "glyphicon glyphicon-log-out"></i>  Выход','url' => ['/account/logout']]

                    ),


                ], */
            ],

            //['label' => '']
        ],
    ]);
    NavBar::end();

