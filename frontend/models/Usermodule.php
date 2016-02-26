<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%usermodule}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $moduleid
 * @property integer $module_status
 */
class Usermodule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usermodule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'moduleid'], 'required'],
            [['uid', 'moduleid', 'module_status'], 'integer']
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
            'moduleid' => Yii::t('tbhome', 'Moduleid'),
            'module_status' => Yii::t('tbhome', 'Module status'),
        ];
    }
}
