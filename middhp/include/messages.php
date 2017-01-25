<?php

class Messages{
    private $stack;
    
    public function __construct(){
        
    }
    
    function info($text){
        $this->stack[] = array(
            'type' => "info",
            'text' => $text,
            'trace' => debug_backtrace()
        );
    }
}

?>