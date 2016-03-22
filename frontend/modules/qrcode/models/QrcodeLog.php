<?php

namespace frontend\modules\qrcode\models;

use Yii;

/**
 * This is the model class for table "{{%anti_log}}".
 ******************99999999999999999
 * @property integer $id
 * @property integer $startid
 * @property integer $endid
 * @property string $url
 * @property integer $time
 * @property string $remark
 */
class QrcodeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
   //    return 'tbhome_anti_log_'.Yii::$app->user->id;
        return 'tbhome_qrcode_log_'.Yii::$app->user->id;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['startid', 'endid', 'url', 'time', 'remark'], 'required'],
            [['startid', 'endid', 'time'], 'integer'],
            [['url', 'remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tbhome', 'ID'),
            'startid' => Yii::t('tbhome', '开始序号'),
            'endid' => Yii::t('tbhome', '结束序号'),
            'url' => Yii::t('tbhome', 'Url'),
            'time' => Yii::t('tbhome', '生产时间'),
            'remark' => Yii::t('tbhome', 'Remark'),
        ];
    }
}
