<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%column}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $type
 * @property string $column
 * @property string $label
 * @property string $remark
 */
class Column extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%column}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['uid', 'type', 'column', 'label', 'remark'], 'required'],
            [['uid'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['column'], 'string', 'max' => 30],
            [['label'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 255],
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
            'type' => Yii::t('tbhome', 'Type'),
            'column' => Yii::t('tbhome', 'Column'),
            'label' => Yii::t('tbhome', 'Label'),
            'remark' => Yii::t('tbhome', 'Remark'),
        ];
    }
}
