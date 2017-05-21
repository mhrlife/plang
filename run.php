<?php

/**
 *  Autoload function
 */
function __autoload($class){
    $class = str_replace("\\","/",$class);
    require_once __DIR__ . "/" . $class . ".php";
}
if(count($argv) < 2)
    \vendor\Basic::error("Set the input file");
define("REQUEST_FILE",($argv[1]));
define("DEV",false);
define("BASEDIR",__DIR__);

if(!is_file(REQUEST_FILE))
    \vendor\Basic::error("File is not exists");

\vendor\App::$app = new \vendor\Basic(file_get_contents(REQUEST_FILE));
\vendor\App::$app->activate();
