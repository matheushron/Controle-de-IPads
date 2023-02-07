<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChipsC_model extends CI_Model
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
        from CHIP 
        where STATUS like 'ESTOQUE%'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countEmUso(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS) EMUSO
        from CHIP
        where STATUS = 'EM USO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countTransito(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS_DO_CHIP) TRANSITO
        from IPADS 
        where STATUS_DO_CHIP = 'TRANSITO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countRoubado(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS_DO_CHIP) ROUBADO
        from IPADS 
        where STATUS_DO_CHIP = 'ROUBADO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countPerdido(){
        $conn = $this->ConnectionOracleIPads->conn();

        $select = "select count(STATUS_DO_CHIP) PERDIDO
        from IPADS 
        where STATUS_DO_CHIP = 'PERDIDO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countInterno(){
        $conn = $this->ConnectionOracleIPads->conn();

        
        $select = "select count(STATUS_DO_CHIP) INTERNO
        from IPADS 
        where STATUS_DO_CHIP = 'USO INTERNO'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function countInstalado(){
        $conn = $this->ConnectionOracleIPads->conn();

        
        $select = "select count(STATUS_DO_CHIP) INSTALADO
        from IPADS 
        where STATUS_DO_CHIP = 'INSTALADO EM IPAD'
        ";

        $statment = $conn->prepare($select);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }
} 