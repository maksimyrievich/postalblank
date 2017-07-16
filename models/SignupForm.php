<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form - Форма регистрации юзера на сайте
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => Yii::t('translate', 'MESS_VALID_REQUIRED{attribute}')],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i', 'message' => Yii::t('translate', 'MESS_VALID_PATTERN')],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('translate', 'MESS_VALID_USERMAME_UNIQ')],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('translate', 'MESS_VALID_TOSHORT{attribute}'),
                'tooLong' => Yii::t('translate', 'MESS_VALID_TOLONG{attribute}')],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => Yii::t('translate', 'MESS_VALID_REQUIRED{attribute}')],
            ['email', 'email', 'message' => Yii::t('translate','MESS_VALID_EMAIL{attribute}')],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('translate', 'MESS_VALID_EMAIL_UNIQ')],

            ['password', 'required', 'message' => Yii::t('translate', 'MESS_VALID_REQUIRED{attribute}')],
            ['password', 'string', 'min' => 6, 'tooShort' => Yii::t('translate', 'MESS_VALID_TOSHORT{attribute}')],

            ['verifyCode', 'captcha', 'captchaAction' => '/site/captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'username' => Yii::t('translate','TEXT_USERNAME'),
            'email' => Yii::t('translate','TEXT_EMAIL'),
            'password' => Yii::t('translate','TEXT_PASSWORD'),
        ];
    }



    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            if ($user->save()) {
                \Yii::$app->mailer->getView()->params['userName'] = ', '.$user->username.'.';   //передаем параметры в layout, в данном случае имя пользователя
                                                                                                //можно конечно передавать и любые другие параметры
                Yii::$app->mailer->compose('EmailConfirm', ['user' => $user])
                    ->setTo($user->email)
                    ->setSubject('Код подтверждения адреса электронной почты')
                    ->send();

                // Reset layout params
                \Yii::$app->mailer->getView()->params['userName'] = null; //необходимо очистить параметры, которые мы передавали в layout
                //Эта очистка нужна для того, что бы эти параметры не передались в следующее письмо, которые может быть отправлено где либо в другом месте кода.

                return $user;
            }
        }

        return null;
    }
}