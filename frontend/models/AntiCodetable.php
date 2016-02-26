<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%anti_code}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $code
 * @property integer $replyid
 * @property integer $productid
 * @property integer $query_time
 * @property integer $create_time
 * @property integer $status
 * @property integer $uid
 * @property integer $clicks
 * @property string $prize
 */
class AntiCodetable extends \yii\db\ActiveRecord
{
 /*   private static $tableName ;

    public function __construct($table_name = '') {
        if($table_name === null) {
            parent::__construct(null);
        } else {
            self::$tableName = $table_name ;
            parent::__construct();
        }
    }

    public static function model($table_name='')
    {
        self::$tableName = $table_name ;
        return parent::model(__CLASS__);
    }

    public static function tableName()
    {
        return self::$tableName;
    }
*/

    public static function tableName($table)
    {
        return $table;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
  //          [['uid', 'code', 'replyid', 'productid', 'query_time', 'clicks', 'prize'
    //        ], 'required'],
            [['uid', 'replyid', 'create_time', 'productid', 'query_time', 'clicks'], 'integer'],
            [['code', 'prize'], 'string', 'max' => 255],
            [['code'], 'unique']
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
            'code' => Yii::t('tbhome', 'Code'),
            'replyid' => Yii::t('tbhome', '查询回复语'),
            'productid' => Yii::t('tbhome', '防伪产品'),
            'query_time' => Yii::t('tbhome', 'Query Time'),
            'clicks' => Yii::t('tbhome', 'Clicks'),
            'prize' => Yii::t('tbhome', 'Prize'),
            'create_time' => Yii::t('tbhome', 'create time'),
            'status' => Yii::t('tbhome', 'status'),
        ];
    }
}
