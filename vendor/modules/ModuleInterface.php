<?php
namespace vendor\modules;
interface ModuleInterface {
    public function run($line,$line_num);
}