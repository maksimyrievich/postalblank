<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RulesTable */

$this->title = 'Create Rules Table';
$this->params['breadcrumbs'][] = ['label' => 'Rules Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rules-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
