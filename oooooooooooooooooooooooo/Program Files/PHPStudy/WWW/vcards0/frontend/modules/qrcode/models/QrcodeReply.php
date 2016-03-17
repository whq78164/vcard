<?php

namespace frontend\modules\qrcode\models;

use Yii;

/**
 * This is the model class for table "{{%qrcode_reply}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $tag
 * @property string $success
 * @property string $fail
 * @property integer $valid_clicks
 */
class QrcodeReply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%qrcode_reply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid','success', 'fail', 'valid_clicks'], 'required'],
            [['uid', 'valid_clicks'], 'integer'],
            [['tag'], 'string'],
            [['fail'], 'string', 'max' => 255],
            [['success', 'content'], 'string'],
      //      [['uid'], 'unique']
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
            'tag' => Yii::t('tbhome', 'Tag'),
            'success' => Yii::t('tbhome', 'Success'),
            'fail' => Yii::t('tbhome', 'Fail'),
            'content' => Yii::t('tbhome', '自定义网页'),
            //'valid_clicks' => Yii::t('tbhome', 'Valid Clicks'),
            'valid_clicks' => Yii::t('tbhome', '有效次数'),
        ];
    }
}
