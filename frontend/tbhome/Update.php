<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 0:36
 */

namespace frontend\tbhome;
//use Yii;

class Update
{

    static public function filesList(){
        $filesMd5=self::filesMd5();
        $checkDiffApi='http://demo.vcards.top/vcardsdemo/frontend/web/index.php?r=api/update/checkdiff';
        $curl = new Curl();
        $diffFiles = $curl->setOption(
            CURLOPT_POSTFIELDS,
            http_build_query($filesMd5)
        )->post($checkDiffApi);
        $diffFiles=json_decode($diffFiles,true) ? json_decode($diffFiles,true) : false;
        if($diffFiles){
            $updateFiles=array();
            foreach($diffFiles as $key=>$value){
                //   $updateFiles=array_merge($updateFiles,$key);
                $updateFiles[]=$key;
            }
            return $updateFiles;
        }else{
            return false;
        }

    }






    static function filesMd5(){
        ini_set("max_execution_time", "1800");
        $frontend=dirname(__DIR__);
        $excludeFrontend=[
            $frontend.'/web',
            $frontend.'/.idea',
            $frontend.'/config',
            $frontend.'/assets/phpqrcode',
            $frontend.'/runtime',
            $frontend.'/modules',
            $frontend.'/controllers/CloudController.php',
            $frontend.'/controllers/CloudtableController.php',
            $frontend.'/views/cloud',
            $frontend.'/views/cloudtable',
        ];
        $frontendDirs=FileTools::md5Files($frontend, $frontend.'/', '', $excludeFrontend);

        $excludeWeb=[
            $frontend.'/web/tbhome/AdminLTE',
            $frontend.'/web/tbhome/font-awesome',
            $frontend.'/web/tbhome/Ionicons',
            $frontend.'/web/tbhome/pace',
            $frontend.'/web/tbhome/ueditor',
            $frontend.'/web/tbhome/weui',
        ];
        $webDirs=FileTools::md5Files($frontend.'/web/tbhome', $frontend.'/', '', $excludeWeb);

        $dirs=array_merge($frontendDirs,$webDirs);

        return $dirs;

    }



    static function downZip($dir,$version){

        $updateFilesArr=Update::filesList();

        $updateFilesApi='http://demo.vcards.top/vcardsdemo/frontend/web/index.php?r=api/update/updatefiles';

       // $version=$this->getVersion();
        $postData=[
            'version'=>$version,
            'files'=>$updateFilesArr,
        ];

        $ch = curl_init($updateFilesApi);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        $fp = fopen($dir, "wb");
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $res=curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        return $res;

        /*
        foreach($updateFilesArr as $updateFile){
            $postData=[
                'version'=>$version,
                'file'=>$updateFile,
        ];
            $diffFiles = $curl->setOption(
                CURLOPT_POSTFIELDS,
                http_build_query($postData)
            )->post($updateFilesApi);
            echo $diffFiles;
        }
*/


    }

    static function backupFiles($backFilename){
        $frontend=\Yii::getAlias('@frontend');
        $updateFilesArr=self::filesList();
        $zip = new \ZipArchive();
        if ($zip->open($backFilename.'.zip', \ZipArchive::CREATE) === TRUE) {
            //新建时必须为CREATE, OVERWRITE为覆盖，不可用。
            foreach($updateFilesArr as $value){
                $eachFile=$frontend.'/'.$value;
                $zip->addFile($eachFile);
            }
            $zip->close(); //关闭处理的zip文件
        }
        echo '<br/>本地差量文件备份成功：<br/>'.$backFilename.'.zip';
        return $updateFilesArr;
    }









}