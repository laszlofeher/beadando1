<?php

/**
 * Description of Book
 *
 * @author feherlaszlo
 */
class Book extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }
    
    public function index(){
        $crud = new grocery_CRUD();
        $crud->set_theme('datatables');
        $crud->set_subject('Könyv');
        $crud->set_table('konyv');
        $crud->columns('cim','isbn');
        $crud->set_relation('kiado_id','kiado','nev');
        $output = [];
        $output = $crud->render();
        $output = (Array)$output;
        $output['page']         = 'book';
        $output['username']     = $this->session->get_userdata('user')['user']['utonev'];
        $this->load->view('home', $output);
    }
}
