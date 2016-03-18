<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 0:36
 */

namespace frontend\tbhome;


class FileTools
{
    static function searchFiles($file){
        $fileArr=[];
        if(is_dir($file)){
            $dirHandle = opendir($file);
            while (($files = readdir($dirHandle)) !== false) {

                if ($files !== "." && $files !== "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                    //  echo "filename: $file : filetype: " . filetype($dir . $file) . "n"."<br />";
                    $eachFile=$file.'/'. $files;
                    if(filetype($eachFile)=='dir'){
                        $fileArr=array_merge($fileArr, self::searchFiles($eachFile));
                    }elseif(filetype($eachFile)=='file'){
                        $fileArr[]=$file.'/'.$files;
                    }

                }

            }
            closedir($dirHandle);

        }


        if(is_file($file)){
            $fileArr[]=$file;
        }

        return $fileArr;
    }

    static function searchDirs($file){
        $fileArr=[];

        if(is_dir($file)){
         //   $fileArr[]=$file;
            $dirHandle = opendir($file);
            while (($files = readdir($dirHandle)) !== false) {

                if ($files !== "." && $files !== "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                    //  echo "filename: $file : filetype: " . filetype($dir . $file) . "n"."<br />";
                    $eachFile=$file.'/'. $files;
                    if(filetype($eachFile)=='dir'){
                        $fileArr[]=$eachFile;
                        $fileArr=array_merge($fileArr, self::searchDirs($eachFile));
                    }

                }

            }
            closedir($dirHandle);

        }


        return $fileArr;
    }

    static function checkWritable($file){
        $fileArr=[];

        if(is_dir($file)){
            if(!is_writable($file)){
                $fileArr[]=$file;
                //$fileArr=array_merge($fileArr, self::checkWritable($file));
            }else{
                $dirHandle = opendir($file);
                while (($files = readdir($dirHandle)) !== false) {

                    if ($files !== "." && $files !== "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                        $eachFile=$file.'/'. $files;
                        if(filetype($eachFile)=='dir'){
                            if(!is_writable($eachFile)){
                                $fileArr[]=$eachFile;
                            }else{
                                $fileArr=array_merge($fileArr, self::checkWritable($eachFile));
                            }
                        }
                    }
                }
                closedir($dirHandle);
            }



        }


        return $fileArr;
    }

    static function extractZip($file, $path){
    if (!is_dir($path)) {mkdir($path, 0777, true);}//is_dir, file_exists()
        $zip=new \ZipArchive();
        $res=$zip->open($file);
        if($res==TRUE){
            $zip->extractTo($path);
            $zip->close();
        }
    }
    static function createZip($filename, $path){
        $zip = new \ZipArchive();
        if ($zip->open($filename, \ZipArchive::CREATE) === TRUE) {
            //必须为CREATE, OVERWRITE为覆盖，不可用。
            $files=self::searchFiles($path);
            //  $zip->addFile('autoload.php');
            foreach($files as $value){
                $zip->addFile($value);
            }
            //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
            $zip->close(); //关闭处理的zip文件
        }

    }





    static function readDir($path){
        $files=self::searchFiles($path);
        foreach($files as $file) {
            if (filetype($file)=='file'){
                echo $file.'<br/>';
            }
        }
    }








}