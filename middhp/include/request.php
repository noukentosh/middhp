<?php

class Request{
    public $cookies;
    public $hostname;
    public $ip;
    public $method;
    public $originalUrl;
    public $query;
    public $params;
    
    public function __construct(){
        $this->cookies = $_COOKIE;
        $this->hostname = $_SERVER['HTTP_HOST'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->originalUrl = $_SERVER['REQUEST_URI'];
        $this->query = $_GET;
    }
}

?>