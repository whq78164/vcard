<?php

namespace frontend\models;

use Yii;
//use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%anti_code}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $code
 * @property integer $replyid
 * @property integer $productid
  * @property integer $traceabilityid
 * @property integer $query_time
 * @property integer $create_time
 * @property integer $status
 * @property integer $clicks
 * @property string $remark
 * @property string $prize
 */
class AntiCode extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%anti_code}}';
    }

/*
 public function behaviors()
  {
      return [
          [
              'class' => AttributeBehavior::className(),
              'attributes' => [
                  ActiveRecord::EVENT_BEFORE_INSERT => ['create_time'],
             //     ActiveRecord::EVENT_BEFORE_UPDATE => 'attribute2',
              ],
       //       'value' => function ($event) {
         //            return 'some value';
           //      },
          ],
      ];
  }
*/



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
  //          [['uid', 'code', 'replyid', 'productid', 'query_time', 'clicks', 'prize'
    //        ], 'required'],
            [['code'], 'required'],
              [['id', 'uid', 'replyid', 'traceabilityid', 'productid', 'create_time', 'query_time', 'clicks'], 'integer'],
            [['code', 'url'], 'string', 'max' => 255],
            [['prize', 'remark'], 'string'],
            [['code'], 'unique'],
            ['uid', 'default', 'value' => Yii::$app->user->id],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['remark', 'default', 'value' => ''],
            ['prize', 'default', 'value' => ''],
            ['traceabilityid', 'default', 'value' => 1],
            ['query_time', 'default', 'value' => 0],
            ['clicks', 'default', 'value' => 0],
            ['productid', 'default', 'value' => 1],


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
			'traceabilityid' => Yii::t('tbhome', '追溯'),
            'productid' => Yii::t('tbhome', '防伪产品'),
            'query_time' => Yii::t('tbhome', 'Query Time'),
            'clicks' => Yii::t('tbhome', 'Clicks'),
            'prize' => Yii::t('tbhome', '奖品'),
            'remark' => Yii::t('tbhome', '备注'),
            'create_time' => Yii::t('tbhome', 'create time'),
            'status' => Yii::t('tbhome', 'status'),
        ];
    }
}
