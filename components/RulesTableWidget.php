<?php


namespace app\components;

use app\models\RulesTableSearch;
use Yii;
use yii\base\Widget;



class RulesTableWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $searchModel = new RulesTableSearch();
        $dataProvider = $searchModel->search(Yii::$app->user->id);
        return $this->render('rulestable', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }
}