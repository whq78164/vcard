<?php
function genqrcode($value)
{
    $qrApi =  \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/qrcode.php?value=';
	//$qrApi = 'http://www.vcards.top/qrcode.php?value=';
    $value = urlencode($value);
    $qrcodeurl = $qrApi . $value;
    return $qrcodeurl;
}

function genqr($value)
{
    $qrApi =  \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/qrcode.php?value=';
	//$qrApi = 'http://www.vcards.top/qrcode.php?value=';
  //  $value = urlencode($value);
    $qrcodeurl = $qrApi . $value;
    return $qrcodeurl;
}


//取客户端 ip
function get_client_ip(){
    if (isset($_SERVER['HTTP_CLIENT_IP']) and !empty($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
    }
    if (isset($_SERVER['HTTP_PROXY_USER']) and !empty($_SERVER['HTTP_PROXY_USER'])){
        return $_SERVER['HTTP_PROXY_USER'];
    }
    if (isset($_SERVER['REMOTE_ADDR']) and !empty($_SERVER['REMOTE_ADDR'])){
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return "0.0.0.0";
    }
}



function get_ip_data($ip = "114.114.114.114"){
//    $ip=file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=" . $ip);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $location = curl_exec($curl);
    $location = json_decode($location);
    if (is_object($location)) {
        return $location->province . $location->city;
    } else {
        return '本地';
    }

}



function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
}


