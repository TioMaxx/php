<?php

namespace DB;
use \PDO;

class Sql extends PDO {
    
    private $conn;
    
    public function __construct() {
        $this->conn = new PDO("mysql:dbname=treinamento;server=locahost", "root", "");
    }
    
    private function setParams($statement, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }
    
    private function setParam($statement, $key, $value){
        $statement->bindParam($key, $value);
    }
    
    public function query($rawQuery, $params = array ()){
        $stmt = $this->conn->prepare($rawQuery);
        
        $this->setParams($stmt, $params);
        
        $stmt->execute();
        
        return $stmt;        
    }
    
    public function select($rawQuery, $params = array()){
        $stmt = $this->query($rawQuery, $params);
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
}

