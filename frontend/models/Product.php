<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $share
 * @property string $image
 * @property string $factory
 * @property string $name
 * @property string $describe
 * @property string $specification
 * @property string $unit
 * @property string $brand
 * @property string $price
 * @property integer $hot
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
       //     [['uid', 'image', 'factory', 'name', 'describe', 'specification', 'unit', 'brand', 'price', 'hot'], 'required'],
            [['uid', 'share', 'hot'], 'integer'],
            [['image', 'specification'], 'string', 'max' => 255],
            [['factory'], 'string', 'max' => 30],
            [['name', 'unit'], 'string', 'max' => 30],
            [['price'], 'number'],
            [['describe'], 'string'],
            [['brand'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tbhome', 'ID'),
            'uid' => Yii::t('tbhome', 'Uid'),
            'share' => Yii::t('tbhome', 'Share'),
            'image' => Yii::t('tbhome', 'Image'),
            'factory' => Yii::t('tbhome', 'Factory'),
            'name' => Yii::t('tbhome', '产品名称'),
            'describe' => Yii::t('tbhome', 'Describe'),
            'specification' => Yii::t('tbhome', 'Specification'),
            'unit' => Yii::t('tbhome', '计量单位'),
            'brand' => Yii::t('tbhome', 'Brand'),
            'price' => Yii::t('tbhome', 'Price'),
            'hot' => Yii::t('tbhome', 'Hot'),
        ];
    }
}
