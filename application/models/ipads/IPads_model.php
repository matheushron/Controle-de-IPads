<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IPads_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ConnectionOraclePDO');
		$this->load->model('ConnectionOracleIPads');
		$this->load->model('Log');
	}

	public function listAtribuicao()
	{

		try {
			$conn = $this->ConnectionOracleIPads->conn();

			$list = [];
			$sql = "
	  	  	select 
				RESPONSAVEL,
				ID,
			  	MODELO,
				EMAIL,
				SERIAL,
				IMEI,
				STATUS,
				CHIP,
				OBS,
				PART_NUMBER
			  from IPADS
	  	  	ORDER BY RESPONSAVEL
	  	";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$list[] = [
					'ID' => $row['ID'],
					'RESPONSAVEL' => $row['RESPONSAVEL'],
					'MODELO' => $row['MODELO'],
					'EMAIL' => $row['EMAIL'],
					'SERIAL' => $row['SERIAL'],
					'IMEI' => $row['IMEI'],
					'STATUS' => $row['STATUS'],
					'CHIP' => $row['CHIP'],
					'OBS' => $row['OBS'],
					'PART_NUMBER' => $row['PART_NUMBER']
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


	public function list($post)
	{

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$filt_transportadora = @$post['filt_transportadora'];

			$list = [];
			$sql = "
			  select
			   IMEI,
			   RESPONSAVEL, 
			   ID,
			   MODELO,
			   EMAIL,
			   SERIAL,
			   STATUS,
			   CHIP,
			   OBS,
			   PART_NUMBER
			  from IPADS
			  WHERE 1=1
			";
			if (!empty($filt_transportadora)) {
				$sql .= "and ID  like = :filt_transportadora
			  or NUMERO_FRENTE  like = :filt_transportadora
			  or RESPONSAVEL  like = :filt_transportadora
			  or EMAIL  like = :filt_transportadora
			  or NUMERO_LINHA  like = :filt_transportadora
			  or CONTA  like = :filt_transportadora
			  or CHIP  like = :filt_transportadora
			  or IMEI  like = :filt_transportadora
			  or OBS  like = :filt_transportadora
			  or STATUS  like = :filt_transportadora";
			}


			$sql .= " ORDER BY RESPONSAVEL";

			$stmt = $conn->prepare($sql);

			if (!empty($filt_transportadora)) {
				$stmt->bindParam(':filt_transportadora', $filt_transportadora);
			}
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$list[] = [
					'ID' => $row['ID'],
					'MODELO' => $row['MODELO'],
					'EMAIL' => $row['EMAIL'],
					'SERIAL' => $row['SERIAL'],
					'STATUS' => $row['STATUS'],
					'RESPONSAVEL' => $row['RESPONSAVEL'],
					'IMEI' => $row['IMEI'],
					'CHIP' => $row['CHIP'],
					'OBS' => $row['OBS'],
					'PART_NUMBER' => $row['PART_NUMBER'],
				];
			}

			$log = [
				'level' => 'INFO',
				'msg' => '',
				'list' => $list
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
				     set MODELO = :MODELO,
					   PART_NUMBER = :PART_NUMBER,
				       EMAIL = :EMAIL,
				       SERIAL = :SERIAL,				         
				       IMEI = :IMEI,				         
				       STATUS = :STATUS,		         		         
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
			        MODELO,
			  		EMAIL,
			  		IMEI,
			  		SERIAL,
			  		STATUS,
			  		RESPONSAVEL,
			  		CHIP,
			  		OBS,
			  		PART_NUMBER
			      ) values (
                  :MODELO,
				  :EMAIL,
				  :IMEI,
				  :SERIAL,
				  :STATUS,
				  :RESPONSAVEL,
				  :CHIP,
				  :OBS,
				  :PART_NUMBER
			      )";
				$stmt = $conn->prepare($sql);

				$stmt->bindParam(':MODELO', $data['modelo']);
				$stmt->bindParam(':EMAIL', $data['email']);
				$stmt->bindParam(':SERIAL', $data['serial']);
				$stmt->bindParam(':STATUS', $data['status']);
				$stmt->bindParam(':IMEI', $data['imei']);
				$stmt->bindParam(':RESPONSAVEL', $data['responsavel']);
				$stmt->bindParam(':CHIP', $data['chip']);
				$stmt->bindParam(':OBS', $data['obs']);
				$stmt->bindParam(':PART_NUMBER', $data['part_number']);
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
			 	     set MODELO = :modelo,
			 		  PART_NUMBER = :part_number,
			 	      EMAIL = :email,
				      IMEI = :imei,
				      SERIAL = :serial,				         
			 	      STATUS = :status,			         		         
			 	      CHIP = :chip,			         		         
			 	      OBS = :obs,			         		         
			 	      RESPONSAVEL = :responsavel 				         
			 	   where ID = :ID
			 	";
			 	$stmt = $conn->prepare($sql);
				$stmt->bindParam(':ID', $data['id']);
			 	$stmt->bindParam(':MODELO', $data['modelo']);
			 	$stmt->bindParam(':EMAIL', $data['email']);
			 	$stmt->bindParam(':IMEI', $data['imei']);
			 	$stmt->bindParam(':SERIAL', $data['serial']);
				$stmt->bindParam(':PART_NUMBER', $data['part_number']);
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
			 }
			if(isset($data['responsavel'])){
				$sql = "
				update IPADS
				set STATUS = 'EM USO'
				where ID = :ID
				";
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
			  MODELO,
			  EMAIL,
			  SERIAL,
			  IMEI,
			  STATUS,
			  RESPONSAVEL,
			  CHIP,
			  OBS,
			  PART_NUMBER
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
		delete from IPADS
		where ID = :id
      	";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $data['id']);
			$stmt->execute();

			$log = [
				'level' => 'INFO',
				'msg' => 'Usuário: id=' . $data['id'] . ' excluido.'
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

	public function desliga($data)
	{

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$sql1 = "
			begin 
     			insert into DESLIGADOS(nome_usua,email,serial,imei,chip,obs) select responsavel,email,serial,imei,chip,obs from IPADS where ID = :id;
    			 update IPADS set status = 'ESTOQUE' where ID = :id;
     			 update IPADS set responsavel = null, email = null  where ID = :id;
				 update IPADS set STATUS_DO_CHIP = 	'INSTALADO EM IPAD' where ID = :id;
			end;
			";
			$stmt = $conn->prepare($sql1);
			$stmt->bindParam(':id', $data['id']);
			$stmt->execute();

			$log = [
				'level' => 'INFO',
				'msg' => 'Usuário: id=' . $data['id'] . ' desligado.'
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

	public function atribui($data)
	{

		try {
			$conn = $this->ConnectionOracleIPads->conn();

			$sql2 = "
			update IPADS
			   set 
			     EMAIL = :email,
			     RESPONSAVEL = :responsavel,
				 STATUS = 'EM USO',	
				 STATUS_DO_CHIP = 'EM USO'
			 where ID = :ID
		    ";
			// $sql2 = "
			// begin
			// 	update IPADS set STATUS = 'EM USO' where ID = :id;
			// 	update IPADS set STATUS_DO_CHIP = 'EM USO' where ID = :id;
			// 	update IPADS set RESPONSAVEL = :responsavel where ID = :id; 
			// 	update IPADS set EMAIL = :email where ID = :id; 
			// end;
			// ";

			$stmt = $conn->prepare($sql2);
			$stmt->bindParam(':id', $data['id']);
			$stmt->bindParam(':email', $data['email']);
			$stmt->bindParam(':responsavel', $data['responsavel']);
			$stmt->execute();

			$log = [
				'level' => 'INFO',
				'msg' => 'Usuário: id=' . $data['id'] . ' atribuido.'
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


