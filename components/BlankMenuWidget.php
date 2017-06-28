<?php

namespace app\components;
use app\models\BlankMenuForm;
use app\models\RulesTable;
use yii\base\Widget;
use app\models\BlankMenu;
use Yii;
use yii\bootstrap\ActiveForm;

class BlankMenuWidget extends Widget {

    //
    public $template;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent:: init();

    }

    public function run()
    {
        $model = new BlankMenuForm();
        $id = Yii::$app->request->get('id');
        $rules = RulesTable::findOne($id);
        $settings = unserialize($rules->settings_rule);

        $model->blankF7P = $settings[0];
        $model->blankF112P = $settings[1];
        $model->obiavlenncennost = $settings[2];
        $model->nalogennplatege = $settings[3];
        $model->typ_posilki = $settings[4];
        $model->jde_blank = $settings[5];
        $model->pek_blank = $settings[6];
        $model->dellin_blank = $settings[7];

        //debug($settings);
        return $this->render('blankmenu', ['model' =>$model]);




        // get cache
//        $menu = Yii::$app->cache->get('menublank');
  //      if($menu) return $menu;

        //asArray() - ворачивает данные в виде массивов, а не ввиде объектов
        //indexBy() - позволяет указать какое поле таблицы использовать для индексации массива
    //    $this->data = BlankMenu::find()->indexBy('id')->asArray()->all();
      //  $this->tree = $this->getTree();
        //debug($this->tree);
        //$this->menuHtml = $this->getMenuHtml($this->tree);
        //set cache
//        Yii::$app->cache->set('menublank', $this->menuHtml, 1);

  //      return $this->menuHtml;
    }


}