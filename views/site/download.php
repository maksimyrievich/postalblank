<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 15.12.2016
 * Time: 21:03
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Скачивание';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
        <div class="panel panel-default">
            Место для рекламы
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
        <div class="site-contact panel panel-default">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php if (Yii::$app->session->hasFlash('downloadFormSubmitted')): ?>
                <div class="alert alert-success">
                    Вы зарегистрированы на сайте POSTALBLANK.RU. Теперь вы можете войти на сайт, используя свой логин и пароль. На ваш емайл выслано сообщение с данными регистрации. Не разглашайте эти данные третьим лицам.
                </div>
                <p>
                    <?= Html::a('Ваша ссылка для скачивания плагина',Url::to(['/download', 'id' => $id, 'd'=> '1']))?> .Note that if you turn on the Yii debugger, you should be able
                    to view the mail message on the mail panel of the debugger.
                    <?php if (Yii::$app->mailer->useFileTransport): ?>
                        Because the application is in development mode, the email is not sent but saved as
                        a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                                                                                                            Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                        application component to be false to enable email sending.
                    <?php endif; ?>
                </p>

            <?php elseif(Yii::$app->session->hasFlash('ErrorLogin')):?>
                <div class="alert alert-danger">
                    Пользователь с таким логином (e-mail) уже зарегистрирован на сайте.
                </div>
                <div class="alert alert-info" style="text-align: center">
                    <?= Html::a('Вернуться к регистрации.',Url::to(['/download', 'id' => $id]))?>
                </div>
                <div class="alert alert-info" style="text-align: center">
                    <?= Html::a('Перейти в личный кабинет.',Url::to(['/account/login', 'id' => $id, 'd'=> '1']))?>
                </div>


            <?php else: ?>

                    <div class="alert alert-info">
                        Для скачивания плагина, необходимо зарегистрироваться на сайте. После регистрации, вы сможете скачать плагин.
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                            <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'lastname') ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'password') ?>

                            <?php //$form->field($model, 'subject') ?>

                            <?php //$form->field($model, 'body')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-7">{input}</div></div>',
                            ]) ?>

                            <div class="form-group" style="text-align: center">
                                <?= Html::submitButton('Скачать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>

            <?php endif; ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
        <div class="panel panel-default">
            Место для рекламы 2
        </div>
    </div>
</div>