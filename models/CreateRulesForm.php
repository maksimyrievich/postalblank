<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CreateRulesForm extends Model
{
    public $delivery_type;
    public $regular_filter_1;
    public $regular_filter_2;
    public $regular_filter_3;
    public $regular_filter_4;
    public $regular_filter_5;
    public $regular_rule;




    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['delivery_type'], 'required', 'on' => 'resultfilter'],
            [['regular_rule'], 'required', 'on' => 'resultsave'],
            [['regular_filter_1'], 'validateStr1'],
            [['regular_filter_2'], 'validateStr2'],
            [['regular_filter_3'], 'validateStr3'],
            [['regular_filter_4'], 'validateStr4'],
            [['regular_filter_5'], 'validateStr5'],
            [['regular_rule','delivery_type'], 'string', 'max'=>255],
        ];
        //, 'regular_rule'
    }

    public function validateStr1($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if (!preg_match("/^[a-z\" \"абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9_]{0,255}$/", $this->regular_filter_1)){
                $this->addError($attribute, 'В строке найдены не допустимые символы');
            }
        }
    }

    public function validateStr2($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if (!preg_match("/^[a-z\" \"абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9_]{0,255}$/", $this->regular_filter_2)){
                $this->addError($attribute, 'В строке найдены не допустимые символы');
            }
        }
    }

    public function validateStr3($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if (!preg_match("/^[a-z\" \"абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9_]{0,255}$/", $this->regular_filter_3)){
                $this->addError($attribute, 'В строке найдены не допустимые символы');
            }
        }
    }

    public function validateStr4($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if (!preg_match("/^[a-z\" \"абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9_]{0,255}$/", $this->regular_filter_4)){
                $this->addError($attribute, 'В строке найдены не допустимые символы');
            }
        }
    }

    public function validateStr5($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if (!preg_match("/^[a-z\" \"абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9_]{0,255}$/", $this->regular_filter_5)){
                $this->addError($attribute, 'В строке найдены не допустимые символы');
            }
        }
    }



}