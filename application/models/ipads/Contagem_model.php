<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contagem_model extends CI_Model
{

    public function __construct()
	{
		parent::__construct();

		$this->load->model('ConnectionOraclePDO');
		$this->load->model('ConnectionOracleIPads');
		$this->load->model('Log');
	}

    public function countEstoque(){
        $conn = $this->ConnectionOracleIPads->conn();

        
        $select = "select count(STATUS) ESTOQUE
        from IPADS 
        where STATUS = 'ESTOQUE'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countEmUso(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS) EMUSO
        from IPADS
        where STATUS = 'EM USO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countTransito(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS) TRANSITO
        from IPADS 
        where STATUS = 'TRANSITO' or
        STATUS = 'TRANSITO DE DESLIGAMENTO' or 
        STATUS = 'TRANSITO DE MANUTENÇÃO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countRoubado(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS) ROUBADO
        from IPADS 
        where STATUS = 'ROUBADO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countPerdido(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS) PERDIDO
        from IPADS 
        where STATUS = 'PERDIDO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countInterno(){
        $conn = $this->ConnectionOracleIPads->conn();

        
        $select = "select count(STATUS) INTERNO
        from IPADS 
        where STATUS = 'USO INTERNO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }
} 