<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ConnectionOraclePDO {
    
    protected $conn;
    
    public function __construct(){
        $this->conn = $this->conn();
        //$this->load->model('Log');
    }
    
    public function conn(){
        
        try {

            $conn = new PDO("oci:dbname=phpdev;charset=UTF8", "acesso", "acesso");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // var_dump($conn);

            return $conn;
        
        } catch (PDOException $pdoe){
            /*
            $this->Log->appendLog([
                'level' => 'ERROR',
                'msg' => 'PDO:' . $pdoe->getMessage()
            ]);
            */
            
            return "Erro PDO: " . $pdoe->getMessage();
            
        } catch (Exception $e){
            /*
            $this->Log->appendLog([
                'level' => 'ERROR',
                'msg' => 'Error:' . $e->getMessage()
            ]);
            */
            
            return "Erro conexão: " . $e->getMessage();
        }
    }
    
}