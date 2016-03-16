<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
class Uploadfile extends Model
{
    /**
     * @var UploadedFile
     *
     */

    public $file;//文件路径和姓名

    public function rules()
    {

        return [
         //  [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, bmp, xls, xlsx'],
    //        [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, bmp, xls, xlsx'],
        ];
    }

    public function upload($dir="Uploads/", $filename)
    {
        if ($this->validate()) {
            //   $uid=Yii::$app->user->id;
            //   $dirpath='Uploads/'. $uid.'/'.$dir;
            if (!file_exists($dir)) mkdir($dir, 0777, true);//is_dir
     //       $this->file = UploadedFile::getInstance($model, 'file');//上传!
            $this->file->saveAs($dir. $filename . '.' . $this->file->extension);
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