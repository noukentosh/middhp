<?php

class Renderer{
    private $context;
    private $engine;
    
    function __construct(){
        Fenom::registerAutoload();
        $this->engine = new Fenom(new Fenom\Provider('./templates/'));
        $this->engine->setCompileDir('./cache/');
        $this->engine->setOptions(Fenom::DISABLE_CACHE | Fenom::FORCE_INCLUDE);
    }
    
    function render($path, $data = array(), $callback = NULL){
        //TODO callback
        return $this->engine->fetch($path, $data);
    }
}

?>