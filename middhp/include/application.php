<?php

class Application{
    private $routes = array();
    private $staticfiles;
    
    public function __construct(){

    }
    
    public function get($route, $func){
        $this->routes[] = array(
            "method" => "GET",
            "route" => new Route($route),
            "func" => $func
        );
    }
    
    public function post($route, $func){
        $this->routes[] = array(
            "method" => "POST",
            "route" => new Route($route),
            "func" => $func
        );
    }
    
    public function run(){
        $req = new Request();
        $res = new Response();
        
        $founded = false;
        
        foreach($this->routes as $route){
            $params = $route['route']->match($_SERVER['REQUEST_URI']);
            if($route['method'] == $_SERVER['REQUEST_METHOD'] && is_array($params)){
                $founded = true;
                $req->params = $params;
                $route['func']($req, $res);
                break;
            }
        }
        if(!$founded)
            echo "Not Found: {$_SERVER['REQUEST_URI']}";
    }

}

?>