<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\captcha\Captcha;

$this->title = Yii::t('translate', 'TITLE_RESTORE_PASSWORD');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/site/password-reset-request.html'];
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="site-request-password-reset">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-lg-5">
                    <p><?= Yii::t('translate', 'TEXT_RESET_REGISTR') ?></p>
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label(Yii::t('translate','TEXT_EMAIL')) ?>
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'captchaAction' => '/site/captcha',
                            'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
                        ])->label(Yii::t('translate','TEXT_CAPCHA'))?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('translate', 'BUTTON_SEND'), ['class' => 'btn btn-primary']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>