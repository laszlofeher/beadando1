<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('auser'));
    }


    public function index()
    {
        $output = [];
        if($this->session->has_userdata('user')){
            $output['username'] = $this->session->get_userdata('user')['user']['utonev'];
            
            $this->load->view('home', $output);
        }else{
            $this->load->view('login');
        }
    }
    
    
    public function login(){
        $this->form_validation->set_rules('username', 'Felhasználónév', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Jelszó', 'required|callback_usercheck');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('Home/index');
        }
    }
    
    public function logout(){
        $this->session->unset_userdata('user');
        redirect('Home/index');
    }
    
    public function usercheck(){
        $email = $this->input->post('username');
        $password = $this->input->post('password');
        $userdata = $this->auser->getUserByEmailPassword($email, $password);
        if(count($userdata) === 0){
            $this->form_validation->set_message('usercheck', 'Hibás felhasználónév vagy jelszó!');
            $this->form_validation->set_message('password', 'Hibás bejelentkezés, kérem elenőrizze a jelszavát!');
            return false;
        }
        else{
            $this->session->set_userdata('user', $userdata);
            return true;
        }
    }
    
}
