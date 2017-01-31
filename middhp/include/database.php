<?php

class DataBase{
    private $db;
    private $connect_url;
    
    public function __construct($url){
        $models = array_slice(scandir("./models/"), 2);
        foreach($models as $model){
            include_once("./models/{$model}");
        }
        $this->connect_url = parse_url($url);
        $this->connect_url['dbname'] = substr($this->connect_url['path'], 1);
        if(!isset($this->connect_url['password'])) $this->connect_url['password'] = "";
        switch($this->connect_url['scheme']){
            case "mysqli":{
                $this->db = new mysqli($this->connect_url['host'], $this->connect_url['user'], $this->connect_url['password']);
                $this->query("CREATE DATABASE IF NOT EXISTS {$this->connect_url['dbname']}");
                $this->db->select_db($this->connect_url['dbname']);
            }
        }
    }
    
    public function query($query){
        switch($this->connect_url['scheme']){
            case "mysqli":{
                return $this->db->query($query);
            }
        }
    }
    
    public function getInsertId(){
        switch($this->connect_url['scheme']){
            case "mysqli":{
                return $this->db->insert_id;
            }
        }
    }
}

?>