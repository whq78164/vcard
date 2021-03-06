<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%cloud}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $siteurl
 * @property string $company
 * @property string $tel
 * @property integer $qq
 * @property string $email
 * @property string $address
 * @property string $copyright
 * @property string $icp
 * @property string $ip
 * @property integer $pageid1
 * @property integer $pageid2
 * @property integer $status
 */
class Cloud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cloud}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['title', 'siteurl', 'company', 'tel', 'qq', 'email', 'address', 'copyright', 'icp', 'ip', 'pageid1', 'pageid2'], 'required'],
            [['qq', 'pageid1', 'pageid2', 'status'], 'integer'],
            [['sitetitle', 'siteurl', 'address', 'welcome'], 'string', 'max' => 255],
            [['company', 'email'], 'string', 'max' => 50],
            [['tel', 'copyright', 'icp'], 'string', 'max' => 20],
            [['ip'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tbhome', 'ID'),
            'sitetitle' => Yii::t('tbhome', 'Sitetitle'),
            'siteurl' => Yii::t('tbhome', 'Siteurl'),
            'company' => Yii::t('tbhome', 'Company'),
            'tel' => Yii::t('tbhome', 'Tel'),
            'qq' => Yii::t('tbhome', 'Qq'),
            'email' => Yii::t('tbhome', 'Email'),
            'address' => Yii::t('tbhome', 'Address'),
            'copyright' => Yii::t('tbhome', 'Copyright'),
            'icp' => Yii::t('tbhome', 'Icp'),
            'ip' => Yii::t('tbhome', 'Ip'),
            'welcome'=>'欢迎语',
            'pageid1' => Yii::t('tbhome', 'Pageid1'),
            'pageid2' => Yii::t('tbhome', 'Pageid2'),
            'status' => Yii::t('tbhome', 'Status'),
        ];
    }
}
