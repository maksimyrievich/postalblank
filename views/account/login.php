<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 04.12.2016
 * Time: 0:51
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use  yii\helpers\Url;

$this->title = Yii::t('translate','TITLE_LOGIN_MY_ACCOUNT');
$this->params['breadcrumbs'][] = ['label' => $this->title,'url' => '/account/login.html'];
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container-fluid">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="row">
            <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-5">
                <div class="site-login panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h1><?= Html::encode($this->title) ?></h1>
                            <p><?= Yii::t('translate','TEXT_PLEASE_FILL_LOGIN')?></p>
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'login-form',]);?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('translate','TEXT_USERNAME')) ?>
                        <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('translate','TEXT_PASSWORD')) ?>
                        <?= $form->field($model, 'rememberMe')->checkbox([
                            //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        ])->label(Yii::t('translate','TEXT_REMEMBER_ME')) ?>
                        <div style="color:#999;margin:1em 0">
                            <?= Html::a(Yii::t('translate','TEXT_RESTORE_PASSWORD'), ['/site/password-reset-request']) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('translate','BUTTON_LOGIN'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            <?= Html::a(Yii::t('translate', 'BUTTON_SIGNUP'), Url::to(['/signup']), ['class' => 'btn btn-info', 'style' => 'margin: 4px 0px 4px 0px']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-3"></div>
        </div>
    </div>
</section>