<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        session_start();
        //$this->load->library('phplot');
        $this->load->model('geral_model');
    }

    public function index() {
        if (isset($_SESSION['idusuario'])) {
            $data['usuario'] = $_SESSION['login'];
            $data['data'] = $this->geral_model->translateMonth(date('m'));
            $data['total_geral'] = $this->geral_model->totalSMS();
            $data['total_mes'] = $this->geral_model->totalSMSmes();
            $data['total_operadora'] = $this->geral_model->totalSMScarrier();
            $data['total_pc'] = $this->geral_model->totalSMSpc(4);

            $this->load->view('home_view', $data);
        } else {
            redirect('login');
        }
    }
}