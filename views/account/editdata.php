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
use app\components\AccountMenuWidget;
use app\assets\AccordionViewSmartyAsset;

$this->title = Yii::t('translate','TITLE_EDIT_DATA');
$this->params['breadcrumbs'][] = ['label' => $this->title,'url' => '/account/edit-data.html'];


AccordionViewSmartyAsset::register($this);
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container-fluid">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px;">
                    <div class="panel" style="margin: 0px 0px 0px 0px">
                        <div class="panel-primary">
                            <div class="panel-heading" style="text-align: center">
                                Навигационное меню
                            </div>
                            <div style="width: 203px; padding: 15px 0px 10px 0px; margin: 0px auto;" >
                                <ul type="none" class="catalogg" style="padding: 0px 0px 0px 0px">
                                    <?= AccountMenuWidget::widget(['template' => 'accountmenu']);?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                <div class=" panel" style="background-color: #269abc; padding: 0px;" >
                    <div class="panel" style="margin: 0px 0px 0px 0px">
                        <div class="panel-primary">
                            <div class="panel-heading" style="text-align: center">
                                <i class="glyphicon glyphicon-user"></i> <?= Html::encode($this->title) ?>
                            </div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <p><?= Yii::t('translate','TEXT_PLEASE_FILL_LOGIN')?></p>
                                </div>
                                <?php $form = ActiveForm::begin(['id' => 'edit-data-form',]);?>
                                <?= $form->field($model, 'firstname')->textInput(['autofocus' => true])?>
                                <?= $form->field($model, 'lastname')->textInput()?>
                                <?= $form->field($model, 'telephone')->textInput()?>
                                <div class="form-group">
                                    <?= Html::submitButton(Yii::t('translate','BUTTON_SAVE_DATA'), ['class' => 'btn btn-success', 'name' => 'edit-data-button']) ?>
                                    <?= Html::a(Yii::t('translate', 'BUTTON_BACK'), Url::to(['/account/mydata']), ['class' => 'btn btn-info', 'style' => 'margin: 4px 0px 4px 0px']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-3"></div>
        </div>
    </div>
</section>