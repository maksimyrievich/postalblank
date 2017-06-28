<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TranzactionTableSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tranzaction-table-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'domen_tranzaction') ?>

    <?= $form->field($model, 'status_tranzaction') ?>

    <?= $form->field($model, 'date_tranzaction') ?>

    <?= $form->field($model, 'key_tranzaction') ?>

    <?= $form->field($model, 'delivery_type') ?>

    <?= $form->field($model, 'balance') ?>


    <?php //echo $form->field($model, 'body_tranzaction') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
