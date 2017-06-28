<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TranzactionTable */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tranzaction Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tranzaction-table-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'domen_tranzaction',
            'delivery_type',
            'body_tranzaction:ntext',
            'status_tranzaction',
            'date_tranzaction',
            'key_tranzaction',
            'balance',
        ],
    ]) ?>

</div>
