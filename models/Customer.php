<?php

namespace app\models;

use app\enums\CustomerQualityEnum;
use app\enums\CustomerTypeEnum;
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
    const QUALITY_ACTIVE = 'active';
    const QUALITY_REJECTED = 'rejected';
    const QUALITY_COMMUNITY = 'community';
    const QUALITY_UNASSIGNED = 'unassigned';
    const QUALITY_TRICKLE = 'trickle';

    const TYPE_LEAD = 'lead';
    const TYPE_DEAL = 'deal';
    const TYPE_LOAN = 'loan';

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

    /**
     * @param $quality
     * @return mixed|null
     */
    public static function getQualityTextByQuality($quality)
    {
        return CustomerQualityEnum::getQualityTexts()[$quality] ?? $quality;
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function getTypeTextByType($type)
    {
        return CustomerTypeEnum::getTypeTexts()[$type] ?? $type;
    }
}
