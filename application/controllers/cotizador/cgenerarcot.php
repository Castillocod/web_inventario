<?php 
require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class cgenerarcot extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cotizador/mgenerarcot');
    }

    public function index()
    {
        $this->data['tipoclientes'] = $this->mgenerarcot->obtenertc() ?? [];
        $this->data['almacen_productos'] = $this->mgenerarcot->almacen_productos() ?? [];

        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('cotizador/vgenerarcot', $this->data);
        $this->load->view('layouts/footer');
    }

    public function obtenerclientesxtp()
    {
        $tc_cliente = $this->input->post('tc_cliente');
        $tipocliente_ls = $this->input->post('tipocliente_ls');

        $clientes = $this->mgenerarcot->obtenerclientesxtp($tc_cliente, $tipocliente_ls);

        echo json_encode($clientes);
    }

    public function obtenerprodxcl()
    {
        $productos = $this->mgenerarcot->obtenerprodxcl();
        echo json_encode($productos);
    }

    public function buscarxcod()
    {
        $buscar = $this->input->post('buscar_prod');
        $resultado = $this->mgenerarcot->buscarxcod($buscar);
        echo json_encode($resultado);
    }

    public function obtenertotalclientes()
    {
        $tc_cliente = $this->input->post('tc_cliente');
        $cliente_prod = $this->input->post('cliente_prod');

        $sel_prod = array(
            'modelo' => $this->input->post('sel_prod'),
            'id' => $this->input->post('sel_prod')
        );

        $totalclientes = $this->mgenerarcot->obtenertotalclientes($tc_cliente, $cliente_prod);
        $totalproductos = $this->mgenerarcot->obtenerproductos($sel_prod);
        $formulas = $this->mgenerarcot->formulas();

        $variosdatos = array(
            'clientes_totalclientes' => $totalclientes,
            'almacen_productos' => $totalproductos,
            'cotizador_formulas' => $formulas
        );

        echo json_encode($variosdatos);
    }

    public function formulas()
    {
        $formulas = $this->mgenerarcot->formulas();
        echo json_encode($formulas);
    }

    public function crearcotizacion($datos_tabla)
    {
        $datospdf['datos_tabla'] = $datos_tabla;
        echo 'Datos PDF:'.$datospdf['datos_tabla'];
        $html = $this->load->view('cotizador/plantillas_pdf/crearcotizacion', $datospdf, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetTitle('');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
?>