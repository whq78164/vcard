<?php

namespace frontend\modules\column\models;

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
           [['type', 'column', 'label'], 'required'],
            [['uid'], 'integer'],
            ['uid', 'default', 'value' => Yii::$app->user->id],
            [['type'], 'string', 'max' => 20],
            [['column'], 'string', 'max' => 21],
            [['label'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 255],
            [['column'], 'unique'],
            [['column'],'match','pattern'=>'/^[a-z][a-z0-9_]{4,20}$/','message'=>'只能包含小写英文字母，数字，下划线，并且小写字母开头，5-20位字符'],
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
            'type' => Yii::t('tbhome', '字段类型'),
            'column' => Yii::t('tbhome', 'Column'),
            'value' => Yii::t('tbhome', '特殊值'),
            'label' => Yii::t('tbhome', '字段标签'),
            'remark' => Yii::t('tbhome', 'Remark'),
        ];
    }
}
