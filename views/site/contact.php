<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('translate', 'TITLE_CONTACT');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translate', 'TITLE_CONTACT'), 'url' => '/contact.html'];
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="site-contact">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                <div class="alert alert-success">
                    <?= Yii::t('translate', 'TEXT_THANK_YOU') ?>
                </div>

            <?php else: ?>

                <div class="row">
                    <div class="col-lg-5">

                        <p><?=Yii::t('translate','TEXT_IF_YOU_HAVE')?></p>

                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'subject') ?>

                            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'file',['enableLabel' => false])->fileInput(array('class' => 'custom-file-upload',
                                'data-btn-text' => Yii::t('translate','TEXT_SELECT_FILE')))->label(Yii::t('translate','TEXT_FILE')) ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
                            ])->label(Yii::t('translate','TEXT_CAPCHA')) ?>

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('translate','BUTTON_SUBMIT'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</section>
