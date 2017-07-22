<?php
/**
 *
 * @var \yii\data\ActiveDataProvider $listDataProvider
 */
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;

$this->title = 'Плагины для CMS';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/plagins.html'];
?>
<section style=" background-image: url('/web/AssetsSmarty/images/demo/1200x800/fon4.jpg');">
   <div class="container-fluid">
       <div class = 'row'>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])?>
                <?php echo ListView::widget(['dataProvider' => $listDataProvider,'itemView' => '_post','summary' => '']);    ?>
            </div>
        </div>
    </div>
</section>
