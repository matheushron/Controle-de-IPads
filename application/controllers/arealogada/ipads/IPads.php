<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IPads extends CI_Controller
{

    private $logged;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->logged = $this->session->userdata('logged');
        $this->load->model('ipads/IPads_model');
        $this->load->model('ipads/Contagem_model');
        $this->load->model('Log');
    }

    public function index()
    {
        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(200, $_SESSION['transacao']) || in_array(201, $_SESSION['transacao'])) {

                $listTransportadora = $this->IPads_model->listAtribuicao();
                $Status = new Contagem_model();

                $data = [
                    
                    'listTransportadora' => $listTransportadora['list'],

                    'point' => [
                        $Status->countEmUso()['EMUSO'],
                        $Status->countEstoque()['ESTOQUE'],
                        $Status->countTransito()['TRANSITO'],
                        $Status->countRoubado()['ROUBADO'],
                        $Status->countPerdido()['PERDIDO'],
                        $Status->countInterno()['INTERNO']
                    ]

                ];

                $this->load->view('arealogada/ipads/ipads', $data);
                $this->Log->appendLog(['level' => 'VIEW']);
            } else {
                redirect(base_url() . 'arealogada/principal');
            }
        } else {
            redirect(base_url() . 'login');
        }
    }
    
    public function insert(){

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

                if ($ret['err'] == true) {
                    echo json_encode($ret);
                    exit();
                }
                if(isset($responsavel) || isset($email)){
                    $update = $this->IPads_model->update([
                        'status' => 'EM USO',
                    ]);
                }

                if (isset($id)) {

                    $update = $this->IPads_model->update([
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

                    $insert = $this->IPads_model->insert([
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

            $getRegister = $this->IPads_model->getRegister(['id' => $id]);
            echo json_encode($getRegister);
        } else {
            redirect(base_url() . 'login');
        }
    }


    public function deleteApont()
    {

        if ($this->logged) {

            $id = $this->input->post('id');

            echo json_encode($this->IPads_model->delete(['id' => $id]));
        } else {
            redirect(base_url() . 'login');
        }
    }


    public function desliga(){
        if ($this->logged){
            $id = $this->input->post('id');

            echo json_encode($this->IPads_model->desliga(['id' => $id]));
        }else{
            redirect(base_url() . 'login');
        }
    }

    public function atribui(){
        if ($this->logged){
            $data = [
                'id' => $this->input->post('id'),
                'email' => $this->input->post('email'),
                'responsavel' => $this->input->post('responsavel')
            ];
            // $id = $this->input->post('id');
            // $email = $this->input->post('email');
            // $responsavel = $this->input->post('responsavel');

            echo json_encode($this->IPads_model->atribui($data));

        }else{
            redirect(base_url() . 'login');
        }
    }

}
