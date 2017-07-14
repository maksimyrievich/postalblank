<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->title = Yii::t('translate', 'TITLE_RESET_PASSWORD');
$this->params['breadcrumbs'][] = $this->title;
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container-fluid">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="row">
            <div class="hidden-xs col-sm-2 col-md-3 col-lg-4"></div>
            <div class=" col-xs-12 col-sm-8 col-md-6 col-lg-4">
                <div class="site-reset-password panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h1><?= Html::encode($this->title) ?></h1>
                            <p><?= Yii::t('translate', 'TEXT_RESET_PASSWORD') ?></p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                                        <?= Html::a(Yii::t('translate', 'BUTTON_BACK'), Url::to(['/account/login']), ['class' => 'btn btn-info', 'style' => 'margin: 4px 0px 4px 0px']) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden-xs col-sm-2 col-md-3 col-lg-4"></div>
        </div>
    </div>
</section>