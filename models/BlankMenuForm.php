<?php

namespace app\models;

use Yii;
use yii\base\Model;



/**
 * BlankMenuForm is the model behind the Tranzaction form.
 *
 */
class BlankMenuForm extends Model
{
    public $blankF7P = false;            // Ярлык на почтовую коробку Почта России (ф.7-п)
    public $blankF112P = false;          // Бланк почтового перевода (ф.112ЭП).
    public $obiavlenncennost = false;    // С объявленной ценностью.
    public $nalogennplatege = false;     // С наложенным платёжом.
    public $typ_posilki = 1;             // Посылка.

    public $jde_blank = false;           // Основной бланк ТК "ЖелДорЭкспедиции".
    public $pek_blank = false;           // Основной бланк ТК "ПЭК".
    public $dellin_blank = false;        // Основной бланк ТК "Деловые линии".

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // поля, которые обязательно должны быть заполнены в запросе
            [['blankF7P', 'blankF112P', 'obiavlenncennost', 'nalogennplatege', 'typ_posilki',
              'jde_blank','pek_blank','dellin_blank'], 'string'],
        ];
    }


    public function attributes()
    {
        return ['blankF7P' => 'Ярлык на почтовую коробку (ф.7-п).',
                'blankF112P' => 'Бланк почтового перевода (ф.112ЭП).',
                'obiavlenncennost' => 'С объявленной ценностью.',
                'nalogennplatege' => 'С наложенным платёжом.',
                'typ_posilki' => 'Тип посылки',
                'jde_blank' => 'Основной бланк ТК "ЖелДорЭкспедиции".',
                'pek_blank' => 'Основной бланк ТК "ПЭК".',
                'dellin_blank' => 'Основной бланк ТК "Деловые линии".'];
    }
}