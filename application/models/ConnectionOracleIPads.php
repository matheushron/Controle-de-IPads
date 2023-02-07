<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ConnectionOracleIPads {
    
    protected $conn;
    
    public function __construct(){
        $this->conn = $this->conn();
        //$this->load->model('Log');
    }
    
    public function conn(){
        $mydb="
            (DESCRIPTION =
                (ADDRESS = (PROTOCOL = TCP)(HOST = 10.1.32.22)(PORT = 1521))
                (CONNECT_DATA =
                    (SERVER = DEDICATED)
                    (SID = SATELITE)
                )
        )";
        
        try {
            $conn = new PDO("oci:dbname={$mydb};charset=UTF8", "TI", "mrj@2709");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
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