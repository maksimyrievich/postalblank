<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RulesTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rules Tables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rules-table-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rules Table', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'regular_filter_1',
            'regular_rule',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
