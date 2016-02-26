<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%label}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $card_label
 * @property string $card_value
 */
class Label extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%label}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'card_label', 'card_value'], 'required'],
            [['uid'], 'integer'],
            [['card_label'], 'string', 'max' => 20],
            [['card_value'], 'string', 'max' => 255]
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
            'card_label' => Yii::t('tbhome', 'Card Label'),
            'card_value' => Yii::t('tbhome', 'Card Value'),
        ];
    }
}
