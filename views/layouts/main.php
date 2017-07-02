<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\components\SiteMenuWidget;
use app\components\HeaderMenuWidget;
use app\components\AccountMenuWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="google-site-verification" content="w4aANXNTNlTJBqDtdWS1W3f6M_K9tbObmITxjerKQZc" />
    <meta name="yandex-verification" content="4058d1802b18ff51" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- THEME CSS -->
    <link href="<?= Url::to("@web/web/AssetsSmarty/css/essentials.css")?>" rel="stylesheet" type="text/css" />
    <link href="<?= Url::to("@web/web/AssetsSmarty/css/layout.css")?>" rel="stylesheet" type="text/css" />

    <!-- PAGE LEVEL SCRIPTS -->
    <link href="<?= Url::to("@web/web/AssetsSmarty/css/header-1.css")?>" rel="stylesheet" type="text/css" />
    <link href="<?= Url::to("@web/web/AssetsSmarty/css/color_scheme/green.css")?>" rel="stylesheet" type="text/css" id="color_scheme" />
</head>

<body class="smoothscroll enable-animation" >
<?php $this->beginBody() ?>

<div id= "wrapper" >
    <!--
    AVAILABLE HEADER CLASSES
    Default nav height: 96px
    .header-md 		= 70px nav height
    .header-sm 		= 60px nav height
    .noborder 		= remove bottom border (only with transparent use)
    .transparent	= transparent header
    .translucent	= translucent header
    .sticky			= sticky header
    .static			= static header
    .dark			= dark header
    .bottom			= header on bottom
    shadow-before-1 = shadow 1 header top
    shadow-after-1 	= shadow 1 header bottom
    shadow-before-2 = shadow 2 header top
    shadow-after-2 	= shadow 2 header bottom
    shadow-before-3 = shadow 3 header top
    shadow-after-3 	= shadow 3 header bottom
    .clearfix		= required for mobile menu, do not remove!
    Example Usage:  class="clearfix sticky header-sm transparent noborder"
    -->
    <div id="header" class="sticky dark noborder clearfix">
        <!-- TOP NAV -->
        <header id="topNav">
            <div class="full-container"><!-- add .full-container for fullwidth -->
                <!-- Mobile Menu Button -->
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- LOGO -->
                <a class="logo pull-left" href="index.html">
                    <img src="<?= Url::to("@web/web/AssetsSmarty/images/logo_light_postalblank.ru.png")?>" alt="" />
                </a>
                <!--
                Top Nav
                AVAILABLE CLASSES:
                submenu-dark = dark sub menu
                -->
                <div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
                    <nav class="nav-main">
                        <!--
                        NOTE
                        For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
                        Direct Link Example:
                            <li>
                                <a href="#">HOME</a>
                            </li>
                        -->
                        <ul id="topMain" class="nav nav-pills nav-main ">
                            <li ><!-- HOME -->
                                <a href="<?= Url::to("/")?>"><i class = "glyphicon glyphicon-home"></i> ГЛАВНАЯ</a>
                            </li>
                            <li ><!-- PAGES -->
                                <a href= "<?= Url::to (['/plagins']);?>"><i class = "glyphicon glyphicon-download"></i> ПЛАГИНЫ ДЛЯ CMS</a>
                            </li>
                            <li ><!-- PAGES -->
                                <a href= "<?= Url::to (['/contact']);?>"><i class = "glyphicon glyphicon-send"></i> КОНТАКТ</a>
                            </li>
                            <?php if(Yii::$app->user->isGuest): ?>
                            <li ><!-- FEATURES -->
                                <a href="<?= Url::to (['/signup']);?>"><i class = "glyphicon glyphicon-registration-mark"></i> РЕГИСТРАЦИЯ</a>
                            </li>
                            <?php else :?><?php endif;?>
                            <li ><!-- FEATURES -->
                                <a href="<?= Url::to (['/account/login']);?>"><i class = "glyphicon glyphicon-user"></i> МОЙ КАБИНЕТ</a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#"><img class="flag-lang" src="<?= Url::to("@web/web/AssetsSmarty/images/flags/ru.png")?>" width="16" height="11" alt="lang" />
                                    РУССКИЙ
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a  href="#"><img class="flag-lang" src="<?= Url::to("@web/web/AssetsSmarty/images/flags/us.png")?>" width="16" height="11" alt="lang" /> ENGLISH</a></li>
                                    <li><a  href="#"><img class="flag-lang" src="<?= Url::to("@web/web/AssetsSmarty/images/flags/de.png")?>" width="16" height="11" alt="lang" /> GERMAN</a></li>
                                    <li><a  href="#"><img class="flag-lang" src="<?= Url::to("@web/web/AssetsSmarty/images/flags/ru.png")?>" width="16" height="11" alt="lang" /> РУССКИЙ</a></li>
                                    <li><a  href="#"><img class="flag-lang" src="<?= Url::to("@web/web/AssetsSmarty/images/flags/it.png")?>" width="16" height="11" alt="lang" /> ITALIAN</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- /Top Nav -->
    </div>
    <!--<div class="callout "> <?php //Breadcrumbs::widget([
            //'homeLink' => ['label' => ''],
            //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
       // ]) ?>
    </div> -->
    <?= $content ?>
</div>

<footer id="footer">
    <div class="container">

        <div class="row margin-top-60 margin-bottom-40 size-13">

            <!-- col #1 -->
            <div class="col-md-4 col-sm-4">

                <!-- Footer Logo -->
                <img class="footer-logo" src="<?= Url::to("/web/AssetsSmarty/images/logo_light_postalblank_ru_futer.png")?>" alt="" />

                <p>
                    Сервис автоматического заполнения почтовых бланков для интернет-магазинов, CMS Joomla, JoomShopping.
                </p>

                <h2>+7 (927) 130 35 07</h2>

                <!-- Social Icons -->
                <div class="clearfix">

                    <a href="#" class="social-icon social-icon-sm social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>

                    <a href="#" class="social-icon social-icon-sm social-icon-border social-twitter pull-left" data-toggle="tooltip" data-placement="top" title="Twitter">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>

                    <a href="#" class="social-icon social-icon-sm social-icon-border social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                        <i class="icon-gplus"></i>
                        <i class="icon-gplus"></i>
                    </a>

                    <a href="#" class="social-icon social-icon-sm social-icon-border social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
                        <i class="icon-linkedin"></i>
                        <i class="icon-linkedin"></i>
                    </a>

                    <a href="#" class="social-icon social-icon-sm social-icon-border social-rss pull-left" data-toggle="tooltip" data-placement="top" title="Rss">
                        <i class="icon-rss"></i>
                        <i class="icon-rss"></i>
                    </a>

                </div>
                <!-- /Social Icons -->

            </div>
            <!-- /col #1 -->

            <!-- col #2 -->
            <div class="col-md-8 col-sm-8">

                <div class="row">

                    <div class="col-md-5 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">ПОСЛЕДНИЕ НОВОСТИ</h4>
                        <ul class="list-unstyled footer-list half-paddings">
                            <li>
                                <a class="block" href="#">New CSS3 Transitions this Year</a>
                                <small>June 29, 2015</small>
                            </li>
                            <li>
                                <a class="block" href="#">Inteligent Transitions In UX Design</a>
                                <small>June 29, 2015</small>
                            </li>
                            <li>
                                <a class="block" href="#">Lorem Ipsum Dolor</a>
                                <small>June 29, 2015</small>
                            </li>
                            <li>
                                <a class="block" href="#">New CSS3 Transitions this Year</a>
                                <small>June 29, 2015</small>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">ДЛЯ ПРОЧТЕНИЯ</h4>
                        <ul class="list-unstyled footer-list half-paddings noborder">
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> About Us</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> About Me</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> About Our Team</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Services</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Careers</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Gallery</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> FAQ</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h4 class="letter-spacing-1">ПРИЁМ ПЛАТЕЖЕЙ</h4>
                        <p>Сайт осуществляет прием платежей "on-line". Сервис оплаты доступен из личного кабинета абонента.</p>
                        <p>	<!-- see assets/images/cc/ for more icons -->
                            <img src="/web/AssetsSmarty/images/cc/Visa.png" alt="" />
                            <img src="/web/AssetsSmarty/images/cc/Mastercard.png" alt="" />
                            <img src="/web/AssetsSmarty/images/cc/Maestro.png" alt="" />
                            <img src="/web/AssetsSmarty/images/cc/YandexMoney.png" alt="" />
                        </p>
                    </div>

                </div>

            </div>
            <!-- /col #2 -->

        </div>

    </div>

    <div class="copyright">
        <div class="container">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a href="#">Terms &amp; Conditions</a></li>
                <li>&bull;</li>
                <li><a href="#">Privacy</a></li>
                <li>&bull;</li>
                <!-- Yandex.Metrika informer -->
                <li><a href="https://metrika.yandex.ru/stat/?id=43063204&amp;from=informer"
                       target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/43063204/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                       style="width: 75px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="43063204" data-lang="ru" />
                    </a>
                </li>
                <!-- /Yandex.Metrika informer -->
            </ul>
            &copy; 2017 - <?= date('Y') ?> POSTALBLANK.RU   <!-- © All Rights Reserved, Company LTD -->
        </div>
    </div>

</footer>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter43063204 = new Ya.Metrika({
                    id:43063204,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/43063204" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?= Url::to("@web/web/AssetsSmarty/plugins/")?>';</script>
<script type="text/javascript" src="<?= Url::to("@web/web/AssetsSmarty/js/scripts.js")?>"></script>

</body>
</html>
<?php $this->endPage() ?>
