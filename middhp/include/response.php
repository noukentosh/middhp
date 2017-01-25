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
        //TODO add field to header
    }
    
    function cookie($name, $value, $options = array()){
        //TODO set cookie
    }
    
    function clearCookie($name){
        //TODO clear cookie
    }
    
    function end(){
        foreach($this->body as $part){
            echo $part;
        }
    }
    
    function location($location){
        //TODO change location
    }
    
    function redirect($location, $status = 302){
        //TODO change location with status
    }
    
    function render($path, $data = array(), $callback = NULL){
        $this->body[] = $this->renderer->render($path, $data);
    }
    
    function send($data){
        //TODO append $data to $body
    }
    
    function type($type){
        //TODO set response content type
    }
}

?>