<?php

namespace vendor\modules;
class Outputs{
    static function normalOutput($data){
        return [
            "type"=>"normal",
            "data"=>$data
        ];
    }
    static function doOutput($output){
        if($output['type'] == 'normal'){
            $data =  "# ${output['data']}\n";
            echo $data;
        }
    }
}