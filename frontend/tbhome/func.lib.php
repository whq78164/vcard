<?php
function genqrcode($value)
{
    $qrApi = $picUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/qrcode.php?value=';
    $value = urlencode($value);
    $qrcodeurl = $qrApi . $value;
    return $qrcodeurl;
}