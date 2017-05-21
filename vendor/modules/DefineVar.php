<?php
namespace vendor\modules;

use vendor\App;
use vendor\Basic;
use vendor\Calculation;
use vendor\Config;

class DefineVar implements ModuleInterface {

    public function run($line, $line_num)
    {
        $commands = Basic::explodedLine($line,2);
        if($commands[0] == Config::$define_text){
            $d = explode("=",$commands[1]);
            if(count($d) == 1){
                App::$app->context->setVariable(trim($d[0]),null);
            }else{
                $d[1] = Condition::conditionParse(Show::parseLine($d[1]));
                $res = ( Calculation::run(trim($d[1])));
                $d[0] = trim($d[0]);
                App::$app->context->setVariable($d[0],$res);
            }
            return App::$app->handler->SkipHandler();
        }else
            return App::$app->handler->NormalHandler();
    }
}