<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Tables';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="users-table-index container-fluid">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Users Table', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_from',
                        'attribute2' => 'date_to',
                        'type' => DatePicker::TYPE_RANGE,
                        'separator' => 'to',
                        'pluginOptions' => ['format' => 'yyyy-mm-dd']
                    ]),
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                ],
                'username',
                'email:email',
                [
                    'filter' => User::getStatusesArray(),
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column) {
                        /** @var User $model */
                        /** @var \yii\grid\DataColumn $column */
                        $value = $model->{$column->attribute};
                        switch ($value) {
                            case User::STATUS_ACTIVE:
                                $class = 'success';
                                break;
                            case User::STATUS_WAIT:
                                $class = 'warning';
                                break;
                            case User::STATUS_BLOCKED:
                            default:
                                $class = 'default';
                        };
                        $html = Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label label-' . $class]);
                        return $value === null ? $column->grid->emptyCell : $html;
                    }
                ],
                ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'white-space: nowrap; text-align: center; letter-spacing: 0.1em; max-width: 7em;'],
                ],
            ],
        ]); ?>
    </div>

