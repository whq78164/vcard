<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
class Upload extends Model
{
    /**
     * @var UploadedFile
     *
     */

    public $imageFile;//文件路径和姓名

    public function rules()
    {

        return [
        /*
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, bmp'],
        */
        ];

    }

    public function upload($filename, $dir="Uploads/")
    {
        if ($this->validate()) {
            //   $uid=Yii::$app->user->id;
            //   $dirpath='Uploads/'. $uid.'/'.$dir;
            if (!file_exists($dir)) mkdir($dir, 0777, true);//is_dir
   //         $this->imageFile = UploadedFile::getInstance($face, 'imageFile');//上传!
            $this->imageFile->saveAs($dir. $filename . '.' . $this->imageFile->extension);
            /*多文件上传使用foreach
             * foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
             * */
            return true;
        } else {
            return false;
        }
    }
}