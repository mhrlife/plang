<?php
namespace vendor;
use vendor\modules\Condition;
use vendor\modules\Define;
use vendor\modules\DefineVar;
use vendor\modules\GetVar;
use vendor\modules\Show;
use vendor\modules\Start;
use vendor\modules\WhileLoop;

define("غلط",false);
define("صحیح",true);

class Config{
    static $start_text = "شروع";
    static $show_text = "نمایش";
    static $define_text = "تعریف";
    static $getvar_text = "دریافت";
    static $if_text = "اگر";
    static $else_text = "درغیراینصورت";
    static $endif_text = "پایان_شرط";
    static $while_start_text = "تا_وقتی";
    static $while_end_text = "پایان_حلقه";

    static function getModules(){
        return [
            Start::class,
            Condition::class,
            WhileLoop::class,
            Show::class,
            DefineVar::class,
            GetVar::class,
        ];
    }

}