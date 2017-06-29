<?php


namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\RulesTable;



class DataRulesWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $id = Yii::$app->request->get('id');
        $model = RulesTable::findOne($id);
        //debug($model);
        return $this->render('datarules', ['model' =>$model, 'id' =>$id]);


    }

}