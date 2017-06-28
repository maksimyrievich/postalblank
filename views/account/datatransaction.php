<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */
use app\components\AccountMenuWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\DataTransactionWidget;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class = 'row'>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px">
            <div class="panel" style="margin: 0px 0px 0px 0px">
                <div class="panel-primary">
                    <div class="panel-heading" style="text-align: center">
                        Навигационное меню
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
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 ">
        <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px">
            <div class="panel" style="margin: 0px 0px 0px 0px">
                <div class="panel-primary">
                    <div class="panel-heading"style="text-align: center" >
                        Детали запроса
                    </div>
                    <?= DataTransactionWidget::widget() ?>
                </div>
            </div>
        </div>
        <!--<div class="form-group"> -->

        <!--</div> -->
    </div>
</div>