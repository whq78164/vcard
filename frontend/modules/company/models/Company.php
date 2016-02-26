<?php

namespace frontend\modules\company\models;

use Yii;

/**
 * This is the model class for table "{{%company}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $company
 * @property string $address
 * @property string $location
 * @property string $tpl
 * @property string $image
 *  @property string $url
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid'], 'integer'],
            [['company', 'image', 'url', 'address', 'location', 'tpl'], 'string', 'max' => 255]
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
            'company' => Yii::t('tbhome', 'Company'),
            'address' => Yii::t('tbhome', 'Address'),
            'location' => Yii::t('tbhome', 'Location'),
            'tpl' => Yii::t('tbhome', 'Tpl'),
            'image' => Yii::t('tbhome', 'Image'),
            'url' => Yii::t('tbhome', 'Url'),

        ];
    }
}
