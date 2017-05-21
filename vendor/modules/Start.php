<?php
namespace vendor\modules;
use vendor\App;
use vendor\Basic;
use vendor\Config;
use vendor\Outputs;

class Start implements ModuleInterface{
    private $started=false;

    function __construct()
    {
        if(DEV)
        echo "Module START Loaded \n";
    }

    public function run($line,$line_num)
    {
        if(!$this->started&&$line!=Config::$start_text) {
            App::$app->setLineOutput(\vendor\modules\Outputs::normalOutput($line));
            return App::$app->handler->SkipHandler();
        }
        else if(!$this->started&&$line==Config::$start_text) {
            $this->started = true;
            return App::$app->handler->SkipHandler();
        }else{
            return App::$app->handler->NormalHandler();
        }
    }
}