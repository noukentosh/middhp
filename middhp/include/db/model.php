<?php

class Model{
    private $_DATA = array();
    private $__model_name;
    
    public function __construct(){
        
    }
    
    public function __set($name, $value){
        $this->_DATA[$name] = $value;
    }
    
    public function __get($name){
        return $this->_DATA[$name];
    }
}

?>