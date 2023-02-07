<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atribuicao_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ConnectionOraclePDO');
		$this->load->model('ConnectionOracleIPads');
		$this->load->model('Log');
	}


//começo da model da lista de ipads em estoque para nova atribuição.
	public function listSerial(){
	
		try {
			$conn = $this->ConnectionOracleIPads->conn();

			$list = [];
			$sql = "
	  	  select SERIAL 
		  from IPADS 
		  where STATUS = 'ESTOQUE'
	  	  	order by  SERIAL
	  	";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$list[] = [
					'SERIAL' => $row['SERIAL']
				];
			}

			$log = [
				'level' => 'INFO',
				'msg' => '',
				'list' => $list
			];
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'list' => $list
			];
		}

		return $log;
	}
//fim da model da lista de ipads em estoque para nova atribuição.


	public function listAtribuição(){
	

		try {
			$conn = $this->ConnectionOracleIPads->conn();

			$listAtribuicao = [];
			$sql = "
	  	  	select 
			ID,
			RESPONSAVEL,
			EMAIL,
			SERIAL
			  from IPADS
	  	  	ORDER BY RESPONSAVEL
	  	";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$listAtribuicao[] = [
					'ID' => $row['ID'],
					'RESPONSAVEL' => $row['RESPONSAVEL'],
					'EMAIL' => $row['EMAIL'],
					'SERIAL' => $row['SERIAL']
				];
			}

			$log = [
				'level' => 'INFO',
				'msg' => '',
				'list' => $listAtribuicao
			];
		} catch (Exception $e) {

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'list' => $listAtribuicao
			];
		}

		return $log;
	}
	//fim do array

	public function update($data)
	{
		try {
			$conn = $this->ConnectionOracleIPads->conn();

				$sql = "
				update IPADS
				set MODELO = :MODELO,
				PART_NUMBER = :PART_NUMBER,
				EMAIL = :EMAIL,
				SERIAL = :SERIAL,				         
				IMEI = :IMEI,				         
				STATUS = 'EM USO',		         		         
				CHIP = :CHIP,		         		         
				OBS = :OBS,		         		         
				RESPONSAVEL = :RESPONSAVEL	         
				 where ID = :ID
			  ";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':ID', $data['id']);
				$stmt->bindParam(':MODELO', $data['modelo']);
				$stmt->bindParam(':EMAIL', $data['email']);
				$stmt->bindParam(':SERIAL', $data['serial']);
				$stmt->bindParam(':PART_NUMBER', $data['part_number']);
				$stmt->bindParam(':IMEI', $data['imei']);
				$stmt->bindParam(':STATUS', $data['status']);
				$stmt->bindParam(':CHIP', $data['chip']);
				$stmt->bindParam(':OBS', $data['obs']);
				$stmt->bindParam(':RESPONSAVEL', $data['responsavel']);
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
			        RESPONSAVEL,
			        ID,
			  		EMAIL,
					SERIAL
			      ) values (
                  :RESPONSAVEL,
				  :EMAIL,
				  :ID,
				  :SERIAL
			      )";
				$stmt = $conn->prepare($sql);

				$stmt->bindParam(':RESPONSAVEL', $data['responsavel']);
				$stmt->bindParam(':EMAIL', $data['email']);
				$stmt->bindParam(':SERIAL', $data['serial']);
				$stmt->bindParam(':ID', $data['id']);
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
				     set RESPONSAVEL =:responsavel,
				     EMAIL = :email,
					 SERIAL = :serial				         
				   where id = :id
				";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':id', $data['id']);
				$stmt->bindParam(':RESPONSAVEL', $data['responsavel']);
				$stmt->bindParam(':EMAIL', $data['email']);
				$stmt->bindParam(':SERIAL', $data['serial']);

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
			RESPONSAVEL,
			ID,
			EMAIL,
			SERIAL
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
			BEGIN
			UPDATE ipads SET serial = NULL WHERE ID = :id;
			UPDATE ipads SET STATUS = 'ESOQUE'  WHERE ID = :id;
			END;
      	";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $data['id']);
			$stmt->execute();

			$log = [
				'level' => 'INFO',
				'msg' => 'Serial: id=' . $data['id'] . ' excluida.'
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