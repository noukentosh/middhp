<?php

class Application{
    private $routes = array();
    private $staticfiles;
    
    public function __construct(){

    }
    
    public function get($route, $func){
        $this->routes[] = array(
            "method" => "GET",
            "route" => $route,
            "func" => $func
        );
    }
    
    public function post($route, $func){
        $this->routes[] = array(
            "method" => "POST",
            "route" => $route,
            "func" => $func
        );
    }
    
    public function run(){
        $req = new Request();
        $res = new Response();
        
        $founded = false;
        foreach($this->routes as $route){
            if($route['method'] == $_SERVER['REQUEST_METHOD'] && $route['route'] == $_SERVER['REQUEST_URI']){
                $founded = true;
                $route['func']($req, $res);
                break;
            }
        }
        if(!$founded)
            echo "Not Found: {$_SERVER['REQUEST_URI']}";
            
        $this->loadingtime -= -microtime(); 
    }

}

?>