<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 04.01.2017
 * Time: 22:29
 */

namespace app\models;
use yii\db\ActiveRecord;

class AccountMenu extends ActiveRecord
{
    public static function tableName()
    {
        return 'accountmenu';
    }


}