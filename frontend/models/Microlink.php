<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%microlink}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $link_title
 * @property string $link_url
 */
class Microlink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%microlink}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'link_title', 'uid', 'link_url'], 'required'],
           [['uid'], 'integer'],
            [['link_title'], 'string', 'max' => 20],
            [['link_url'], 'string', 'max' => 255],
        //    [['uid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
       //     'id' => Yii::t('tbhome', 'ID'),
       //     'uid' => Yii::t('tbhome', 'Uid'),
            'link_title' => Yii::t('tbhome', 'Link Title'),
            'link_url' => Yii::t('tbhome', 'Link Url'),
        ];
    }
}
