<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chips extends CI_Controller
{

    private $logged;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->logged = $this->session->userdata('logged');
        $this->load->model('chips/Chips_model');
        $this->load->model('chips/ChipsC_model');
        $this->load->model('Log');
    }

    public function index()
    {
        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(200, $_SESSION['transacao']) || in_array(201, $_SESSION['transacao'])) {

                $listChips = $this->Chips_model->listChips();
                $status = new ChipsC_model();

                $data = [
                    'tabelaChip' => $listChips['list'],
                    
                    'point' => [
                        $status->countEmUso()['EMUSO'],
                        $status->countEstoque()['ESTOQUE'],
                        $status->countInstalado()['INSTALADO'],
                        $status->countTransito()['TRANSITO'],
                        $status->countRoubado()['ROUBADO'],
                        $status->countPerdido()['PERDIDO'],
                        $status->countInterno()['INTERNO'],
                    ]

                ];

                $this->load->view('arealogada/chips/chips', $data);
                $this->Log->appendLog(['level' => 'VIEW']);
            } else {
                redirect(base_url() . 'arealogada/principal');
            }
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function tabelaChip()
    {

        if ($this->logged) {

            $tabelaChip = $this->Chips_model->tabelaChip($this->input->post());

            $this->load->view('arealogada/chips/tabelaChip', $tabelaChip);
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function insert()
    {

        if ($this->logged) {
            if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT']) || in_array(1, $_SESSION['transacao'])) {

                $id = $this->input->post('id') ?  $id = $this->input->post('id') : null;
                $status_do_chip = $this->input->post('status_do_chip');
                $linha_do_chip = $this->input->post('linha_do_chip');
                $chip = $this->input->post('chip');
                $conta_do_chip = $this->input->post('conta_do_chip');
                $serial = $this->input->post('serial');
                $ret = [
                    "field" => "",
                    "msg" => "",
                    "err" => ""
                ];

                if ($ret['err'] == true) {
                    echo json_encode($ret);
                    exit();
                }

                if (isset($id)) {

                    $update = $this->Chips_model->update([
                        'id' => $id,
                        'status_do_chip' => $status_do_chip,
                        'linha_do_chip' => $linha_do_chip,
                        'chip' => $chip,
                        'conta_do_chip' => $conta_do_chip,
                        'serial' => $serial
                    ]);

                    echo json_encode($update);
                } else {

                    $insert = $this->Chips_model->insert([
                        'status_do_chip' => $status_do_chip,
                        'linha_do_chip' => $linha_do_chip,
                        'conta_do_chip' => $conta_do_chip,
                        'serial' => $serial,
                        'chip' => $chip
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

            $getRegister = $this->Chips_model->getRegister(['id' => $id]);
            echo json_encode($getRegister);
        } else {
            redirect(base_url() . 'login');
        }
    }


    public function deleteApont()
    {

        if ($this->logged) {

            $id = $this->input->post('id');

            echo json_encode($this->Chips_model->delete(['id' => $id]));
        } else {

            redirect(base_url() . 'login');
        }
    }
}
