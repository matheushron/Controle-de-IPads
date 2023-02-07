<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atribuicao extends CI_Controller
{

    private $logged;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->logged = $this->session->userdata('logged');
        $this->load->model('ipads/Atribuicao_model');
        $this->load->model('Log');
    }
    
    public function index(){
        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(200, $_SESSION['transacao']) || in_array(201, $_SESSION['transacao'])) {

                $listAtribuição = $this->Atribuicao_model->listAtribuição();
                $listEstoque = $this->Atribuicao_model->listSerial();

                $data = [
                    'tabela' => $listAtribuição['list'],
                    'listEstoque' => $listEstoque['list']
                ];

                $this->load->view('arealogada/ipads/atribuicao', $data);
                $this->Log->appendLog(['level' => 'VIEW']);
            } else {
                redirect(base_url() . 'arealogada/principal');
            }
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function insert()
    {

        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(1, $_SESSION['transacao'])) {

                $id = $this->input->post('id') ?  $id = $this->input->post('id') : null;
                $responsavel = $this->input->post('responsavel');
                $status = $this->input->post('status');
                $modelo = $this->input->post('modelo');
                $part_number = $this->input->post('part_number');
                $imei = $this->input->post('imei');
                $serial = $this->input->post('serial');
                $obs = $this->input->post('obs');
                $email = $this->input->post('email');
                $chip = $this->input->post('chip');
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

                    $update = $this->Atribuicao_model->update([
                        'id' => $id,
                        'responsavel' => $responsavel,
                        'imei' => $imei,
                        'status' => $status,
                        'modelo' => $modelo,
                        'part_number' => $part_number,
                        'obs' => $obs,
                        'serial' => $serial,
                        'chip' => $chip,
                        'email' => $email
                    ]);

                    echo json_encode($update);

                } else {

                    $insert = $this->Atribuicao_model->insert([
                        'responsavel' => $responsavel,
                        'status' => $status,
                        'modelo' => $modelo,
                        'part_number' => $part_number,
                        'obs' => $obs,
                        'serial' => $serial,
                        'imei' => $imei,
                        'chip' => $chip,
                        'email' => $email
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

            $id = $this->input->post('id');

            $getRegister = $this->Atribuicao_model->getRegister(['id' => $id]);
            echo json_encode($getRegister);
        } else {
            redirect(base_url() . 'login');
        }
    }


    public function deleteApont()
    {

        if ($this->logged) {

            $id = $this->input->post('id');

            echo json_encode($this->Atribuicao_model->delete(['id' => $id]));
        } else {

            redirect(base_url() . 'login');
        }
    }


}