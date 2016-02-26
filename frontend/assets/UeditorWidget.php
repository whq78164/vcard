<?php
namespace frontend\assets;
 
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use frontend\assets;
//use yii\web\View;
 
class UeditorWidget extends InputWidget
{
    public $attributes;
    public $serverparam;
 
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $view = $this->getView();
        $this->attributes['id']=$this->options['id'];
        if($this->hasModel()){
            $input=Html::activeTextarea($this->model, $this->attribute,$this->attributes);
        }else{
            $input=Html::textarea($this->name,'',$this->attributes);
        }
        echo $input;

        UeditorAsset::register($view);//将Ueditor用到的脚本资源输出到视图

$js='var ue = UE.getEditor("'.$this->options['id'].'", '.$this->getOptions().');
ue.ready(function(){
ue.execCommand("'.'serverparam'.'", '.$this->getServerparam().'
);});';

        //Ueditor初始化脚本
        $view->registerJs($js, $view::POS_END);//将Ueditor初始化脚本也响应到视图中

    }


    public function getServerparam()
    {
//        unset($this->options['id']);//Ueditor识别不了id属性,故而删之
        return Json::encode($this->serverparam);
    }


    public function getOptions()
    {
        unset($this->options['id']);//Ueditor识别不了id属性,故而删之
        return Json::encode($this->options);
    }
}