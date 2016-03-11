<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%module}}".
 *
 * @property integer $id
 * @property string $modulename
 * @property string $module_label
 * @property string $module_des
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modulename', 'module_label', 'module_des'], 'required'],
            [['modulename'], 'unique'],
            [['modulename'],'match','pattern'=>'/^[a-z][a-z0-9_]{4,20}$/','message'=>'只能包含小写英文字母，数字，下划线，并且小写字母开头，5-20位字符'],
            [['module_des', 'mark', 'markclass', 'icon'], 'string'],
          ['icon','default', 'value'=>'fa fa-external-link'],
           ['mark','default', 'value'=>'New'],
            ['markclass','default', 'value'=>'label pull-right bg-red'],
            [['modulename', 'module_label'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tbhome', 'ID'),
            'modulename' => Yii::t('tbhome', 'Modulename'),
            'module_label' => Yii::t('tbhome', 'Module Label'),
            'module_des' => Yii::t('tbhome', 'Module Des'),
            'icon' => '图标样式',
            'mark' => '标记',
            'markclass' => '标记样式',
        ];
    }
}
