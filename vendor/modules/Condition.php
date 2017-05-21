<?php
namespace vendor\modules;
use vendor\App;
use vendor\Basic;
use vendor\Calculation;
use vendor\Config;

class Condition implements ModuleInterface{
    public $activated = false;
    public $skip_to_else = false;
    public $is_else = false;
    static function conditionParse($line){
        $line = explode(" ",$line);
        foreach ($line as $index=>$item){
            $item = trim($item);
            if(isset($item[0]) && $item[0]=="\""){
                $line[$index]=$item;
            }else
                $line[$index] = App::$app->context->getVariable($item);
        }
        return implode("",$line);
    }
    public function run($line, $line_num)
    {
        $commands = Basic::explodedLine($line,2);
        if($commands[0] == Config::$if_text){
            $this->activated = true;
            if(Calculation::run(self::conditionParse ($commands[1]))){
                $this->skip_to_else = false;
            }else{
                $this->skip_to_else = true;
            }
        }
        if(trim($commands[0]) == Config::$else_text)
            $this->is_else = true;
        if(trim($commands[0]) == Config::$endif_text){
            $this->activated = false;
            $this->is_else = false;
            $this->skip_to_else = false;
        }
        if($this->activated){
            if($this->skip_to_else && !$this->is_else) return App::$app->handler->SkipHandler();
            if(!$this->skip_to_else && $this->is_else) return App::$app->handler->SkipHandler();
        }else{
            return App::$app->handler->NormalHandler();
        }
    }
}