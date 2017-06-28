<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TranzactionTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ваши транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tranzaction-table-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?= Html::a('Create Tranzaction Table', ['create'], ['class' => 'btn btn-success']) ?>
    </p>  -->
    <?= GridView::widget([

        'summary' => '',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
       'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'date_tranzaction',
            'domen_tranzaction',
            'status_tranzaction',
            'delivery_type',
            'body_tranzaction:ntext',
            //'key_tranzaction',
            'balance',
           //'userid_tranzaction',


           //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
