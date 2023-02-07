<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desligados_model extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->model('ConnectionOraclePDO');
		$this->load->model('ConnectionOracleIPads');
		$this->load->model('Log');
	}

    //um array que dá erro no topo da página 
	public function listAtribuição(){

	  try {
	  	$conn = $this->ConnectionOracleIPads->conn();	  	
        
        $listAtribuicao = [];
	  	$sql = "
	  	  	select 
			ID,
            NOME_USUA,
            EMAIL,
			SERIAL,
			IMEI,
			CHIP
			  from DESLIGADOS
	  	  	ORDER BY NOME_USUA
	  	";
	  	$stmt = $conn->prepare($sql);
	  	$stmt->execute();
		foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
				$listAtribuicao[] = [
					'NOME_USUA' => $row['NOME_USUA'],
					'EMAIL' => $row['EMAIL'],
					'SERIAL' => $row['SERIAL'],
					'IMEI' => $row['IMEI'],
					'CHIP' => $row['CHIP'],
					'ID' => $row['ID']

				];
			}

        $log = [
		  'level' => 'INFO',
		  'msg' => '',
		  'list' => $listAtribuicao
		];

	  } catch (Exception $e){

        $log = [
		  'level' => 'ERROR',
		  'msg' => $e->getMessage(),
		  'list' => $listAtribuicao
		];	  	

	  }

      return $log;

	}
	//fim do array

	public function tabela($post){

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$filt_transportadora = @$post['filt_transportadora'];			
			
			$tabela = [];
			$sql = "
			select 
			ID,
			NOME_USUA,
			EMAIL,
			SERIAL,
			IMEI,
			CHIP
			  from DESLIGADOS
			  WHERE 1=1
			";
			if(!empty($filt_transportadora)){			  
              $sql .="and NOME_USUA  like = :filt_transportadora
              and EMAIL  like = :filt_transportadora
              and SERIAL  like = :filt_transportadora
              and IMEI  like = :filt_transportadora
              and CHIP  like = :filt_transportadora
			  or ID  like = :filt_transportadora";
			}
			
			$sql .= " ORDER BY NOME_USUA ";

			$stmt = $conn->prepare($sql);

			if(!empty($filt_transportadora)){
		      $stmt->bindParam(':filt_transportadora', $filt_transportadora);
			}			
			$stmt->execute();
			foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
				$tabela[] = [
					'NOME_USUA' => $row['NOME_USUA'],
					'EMAIL' => $row['EMAIL'],
					'SERIAL' => $row['SERIAL'],
					'CHIP' => $row['CHIP'],
					'IMEI' => $row['IMEI'],
					'ID' => $row['ID']
				];
			}

			$log = [
			  'level' => 'INFO',
			  'msg' => '',
			  'tabela' => $tabela
			];

			return $log;

		} catch (Exception $e){

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage(),
				'list' => []
			];

			$this->Log->appendLog($log);	

			return $log;

		}

	}

	//  public function update($data){
	// 	try{
	// 		$conn = $this->ConnectionOracleIPads->conn();

	// 		if($data['nome_usua'] ==null && $data['email'] == null){
					
	// 			$sql = "
	// 			update DESLIGADOS
	// 			   NOME_USUA.
    //                EMAIL,
	// 			   SERIAL	         
	// 			 where ID = :ID
	// 		  ";
	// 		  $stmt = $conn->prepare($sql);
	// 		  $stmt->bindParam(':NOME_USUA', $data['nome_usua']);
	// 		  $stmt->bindParam(':EMAIL', $data['email']);
	// 		  $stmt->bindParam(':SERIAL', $data['serial']);
	// 		  $stmt->bindParam(':ID', $data['id']);
	// 		  $stmt->execute();
	// 		  $log = [
	// 			  'level' => 'INFO',
	// 			  'msg' => 'Alterado.',
	// 			  'dados' => $data
	// 		  ];

	// 		  $this->Log->appendLog($log);

	// 		  return $log;

	// 		}
	// 	}catch(Exception $e){
	// 		$log = [
	// 			'level' => 'ERROR',
	// 			'msg' => $e->getMessage(),
	// 			'dados' => $data
	// 		];

	// 		$this->Log->appendLog($log);	

	// 		return $log;
	// 	}
	//  }

	// public function insert($data){

	// 	try {

	// 		$conn = $this->ConnectionOracleIPads->conn();

	// 		if(empty($data['id'])){

    //             $sql = "
	// 		  	  insert into IPADS (
	// 		        NOME_USUA,
	// 		        ID,
	// 		  		EMAIL,
	// 				SERIAL
	// 		      ) values (
    //               :NOME_USUA,
	// 			  :EMAIL,
	// 			  :SERIAL,
	// 			  :ID
	// 		      )";
	// 		    $stmt = $conn->prepare($sql);
			    
	// 		    $stmt->bindParam(':NOME_USUA', $data['nome_usua']);
	// 		    $stmt->bindParam(':EMAIL', $data['email']);       
	// 		    $stmt->bindParam(':SERIAL', $data['serial']);       
	// 		    $stmt->bindParam(':ID', $data['id']);    
	// 		    $stmt->execute();
	// 		    $log = [
	// 		    	'level' => 'INFO',
	// 		    	'msg' => 'Incluído.',
	// 		    	'dados' => $data
	// 		    ];

	// 		    $this->Log->appendLog($log);

	// 		    return $log;
	// 		} else {

	// 			$sql = "
	// 			  update IPADS
	// 			     set NOME_USUA =:nome_usua,
	// 			     EMAIL = :email,
	// 				 SERIAL = :serial		         
	// 			   where id = :id
	// 			";
	// 		    $stmt = $conn->prepare($sql);
	// 		    $stmt->bindParam(':id', $data['id']);
	// 		    $stmt->bindParam(':nome_usua', $data['nome_usua']);
	// 		    $stmt->bindParam(':email', $data['email']);
			   
	// 		    $stmt->execute();

	// 		    $log = [
	// 		    	'level' => 'INFO',
	// 		    	'msg' => 'Alterado.',
	// 		    	'dados' => $data
	// 		    ];

	// 		    $this->Log->appendLog($log);

	// 		    return $log;

	// 		}


	// 	} catch (Exception $e){

	// 		$log = [
	// 			'level' => 'ERROR',
	// 			'msg' => $e->getMessage(),
	// 			'dados' => $data
	// 		];

	// 		$this->Log->appendLog($log);	

	// 		return $log;

	// 	}

	// }

	public function getRegister($data){

		try {

			$conn = $this->ConnectionOracleIPads->conn();

			$sql = "
			select 
			NOME_USUA,
			ID,
			EMAIL,
			SERIAL
			  from DESLIGADOS
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

		} catch (Exception $e){

			$log = [
				'level' => 'ERROR',
				'msg' => $e->getMessage()
			];

			$this->Log->appendLog($log);

			return $log;

		}

	}

	public function delete($data){

      try {

      	$conn = $this->ConnectionOracleIPads->conn();

      	$sql = "
      	  DELETE FROM DESLIGADOS
		  WHERE ID = :id
      	";
      	$stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();        

      	$log = [
          'level' => 'INFO',
          'msg' => 'Usuario: id=' . $data['id'] . ' excluido.'
      	];
      	$this->Log->appendLog($log);

      	return $log;

      } catch (Exception $e){

      	$log = [
      		'level' => 'ERROR',
      		'msg' => $e->getMessage()
      	];
      	$this->Log->appendLog($log);
      	return $log;

      }

	}


}