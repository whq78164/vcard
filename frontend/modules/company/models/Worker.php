<?php

namespace frontend\modules\company\models;

use Yii;

/**
 * This is the model class for table "{{%company_worker}}".
 *
 * @property string $id
 * @property string $job_id
 * @property string $uid
 * @property integer $company_id
 * @property integer $department_id
 * @property string $name
 * @property string $mobile
 * @property integer $qq
 * @property string $email
 * @property string $head_img
 * @property string $position
 * @property string $task
 * @property string $work_tel
 * @property string $wechat_account
 * @property string $wechat_qrcode
 * @property string $fax
 * @property integer $is_work
 * @property string $remark
 */
class Worker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_worker}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'uid', 'company_id', 'department_id',  'is_work'], 'integer'],
            [['job_id', 'work_tel'], 'string', 'max' => 30],
            [['name', 'mobile', 'qq','email', 'head_img', 'task', 'wechat_qrcode', 'fax', 'remark'], 'string', 'max' => 255],
            [['job_id'], 'unique'],
            [['position', 'wechat_account'], 'string', 'max' => 50]
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
            'job_id' => Yii::t('tbhome', 'Job ID'),
            'company_id' => Yii::t('tbhome', 'Company ID'),
            'department_id' => Yii::t('tbhome', 'Department ID'),
            'name' => Yii::t('tbhome', 'Name'),
            'mobile' => Yii::t('tbhome', 'Mobile'),
            'qq' => Yii::t('tbhome', 'Qq'),
            'email' => Yii::t('tbhome', 'Email'),
            'head_img' => Yii::t('tbhome', 'Head Img'),
            'position' => Yii::t('tbhome', 'Position'),
            'task' => Yii::t('tbhome', 'Task'),
            'work_tel' => Yii::t('tbhome', 'Work Tel'),
            'wechat_account' => Yii::t('tbhome', 'Wechat Account'),
            'wechat_qrcode' => Yii::t('tbhome', 'Wechat Qrcode'),
            'fax' => Yii::t('tbhome', 'Fax'),
            'is_work' => Yii::t('tbhome', 'Is Work'),
            'remark' => Yii::t('tbhome', 'Remark'),
        ];
    }


}
