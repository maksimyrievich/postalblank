<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rulestable".
 *
 * @property string $id
 * @property string $user_id
 * @property string $regular_filter
 * @property string $regular_rule
 * @property string $delivery_type
 * @property string $settings_rule
 * @property string $settings_rule_decode
 */
class RulesTable extends \yii\db\ActiveRecord
{
    public $blankF7P = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rulestable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'delivery_type','regular_filter_1','regular_filter_2','regular_filter_3','regular_filter_4',
                'regular_filter_5', 'regular_rule','settings_rule','settings_rule_decode'], 'string', 'max' => 255],
            [['user_id','id'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'user_id' => 'User ID',
            'delivery_type'=>'Тип доставки',
            'regular_filter_1' => 'Regular Filter',
            'regular_filter_2' => 'Regular Filter',
            'regular_filter_3' => 'Regular Filter',
            'regular_filter_4' => 'Regular Filter',
            'regular_filter_5' => 'Regular Filter',
            'regular_rule' => 'Описание правила',
            'settings_rule' => 'Настройки',
            'settings_rule_decode' => 'Настройки',
        ];
    }

    public function saveBlankSetting()
    {
        $array = [$this->blankF7P,];
        $this->settings_rule = serialize($array);
        $this->save();
    }
}
