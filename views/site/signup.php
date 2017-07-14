<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

$this->title = Yii::t('translate','TITLE_SIGNUP');
$this->params['breadcrumbs'][] = ['label' =>$this->title, 'url' => '/signup.html'];
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container-fluid">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="row">
            <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-5">
                <div class="user-default-signup panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h1><?= Html::encode($this->title) ?></h1>
                        </div>
                        <?php if (Yii::$app->session->hasFlash('signupFormSubmitted')): ?>
                        <div class="alert alert-success">
                            <?= Yii::t('translate', 'TEXT_CONFIRM_REGISTR') ?>
                        </div>
                        <?php else: ?>
                        <p><?= Yii::t('translate','TEXT_PLEASE_FILL_REGISTR')?></p>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('translate','TEXT_USERNAME'))  ?>
                        <?= $form->field($model, 'email')->label(Yii::t('translate','TEXT_EMAIL'))  ?>
                        <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('translate','TEXT_PASSWORD')) ?>
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'captchaAction' => '/site/captcha',
                            'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
                        ])->label(Yii::t('translate','TEXT_CAPCHA'))?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('translate','BUTTON_SIGNUP'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-3"></div>
        </div>
    </div>
</section>