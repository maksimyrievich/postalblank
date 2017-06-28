<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Tables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-table-index">

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
            'firstusername',
            'lastusername',
            'username',
            'password',
            'balance',
            // 'authkey',
            // 'accesstoken',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
