<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 21.11.2016
 * Time: 21:11
 */

use app\components\AccountMenuWidget;



$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class = 'row'>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <div class="panel" style="background-color: #269abc; padding: 20px 20px 0px 20px">
            <div class="panel"style="padding: 15px 0px 15px 0px">
                <ul class="catalogg">
                    <?= AccountMenuWidget::widget(['template' => 'accountmenu']);?>
                </ul>
            </div>
        </div>



    </div>


    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">

    </div>
</div>


