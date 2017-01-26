<?php

class Route{
    private $path_tpl;
    private $path_regex;
    private $params = array();
    
    public function __construct($path){
        $this->func = $func;
        $this->path_tpl = $path;
        $this->path_regex = PathToRegexp::convert($path, $this->params);
    }
    
    public function match($path){
        $matches = PathToRegexp::match($this->path_regex, $path);
        if($matches == NULL)
            return NULL;
            
        $results = array();
        foreach($this->params as $k => $param){
            $results[$param['name']] = $matches[$k+1];
        }
        return $results;
    }
}

?>