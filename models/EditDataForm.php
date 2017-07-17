<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EditDataForm extends Model
{
    public $firstname;
    public $lastname;
    public $telephone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['firstname', 'lastname', 'telephone'], 'string', 'min' => 2, 'max' => 30,'tooShort' => Yii::t('translate', 'MESS_VALID_TOSHORT{attribute}'),
                'tooLong' => Yii::t('translate', 'MESS_VALID_TOLONG{attribute}')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('translate','TEXT_FIRSTNAME'),
            'lastname' => Yii::t('translate','TEXT_LASTNAME'),
            'telephone' => Yii::t('translate','TEXT_TELEPHONE'),
        ];
    }
}




