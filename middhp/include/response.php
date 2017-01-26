<?php

class Response{
    public $headers = array();
    public $body = array();
    public $messages;
    private $renderer;
    
    function __construct(){
        $this->messages = new Messages();
        $this->renderer = new Renderer();
    }
    
    function append($field, $variables){
        if(is_array($variables))
            header("{$field}: " . implode(', ', $variables));
        else if(is_string($variables))
            header("{$field}: $variables");
    }
    
    function cookie($name, $value, $options = array()){
        //TODO $options
        setcookie($name, $value);
    }
    
    function clearCookie($name){
        unset($_COOKIE[$name]);
    }
    
    function end(){
        foreach($this->body as $part){
            echo $part;
        }
    }
    
    function location($location){
        header("Location: {$location}");
    }
    
    function redirect($location, $status = 302){
        header("Location: {$location}", true, $status);
    }
    
    function render($path, $data = array(), $callback = NULL){
        $this->body[] = $this->renderer->render($path, $data);
    }
    
    function send($data){
        $this->body[] = $data;
    }
    
    function type($type){
        header('Content-Type: {$type}');
    }
}

?>