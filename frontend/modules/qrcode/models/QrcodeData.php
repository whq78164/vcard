<?php

namespace frontend\modules\qrcode\models;
use Yii;
//use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
use yii\db\Schema;
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
 * @property integer $clicks
 * @property string $prize
 * @property string $remark
 */
class QrcodeData extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
   // public $listDiyColumns=array();

    protected function columnExist($table, $column){
        $sql="Describe $table $column";
        $con=Yii::$app->db->createCommand($sql)->queryOne();
        if($con['Field']==$column){
            return true;
        }else{
            return false;
        }
    }

    protected function addColumn($table, $column, $type)
    {
        $columnExist=$this->columnExist($table, $column);
        if(!$columnExist){
            Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
        }
    }


    public function dataColumns($type='attribute'){
        $uid=Yii::$app->user->id;
        $sql="SELECT * FROM {{%column}} WHERE uid=$uid AND type='qrcode'";
        $qrcodeColumns=Yii::$app->db->createCommand($sql)->queryAll();

if (!empty($qrcodeColumns)){

    $qrcodeColumn=array();
    $listDiyColumns=array();
    foreach($qrcodeColumns as $key => $value){//$qrcodeColumns as $qrcodeColumn
        $tempColumn=[$value['column']=>$value['label']];
        $qrcodeColumn=array_merge($qrcodeColumn,$tempColumn);//$myarr[]=$addarry,不可使用，否则索引为数字！
        $listDiyColumns[]=$value['column'];
    }
    $labelExts=$qrcodeColumn;
    //$this->listDiyColumns=$listDiyColumns;


    foreach($labelExts as $key => $value){
      $this->addColumn(self::tableName(), strval($key), Schema::TYPE_STRING.' NOT NULL');
    }



}else{
    $labelExts=array();
    $listDiyColumns=array();
}

        switch($type){
            case 'attribute':
                return $labelExts;
            break;
            case 'rules':
                return $listDiyColumns;
            break;
            default :
                return $labelExts;
        }

    }

    public static function tableName()
    {
        return 'tbhome_qrcode_data_'.Yii::$app->user->id;

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $stringRule=$this->dataColumns('rules');
      //  $stringRule[]=['prize', 'remark'];
        return [
    //        [['uid', 'code', 'replyid', 'productid', 'query_time', 'clicks', 'prize'], 'required'],
            [['code'], 'required'],
            [['id', 'uid', 'replyid',  'productid', 'create_time', 'query_time', 'clicks'], 'integer'],
            [['code', 'url', 'prize', 'remark'], 'string', 'max' => 255],
          //  array('email, username', 'length', 'max'=>64),
            [$stringRule, 'string'],
            [['code'], 'unique'],
            ['uid', 'default', 'value' => Yii::$app->user->id],
           ['remark', 'default', 'value' => ''],
           ['prize', 'default', 'value' => ''],
           ['status', 'default', 'value' => self::STATUS_ACTIVE],

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
        $labelBase=[
            'id' => Yii::t('tbhome', 'ID'),
            'uid' => Yii::t('tbhome', 'Uid'),
            'code' => Yii::t('tbhome', '唯一码'),
            'replyid' => Yii::t('tbhome', 'Replyid'),
            'productid' => Yii::t('tbhome', 'Productid'),
            'query_time' => Yii::t('tbhome', 'Query Time'),
            'clicks' => Yii::t('tbhome', 'Clicks'),
            'prize' => Yii::t('tbhome', '奖品'),
            'remark' => Yii::t('tbhome', '备注'),
            'create_time' => Yii::t('tbhome', 'create time'),
            'status' => Yii::t('tbhome', 'status'),
        ];


        $labelExts=$this->dataColumns('attribute');

        $newLabels=array_merge($labelBase,$labelExts);

        return $newLabels;

    }







    /*
* Usage:
* $result = Log::model()->setDate("20140603")->findAll();



    private $_date;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "tbl_log_". $this->getDate();
    }

    public function setDate($date){
        $this->_date = $date;
        $this->refreshMetaData();
        return $this;
    }

    public function getDate(){
        if($this->_date === NULL){
            $this->setDate("20140601");
        }
        return $this->_date;
    }

*/













}
