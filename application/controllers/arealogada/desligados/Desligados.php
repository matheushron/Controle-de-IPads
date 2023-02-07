<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Desligados extends CI_Controller
{

    private $logged;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->logged = $this->session->userdata('logged');
        $this->load->model('desligados/Desligados_model');
        $this->load->model('Log');
    }

    public function index(){
        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(200, $_SESSION['transacao']) || in_array(201, $_SESSION['transacao'])) {

                $listAtribuição = $this->Desligados_model->listAtribuição();

                $data = [
                    'tabela' => $listAtribuição['list'],
                ];

                $this->load->view('arealogada/desligados/desligados', $data);
                $this->Log->appendLog(['level' => 'VIEW']);
            } else {
                redirect(base_url() . 'arealogada/principal');
            }
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function tabela(){
       
        if($this->logged){

            $tabela = $this->Desligados_model->tabela($this->input->post());

            $this->load->view('arealogada/ipads/desligados',$tabela);
        } else {
            redirect(base_url().'login');
        }
    }

    public function insert()
    {

        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(1, $_SESSION['transacao'])) {

                $id = $this->input->post('id') ?  $id = $this->input->post('id') : null;
                $nome = $this->input->post('nome');
                $email = $this->input->post('email');
                $serial = $this->input->post('serial');
                $this->Log->appendLog(['serial'=>$this->input->post()]);              
                // echo $id;

                $ret = [
                    "field" => "",
                    "msg" => "",
                    "err" => ""
                ];


                if(empty($serial)){
                    $ret = [
                        "field" => "serial",
                        "msg" => "Informe o serial do equipamento.",
                        "err" => true
                    ];

                } 

                if ($ret['err'] == true) {
                    echo json_encode($ret);
                    exit();
                }

                if (isset($id)) {

                    $update = $this->Desligados_model->update([
                        'id' => $id,
                        'nome' => $nome,
                        'email' => $email,
                        'serial' => $serial,
                    ]);

                    echo json_encode($update);

                } else {

                    $insert = $this->Desligados_model->insert([
                        'nome' => $nome,
                        'email' => $email,
                    ]);
                    echo json_encode($insert);
                }
                
               
            } else {
                echo json_encode(['msg' => 'Sem acesso.']);
            }
        } else {
            echo json_encode(['msg' => 'Não autenticado.']);
        }
    }

    public function getRegister()
    {

        if ($this->logged) {

            $id = $this->input->post('ID');

            $getRegister = $this->Desligados_model->getRegister(['ID' => $id]);
            echo json_encode($getRegister);
        } else {
            redirect(base_url() . 'login');
        }
    }


    public function deleteApont()
    {

        if ($this->logged) {

            $id = $this->input->post('id');

            echo json_encode($this->Desligados_model->delete(['id' => $id]));
        } else {

            redirect(base_url() . 'login');
        }
    }
}
