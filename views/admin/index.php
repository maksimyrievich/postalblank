<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use kartik\date\DatePicker;
use app\components\grid\LinkColumn;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\components\grid\RoleColumn;
use yii\helpers\ArrayHelper;


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
                        'separator' => '-',
                        'pluginOptions' => ['format' => 'yyyy-mm-dd']
                    ]),
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                ],
                [
                    'class' => LinkColumn::className(),
                    'attribute' => 'username',
                ],
                'email:email',
                [
                    'class' => SetColumn::className(),
                    'filter' => User::getStatusesArray(),
                    'attribute' => 'status',
                    'name' => 'statusName',
                    'cssCLasses' => [
                        User::STATUS_ACTIVE => 'success',
                        User::STATUS_WAIT => 'warning',
                        User::STATUS_BLOCKED => 'default',
                    ],
                ],
                [
                    'class' => RoleColumn::className(),
                    'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
                    'attribute' => 'role',
                ],
                ['class' => ActionColumn::className()],
            ],
        ]); ?>
    </div>

