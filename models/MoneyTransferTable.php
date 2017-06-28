<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 04.01.2017
 * Time: 22:29
 */

namespace app\models;
use yii\db\ActiveRecord;

class MoneyTransferTable extends ActiveRecord
{



    public static function tableName()
    {
        return 'moneytransfer';
    }

    public function rules()
    {
        return [
            [['token_transaction'], 'string', 'max' => 32],
            //[['user_id'], 'integer', 'max' => 11],
            //[['time_transaction'], 'date', 'format' => 'Y-m-d H:i:s'],
        ];
    }

}