<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model {

  public function __construct(){
  	parent::__construct();

  	$this->load->model('ConnectionOraclePDO');
  	$this->load->model('ConnectionOraclePDOWebdb');
  	$this->load->model('caminhoes/CaminhoesModel');
  	$this->load->model('Log');
  }

  public function sincUsuarios(){

    try {

      $connWebdb = $this->ConnectionOraclePDOWebdb->conn();
      $conn = $this->ConnectionOraclePDO->conn();

      $sql = "
        select usua.nome_usua_uspo, 
               trim(usua.email_usua_uspo) email_usua_uspo, 
               usua.id_re,
               depto.sigla_depto,
               usua.sta_usua_uspo
          from usua_uspo usua
            left join depto_ti depto on (usua.cd_depto = depto.cd_depto)
         where usua.tipo_usua_uspo <> 'R'
           and trim(usua.email_usua_uspo) <> '@'
      ";
      $stmt = $connWebdb->prepare($sql);
      $stmt->execute();
      $list = [];
      foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        
        // Get ID user if exists ---
        $sql = "
          select id_usua
            from usuario
           where email_usua like :email_usua
        ";
        $stmt_usua = $conn->prepare($sql);
        $stmt_usua->bindParam(':email_usua', $row['EMAIL_USUA_USPO']);
        $stmt_usua->execute();
        $row_usua = $stmt_usua->fetch(PDO::FETCH_ASSOC);
        $id = @$row_usua['ID_USUA'];
        // Get ID user if exists ---

        if(empty($id)){

          if($row['STA_USUA_USPO'] == 9){
          	continue;
          }

          $sql = "
            select max(id_usua)+1 next_id
              from usuario
          ";
          $stmt_usua = $conn->prepare($sql);
          $stmt_usua->execute();
          $row_usua = $stmt_usua->fetch(PDO::FETCH_ASSOC);
          $next_id = $row_usua['NEXT_ID'];

          $senha_usua = md5(str_shuffle('m@rjaN'));

          $sql = "
            insert into usuario (
              nome_usua,
              senha_usua,
              email_usua,
              id_sitc,
              id_modulo,
              id_re
            ) values (
              :nome_usua,
              :senha_usua,
              :email_usua,
              1,
              :id_modulo,
              :id_re
            )
          ";
          $stmt = $conn->prepare($sql);
          //$stmt->bindParam(':id_usua', $next_id);
          $stmt->bindParam(':nome_usua', $row['NOME_USUA_USPO']);
          $stmt->bindParam(':senha_usua', $senha_usua);
          $stmt->bindParam(':email_usua', $row['EMAIL_USUA_USPO']);
          $stmt->bindParam(':id_modulo', $row['SIGLA_DEPTO']);
          $stmt->bindParam(':id_re', $row['ID_RE']);
          $stmt->execute();

        } else {

          $id_sitc = ($row['STA_USUA_USPO'] == 9 ? 2 : 1);

          $sql = "
            update usuario
               set nome_usua = :nome_usua,
                   email_usua = :email_usua,
                   id_sitc = :id_sitc,
                   id_modulo = :id_modulo,
                   id_re = :id_re
             where id_usua = :id_usua
          ";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':nome_usua', $row['NOME_USUA_USPO']);
          $stmt->bindParam(':email_usua', $row['EMAIL_USUA_USPO']);
          $stmt->bindParam(':id_sitc', $id_sitc);
          $stmt->bindParam(':id_modulo', $row['SIGLA_DEPTO']);
          $stmt->bindParam(':id_re', $row['ID_RE']);
          $stmt->bindParam(':id_usua', $id);
          $stmt->execute();

        }
        
      }

      $log = [
      	'level' => 'INFO',
      	'msg' => 'Sincronizado.',
      	'list' => $list
      ];
      $this->Log->appendLog($log);
      return $log;

    } catch (Exception $e){

      $log = [
      	'level' => 'ERROR',
      	'msg' => $e->getMessage() . ":" . $e
      ];
      $this->Log->appendLog($log);
      return $log;

    }

  }

  public function sincFileApData(){

    try {

      $path = 'H:\\\\';
      $listFiles = [];

      foreach (glob($path) as $file) {
        $listFiles[] = $file; 
      }

      $log = [
        'level' => 'INFO',
        'msg' => 'teste sincFileApData',
        'list' => $listFiles
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

  public function deleteUser($data){

    try {

      $sql = "  
      ";

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