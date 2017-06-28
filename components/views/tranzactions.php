<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TranzactionTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Последние транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="table-responsive">


    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--
    <p>
        <?= Html::a('Create Tranzaction Table', ['create'], ['class' => 'btn btn-success']) ?>
    </p>  -->
    <div style="background-color: #fff">
    <?= GridView::widget([

        'summary' => '',
        'dataProvider' => $dataProvider,


        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],


            [   'attribute'=>'date_tranzaction',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->date_tranzaction, 'style' => 'white-space: nowrap;
                                                            text-overflow: ellipsis; 
                                                            max-width: 63px; 
                                                            overflow: hidden'];}],

            [   'attribute'=>'domen_tranzaction',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->domen_tranzaction, 'style' => 'white-space: nowrap;
                                                            text-overflow: ellipsis;
                                                            max-width: 100px; 
                                                            overflow: hidden'];
                },

            ],

//            [   'attribute'=>'status_tranzaction',
//                'contentOptions' =>function ($model){
//                    return ['class' => 'name', 'title'=>$model->status_tranzaction,'style' => 'white-space: nowrap;
//                                                            text-overflow: ellipsis;
//                                                            max-width: 100px;
//                                                            overflow: hidden'];
//                },
//
//            ],
            [   'attribute'=>'delivery_type',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->delivery_type, 'style' => 'white-space: nowrap;
                                                            text-overflow: ellipsis;
                                                            max-width: 100px; 
                                                            overflow: hidden'];
                },

            ],

            [   'attribute'=>'body_tranzaction',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->body_tranzaction, 'style' => 'white-space: nowrap;
                                                            text-overflow: ellipsis;
                                                            max-width: 50px; 
                                                            overflow: hidden'];
                },

            ],
            //'key_tranzaction',

            [   'attribute'=>'balance',


            ],
            [

                'format' => 'html',
                'value' => function($model){
                    return Html::a('Детали...', Url::to(['account/data-transaction', 'id' => $model->id ]),

                        [
                            'title' => 'Настройки запроса',
                            'target' => '_blank'
                        ]
                    );

                },

            ],

            //'userid_tranzaction',


            //['class' => 'yii\grid\ActionColumn',],

        ],

    ]); ?>
    </div>
</div>