<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 04.12.2016
 * Time: 0:51
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('translate','TITLE_LOGIN_MY_ACCOUNT');
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <div class="container">
        <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <p><?= Yii::t('translate','TEXT_PLEASE_FILL_LOGIN')?></p>

            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',

                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('translate','TEXT_USERNAME')) ?>

                    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('translate','TEXT_PASSWORD')) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ])->label(Yii::t('translate','TEXT_REMEMBER_ME')) ?>
                </div>
            </div>


            <div class="form-group">

                    <?= Html::submitButton(Yii::t('translate','BUTTON_LOGIN'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>

            <!--<div class="col-lg-offset-1" style="color:#999;">

            </div> -->
        </div>
    </div>
</section>