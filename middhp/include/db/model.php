<?php

class Model{
    private $__model_name;
    private $db;
    private $uid;
    private $fields = array();
    
    public function __construct($db){
        $this->db = $db;
        $this->__model_name = strtolower(get_class($this));
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_{$this->__model_name}` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`))  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_{$this->__model_name}_nodes` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `uid` bigint(20) unsigned NOT NULL, `parent` bigint(20) unsigned NOT NULL, `name` text NOT NULL, `value` text NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $property) {
            $this->fields[$property->getName()] = $property->getValue($this);
        }
    }
    
    public function save(){
        if($this->uid == NULL){
            $this->db->query("INSERT INTO `tbl_{$this->__model_name}` (`id`) VALUES (NULL)");
            $this->uid = $this->db->getInsertId();
            $reflection = new ReflectionObject($this);
            $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
            foreach ($properties as $property) {
                $name = $property->getName();
                $value = $property->getValue($this);
                $this->db->query("INSERT INTO `tbl_{$this->__model_name}_nodes` (`id`, `uid`, `parent`, `name`, `value`) VALUES (NULL, '{$this->uid}', '0', '{$name}', '{$value}')");
            }
        }
    }
    
    public function find($filters = array(), $limit = NULL){
        $results = array();
        
        $sql = "SELECT `uid` FROM `tbl_{$this->__model_name}_nodes` WHERE ";
        
        foreach($filters as $key => $filter){
            $sql .= "`name`='{$key}' AND `value`='{$filter}' AND ";
        }
        
        $sql = substr($sql, 0, strlen($sql) - 5);
        
        if($limit != NULL)
            $result = $this->db->query($sql . " LIMIT {$limit}");
        else
            $result = $this->db->query($sql);
        
        $uids = array();
        while ($row = $result->fetch_assoc()) {
            $uids[] = $row['uid'];
        }
        
        $sql = "SELECT `uid`, `name`, `value` FROM `tbl_{$this->__model_name}_nodes` WHERE `uid` IN ('" . implode("', '", $uids) . "') AND `name` IN ('" . implode("', '", array_keys($this->fields)) . "')";
        
        $result = $this->db->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $results[$row['uid']][$row['name']] = $row['value'];
        }
        
        return $results;
    }
    
    public function findOne($filters = array()){
        $results = $this->find($filters, 1);
        
        return array_shift($results);
    }
}

?>