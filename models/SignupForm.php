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
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha', 'captchaAction' => '/site/captcha'],
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