<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2015-10-01
 * Time: 16:55
 */
//use \phpqrcode\QRcode;
require(__DIR__ . '/../../vendor/autoload.php');
//require(__DIR__ . '/../../vendor/phpqrcode/qrlib.php');
//$qrlibpath=Yii::getAlias('@web/../assets/phpqrcode/qrlib.php');
//require($qrlibpath);
/*
$value='http://tbhome.com.cn';
$file=false;
$level='L';
$size=10;
$margin=3;
*/
/*
$vcards=$_GET['vcards'];
if($vcards){
    $filepath=time().'.vcf';
    $file = fopen($filepath, "x+");//w+
    fwrite($file, $vcards);
 //   header('Content-type:application/octet-stream');
  //  header('Accept-Ranges:bytes');
 //   header('Accept-Length:' . filesize($filepath));
  //  header('Content-Disposition:attachment;filename="' . $filename . '"');
    echo fread($file, filesize($filepath));
    fclose($file);
    header("location:$filepath");
}
*/
//index.php?r=site/qrcode
header ("Content-type: image/png");
$value=isset($_GET['value'])? $_GET['value']:'123456789';

//$file=$_GET['file'];
//$level=$_GET['level'];
//$size=$_GET['size'];
//$margin=$_GET['margin'];
//二维码内容
//header('Content-Type:text/html;charset=UTF-8');
//生成二维码图片
if(!isset($filename)){
    QRcode::png($value,false,'M',8,1);
}else{
//    $filename=$_GET['filename']?$_GET['filename']:'123456789.png';
    $filename=$_GET['filename'];
    QRcode::png($value,$filename,'M',6,1);
    echo '<img src="'.$filename.'">';
}
/*

public static function png($text, $outfile=false, $level=QR_ECLEVEL_L, $size=3, $margin=4, $saveandprint=false)
{
    $enc = QRencode::factory($level, $size, $margin);
    return $enc->encodePNG($text, $outfile, $saveandprint=false);
}


*/
/*
$logo = 'logo.png';//准备好的logo图片
$QR = 'qrcode.png';//已经生成的原始二维码图


if ($logo !== FALSE) {
    $QR = imagecreatefromstring(file_get_contents($QR));
    $logo = imagecreatefromstring(file_get_contents($logo));
    $QR_width = imagesx($QR);//二维码图片宽度
    $QR_height = imagesy($QR);//二维码图片高度
    $logo_width = imagesx($logo);//logo图片宽度
    $logo_height = imagesy($logo);//logo图片高度
    $logo_qr_width = $QR_width / 5;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;
    $from_width = ($QR_width - $logo_qr_width) / 2;
    //重新组合图片并调整大小
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
    $logo_qr_height, $logo_width, $logo_height);
}
//输出图片
imagepng($QR, 'helloweixin.png');
echo '<img src="helloweixin.png">';
*/

//include '../phpqrcode/phpqrcode.php';
//QRcode::png('http://m.tbhome.com.cn/index.php/Home/Member/fwcx/fwuid/4', 'filename.png');


/*
 $data = 'http://gz.altmi.com';
   // 生成的文件名
   $filename = $errorCorrectionLevel.'|'.$matrixPointSize.'.png';
   // 纠错级别：L、M、Q、H
   $errorCorrectionLevel = 'L';
   // 点的大小：1到10
   $matrixPointSize = 4;
   QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);



*/
?>
