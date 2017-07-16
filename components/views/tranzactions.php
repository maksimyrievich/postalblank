<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TranzactionTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Последние транзакции';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/account/login.html'];
?>





    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--
    <p>
        <?= Html::a('Create Tranzaction Table', ['create'], ['class' => 'btn btn-success']) ?>
    </p>  -->
    <div  style="background-color: #fff ">
        <?= GridView::widget([
            'summary' => '',
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table  dataTable ', 'id' => 'sample_3'],
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                ['attribute'=>'id'],
                [   'attribute'=>'date_tranzaction',
                    'contentOptions' =>function ($model){
                        return ['class' => 'name', 'title'=>$model->date_tranzaction, 'style' => 'white-space: nowrap;
                                                                text-overflow: ellipsis;                                                                 
                                                                overflow: hidden'];}],
                [   'attribute'=>'domen_tranzaction',
                    'contentOptions' =>function ($model){
                        return ['class' => 'name', 'title'=>$model->domen_tranzaction, 'style' => 'white-space: nowrap;
                                                                text-overflow: ellipsis;                                                                
                                                                overflow: hidden'];}],
                [   'attribute'=>'status_tranzaction',
                    'contentOptions' =>function ($model){
                        return ['class' => 'name', 'title'=>$model->status_tranzaction,'style' => 'white-space: nowrap;
                                                                text-overflow: ellipsis;                                                                
                                                                overflow: hidden'];}],
                [   'attribute'=>'delivery_type',
                    'contentOptions' =>function ($model){
                        return ['class' => 'name', 'title'=>$model->delivery_type, 'style' => 'white-space: nowrap;
                                                                text-overflow: ellipsis;                                                                
                                                                overflow: hidden'];}],
                [   'attribute'=>'body_tranzaction',
                    'contentOptions' =>function ($model){
                        return ['class' => 'name', 'title'=>$model->body_tranzaction, 'style' => 'white-space: nowrap;
                                                                text-overflow: ellipsis;                                                                
                                                                overflow: hidden'];}],
                ['attribute'=>'key_tranzaction'],
                ['attribute'=>'balance'],
                ['attribute'=>'userid_tranzaction'],
                ['format' => 'html',
                    'value' => function($model){
                        return Html::a('<i class = "glyphicon glyphicon-cog"></i> Создать стандартное правило для этого вида доставки', Url::to(['account/data-transaction', 'id' => $model->id]),
                            [
                                'title' => 'Вы можете создать таповое правило для данного варианта доставки.',
                                'target' => '_blank'
                            ]);}]
                //['class' => 'yii\grid\ActionColumn',],

            ]
        ]); ?>
    </div>

