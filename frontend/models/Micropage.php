<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%micropage}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $page_title
 * @property string $page_content
 */
class Micropage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%micropage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'page_title', 'page_content'], 'required'],
            [['uid', 'status'], 'integer'],
            [['page_content'], 'string'],
            [['page_title'], 'string', 'max' => 100]
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
            'page_title' => Yii::t('tbhome', 'Page Title'),
            'page_content' => Yii::t('tbhome', 'Page Content'),
        ];
    }
}
