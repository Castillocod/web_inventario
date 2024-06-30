<?php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';

class cmarcas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('almacen/mmarcas');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('almacen/vmarcas');
        $this->load->view('layouts/footer');
    }
}
?>