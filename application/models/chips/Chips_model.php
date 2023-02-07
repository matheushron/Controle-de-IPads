<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chips_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ConnectionOraclePDO');
		$this->load->model('ConnectionOracleIPads');
		$this->load->model('Log');
	}

	//numero_frente é o numero de 20 digitos que fica na frente do chip 
	//numero_linha é o nuero da linha : +55(DDD)....

	public function listChips()
	{

		try {
			$conn = $this->ConnectionOracleIPads->conn();

			$listChips = [];
			$sql = "
	  	  	select 
             ID,
             CHIP,
             LINHA_DO_CHIP,
             CONTA_DO_CHIP,
             SERIAL,
             STATUS_DO_CHIP
			  from IPADS
	  	  	ORDER BY ID 
	  	";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$listChips[] = [
					'ID' => $row['ID'],
					'CHIP' => $row['CHIP'],
					'LINHA_DO_CHIP' => $row['LINHA_DO_CHIP'],
					'CONTA_DO_CHIP' => $row['CONTA_DO_CHIP'],
					'SERIAL' => $row['SERIAL'],
					'STATUS_DO_CHIP' => $row['STATUS_DO_CHIP']
				];
			}

			$log = [
				'level' => 'INFO',
				'msg' => '',
				'list' => $listChips
			];
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'list' => $listChips
			];
		}

		return $log;
	}
	//fim do array

	public function tabelaChip($post)
	{

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$filt_transportadora = @$post['filt_transportadora'];

			$tabelaChip = [];
			$sql = "
			select 
			ID,
			CHIP,
			LINHA_DO_CHIP,
			CONTA_DO_CHIP,
			SERIAL,
			STATUS_DO_CHIP
			 from IPADS
			  WHERE 1=1
			";
			if (!empty($filt_transportadora)) {
				$sql .= "and ID  like = :filt_transportadora
			  or CHIP  like = :filt_transportadora
			  or LINHA_DO_CHIP  like = :filt_transportadora
			  or CONTA_DO_CHIP  like = :filt_transportadora
			  or SERIAL  like = :filt_transportadora
			  or STATUS_DO_CHIP  like = :filt_transportadora";
			}

			$sql .= " ORDER BY ID ";

			$stmt = $conn->prepare($sql);

			if (!empty($filt_transportadora)) {
				$stmt->bindParam(':filt_transportadora', $filt_transportadora);
			}
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$tabelaChip[] = [
					'ID' => $row['ID'],
					'CHIP' => $row['CHIP'],
					'LINHA_DO_CHIP' => $row['LINHA_DO_CHIP'],
					'CONTA_DO_CHIP' => $row['CONTA_DO_CHIP'],
					'SERIAL' => $row['SERIAL'],
					'STATUS_DO_CHIP' => $row['STATUS_DO_CHIP'],
				];
			}

			$log = [
				'level' => 'INFO',
				'msg' => '',
				'tabelaChip' => $tabelaChip
			];

			return $log;
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'list' => []
			];

			$this->Log->appendLog($log);

			return $log;
		}
	}

	public function update($data)
	{
		try {
			$conn = $this->ConnectionOracleIPads->conn();

			$sql = "
				  update IPADS
				     set STATUS_DO_CHIP = :STATUS_DO_CHIP,
				      SERIAL = :SERIAL,
					  CONTA_DO_CHIP = :CONTA_DO_CHIP,			         
					  LINHA_DO_CHIP = :LINHA_DO_CHIP,
					  CHIP = :CHIP    
				   where ID = :ID
				";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':ID', $data['id']);
			$stmt->bindParam(':LINHA_DO_CHIP', $data['linha_do_chip']);
			$stmt->bindParam(':STATUS_DO_CHIP', $data['status_do_chip']);
			$stmt->bindParam(':CONTA_DO_CHIP', $data['conta_do_chip']);
			$stmt->bindParam(':SERIAL', $data['serial']);
			$stmt->bindParam(':CHIP', $data['chip']);
			$stmt->execute();
			$log = [
				'level' => 'INFO',
				'msg' => 'Alterado.',
				'dados' => $data
			];

			$this->Log->appendLog($log);

			return $log;
		} catch (Exception $e) {
			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'dados' => $data
			];

			$this->Log->appendLog($log);

			return $log;
		}
	}

	public function insert($data)
	{

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			if (empty($data['id'])) {

				$sql = "
			  	  insert into IPADS (
					CHIP,
					LINHA_DO_CHIP,
					CONTA_DO_CHIP,
					SERIAL,
					STATUS_DO_CHIP
			      ) values (
					:CHIP,
					:LINHA_DO_CHIP,
					:CONTA_DO_CHIP,
					:SERIAL,
					:STATUS_DO_CHIP
			      )";
				$stmt = $conn->prepare($sql);

				$stmt->bindParam(':LINHA_DO_CHIP', $data['linha_do_chip']);
				$stmt->bindParam(':CHIP', $data['chip']);
				$stmt->bindParam(':CONTA_DO_CHIP', $data['conta_do_chip']);
				$stmt->bindParam(':SERIAL', $data['serial']);
				$stmt->bindParam(':STATUS_DO_CHIP', $data['status_do_chip']);
				$stmt->execute();
				$log = [
					'level' => 'INFO',
					'msg' => 'Incluído.',
					'dados' => $data
				];

				$this->Log->appendLog($log);

				return $log;
			} else {

				$sql = "
				  update IPADS
				     set STATUS_DO_CHIP = :status_do_chip,
				     CHIP = :chip,
					 LINHA_DO_CHIP = :linha_do_chip,				         
					 CONTA_DO_CHIP = :conta_do_chip,	         
					 SERIAL = :serial			         
				   where id = :id
				";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':status_do_chip', $data['status_do_chip']);
				$stmt->bindParam(':chip', $data['chip']);
				$stmt->bindParam(':linha_do_chip', $data['linha_do_chip']);
				$stmt->bindParam(':conta_do_chip', $data['conta_do_chip']);
				$stmt->bindParam(':serial', $data['serial']);

				$stmt->execute();

				$log = [
					'level' => 'INFO',
					'msg' => 'Alterado.',
					'dados' => $data
				];

				$this->Log->appendLog($log);

				return $log;
			}
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'dados' => $data
			];

			$this->Log->appendLog($log);

			return $log;
		}
	}

	public function getRegister($data)
	{

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$sql = "
			select 
			ID,
			CHIP,
			LINHA_DO_CHIP,
			CONTA_DO_CHIP,
			SERIAL,
			STATUS_DO_CHIP
			 from IPADS
			  WHERE ID = :id
            ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $data['id']);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$log = [
				'level' => 'INFO',
				'msg' => '',
				'register' => $row
			];

			return $log;
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage()
			];

			$this->Log->appendLog($log);

			return $log;
		}
	}

	public function delete($data)
	{

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$sql = "
      	  DELETE FROM IPADS
		  WHERE ID = :id
      	";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $data['id']);
			$stmt->execute();

			$log = [
				'level' => 'INFO',
				'msg' => 'Chip : id=' . $data['id'] . ' excluida.'
			];
			$this->Log->appendLog($log);

			return $log;
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage()
			];
			$this->Log->appendLog($log);
			return $log;
		}
	}
}
