<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


$this->title = 'Детали';
$this->params['breadcrumbs'][] = $this->title;
?>


<div style=" padding: 30px 20px 10px 20px" >
    <?php $form = ActiveForm::begin(); ?>


    <div class = 'row '>
        <div class=" col-xs-12 col-sm-6 col-md-5 col-lg-5" >
                <?= $form->field($model, 'id',[
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-3',
                        'wrapper' => 'col-lg-9']])->textInput(['readonly'=>''])->label('ID запроса') ?>
                <?= $form->field($model, 'date_tranzaction',[
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-3',
                        'wrapper' => 'col-lg-9']])->textInput(['readonly'=>''])?>
                <?= $form->field($model, 'status_tranzaction',[
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-3',
                        'wrapper' => 'col-lg-9']])->textInput(['readonly'=>'']) ?>
        </div>

        <div class=" col-xs-12 col-sm-6 col-md-7 col-lg-7" >
                <?= $form->field($model, 'domen_tranzaction',[
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-4',
                        'wrapper' => 'col-lg-8']])->textarea(['rows' => 1, 'readonly'=>''])->label('Адрес сайта:') ?>
                <?= $form->field($model, 'key_tranzaction',[
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-4',
                        'wrapper' => 'col-lg-8']])->textInput(['readonly'=>''])->label('Ключ:') ?>
                <?= $form->field($model, 'userid_tranzaction',[
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-4',
                        'wrapper' => 'col-lg-8']])->textarea(['rows' => 1, 'readonly'=>''])->label('Клиент, ID:') ?>
        </div>
    </div>

    <div class = 'row'>
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    <?= $form->field($model, 'body_tranzaction',[
                    'horizontalCssClasses' => [
                    'label' => 'col-lg-3',
                    'wrapper' => 'col-lg-9']])->textInput(['readonly'=>''])->label('Отданные бланки') ?>
                    <div class="row">
                                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                    <?= $form->field($model, 'delivery_type',[
                                        'horizontalCssClasses' => [
                                            'label' => 'col-lg-2',
                                            'wrapper' => 'col-lg-10']])->textarea(['rows' => 2, 'readonly'=>'']) ?>
                                </div>
                                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="text-align: center; padding: 0px 0px 5px 0px ">
<p>
                                        <?= Html::a('Создать правило', Url::to(['createrule', 'id'=> $model->id ]),['class' => 'btn btn-success', 'style' => 'margin: 0px 0px 4px 0px']) ?>
                                        <?= Html::a('Назад', Url::to(['login']),['class' => 'btn btn-primary ', 'style' => 'margin: 0px 0px 4px 0px']) ?>
</p>
                                </div>
                    </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>




