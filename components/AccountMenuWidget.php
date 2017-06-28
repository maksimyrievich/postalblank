<?php

namespace app\components;
use yii\base\Widget;
use app\models\AccountMenu;
use Yii;

class AccountMenuWidget extends Widget {

    //
    public $template;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent:: init();
        if($this->template === null){
            $this->template = 'accountmenu';
        }
        $this->template .= '.php';
    }

    public function run()
    {
        // get cache
        $menu = Yii::$app->cache->get('menu');
        if($menu) return $menu;

        //asArray() - ворачивает данные в виде массивов, а не ввиде объектов
        //indexBy() - позволяет указать какое поле таблицы использовать для индексации массива
        $this->data = AccountMenu::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //set cache
        Yii::$app->cache->set('menu', $this->menuHtml, 1);

        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id => &$node){
            if(!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    //Функция, которая из массива представленного в виде дерева, создает и возвращает
    //Html код.
    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category){
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }
    //Функция сохраняющая в буфер кусок Html кода
    protected function catToTemplate($category){
        //включаем буферизацию
        ob_start();
        //Включаем в него кусок Html кода
        include __DIR__ . '/accountmenu_template/' . $this->template;
        //Возвращаем кусок Html кода, только не на экран а в буферизованном виде.
        return ob_get_clean();
}

}