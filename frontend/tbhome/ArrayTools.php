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
    static public function arrayToString($array){
        $msg='';
        if(is_array($array)){
            foreach($array as $key=>$value){
                $msg.='{'.$key.'}'.'=>{';
                if(is_array($value)){
                    $msg.=self::arrayToString($value);
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


    /**
     * diff array from service to client
     * @param array $array_1 the array from service
     * @param array $array_2 the array from client
     * @return array
     */
static function array_diff($array_1, $array_2) {
        $array_2 = array_flip($array_2);
        foreach ($array_1 as $key => $value) {
            if (isset($array_2[$value])) {
                unset($array_1[$key]);
            }
        }

        return $array_1;
    }



    }