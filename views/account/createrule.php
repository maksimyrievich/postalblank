<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */
use app\components\AccountMenuWidget;
use app\components\CreateRuleWidget;
use app\components\DataTransactionWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AccordionViewSmartyAsset;


$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

AccordionViewSmartyAsset::register($this);
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
                    <div class="panel-heading"style="text-align: center" >
                        Создание правила для типового вида доставки
                    </div>
                    <?= CreateRuleWidget::widget(['rulesform' => $rulesform]); ?>
                </div>
            </div>
        </div>
        <!--<div class="form-group"> -->

        <!--</div> -->

    </div>
</div>