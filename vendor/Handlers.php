<?php
namespace vendor;
class Handlers{
    public function NormalHandler(){
        return [
            'type'=>'normal'
        ];
    }
    public function ErrorHandler(){
        return [
            'type'=>'error'
        ];
    }
    public function SkipHandler(){
        return [
            'type'=>'skip'
        ];
    }

    function doHanlder($handler){}
}