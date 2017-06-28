<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>
<li type="none">
    <a style="  text-decoration: none;
        <?php if(isset($category['childs'])):?>
            font-weight: bold;
        <?php endif;?>
        <?php if($category['alias'] === 'logout'):?>
            font-weight: bold;
        <?php endif;?>
        "
        <?php if(!isset($category['childs'])):?>
            href="<?= Url::to(['/account/' . $category['alias']])?>"
        <?php endif;?>
        >
        <?php if(isset($category['childs'])):?>
            <i class="glyphicon glyphicon-triangle-right"></i>
        <?php endif;?>
        <?php if($category['alias'] === 'logout'):?>
            <i class="glyphicon glyphicon-triangle-right"></i>
        <?php endif;?> <?= $category[name]?>
    </a>
    <?php if(isset($category['childs'])):?>
            <ul type="none" style="padding: 5px 0px 25px 20px">
                <?= $this->getMenuHtml($category['childs']) ?>
            </ul>
    <?php endif;?>
</li>

