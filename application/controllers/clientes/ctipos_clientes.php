<?php
class ctipos_clientes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('clientes/mtipos_clientes');
        $this->load->model('clientes/mtotal_clientes');
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('clientes/vtipos_clientes');
        $this->load->view('layouts/footer');
    }
}
?>