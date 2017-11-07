<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersTable */

$this->title = 'Create Users Table';
$this->params['breadcrumbs'][] = ['label' => 'Users Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-table-create container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
