<?php

use yii\helpers\Html;
use app\components\AccountMenuWidget;

/* @var $this yii\web\View */
/* @var $model app\models\RulesTable */

$this->title = 'Update Rules Table: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rules Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class = 'row'>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <ul style="border-radius: 0px;" class="catalog panel panel-default">
            <?= AccountMenuWidget::widget(['template' => 'accountmenu']);?>
        </ul>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">






            <div class="rules-table-update">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
    </div>
</div>