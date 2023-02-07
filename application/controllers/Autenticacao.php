<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacao extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('AutenticacaoModel');
        $this->load->helper('url');
    }
    
    public function validar(){
        
        $email = $this->input->post('pEmail');
        $pass = md5($this->input->post('pPass'));
        
        //Adiciona dominio @marjanfarma.com.br caso não seja informado
        if(strpos($email, '@') === false){
            $email .= '@marjanfarma.com.br';
        }
        
        // var_dump($this->AutenticacaoModel->validar(['email' => $email, 'pass' => $pass]));

        if($this->AutenticacaoModel->validar(['email' => $email, 'pass' => $pass])){
            $ret = [
                'success' => 'true',
                'msg' => 'Usuário cadastrado'
            ];
        } else {
            $ret = [
                'success' => 'false',
                'msg' => 'Usuário/senha não cadastrados'
            ];
        }
        
        
        echo json_encode($ret);
        
    }
    
}