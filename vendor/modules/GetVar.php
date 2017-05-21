<?php
namespace vendor\modules;
use vendor\App;
use vendor\Basic;
use vendor\Calculation;
use vendor\Config;

class GetVar implements ModuleInterface{

    public function run($line, $line_num)
    {
        $commands = Basic::explodedLine($line,2);
        if($commands[0] == Config::$getvar_text){
            $handle = fopen ("php://stdin","r");
            $line = fgets($handle);
            $var = trim($line);
            $var = Show::parseLine($line);
            $var = Calculation::run($var);
            $varname = trim($commands[1]);
            App::$app->context->setVariable($varname,$var);
            return App::$app->handler->SkipHandler();
        }
        else{
            return App::$app->handler->NormalHandler();
        }
    }
}