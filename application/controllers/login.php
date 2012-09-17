<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login', 'Login', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
                 
        if($this->form_validation->run() != false){
            $this->load->model('login_model');
            $ret = $this->login_model->authUser($this->input->post('login'), $this->input->post('password'));
            if($ret != false){
                $_SESSION['idusuario'] = $ret->idusuario;
                $_SESSION['idempresa'] = $ret->idempresa;
                $_SESSION['login'] = $ret->login;
                $_SESSION['adm'] = $ret->adm;
                
                redirect('home');
            }
        }
        
        $this->load->view('login_view');
    }
    
    public function logout(){
        session_destroy();
        $this->load->view('login_view');
    }
}