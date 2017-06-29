<?php

namespace app\models;

class User extends UsersTable implements \yii\web\IdentityInterface
{

    //public $authKey;
    //public $accessToken;

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin@mail.ru',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
    */


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Находит пользователя по имени пользователя
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
        /*//Организуем цикл по массиву $users
        foreach (self::$users as $user) {
            //И если у какого то юзера из массива 'username' равно $username
            if (strcasecmp($user['username'], $username) === 0) {
                //Сразу возвращаем
                return new static($user);
            }
        }

        return null;    */

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getfirstname()
    {
        return $this->firstusername;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authkey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
