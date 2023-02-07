<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

	public function index(){
		$this->load->view('login');
	}
	
	public function logout(){
	    $this->session->sess_destroy();
	    redirect(base_url().'login');
	}
}
