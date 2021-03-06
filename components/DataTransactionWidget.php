<?php


namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\TranzactionTable;


class DataTransactionWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $id = Yii::$app->request->get('id');
        $model = TranzactionTable::findOne($id);
        //debug($model);
        return $this->render('datatransaction', ['model' =>$model]);


    }

}