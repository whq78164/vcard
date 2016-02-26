<?php
error_reporting(0);
session_start();
header('Content-type: text/html; charset=utf-8');
require("data/head.php");
require "mobile_detect.php";

$detect = new Mobile_Detect();

$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';
 if($act == "default"){
	 $result_str = unstrreplace($cf['notices']);
/*	
 if($_REQUEST['themes']!="")	 {
	   $_SESSION['new_themes'] = $_REQUEST['themes'];	 
           $_SESSION['new_themes'] = 'default-03';
	 }else if($_SESSION['new_themes'] == ""){
//	   $_SESSION['new_themes'] = $cf['site_themes'];
$_SESSION['new_themes'] = 'default-03';
	 }
*/
//	 require("themes/".$_SESSION['new_themes']."/index.php");

if ($detect->isMobile()) {
require("themes/mobile/index.php");
}else {
require("themes/default/index.php");
}
	 
echo "<!--Power by 958989.com-->";
 

}







 if($act == "query"){ 
	$bianhao = trim($_GET["bianhao"]);	
	$search  = $_GET['search'];
	$yzm     = trim($_GET['yzm']);
	$result  = 0;
	$msg0    = 1;	
	if($bianhao != ""){
		if($cf['yzm_status'] == 1 && $yzm == "")
		{
		 $msg1 = "请输入验证码";
		 $msg0 = 0;		
		}
		if($cf['yzm_status'] == 1 && $yzm != $_SESSION['authnum_session'])
		{
		 $msg1 = "验证码输入错误";
		 $msg0 = 0;
		}      
	  if($msg0 == 1){
	   $sql="select * from tgs_code where bianhao='$bianhao' limit 1";
	   $res=mysql_query($sql);
	   if(mysql_num_rows($res)>0){
		   $arr = mysql_fetch_array($res);
		   $bianhao  =  $arr["bianhao"];
		   $riqi     =  $arr["riqi"];
		   $product  =  $arr["product"];
		   $zd1      =  $arr["zd1"];
		   $zd2      =  $arr["zd2"];
		   $query_time  = $arr["query_time"];
		   $hits        = $arr['hits'];		   
		   $results     = 1;
		   $msg1        = str_replace("{{product}}",$product,unstrreplace($cf['notice_1']));
		   if($_SESSION['s_query_time']==""){
			 $_SESSION['s_query_time'] = $query_time;
		   }		   
		   if($hits>0){			
			   $results = 2;
			   $msg1        = str_replace("{{product}}",$product,unstrreplace($cf['notice_2']));
		   }

		    $msg1        = str_replace("{{riqi}}",$riqi,$msg1);
			$msg1        = str_replace("{{zd1}}",$zd1,$msg1);
			$msg1        = str_replace("{{zd2}}",$zd2,$msg1);
			$msg1        = str_replace("{{hits}}",$hits+1,$msg1);
			$msg1        = str_replace("{{query_time}}",$_SESSION['s_query_time'],$msg1);	   
		  mysql_query("update tgs_code set hits=hits+1,query_time='".$GLOBALS['tgs']['cur_time']."' where bianhao='".$bianhao."' limit 1");		  
		  $msg0 = 1;
	   }
	   else
	   {
		 $results = 3;		 
		 $msg1   = str_replace("{{bianhao}}",$bianhao,unstrreplace($cf['notice_3']));
	   }
		$sql = "insert into tgs_history set keyword='".$bianhao."',results='".$results."',addtime='".$GLOBALS['tgs']['cur_time']."',addip='".$GLOBALS['tgs']['cur_ip']."'";
		mysql_query($sql);
	 }	
	}else{
	    $msg1 = "请输入防伪码";
	}
  echo $msg0."|".$msg1;
 }
?>
