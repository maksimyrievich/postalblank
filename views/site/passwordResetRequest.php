<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = Yii::t('translate', 'TITLE_RESTORE_PASSWORD');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/site/password-reset-request.html'];
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container-fluid">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="row">
            <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
            <div class=" col-xs-12 col-sm-8 col-md-6 col-lg-5">
                <div class="site-request-password-reset panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h1><?= Html::encode($this->title) ?></h1>
                            <p><?= Yii::t('translate', 'TEXT_RESET_REGISTR') ?></p>
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label(Yii::t('translate','TEXT_EMAIL')) ?>
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'captchaAction' => '/site/captcha',
                            'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
                        ])->label(Yii::t('translate','TEXT_CAPCHA'))?>
                        <div class="form-group ">
                            <?= Html::submitButton(Yii::t('translate', 'BUTTON_SEND'), ['class' => 'btn btn-success']) ?>
                            <?= Html::a(Yii::t('translate', 'BUTTON_BACK'), Url::to(['/account/login']), ['class' => 'btn btn-info', 'style' => 'margin: 4px 0px 4px 0px']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="hidden-xs col-sm-2 col-md-3 col-lg-4"></div>
        </div>
    </div>
</section>