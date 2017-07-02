<?php
namespace app\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

class EmailConfirmForm extends Model
{
    /**
     * @var User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  string $token
     * @param  array $config
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Отсутствует код подтверждения.');
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Неверный токен.');
        }
        parent::__construct($config);
    }

    /**
     * Confirm email.
     *
     * @return boolean if email was confirmed.
     */
    public function confirmEmail()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeEmailConfirmToken();
        $user->balance = 10;
        $user->generateKeySecret();
        $password = $user->password;
        $user->removePassword();

        if($user->save()) {
            Yii::$app->mailer->getView()->params['userName'] = ', ' . $user->username . '.';   //передаем параметры в layout, в данном случае имя пользователя
            Yii::$app->mailer->compose('RegistrationData', ['user' => $user, 'password' => $password])
                ->setTo($user->email)
                ->setSubject('Регистрационные данные')
                ->send();
            // Reset layout params
            Yii::$app->mailer->getView()->params['userName'] = null; //необходимо очистить параметры, которые мы передавали в layout
            //Эта очистка нужна для того, что бы эти параметры не передались в следующее письмо, которые может быть отправлено где либо в другом месте кода.
            return true;
        }
        return false;
    }
}

