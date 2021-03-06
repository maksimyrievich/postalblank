<?php


namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\TranzactionTableSearch;


class TranzactionsWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $searchModel = new TranzactionTableSearch();
        $dataProvider = $searchModel->search(Yii::$app->user->id);

        return $this->render('tranzactions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

}