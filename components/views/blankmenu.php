<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 26.01.2017
 * Time: 23:06
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<?php $form = ActiveForm::begin(); ?>
<li type="none">
    <a style="text-decoration: none;font-weight: bold;"><i class="glyphicon glyphicon-triangle-right"></i>Бланки Почты России</a>
    <ul type="none" style="padding: 0px 0px 0px 15px">
        <?= $form->field($model, 'blankF7P')->checkbox()->label('Ярлык почтовой коробки (ф.7-п)') ?>
    </ul>
    <ul type="none" style="padding: 0px 0px 0px 15px">
        <?= $form->field($model, 'blankF112P')->checkbox()->label('Бланк почтового перевода (ф.112ЭП)') ?>
    </ul>
    <ul type="none" style="padding: 0px 0px 0px 15px">
        <?= $form->field($model, 'obiavlenncennost')->checkbox()->label('С объявленной ценностью') ?>
    </ul>
    <ul type="none" style="padding: 0px 0px 0px 15px">
        <?= $form->field($model, 'nalogennplatege')->checkbox()->label('С наложенным платёжом') ?>
    </ul>
    <ul type="none" style="padding: 0px 0px 25px 15px">
        <?=$form->field($model, 'typ_posilki')
        ->radioList([
        '1' => 'Посылка.',
        '2' => 'Бандероль.',

        ])->label('Тип посылки') ;?>
    </ul>
</li>
<li type="none">
    <a style="text-decoration: none;font-weight: bold;"><i class="glyphicon glyphicon-triangle-right"></i>Бланки ТК "Жел Дор Экспедиция"</a>
    <ul type="none" style="padding: 0px 0px 25px 15px">
        <?= $form->field($model, 'jde_blank')->checkbox()->label('Основной бланк ТК "ЖелДорЭкспедиции"') ?>
    </ul>
</li>
<li type="none">
    <a style="text-decoration: none;font-weight: bold;"><i class="glyphicon glyphicon-triangle-right"></i>Бланки ТК "ПЭК"</a>
    <ul type="none" style="padding: 0px 0px 25px 15px">
        <?= $form->field($model, 'pek_blank')->checkbox()->label('Основной бланк ТК "ПЭК"') ?>
    </ul>
</li>
<li type="none">
    <a style="text-decoration: none;font-weight: bold;"><i class="glyphicon glyphicon-triangle-right"></i>Бланки ТК "Деловые Линии"</a>
    <ul type="none" style="padding: 0px 0px 25px 15px">
        <?= $form->field($model, 'dellin_blank')->checkbox()->label('Основной бланк ТК "Деловые линии"') ?>
    </ul>
</li>
<?php ActiveForm::end();?>
