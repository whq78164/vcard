<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wechatgh}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $appid
 * @property string $appsecret
 * @property string $mchid
 * @property string $mchsecret
 * @property string $name
 * @property string $email
 * @property string $token
 * @property string $aeskey
 * @property string $update_at
 *
 */
class Wechatgh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wechatgh}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         //   [['id'], 'required'],
            [['id', 'uid','update_at'], 'integer'],
            [['appid'], 'unique'],
            [['mchid'], 'unique'],
            [['appid', 'appsecret', 'name', 'email', 'mchid', 'mchsecret', 'token', 'aeskey',], 'string', 'max' => 255]
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
            'appid' => Yii::t('tbhome', 'Appid'),
            'appsecret' => Yii::t('tbhome', 'Appsecret'),
            'mchid' => Yii::t('tbhome', 'Mchid'),
            'mchsecret' => Yii::t('tbhome', 'Mchsecret'),
            'name'=>Yii::t('tbhome', 'Wechatgh'),
            'email'=>Yii::t('tbhome', 'Email'),
            'token'=>Yii::t('tbhome', 'Token'),
            'aeskey'=>Yii::t('tbhome', 'AESkey'),
        ];
    }
}
