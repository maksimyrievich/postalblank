<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-table-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstusername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastusername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'authkey')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'accesstoken')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
