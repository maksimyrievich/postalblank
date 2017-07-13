<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $file;

     /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email','subject','body'], 'required', 'message' => Yii::t('translate','MESS_VALID_REQUIRED{attribute}')],
            // email has to be a valid email address
            ['email', 'email', 'message' => Yii::t('translate','MESS_VALID_EMAIL{attribute}')],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            //Файл может быть загружен только с расширением png, jpg.
            [['file'], 'file', 'extensions' => 'png, jpg, rar, zip', 'wrongExtension' => Yii::t('translate','MESS_VALID_EXTENSION_FILE')],
            [['file'], 'file', 'maxSize' => 3145728, 'tooBig' => Yii::t('translate','MESS_VALID_MAX_SIZE_FILE')],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'name' => Yii::t('translate','TEXT_NAME'),
            'email' => Yii::t('translate','TEXT_EMAIL'),
            'subject' => Yii::t('translate','TEXT_SUBJECT'),
            'body' => Yii::t('translate','TEXT_BODY'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        Yii::$app->mailer->compose()
        ->setTo($email)
        ->setFrom([$email => $this->name.' с postalblank.ru'])
        ->setReplyTo([$this->email => $this->name])
        ->setSubject($this->subject)
        ->setTextBody($this->body)
        ->attach(Yii::$app->basePath.'/uploads/' . $this->file->baseName . '.' . $this->file->extension)
        ->send();
        return true;
    }

    public function upload()
    {
        if ($this->validate()) {
            if($this->file != null) {
                $this->file->saveAs(Yii::$app->basePath . '/uploads/' . $this->file->baseName . '.' . $this->file->extension);
            }
            return true;
        }
        return false;

    }
}
