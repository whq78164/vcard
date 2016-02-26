<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%traceability_info}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $code
 * @property integer $label
 * @property string $describe
 * @property string $remark
 * @property integer $create_time
 * @property integer $status
 */
class TraceabilityInfonew extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbhome_traceability_info_'.Yii::$app->user->id;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
     //       [['uid', 'code', 'label', 'describe', 'remark', 'create_time'], 'required'],
            [['uid', 'create_time', 'status'], 'integer'],
            [['describe', 'label'], 'string'],
            [['code', 'remark'], 'string', 'max' => 255],
            [['code'], 'unique']
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
            'code' => Yii::t('tbhome', 'Code'),
            'label' => Yii::t('tbhome', 'Label'),
            'describe' => Yii::t('tbhome', 'Describe'),
            'remark' => '追溯信息备注',//Yii::t('tbhome', 'Remark'),
            'create_time' => Yii::t('tbhome', 'Create Time'),
            'status' => Yii::t('tbhome', 'Status'),
        ];
    }
}
