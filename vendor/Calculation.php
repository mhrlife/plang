<?php
namespace vendor;
class Calculation{
    static function run($code){
        $code = str_replace([
            "صحیح" , "غلط"
        ],[
            "true","false"
        ],$code);
//        var_dump($code);
        return eval("return $code;");
    }
}