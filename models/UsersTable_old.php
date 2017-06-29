<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $firstusername
 * @property string $lastusername
 * @property string $username
 * @property string $password
 * @property string $balance
 * @property string $key_secret
 * @property string $authkey
 * @property string $accesstoken
 */
class UsersTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstusername', 'lastusername', 'username','balance'], 'required'],
            [['firstusername', 'lastusername', 'username', 'password', 'authkey', 'accesstoken'], 'string', 'max' => 255],
            [['key_secret'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstusername' => 'Фамилия',
            'lastusername' => 'Имя',
            'username' => 'Емайл',
            'password' => 'Пароль',
            'balance' => 'Баланс',
            'key_secret' => 'Ключ',
            'authkey' => 'Authkey',
            'accesstoken' => 'Accesstoken',
        ];
    }
}
