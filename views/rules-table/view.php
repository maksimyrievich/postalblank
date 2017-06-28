<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */
use app\components\AccountMenuWidget;
use app\components\DataRulesWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class = 'row'>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px">
            <div class="panel" style="margin: 0px 0px 0px 0px">
                <div class="panel-primary">
                    <div class="panel-heading" style="text-align: center">
                        <i class = "glyphicon glyphicon-th-list"></i> Навигационное меню
                    </div>
                    <div style="width: 203px; padding: 15px 0px 10px 0px; margin: 0px auto;" >
                        <ul type="none" class="catalogg" style="padding: 0px 0px 0px 0px">
                            <?= AccountMenuWidget::widget(['template' => 'accountmenu']);?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
        <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px">
            <div class="panel" style="margin: 0px 0px 0px 0px">
                <div class="panel-primary">
                    
                        <?=  DataRulesWidget::widget()?>
                </div>
            </div>
        </div>
        <!--<div class="form-group"> -->

        <!--</div> -->

    </div>
</div>



<?php
//
//use yii\helpers\Html;
//use yii\widgets\DetailView;
//use app\components\AccountMenuWidget;
//
///* @var $this yii\web\View */
///* @var $model app\models\RulesTable */
//
//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Rules Tables', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
//?>
<!--<div class = 'row'>-->
<!--    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">-->
<!--        <ul style="border-radius: 0px;" class="catalog panel panel-default">-->
<!--            --><?//= AccountMenuWidget::widget(['template' => 'accountmenu']);?>
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">-->
<!---->
<!--        <div class="rules-table-view">-->
<!--            <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!--            <p>-->
<!--                --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--                --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//                    'class' => 'btn btn-danger',
//                    'data' => [
//                        'confirm' => 'Are you sure you want to delete this item?',
//                        'method' => 'post',
//                    ],
//                ]) ?>
<!--            </p>-->
<!--            --><?//= DetailView::widget([
//                'model' => $model,
//                'attributes' => [
//                    'id',
//                    'user_id',
//                    'regular_filter_1',
//                    'regular_rule',
//                ],
//            ]) ?>
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->