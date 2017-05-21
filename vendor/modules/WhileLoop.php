<?php
namespace vendor\modules;
use vendor\App;
use vendor\Basic;
use vendor\Calculation;
use vendor\Config;

class WhileLoop implements ModuleInterface{
    public $activated = false;
    public $start_cursor = false;
    public $skip = false;

    public function run($line, $line_num)
    {
        $commands = Basic::explodedLine($line,2);
        if($commands[0] == Config::$while_start_text){
            $this->activated = true;
//            var_dump(Calculation::run(Condition::conditionParse ($commands[1])));
//            var_dump((Condition::conditionParse ($commands[1])));
            if(Calculation::run(Condition::conditionParse ($commands[1]))){
                $this->skip = false;
                $this->start_cursor = App::$app->cursor;
                $this->activated = true;
            }else{
                $this->skip = true;
                $this->start_cursor = App::$app->cursor;
                $this->activated = true;
            }
        }
        if(trim($commands[0]) == Config::$while_end_text){
            if(!$this->skip) {
                App::$app->cursor = $this->start_cursor - 1;
                return App::$app->handler->SkipHandler();
            }else{
                $this->activated = false;
                return App::$app->handler->SkipHandler();
            }
        }

        if($this->activated){
            if($this->skip) return App::$app->handler->SkipHandler();
            return App::$app->handler->NormalHandler();
        }else{
            return App::$app->handler->NormalHandler();
        }
    }
}