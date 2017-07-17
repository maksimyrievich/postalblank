<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $username
 * @property string $auth_key
 * @property string $email_confirm_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $balance
 * @property string $key_secret
 * @property string $password
 * @property string $telephone
 * @property string $firstname
 * @property string $lastname
 */
class User extends ActiveRecord implements IdentityInterface
{
    //константы для указания статуса юзера
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

    //Метод переопределяющий название таблицы
    public static function tableName()
    {
        return '{{%user}}';
    }

    //Правила валидации имени пользователя, емайла при записи в таблицу
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#is'],
            ['username', 'unique', 'targetClass' => self::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'This email address has already been taken.'],
            ['email', 'string', 'max' => 255],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
        ];

    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлён',
            'username' => 'Логин',
            'email' => 'Email',
            'status' => 'Статус',
            'balance' => 'Баланс',
            'key_secret' => 'Ключ',
            'password' => 'Реальный пароль',
            'auth_key' => 'Auth Key',
            'email_confirm_token' => 'Email Confirm Token',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'telephone' => 'Телефон',
            'firstname' => 'Фамилия',
            'lastname' => 'Имя',
        ];
    }

    //Статический метод для получения наименования статуса юзера
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    //Статический метод для получения всех статусов у юзера
    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_WAIT => 'Ожидает подтверждения',
        ];
    }

    //Метод вписывает дату при каждом создании или обновлении юзера в поля таблицы 'created_at','updated_at'.
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    //Пять методов для реализации хранения зарегистрированного пользователя в интерфейсе IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    //Перед записью в базу для каждого пользователя нужно генерировать хэш пароля и
    //дополнительный ключ автоматической аутентификации. Добавим методы их генерации и
    //сделаем второй метод автозапускаемым при создании записи:
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    //Теперь добавим возможность смены пароля. Для этого у нас предусмотрено поле "password_reset_token". При запросе
    // восстановления мы в это поле будем записывать уникальную случайную строку с временной меткой и посылать по
    // электронной почте ссылку с этим хешэм на контроллер с действием активаци. А в контроллере уже найдём этого
    // пользователя по данному хешу и поменяем ему пароль. Добавим методы для генерации хеша и поиска по нему:
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    //Для регистрирующихся пользователей не помешает сделать подтверждение адреса электронной почты. Для этой цели
    // добавим несколько методов для управления email_confirm_token. При регистрации мы будем присваивать пользователю
    // статус STATUS_WAIT, генерировать ключ и отправлять ссылку с ключом на почту. А в контроллере (при переходе по
    // этой ссылке) найдём пользователя по ключу и активируем:
    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    /**
     * Get User real password
     */
    public function getPassword()
    {
        $this->password;
    }

    /**
     * Removes real password
     */
    public function removePassword()
    {
        $this->password = null;
    }

    /**
     * Generate KeySecret
     */
    public function generateKeySecret()
    {
        $this->key_secret = Yii::$app->security->generateRandomString();
    }
}
