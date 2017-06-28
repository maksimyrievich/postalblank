<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */

use app\components\AccountMenuWidget;

use app\components\YandexMoneyWidget;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Пополнить счёт';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class='row'>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px">
            <div class="panel" style="margin: 0px 0px 0px 0px">
                <div class="panel-primary">
                    <div class="panel-heading" style="text-align: center">
                        <i class = "glyphicon glyphicon-th-list"></i> Навигационное меню
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
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-3">
        <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px">
            <div class="panel" style="margin: 0px 0px 0px 0px">
                <div class="panel-primary">
                    <div class="panel-heading"style="text-align: center" >
                        Пополнить счет
                    </div>
                    <div style="margin: 20px">
                        <?php $form = ActiveForm::begin(['action' => 'https://money.yandex.ru/quickpay/confirm.xml']); ?>
                        <input type = "hidden" name = "receiver" value = "<?= $model->receiver ?>">
                        <input type = "hidden" name = "label" value = "<?= $model->label ?>">
                        <input type = "hidden" name = "quickpay-form" value = "<?= $model->quickpay_form ?>">
                        <input type = "hidden" name = "targets" value = "<?= $model->targets ?>">
                        <?= $form->field($model, 'sum',['enableLabel' => false])->textInput(['name' => 'sum','data-type' => "number"]) ?>
                        <?= Html::submitButton('Оплатить', ['class' => 'btn btn-success btn-block', 'style' => 'margin: 0px 0px 10px 0px']) ?>
                        <p><input type="radio" name="paymentType" value="AC" checked "> Банковской картой</p>
                        <p><input type="radio" name="paymentType" value="PC" style="font-weight: bold;"> Яндекс. Деньгами</p>
                        <?php ActiveForm::end();?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>