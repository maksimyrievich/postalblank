<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\BlankMenuWidget;

$this->title = 'Настройка правила';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="panel-heading" style="text-align: center">
    Правило № <?= $model->id ?>
</div>
<div style=" padding: 5px 15px 10px" >
    <div class = 'row'>
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'regular_rule',[
                //'disable' => 'disable',
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 2, 'readonly'=>'']) ?>
            <div class="row">
                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    <h5 style = "margin: 0px"><?= Html::label('Настройки бланков для данного типа доставки:');?></h5>
                    <div style="width: auto; padding: 5px 0px 20px 0px;" >
                        <div style="max-width: 300px; padding: 0px 0px 0px 0px; margin: 0px auto;" >
                            <ul style="padding: 15px 0px 5px 0px" class="monologg">
                                <?= BlankMenuWidget::widget(['template'=> 'blankmenu_templatee']);?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="text-align: center" >
                    <p>
                        <?= Html::a('Назад', Url::to(['account/saverule', 'id' => $id ]),['class' => 'btn btn-primary ', 'style' => 'margin: 0px 0px 4px 0px']) ?>
                        <?= Html::submitButton('Сохранить настройки', ['class' => 'btn btn-success', 'formaction' => Url::to(['save-blanks','id'=> $id]), 'style' => 'margin: 0px 0px 4px 0px']) ?>

                    </p>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>


</div>