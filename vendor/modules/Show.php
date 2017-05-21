<?php
namespace vendor\modules;
use vendor\App;
use vendor\Basic;
use vendor\Config;

class Show implements ModuleInterface{
    public function run($line, $line_num)
    {
        $commands = Basic::explodedLine($line,2);
        if($commands[0] == Config::$show_text){
            App::$app->setLineOutput(Outputs::normalOutput(Show::finalShow(Show::parseLine(trim($commands[1])))));
            return App::$app->handler->SkipHandler();
        }else{
            return App::$app->handler->NormalHandler();
        }
    }
    static function parseLine($line){
        $line = explode("_._",$line);
        foreach ($line as $index=>$item){
            $item = trim($item);
            if($item[0]=="\""){
                $line[$index]=$item;
            }else
            $line[$index] = App::$app->context->getVariable($item);
        }
        return implode("",$line);
    }
    static function finalShow($text){
        return str_replace("\"","",$text);
    }
}