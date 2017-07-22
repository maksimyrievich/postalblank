<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.01.2017
 * Time: 23:42
 */
use app\components\AccountMenuWidget;
use yii\widgets\Breadcrumbs;
use app\assets\AccordionViewSmartyAsset;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Мой кабинет';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/account/mydata.html'];
$this->title = 'Личная информация';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/account/mydata.html'];

AccordionViewSmartyAsset::register($this);
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
    <div class="container-fluid">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
        <div class = 'row'>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="panel" style="background-color: #269abc; padding: 0px 0px 0px 0px;">
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
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6" >
                <div class=" panel" style="background-color: #269abc; padding: 0px;" >
                    <div class="panel" style="margin: 0px 0px 0px 0px">
                        <div class="panel-primary">
                            <div class="panel-heading" style="text-align: center">
                                <i class="glyphicon glyphicon-user"></i> Личная информация
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" >
                                    <tbody >
                                        <tr><th style="font-weight: 100">Логин пользователя:</th><th style="font-weight: 100"><?= $user->username;?></th></tr>
                                        <tr><th style="font-weight: 100">Емайл пользователя:</th><th style="font-weight: 100"><?= $user->email; ?></th></tr>
                                        <tr><th style="font-weight: 100">Статус пользователя :</th><th style="font-weight: 100"><?= $user->getStatusName(); ?></th></tr>
                                        <tr><th style="font-weight: 100">Ф.И.О. пользователя:</th><th style="font-weight: 100"><?= $user->firstname;?> <?= $user->lastname; ?></th></tr>
                                        <tr><th style="font-weight: 100">Телефон пользователя:</th><th style="font-weight: 100"><?= $user->telephone; ?></th></tr>
                                        <tr><th style="font-weight: 100">ID пользователя :</th><th style="font-weight: 100"><?= $user->getId(); ?></th></tr>
                                        <tr><th style="font-weight: 100">Баланс счёта (руб) :</th><th style="font-weight: 100" ><?= $user->balance;?></th></tr>
                                        <tr style="font-weight: 100"><th style="font-weight: 100">Секретный ключ :</th><th style="font-weight: 100"><?= $user->key_secret;?></th></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="form-group text-center">
                    <?= Html::a(Yii::t('translate', 'BUTTON_EDIT_DATA'), Url::to(['/account/edit-data']), ['class' => 'btn btn-success', 'style' => 'margin: 4px 0px 4px 0px']) ?>
                    <?= Html::a(Yii::t('translate', 'BUTTON_TOP_UP_BALANCE'), Url::to(['/account/balance']), ['class' => 'btn btn-info']) ?>
                    <?= Html::a(Yii::t('translate', 'BUTTON_GENERATED_KEY'), Url::to(['/account/generate-key']), [
                        'class' => 'btn btn-warning',
                        'style' => 'margin: 4px 0px 4px 0px',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите поменять ключ? После изменения ключа не забудьте его обновить в настройках плагина.',
                            'method' => 'post',
                        ]]) ?>
                   </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-3" >
            </div>
        </div>
    </div>
</section>