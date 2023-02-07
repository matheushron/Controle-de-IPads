<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ConnectionOraclePDOWebdb {
    
    protected $conn;
    
    public function __construct(){
        $this->conn = $this->conn();
    }
    
    public function conn(){
        
        try {
            $conn = new PDO("oci:dbname=erp_marj;charset=UTF8", "webdb", "webdb");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;
            
        } catch (Exception $e){
            return "Erro conexão: " . $e->getMessage();
        }
    }
    
}