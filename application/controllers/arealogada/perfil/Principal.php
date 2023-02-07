<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	private $logged;

	public function __construct(){
		parent::__construct();
		$this->logged = $this->session->userdata('logged');
		$this->load->helper('url');
		$this->load->model('perfil/PerfilModel', 'PerfilModel');
	}

	public function index(){
		if($this->logged){

			$data = $this->PerfilModel->getData();
			$this->load->view('arealogada/perfil/principal', $data);
			$this->Log->appendLog(['level' => 'VIEW']);
			
		} else {
			redirect(base_url().'login');
		}
	}

	public function setData(){
		if($this->logged){

			$passw = $this->input->post('passw');
			$id_usua = $_SESSION['id_usua'];

			$ret = [
				"field" => "",
				"msg" => "",
				"err" => ""
			];

			if(empty($passw)){
				$ret = [
					"field" => "senha_usua",
					"msg" => "Preencha a nova senha.",
					"err" => true
				];
			}

			if($ret['err'] == true){
				echo json_encode($ret);
			    exit();
			}
			
			$ret['msg'] = $this->PerfilModel->setData((object)[
				'senha_usua' => $passw, 
				'id_usua' => $id_usua
			]);

			$ret['err'] = false;

			echo json_encode($ret);

		} else {
			redirect(base_url().'login');
		}
	}

}