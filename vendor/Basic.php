<?php
namespace vendor;
use vendor\modules\ModuleInterface;
use vendor\modules\Outputs;

/**
 * Class Basic
 * @package vendor
 * @property Config $config
 * @property Handlers $handler
 * @property Context $context
 * @property ModuleInterface[] $loadedModules
 */
class Basic{
    /**
     * Construction of the interpreter
     */
    public $cursor=0;
    static function error($data){
        exit( "
_ERROR_
    { $data } 
    
");
    }
    static function explodedLine($data,$d=null){
        return explode(" ",$data,$d);
    }
    /**
     * Start basic class
     */
    private $activated_module=false;
    private $code;
    private $lineOutputs=[];
    private $loadedModules=[];
    function __construct($code)
    {
        $this->code = $code;
    }

    function activate()
    {
        $this->config = new Config();
        $this->handler = new Handlers();
        $this->context = new Context();
        $this->initModules();
        $this->runInterpreter();
    }

    function setLineOutput($output){
        array_push($this->lineOutputs,$output);
    }
    function clearLine(){
        $this->lineOutputs = [];
    }

    function initModules(){
        $modules = Config::getModules();
        foreach ($modules as $module){
            $this->loadedModules[$module] = new $module();
        }
    }

    private function runInterpreter(){
        if(DEV)
            echo "START APPLICATION LOGS : \n";
        $codeLines = explode("\n",$this->code);
        while (App::$app->cursor < count($codeLines)){
            $line = $codeLines[App::$app->cursor];
            $i = App::$app->cursor;


                foreach ($this->loadedModules as $module => $instance) {
                    $handle = (($this->loadedModules[$module])->run($line, $i));
                    if (DEV)
                        echo "Line $i , {$module} type :" . $handle['type'] . "\n";
                    if ($handle['type'] == "skip") break;
                }


            foreach ($this->lineOutputs as $output){
                Outputs::doOutput($output);
            }
            $this->clearLine();
            App::$app->cursor++;
//            $this->context->vardump();
        }
        if(DEV)
            $this->context->vardump();
    }
}


/**
 * @return Basic
 */
function getApp(){
    return App::$app;
}
