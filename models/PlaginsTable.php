<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plagins".
 *
 * @property integer $id
 * @property integer $plagin_publish
 * @property string $plagin_image
 * @property string $plagin_name
 * @property string $plagin_path
 * @property string $description_RU
 * @property string $alt
 */
class PlaginsTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plagins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plagin_publish', 'plagin_image', 'plagin_path', 'plagin_name', 'description_RU'], 'required'],
            [['plagin_publish'], 'integer'],
            [['plagin_name', 'description_RU', 'alt'], 'string'],
            [['plagin_image','plagin_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plagin_publish' => 'Опубликовано',
            'plagin_image' => 'Изображение',
            'plagin_path' => 'Путь к файлу',
            'plagin_name' => 'Имя',
            'description_RU' => 'Описание',
            'alt' => 'alt_описание',
        ];
    }
}
