<?php

namespace frontend\modules\schoolmate\models;

use Yii;

/**
 * This is the model class for table "{{%schoolmate}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $sex
 * @property string $grade
 * @property string $major
 * @property string $studentid
 * @property string $idcardnum
 * @property string $address
 * @property string $city
 * @property string $job
 * @property string $jobtitle
 * @property string $honour
 * @property string $worktel
 * @property string $hometel
 * @property string $mobile
 * @property string $email
 * @property string $qq
 * @property string $comment
 */
class Schoolmate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%schoolmate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['honour', 'comment'], 'string'],
            [['name', 'city'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 5],
            [['grade', 'worktel', 'hometel', 'mobile', 'qq'], 'string', 'max' => 20],
            [['major', 'email'], 'string', 'max' => 50],
            [['studentid', 'idcardnum'], 'string', 'max' => 30],
            [['address', 'job', 'jobtitle'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tbhome', 'ID'),
            'name' => Yii::t('tbhome', 'Name'),
            'sex' => Yii::t('tbhome', 'Sex'),
            'grade' => Yii::t('tbhome', 'Grade'),
            'major' => Yii::t('tbhome', 'Major'),
            'studentid' => Yii::t('tbhome', 'Studentid'),
            'idcardnum' => Yii::t('tbhome', 'Idcardnum'),
            'address' => Yii::t('tbhome', 'Address'),
            'city' => Yii::t('tbhome', 'City'),
            'job' => Yii::t('tbhome', 'Job'),
            'jobtitle' => Yii::t('tbhome', 'Jobtitle'),
            'honour' => Yii::t('tbhome', 'Honour'),
            'worktel' => Yii::t('tbhome', 'Worktel'),
            'hometel' => Yii::t('tbhome', 'Hometel'),
            'mobile' => Yii::t('tbhome', 'Mobile'),
            'email' => Yii::t('tbhome', 'Email'),
            'qq' => Yii::t('tbhome', 'Qq'),
            'comment' => Yii::t('tbhome', 'Comment'),
        ];
    }

    /**
     * @inheritdoc
     * @return SchoolmateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SchoolmateQuery(get_called_class());
    }
}
