<?php


namespace app\components;

use app\models\CreateRulesForm;
use app\models\RulesTable;
use Yii;
use yii\base\Widget;
use app\models\TranzactionTable;


class CreateRuleWidget extends Widget
{
    public $rulesform;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //Если юзер гость то идём на главную страницу сайта
        if (Yii::$app->user->isGuest) {
            return $this->redirect('\site\index');
        }
        $id = Yii::$app->request->get('id');
        $rules = $this->rulesform; //new CreateRulesForm();
        $tranzaction = TranzactionTable::findOne($id);
        //Если модель загружена то
        if ($rules->load(Yii::$app->request->post()) ) {

            $rules->delivery_type = $tranzaction->delivery_type;

            if($rules->validate()){
            $strr = '';
            preg_match("~$rules->regular_filter_1~",$rules->delivery_type,$result);
            $strr .= $result[0];
            preg_match("~$rules->regular_filter_2~",$rules->delivery_type,$result);
            $strr .= ' '.$result[0];
            preg_match("~$rules->regular_filter_3~",$rules->delivery_type,$result);
            $strr .= ' '.$result[0];
            preg_match("~$rules->regular_filter_4~",$rules->delivery_type,$result);
            $strr .= ' '.$result[0];
            preg_match("~$rules->regular_filter_5~",$rules->delivery_type,$result);
            $strr .= ' '.$result[0];
            $rules->regular_rule = $strr;}

            return $this->render('createrule', ['rules'=>$rules,'id'=>$id]);

        } else {

            $rules->delivery_type = $tranzaction->delivery_type;
            return $this->render('createrule', ['rules'=>$rules,'id'=>$id]);}


    }

}