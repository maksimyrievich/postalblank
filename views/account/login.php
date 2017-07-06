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
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
        <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Пожалуйста, заполните следующие поля для входа:</p>

            <?php $form = ActiveForm::begin([
                //'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->label('Запомнить меня') ?>



            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <!--<div class="col-lg-offset-1" style="color:#999;">

            </div> -->
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-3">

    </div>
</div>