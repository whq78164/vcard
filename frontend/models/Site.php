<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%sys}}".
 *
 * @property integer $id
 * @property string $admin_user
 * @property string $user_password
 * @property string $sitetitle
 * @property string $company
 * @property string $tel
 * @property integer $qq
 * @property string $email
 * @property string $address
 * @property string $logo
 * @property string $keywords
 * @property string $siteurl
 * @property string $copyright
 * @property string $icp
 * @property string $ip
 * @property integer $status
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys}}';
    }

    /**
     * @inheritdocREMOTE_HOST
     */
    public function rules()
    {
        return [
            [['sitetitle', 'tel', 'qq', 'email', 'siteurl', //'address', 'company', 'logo', 'keywords',  'copyright', 'icp'
            ], 'required'],
            [['qq', 'status'], 'integer'],
            [['keywords'], 'string'],
            [['admin_user', 'ip'], 'string', 'max' => 25],
            [['user_password', 'sitetitle', 'address', 'logo', 'siteurl'], 'string', 'max' => 255],
            [['company', 'email'], 'string', 'max' => 50],
            [['tel', 'copyright', 'icp'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tbhome', 'ID'),
            'admin_user' => Yii::t('tbhome', 'Admin User'),
            'user_password' => Yii::t('tbhome', 'Password'),
            'sitetitle' => Yii::t('tbhome', '网站标题'),
            'company' => Yii::t('tbhome', '公司名'),
            'tel' => Yii::t('tbhome', '电话或手机'),
            'qq' => Yii::t('tbhome', 'QQ'),
            'email' => Yii::t('tbhome', 'Email'),
            'address' => Yii::t('tbhome', '地址'),
            'logo' => Yii::t('tbhome', 'Logo'),
            'keywords' => Yii::t('tbhome', 'Keywords'),
            'siteurl' => Yii::t('tbhome', 'Siteurl'),
            'copyright' => Yii::t('tbhome', 'Copyright'),
            'icp' => Yii::t('tbhome', 'Icp'),
            'ip' => Yii::t('tbhome', 'IP'),
            'status' => Yii::t('tbhome', 'Status'),
        ];
    }
}
