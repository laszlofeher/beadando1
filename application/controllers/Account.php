<?php

/**
 * Description of Account
 *
 * @author feherlaszlo
 */
class Account extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('auser'));
    }
    
    public function index(){
        $output = [];
        $output['page']         = 'account';
        $output['username']     = $this->session->get_userdata('user')['user']['utonev'];
        $output['userdetails']  = $this->auser->getUserById($this->session->get_userdata('user')['user']['id']);
        
        $this->load->view('home', $output);
    }
    
    public function save(){
        $this->form_validation->set_rules('vezeteknev', 'Vezetéknév', array('required','regex_match[/^([a-zA-ZűáéúőóüöíŰÁÉÚŐÓÜÖÍ]{3,})$/]'));
        $this->form_validation->set_rules('utonev', 'Utónév', array('required','regex_match[/^([a-zA-ZűáéúőóüöíŰÁÉÚŐÓÜÖÍ]{3,})$/]'));
        
        $this->form_validation->set_rules('rjelszo', 'Régi jelszó', 'trim');
        $this->form_validation->set_rules('ujelszo1', 'Új jelszó', 'trim');
        $this->form_validation->set_rules('ujelszo2', 'Új jelszó mégegyszer', 'trim|matches[ujelszo1]');
        
        if ($this->form_validation->run() === FALSE)
        {
            $output = [];
            $output['page']         = 'account';
            $output['username']     = $this->session->get_userdata('user')['user']['utonev'];
            $output['userdetails']  = $this->auser->getUserById($this->session->get_userdata('user')['user']['id']);
            $this->load->view('home', $output);
            
        }
        else
        {
            $vezeteknev     = $this->input->post('vezeteknev');
            $utonev         = $this->input->post('utonev');
            $rjelszo        = $this->input->post('rjelszo');
            $ujelszo1       = $this->input->post('ujelszo1');
            $ujelszo2       = $this->input->post('ujelszo2');
            
            if(strlen($rjelszo) > 0 && strlen($ujelszo1) > 0){
                $email = $this->session->get_userdata('user')['user']['email'];
                $userdata = $this->auser->getUserByEmailPassword($email, $rjelszo);
                if(count($userdata) > 0){
                    $id = $this->session->get_userdata('user')['user']['id'];
                    $data['vezeteknev'] = $vezeteknev;
                    $data['utonev']    = $utonev;
                    $data['jelszo']    = hash('sha512', $ujelszo1);
                    $this->auser->update($id, $data);
                    redirect('Account/index');
                }else{
                    $output = [];
                    $output['page']         = 'account';
                    $output['username']     = $this->session->get_userdata('user')['user']['utonev'];
                    $output['userdetails']  = $this->auser->getUserById($this->session->get_userdata('user')['user']['id']);
                    $output['rjelszoerror'] = 'Hibás jelszó';
                    $this->load->view('home', $output);
                    
                }
            }else{
                $id = $this->session->get_userdata('user')['user']['id'];
                $data['vezeteknev'] = $vezeteknev;
                $data['utonev']    = $utonev;
                $this->auser->update($id, $data);
                redirect('Account/index');
            }
            
        }
    }
}
