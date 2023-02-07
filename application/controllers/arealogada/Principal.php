<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
    
    private $logged;
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->logged = $this->session->userdata('logged');
        $this->load->model('Log');
    }
    
    public function index(){
        if($this->logged){
            
            $this->load->view('arealogada/principal');
            $this->Log->appendLog(['level' => 'VIEW']);
        } else {
            redirect(base_url().'login');
        }
        
    }
    
}