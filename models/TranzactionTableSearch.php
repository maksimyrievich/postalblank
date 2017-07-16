<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TranzactionTable;

/**
 * TranzactionTableSearch represents the model behind the search form about `app\models\TranzactionTable`.
 */
class TranzactionTableSearch extends TranzactionTable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_tranzaction', 'delivery_type','domen_tranzaction', 'userid_tranzaction','balance', 'body_tranzaction',
                'key_tranzaction'], 'safe'],
            [['status_tranzaction'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($id)
    {
        $query = TranzactionTable::find()
            ->where(['userid_tranzaction'=> $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //Сортировка таблицы из конца в начало
        $dataProvider->query->orderBy(['id' => SORT_DESC]);
        $dataProvider->pagination = false;
        $dataProvider->sort = false;

        // grid filtering conditions
        $query->andFilterWhere([
            //'id' => $this->id,
            //'status_tranzaction' => $this->status_tranzaction,
            //'body_tranzaction' => $this->body_tranzaction,
            //'date_tranzaction' => $this->date_tranzaction,
            //'key_tranzaction' => $this->key_tranzaction,
            //'balance' => $this->balance,
        ]);

        $query->andFilterWhere(['like', 'domen_tranzaction', $this->domen_tranzaction])
            ->andFilterWhere(['like', 'body_tranzaction', $this->body_tranzaction]);

        return $dataProvider;
    }
}
