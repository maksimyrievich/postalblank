<?php
namespace app\models;

use yii\base\Model;


class GenerateMail extends Model
{
    public $email;
    /**
     * @param string $view
     * @param string $subject
     * @param array $params
     * @param string $username
     * @return bool
     */
    public function sendMail($view, $subject, $params = [],$email) {
        // Set layout params
        \Yii::$app->mailer->getView()->params['userName'] = 'Максим Юрьевич'; //передаем параметры в layout, в данном случае имя пользователя
                                                                            //можно конечно передавать и любые другие параметры
        $result = \Yii::$app->mailer->compose([   //мы хотим что бы пользователю отправлялись две версии письма:
            // HTML и текстовая. Для этого в методе compose() нам необходимо указать два вида шаблона (view), один для
            // HTML версии письма, второй для текстовой:
            'html' => 'views/' . $view . '-html',
            'text' => 'views/' . $view . '-text',
        ], $params)->setTo($email) //В методе setTo() мы передаем в виде массива имя и e-mail
                                                              // адрес получателя.
            ->setSubject($subject)
            ->send();               //После того как был вызван метод send() письмо было отправлено

        // Reset layout params
        \Yii::$app->mailer->getView()->params['userName'] = null; //необходимо очистить параметры, которые мы передавали в layout
        //Эта очистка нужна для того, что бы эти параметры не передались в следующее письмо, которые может быть отправлено где либо в другом месте кода.

        return $result;
    }
}