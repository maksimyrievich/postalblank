<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TranzactionTable */

$this->title = 'Create Tranzaction Table';
$this->params['breadcrumbs'][] = ['label' => 'Tranzaction Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tranzaction-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
