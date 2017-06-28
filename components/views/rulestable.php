<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RulesTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">

<div style="background-color: #fff">
    <?= GridView::widget([

        'summary' => '',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            //'user_id',

//            [   'attribute'=>'delivery_type',
//                'contentOptions' =>function ($model){
//                    return ['class' => 'name', 'title'=>$model->delivery_type, 'style' => 'white-space: nowrap;
//                                                            text-overflow: ellipsis;
//                                                            max-width: 50px;
//                                                            overflow: hidden'];
//                }],

//            [   'attribute'=>'regular_filter',
//                'contentOptions' =>function ($model){
//                    return ['class' => 'name', 'title'=>$model->regular_filter, 'style' => 'white-space: nowrap;
//                                                            text-overflow: ellipsis;
//                                                            max-width: 50px;
//                                                            overflow: hidden'];
//                }],

            [   'attribute'=>'regular_rule',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->regular_rule, 'style' => 'white-space: nowrap;
                                                            text-overflow: ellipsis;
                                                            max-width: 100px;
                                                            overflow: hidden'];
                }],
            [   'attribute'=>'settings_rule_decode',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->settings_rule_decode, 'style' => 'white-space: nowrap;
                                                            text-overflow: ellipsis;
                                                            max-width: 100px;
                                                            overflow: hidden'];
                }],
            ['class' => 'yii\grid\ActionColumn',
                'controller'=> 'account',
                'template' => '{view}  {delete}',
                'contentOptions' =>function ($model){
                    return ['class' => 'name', 'title'=>$model->regular_rule, 'style' => 'white-space: nowrap;'
                                                            //text-overflow: ellipsis;
                                                            //max-width: 28px;
                                                            //min-width: 27px;
                                                            //overflow: hidden'
                    ];
                }],
//            [
//                'format' => 'html',
//                'value' => function($model){
//                    return Html::a(
//                        'Детали...',['account/data-transaction', 'id' => $model->id ],
//
//                        [
//                            'title' => 'Настройки запроса',
//                            'target' => '_blank'
//                        ]
//                    );
//                }
//            ],
        ],
    ]); ?>
    </div>
</div>
