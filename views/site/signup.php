<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

$this->title = Yii::t('translate','TITLE_SIGNUP');
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <div class="container">
        <div class="user-default-signup">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php if (Yii::$app->session->hasFlash('signupFormSubmitted')): ?>
                <div class="alert alert-success">
                    <?= Yii::t('translate', 'TEXT_CONFIRM_REGISTR') ?>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-5">

                        <p><?= Yii::t('translate','TEXT_PLEASE_FILL_REGISTR')?></p>

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('translate','TEXT_USERNAME'))  ?>
                        <?= $form->field($model, 'email')->label(Yii::t('translate','TEXT_EMAIL'))  ?>
                        <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('translate','TEXT_PASSWORD')) ?>
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'captchaAction' => '/site/captcha',
                            'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ])->label(Yii::t('translate','TEXT_CAPCHA'))?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('translate','BUTTON_SIGNUP'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>