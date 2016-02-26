<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property integer $uid
 * @property string $bg_image
 * @property integer $tpl
 * @property integer $vip
 * @property integer $upline
 * @property integer $status
 * @property integer $leader
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         //   [['bg_image', 'tpl', 'upline', 'leader'], 'required'],
            [['tpl', 'vip', 'upline', 'status', 'leader'], 'integer'],
            [['bg_image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('tbhome', 'Uid'),
            'bg_image' => Yii::t('tbhome', '背景图片'),
            'tpl' => Yii::t('tbhome', '名片模板'),
            'vip' => Yii::t('tbhome', 'Vip'),
            'upline' => Yii::t('tbhome', 'Upline'),
            'status' => Yii::t('tbhome', 'Status'),
            'leader' => Yii::t('tbhome', 'Leader'),
        ];
    }
}
