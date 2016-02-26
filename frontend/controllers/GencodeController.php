<?php

namespace frontend\controllers;

class GencodeController extends \yii\web\Controller
{

    public function beforeAction(){
        $Connection = \Yii::$app->db;
        //      global $_W;
        $this->data = '`tbhome_anti_code_'.\Yii::$app->user->id.'`';
        $this->moban = '`tbhome_anti_code`';
        //       $this->i_logs = 'super_securitycode_logs';
        $sql = "CREATE TABLE IF NOT EXISTS ".$this->data." LIKE ".$this->moban;
        $command=$Connection->createCommand($sql);
        $command->execute();
        //   pdo_query($sql);
    }

    public function doMobileTest(){
        header("Location:http://mp.weixin.qq.com/s?__biz=MzA4MTUzODQwMA==&mid=204532048&idx=1&sn=9a6b58d8cf398954f1b44a63803605c7#rd");
    }


    /**
     * 生成随机数
     *
     * @param int $length 生成字符串长度
     * @param int $type 字符串类型
     * @param bool $special 是否使用特殊字符
     * @return string 返回生成的随机字符串
     * @example random(10, null, true);
     */
    public function random($length, $type = NULL, $special = FALSE){
        $str = "";
        switch ($type) {
            case 1:
                $str = "0123456789";
                break;
            case 2:
                $str = "abcdefghijklmnopqrstuvwxyz";
                break;
            case 3:
                $str = "abcdefghijklmnopqrstuvwxyz0123456789";
                break;
            default:
                $str = "abcdefghijklmnopqrstuvwxyz0123456789";
                break;
        }
        return substr(str_shuffle(($special != FALSE) ? '!@#$%^&*()_+' . $str : $str), 0, $length);
    }

    public function doWebCreate() {

   //     if (checksubmit('submit')) {
        $rule = $_POST['rule'];
        $presql=
            $list = pdo_fetchall("SELECT *  from ".tablename($this->data)." where code like '{$_GPC['sStr']}%'");
            if (!empty($list)) {
                message('防伪码前缀已存在，请修改');
            }


        $rule = $_POST['rule'];
            $i=1;
            while($i<=intval($_POST['sNum'])){
                $code = $this->random(intval($_POST['slen']),$rule,false);
                $data =array(
                    'code' => $_POST['sStr'].$code,
                    'type' => $_POST['sName'],
                    'factory' => $_POST['sFactory'],
                    'stime' => strtotime($_POST['sTime_1']),
                    'createtime' => time(),
                    'creditname' => $_POST['creditname'],
                    'creditnum' => intval($_POST['creditnum']),
                    'creditstatus' => intval($_POST['creditstatus']),
                    'num' => 0,
                    'status'=>1,
                    'tourl'  =>  $_POST['tourl'],
                );
                pdo_insert($this->data, $data);
                $i++;
            }
            message('成功生成'.intval($_POST['sNum']).'条防伪码！', referer(), 'success');
        }


    }


    //冻结 status至设为0
    public function doWebFrozen(){
        global $_GPC, $_W;
        pdo_update($this->data, array('status' => 0), array('id' => $_GPC['id']));
        message('成功冻结该防伪码！', referer(), 'success');
    }
    //删除防伪码 彻底删除数据
    public function doWebDelete(){
        global $_GPC, $_W;
        if(!empty($_GPC['id'])){
            $set = pdo_delete($this->data, array('id' => $_GPC['id']));
            message('成功删除此条防伪码！', referer(), 'success');
        }
    }

    public function doWebCheckepre(){
        global $_GPC, $_W;
        $sStr = $_GPC['sStr'];
        $list = pdo_fetchall("SELECT *  from ".tablename($this->data)." where code like '{$sStr}%'");
        if (!empty($list)) {
            echo count($list);
        }else{
            echo '0';
        }
    }

    public function doWebCheckesecurity(){
        global $_GPC, $_W;
        $security = $_GPC['security'];
        $list = pdo_fetchall("SELECT *  from ".tablename($this->data)." where code = '{$security}'");
        if (!empty($list)) {
            echo '1';
        }else{
            echo '0';
        }
    }

    public function doWebLogs(){
        $t = mktime(0, 0, 0, date("m",time()), date("d",time()), date("y",time()));
        $t1 = $t - 7 * 86400;
        $t2 = $t - 6 * 86400;
        $t3 = $t - 5 * 86400;
        $t4 = $t - 4 * 86400;
        $t5 = $t - 3 * 86400;
        $t6 = $t - 2 * 86400;
        $t7 = $t - 1 * 86400;
        $t8 = $t + 1 * 86400;
        $labels = '"'.date('Y-m-d',$t1).'","'.date('Y-m-d',$t2).'","'.date('Y-m-d',$t3).'","'.date('Y-m-d',$t4).'","'.date('Y-m-d',$t5).'","'.date('Y-m-d',$t6).'","'.date('Y-m-d',$t7).'","'.date('Y-m-d',$t).'"';
        $d1_1 = $this->igetlog($t1,$t2,'2');
        $d1_2 = $this->igetlog($t1,$t2,'1');
        $d2_1 = $this->igetlog($t2,$t3,'2');
        $d2_2 = $this->igetlog($t2,$t3,'1');
        $d3_1 = $this->igetlog($t3,$t4,'2');
        $d3_2 = $this->igetlog($t3,$t4,'1');
        $d4_1 = $this->igetlog($t4,$t5,'2');
        $d4_2 = $this->igetlog($t4,$t5,'1');
        $d5_1 = $this->igetlog($t5,$t6,'2');
        $d5_2 = $this->igetlog($t5,$t6,'1');
        $d6_1 = $this->igetlog($t6,$t7,'2');
        $d6_2 = $this->igetlog($t6,$t7,'1');
        $d7_1 = $this->igetlog($t7,$t,'2');
        $d7_2 = $this->igetlog($t7,$t,'1');
        $d8_1 = $this->igetlog($t,$t8,'2');
        $d8_2 = $this->igetlog($t,$t8,'1');
        $data_1 = $d1_1.','.$d2_1.','.$d3_1.','.$d4_1.','.$d5_1.','.$d6_1.','.$d7_1.','.$d8_1;
        $data_2 = $d1_2.','.$d2_2.','.$d3_2.','.$d4_2.','.$d5_2.','.$d6_2.','.$d7_2.','.$d8_2;
        $data_1_all = $this->igetlog('0',time(),'2');
        $data_2_all = $this->igetlog('0',time(),'1');
        $data_3_all = $this->igetlog('0',time(),'0');
        include $this->template('logs');
    }

    protected function igetlog($t1,$t2,$status){
        global $_GPC, $_W;
        if ($status == '2') {
            $data = pdo_fetchcolumn("SELECT COUNT(*)  from ".tablename($this->i_logs)." where weid ='{$_W['uniacid']}' and createtime >= '{$t1}' and createtime <= '{$t2}'");
        }else{
            $data = pdo_fetchcolumn("SELECT COUNT(*)  from ".tablename($this->i_logs)." where weid ='{$_W['uniacid']}' and createtime >= '{$t1}' and createtime <= '{$t2}' and status = '{$status}'");
        }
        return $data;
    }





}
