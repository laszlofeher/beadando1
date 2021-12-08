<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/vendor/autoload.php"; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel extends Spreadsheet { 
    public function __construct() { 
        parent::__construct(); 
    }
}
?>
