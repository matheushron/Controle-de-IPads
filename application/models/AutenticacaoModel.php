<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AutenticacaoModel extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('ConnectionOraclePDO');
        $this->load->model('Log');
        
    }
    
    public function validar($params){
        

        try {
            $sql = "
                select *
                  from usuario
                 where email_usua = :email_usua
                   and senha_usua = :senha_usua
                   and id_sitc = 1
            ";

            // echo "
            //         select *
            //         from usuario
            //         where email_usua = '{$params['email']}'
            //         and senha_usua = '{$params['pass']}'
            //         and id_sitc = 1
            //     ";
            
            $conn = $this->ConnectionOraclePDO->conn();

            // var_dump(is_object($conn));

            if(!is_object($conn)){
                
              echo $conn;
              
              $this->Log->appendLog([
                'level' => 'ERROR',
                'msg' => $conn
              ]);
              return false;  
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email_usua', $params['email']);
            $stmt->bindParam(':senha_usua', $params['pass']);
            $stmt->execute();
            
            // var_dump($stmt->execute());

            $ft = $stmt->fetchAll();
                
            if(count($ft) > 0){
                
                $this->session->set_userdata([
                    'logged' => true,
                    'email' => $params['email'],
                    'id_usua' => $ft[0]['ID_USUA'],
                    'nome_usua' => $ft[0]['NOME_USUA'],
                    'id_modulo' => $ft[0]['ID_MODULO']
                ]);
                    
                $this->Log->appendLog([
                    'level' => 'INFO',
                    'msg' => 'Cadastrado',
                    'email' => $params['email']
                ]);
                    
                return true;
                
            } else {
                
                $this->Log->appendLog([
                    'level' => 'INFO',
                    'msg' => 'N�o Cadastrado',
                    'email' => $params['email']
                ]);
                
                return false;
                
            }
            
            
        } catch (PDOException $pdoe){
            $this->Log->appendLog([
                'level' => 'ERROR',
                'msg' => 'PDO:' . $pdoe->getMessage()
            ]);
            
            return false;
            
        } catch (Exception $e){
            $this->Log->appendLog([
                'level' => 'ERROR',
                'msg' => $e->getMessage()
            ]);
            
            return false;
        }
        
        
    }
    
}