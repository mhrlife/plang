<?php
namespace vendor;
class Context{
    private $variables = [];
    private $methods = [];
    public function vardump(){
        var_dump($this->variables);
        var_dump($this->methods);
    }
    public function setVariable($name,$value){
        $name = trim($name);
        $name_trim  = trim($name);
        if(($name_trim[0] != "["  && strpos($name,"[") === false) || ($name_trim[0] == "[" )) {
            $this->variables[$name] = $value;
        }else{
            $index_p = explode("[",$name_trim);
            $varname = trim($index_p[0]);
            $index = trim(str_replace("]","",$index_p[1]));
            $index = $this->variables[$index];
            if(!isset($this->variables[$varname]))
                $this->variables[$varname] = [];
            $this->variables[$varname][$index] = $value;
        }
    }
    public function setMethod($name,$code){
        $name = trim($name);
        $this->methods[$name] = $code;
    }
    public function isVariable($name){
        $name = trim($name);
        return isset($this->variables[$name]);
    }
    public function getVariable($name){
        $name_trim = trim($name);
        if(!isset($name_trim[0]) || ($name_trim[0] != "["  && strpos($name,"[") === false) || ($name_trim[0] == "[" )) {
            if ($this->isVariable($name)) {
                $name = trim($name);
                $type =  $this->variables[$name];
                if(is_array($type)) {
                    return "[" . implode(",", $type) . "]";
                }
                if(is_bool($type)){
                    if($type) return "صحیح";
                    else return "غلط";
                }
                    return $type;

            } else
                return $name;
        }else{
//            echo "O\n";
            $index_p = explode("[",$name_trim);
            $varname = trim($index_p[0]);
            $index = trim(str_replace("]","",$index_p[1]));
            if(isset($this->variables[$varname][$index])){
                return $this->variables[$varname][$index];
            }else if(isset($this->variables[$varname][$this->getVariable($index)])){
                return $this->variables[$varname][$this->getVariable($index)];
            } else return $name;
        }
    }
}