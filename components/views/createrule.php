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

$this->title = 'Создание правила';
$this->params['breadcrumbs'][] = $this->title;


?>
<div style=" padding: 30px 20px 10px 20px" >
    <div class = 'row'>
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($rules, 'delivery_type',[
                //'disable' => 'disable',
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 2, 'readonly'=>''])->label('Вид доставки') ?>

            <?= $form->field($rules, 'regular_filter_1',[
                    'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 1])->label('Введите ниже до пяти ключевых фраз. Первая фраза') ?>

            <?= $form->field($rules, 'regular_filter_2',[
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 1])->label('Вторая фраза или слово') ?>

            <?= $form->field($rules, 'regular_filter_3',[
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 1])->label('Третья фраза') ?>

            <?= $form->field($rules, 'regular_filter_4',[
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 1])->label('Четвёртая фраза') ?>

            <?= $form->field($rules, 'regular_filter_5',[
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 1])->label('Пятая фраза') ?>

            <?= $form->field($rules, 'regular_rule', [
                'horizontalCssClasses' => [
                    'label' => 'col-lg-2',
                    'wrapper' => 'col-lg-10']])->textarea(['rows' => 2, 'readonly'=>''])->label('Результирующая фраза после применения фильтра')  ?>
            <div class="row">
                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-6" >

                </div>
                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="text-align: center" >
                <p>
                    <?= Html::submitButton('Показать результат', ['class' => 'btn btn-primary', 'formaction' => Url::to(['createrule', 'id' =>$id]), 'style' => 'margin: 0px 0px 4px 0px']) ?>
                            <?= Html::submitButton('Сохранить правило', ['class' => 'btn btn-success', 'formaction' => Url::to(['saverule','id' =>$id]), 'style' => 'margin: 0px 0px 4px 0px']) ?>
                    <?= Html::a('Назад', Url::to(['account/data-transaction', 'id' => $id ]),['class' => 'btn btn-primary ', 'style' => 'margin: 0px 0px 4px 0px']) ?>
                </p>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
