<?php

namespace app\models;

use app\translations\CustomerQualityTranslation;
use app\translations\CustomerTypeTranslation;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $name
 */
class Customer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
        ];
    }

    public static function getQualityTextByQuality(?string $quality): ?string
    {
        return CustomerQualityTranslation::getText($quality) ?? $quality;
    }

    public static function getTypeTextByType(?string $type): string
    {
        return CustomerTypeTranslation::getText($type) ?? $type;
    }
}
