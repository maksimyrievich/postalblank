<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tranzaction".
 *
 * @property integer $id
 * @property string $date_tranzaction
 * @property string $delivery_type
 * @property integer $status_tranzaction
 * @property string $domen_tranzaction
 * @property string $body_tranzaction
 * @property string $key_tranzaction
 * @property string $balance
 * @property string $userid_tranzaction
 */
class TranzactionTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tranzaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_tranzaction', 'delivery_type', 'userid_tranzaction','balance', 'status_tranzaction', 'domen_tranzaction', 'key_tranzaction'], 'required'],
            [['date_tranzaction'], 'safe'],
            [['status_tranzaction'], 'string', 'max' => 20],
            [['domen_tranzaction', 'body_tranzaction', 'delivery_type'], 'string', 'max' => 255],
            [['key_tranzaction'],'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_tranzaction' => 'Дата',
            'status_tranzaction' => 'Статус',
            'domen_tranzaction' => 'Домен',
            'body_tranzaction' => 'Скачано',
            'key_tranzaction' => 'Ключ',
            'delivery_type'=> 'Вид доставки',
            'balance' => 'Баланс',
            'userid_tranzaction' => 'ID пользователя',

        ];
    }
}
