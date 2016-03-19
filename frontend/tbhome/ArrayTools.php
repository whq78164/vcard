<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-19
 * Time: 20:25
 */

namespace frontend\tbhome;


class ArrayTools
{
    public function arrayToString($array){
        $msg='';
        if(is_array($array)){
            foreach($array as $key=>$value){
                $msg.='{'.$key.'}'.'=>{';
                if(is_array($value)){
                    $msg.=$this->arrayToString($value);
                }
                if(is_string($value)){
                    $msg.=$value.'}';
                }
            }
        }
        if(is_string($array)){
            $msg.=$array;
        }
        return $msg;
    }
}