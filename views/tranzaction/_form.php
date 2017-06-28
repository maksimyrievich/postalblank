<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TranzactionTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tranzaction-table-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'domen_tranzaction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_tranzaction')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_tranzaction')->textInput() ?>

    <?= $form->field($model, 'date_tranzaction')->textInput() ?>

    <?= $form->field($model, 'key_tranzaction')->textInput() ?>

    <?= $form->field($model, 'delivery_type')->textInput() ?>

    <?= $form->field($model, 'balance')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
