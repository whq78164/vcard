<?php

namespace frontend\modules\company\models;

use Yii;

/**
 * This is the model class for table "{{%company_department}}".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $department
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_department}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['department'], 'string', 'max' => 255]
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
            'department' => Yii::t('tbhome', 'Department'),
        ];
    }
}
