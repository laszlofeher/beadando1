<?php

/**
 * Description of Author
 *
 * @author feherlaszlo
 */
class Author extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('authormodel'));
    }
    
    public function index(){
        if($this->session->has_userdata('user')){
            $output = [];
            $output['page']         = 'author';
            $output['username']     = $this->session->get_userdata('user')['user']['utonev'];
            $this->load->view('home', $output);
        }else{
            $this->load->view('login');
        }
    }
    
    public function authors(){
        if($this->session->has_userdata('user')){
            print(json_encode(['data' =>$this->authormodel->getAllAuthors()], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }
    
    public function save() {
        if($this->session->has_userdata('user')){
            $this->form_validation->set_rules('vezeteknev', 'Vezetéknév', array('required','regex_match[/^([a-zA-ZűáéúőóüöíŰÁÉÚŐÓÜÖÍ]{3,})$/]'));
            $this->form_validation->set_rules('utonev', 'Utónév', array('required','regex_match[/^([a-zA-ZűáéúőóüöíŰÁÉÚŐÓÜÖÍ]{3,})$/]'));
            $this->form_validation->set_rules('titulus', 'Titulus', array('regex_match[/^([a-zA-ZűáéúőóüöíŰÁÉÚŐÓÜÖÍ]{2,})$/]'));
            if ($this->form_validation->run() !== FALSE)
            {
                $id         = (int)$this->input->post('id');
                $titulus    = $this->input->post('titulus');
                $vezeteknev = $this->input->post('vezeteknev');
                $utonev     = $this->input->post('utonev');
                if($id === 0){
                    $this->authormodel->insertAuthor($titulus, $vezeteknev, $utonev);
                }else{
                    $this->authormodel->updateAuthor($id, $titulus, $vezeteknev, $utonev);
                }
                print(json_encode(['error' => 0]));
            }else{
                print(json_encode(['error' => 1, 'errorMessage' => validation_errors()]));
            }
        }
    }
    
    public function delete(){
        if($this->session->has_userdata('user')){
            $id = (int)$this->input->post('id');
            $this->authormodel->deleteAuthor($id);
            print(json_encode(['error' => 0]));
        }
    }
}
