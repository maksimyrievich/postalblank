<?php

namespace app\models;

use Yii;
use yii\base\Model;



/**
 * ProtocolTranzactionForm is the model behind the Tranzaction form.
 *
 */
class ProtocolForm extends Model
{
    public $out_f_name;     //Фамилия отправителя
    public $out_l_name;     //Имя отправителя
    public $out_m_name;     //Отчество отправителя
    public $out_street;     //Улица, дом, квартира отправителя
    public $out_zip;        //Индекс отправителя
    public $out_city;       //Город отправителя
    public $out_state;      //Область отправителя
    public $out_country;    //Страна отправителя


    public $f_name;         //Фамилия получателя
    public $l_name;         //Имя получателя
    public $m_name;         //Отчество получателя
    public $street;         //Улица, дом, квартира получателя
    public $zip;            //Индекс получателя
    public $city;           //Город получателя
    public $state;          //Область получателя
    public $country;        //Страна получателя

    public $order_total;    //Сумма счета
    public $delivery_type;  //Тип доставки
    public $key_tranzaction;//Ключ транзакции
    public $url;            //URL с которого идет запрос

    public $user; //Юзер чья транзакция

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // поля, которые обязательно должны быть заполнены в запросе
            [['out_f_name', 'out_l_name', 'out_street', 'out_m_name', 'out_zip', 'out_city', 'out_state',
                'out_country', 'f_name', 'l_name', 'delivery_type', 'order_total', 'street',
                'zip', 'city', 'state', 'country', 'key_tranzaction', 'url'], 'required'],
            //Эти поля должны быть строкового типа
            [['out_f_name', 'out_l_name', 'out_m_name','f_name', 'l_name', 'm_name'], 'string', 'max'=> 255],
            //Эти то же, но длина другая
            [['delivery_type', 'city', 'street', 'state', 'out_country', 'out_street', 'out_city', 'out_state'], 'string', 'max'=> 255],
            //Эти поля должны быть строкового типа
            [['zip', 'out_zip'],'string', 'max' => 6],
            //Код страны
            [['country', 'order_total'], 'string', 'max' => 20],
            // Значение переменной key_tranzaction проверять будем методом validateKeyTranzaction
            ['key_tranzaction', 'validateKeyTranzaction'],
        ];
    }
    /**
     * Валидация KeyTranzaction.
     * Это сервисный метод идет как встроенный для валидации KeyTranzaction.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateKeyTranzaction()
    {
        //Смотрим есть ли в базе такой ключ транзакции. Если есть ключ в базе,
        //в переменную $user грузим данные того кому ключ принадлежит
        $user = User::findOne(['key_secret' => $this->key_tranzaction]);
        //Если в $user ничего нет, тогда регистрируем ошибку проверки ключа
        if (empty($user)){
                $this->addError('Проверка ключа транзакции', '\''.$this->key_tranzaction.'\'-этот ключ не найден в БД');
            }else
                {
                    $this->user = $user;
                }
    }
    public function attributes()
    {
        return ['out_f_name' => 'Фамилия отправителя',
                'out_l_name' => 'Имя отправителя'];
                //return parent::attributes();
    }
}