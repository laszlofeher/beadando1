<?php
/**
 * Description of Bookimport
 *
 * @author feherlaszlo
 */
class Bookimport extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
        $this->load->library(array('Excel'));
    }
    
    public function index(){
        $output = [];
        $output['page']         = 'bookimport';
        $output['username']     = $this->session->get_userdata('user')['user']['utonev'];
        $this->load->view('home', $output);
    }   
    
    public function upload(){
        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'xlsx';
        $config['max_size']             = 1000;

        $this->load->library('upload', $config);
        $output['page']         = 'bookimport';
        
        if ( ! $this->upload->do_upload('xlsxfile'))
        {
                $output['error'] = array('error' => $this->upload->display_errors());
                $this->load->view('home', $output);
        }
        else
        {
                $output['data']  = array('upload_data' => $this->upload->data());
                $this->session->set_userdata('xlsxfile', 'assets\uploads\\'.$output['data']['upload_data']['file_name']);
                
                $this->load->view('home', $output);
                
        }
    }
    
    public function importExcel(){
        if($this->session->has_userdata('xlsxfile')){
            $xlsxfile = $this->session->get_userdata('xlsxfile')['xlsxfile'];
            
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($xlsxfile);
            $rowIterator = $spreadsheet->getActiveSheet()->getRowIterator();
            foreach ($rowIterator as $row) {
                $cellIterator = $row->getCellIterator();
                foreach ($cellIterator as $cell) {
                    $data[$row->getRowIndex()][$cell->getColumn()] = $cell->getCalculatedValue();
                }
            }
            print('<pre>');
            var_dump($data);
            print('</pre>');
            exit();
        }
    }
}
