<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        
        $this->load->model('geral_model');
        $data['geral'] = $this->geral_model->totalSMS();
        $this->load->view('home', $data);
    }

}