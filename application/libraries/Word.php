<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/vendor/autoload.php"; 

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class Word extends PhpWord { 
    public function __construct() { 
        parent::__construct(); 
    }
}
?>
