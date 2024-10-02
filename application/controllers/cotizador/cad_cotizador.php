<?php 
require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class cad_cotizador extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cotizador/mad_cotizador');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['totalpendientes'] = $this->mad_cotizador->totalpendientes();
        $this->data['totalterminadas'] = $this->mad_cotizador->totalterminadas();
        $this->data['totalcotizaciones'] = $this->mad_cotizador->totalcotizaciones();
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('cotizador/vad_cotizador', $this->data);
        $this->load->view('layouts/footer');
    }

    public function comprobacionvcot()
    {
        $comprobacionvcot = $this->mad_cotizador->comprobacionvcot();
        echo json_encode($comprobacionvcot > 0);
    }

    public function tabla_totalcotizaciones()
    {
        $columnas = [
            'folio_cotizacion',
            'tipocliente_cot',
            'idcliente_cot',
            'nombrecliente_cot',
            'fecha_vcot',
            'hora_vcot',
            'estado_borrador'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mad_cotizador->all_totalcotizaciones_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $totalcotizaciones = $this->mad_cotizador->all_totalcotizaciones($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $totalcotizaciones = $this->mad_cotizador->totalcotizaciones_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mad_cotizador->totalcotizaciones_search_count($buscar);
        }

        $datos = array();
        if(!empty($totalcotizaciones))
        {
            foreach($totalcotizaciones as $totalcotizacion){
                $vdata['folio_cotizacion'] = $totalcotizacion->folio_cotizacion;
                $vdata['tipocliente_cot'] = $totalcotizacion->tipocliente_cot;
                $vdata['idcliente_cot'] = $totalcotizacion->idcliente_cot;
                $vdata['nombrecliente_cot'] = $totalcotizacion->nombrecliente_cot;
                $vdata['fecha_vcot'] = $totalcotizacion->fecha_vcot;
                $vdata['hora_vcot'] = $totalcotizacion->hora_vcot;
                $vdata['estado_borrador'] = $totalcotizacion->estado_borrador;

                $datos[] = $vdata;
            }
        }

        $json_data = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($totaldata),
            'recordsFiltered' => intval($totalfiltered),
            'data' => $datos
        );

        echo json_encode($json_data);
    }

    public function tabla_totalpendientes()
    {
        $columnas = [
            'folio_cotizacion',
            'tipocliente_cot',
            'idcliente_cot',
            'nombrecliente_cot',
            'fecha_vcot',
            'hora_vcot',
            'estado_borrador'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mad_cotizador->all_totalpendientes_count();
        $totalfiltered = $totaldata;

        if(!empty($this->input->post('search')['value']))
        {
            $totalpendientes = $this->mad_cotizador->all_totalpendientes($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $totalpendientes = $this->mad_cotizador->totalpendientes_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mad_cotizador->totalpendientes_search_count($buscar);
        }

        $datos = array();
        if(!empty($totalpendientes))
        {
            foreach($totalpendientes as $totalpendiente){
                $vdata['folio_cotizacion'] = $totalpendiente->folio_cotizacion;
                $vdata['tipocliente_cot'] = $totalpendiente->tipocliente_cot;
                $vdata['idcliente_cot'] = $totalpendiente->idcliente_cot;
                $vdata['nombrecliente_cot'] = $totalpendiente->nombrecliente_cot;
                $vdata['fecha_vcot'] = $totalpendiente->fecha_vcot;
                $vdata['hora_vcot'] = $totalpendiente->hora_vcot;
                $vdata['estado_borrador'] = $totalpendiente->estado_borrador;

                $datos[] = $vdata;
            }
        }

        $json_data = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($totaldata),
            'recordsFiltered' => intval($totalfiltered),
            'data' => $datos
        );

        echo json_encode($json_data);
    }

    public function tabla_totalterminadas()
    {
        $columnas = [
            'folio_cotizacion',
            'tipocliente_cot',
            'idcliente_cot',
            'nombrecliente_cot',
            'fecha_vcot',
            'hora_vcot',
            'estado_borrador'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mad_cotizador->all_totalterminadas_count();
        $totalfiltered = $totaldata;

        if(!empty($this->input->post('search')['value']))
        {
            $totalterminadas = $this->mad_cotizador->all_totalterminadas($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $totalterminadas = $this->mad_cotizador->totalterminadas_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mad_cotizador->totalterminadas_search_count($buscar);
        }

        $datos = array();
        if(!empty($totalterminadas))
        {
            foreach($totalterminadas as $totalterminada){
                $vdata['folio_cotizacion'] = $totalterminada->folio_cotizacion;
                $vdata['tipocliente_cot'] = $totalterminada->tipocliente_cot;
                $vdata['idcliente_cot'] = $totalterminada->idcliente_cot;
                $vdata['nombrecliente_cot'] = $totalterminada->nombrecliente_cot;
                $vdata['fecha_vcot'] = $totalterminada->fecha_vcot;
                $vdata['hora_vcot'] = $totalterminada->hora_vcot;
                $vdata['estado_borrador'] = $totalterminada->estado_borrador;

                $datos[] = $vdata;
            }
        }

        $json_data = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($totaldata),
            'recordsFiltered' => intval($totalfiltered),
            'data' => $datos
        );
    }

    public function modificarformulas()
    {
        $datos = $this->mad_cotizador->modificarformulas();
        echo json_encode($datos);
    }

    public function verdatoscotizacion($folio_cotizacion)
    {
        $datoscotizaciones['datoscotizaciones'] = $this->mad_cotizador->verdatoscotizacion($folio_cotizacion);
        $datoscotizaciones['datostablahtml'] = $this->mad_cotizador->verdatoshtml($folio_cotizacion);
        echo json_encode($datoscotizaciones);
    }

    public function actualizarformulas()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('preciodolar', 'Preciodolar', 'trim');
            $this->form_validation->set_rules('porcentajeintegrador', 'Porcentajeintegrador', 'trim');
            $this->form_validation->set_rules('porcentajetienda', 'Porcentajetienda', 'trim');
            $this->form_validation->set_rules('iva', 'Iva', 'trim');

            $this->form_validation->set_message(array(
                "required" => "<strong>{field}</strong> debe ser completado",
                "valid_email" => "Por favor, ingrese una dirección de correo electronico valida",
                "is_unique" => "Ya existe un usuario con el mismo nombre",
                "min_length" => "El número debe ser de 10 digitos"
            ));

            if($this->form_validation->run() == FALSE)
            {
                $data = array('responce' => 'error', 'message' => validation_errors());
            }
            else
            {
                $data['preciodolar'] = $this->input->post('preciodolar');
                $data['porcentajeintegrador'] = $this->input->post('porcentajeintegrador');
                $data['porcentajetienda'] = $this->input->post('porcentajetienda');
                $data['iva'] = $this->input->post('iva');

                if($this->mad_cotizador->actualizarformulas($data))
                {
                    $data = array('responce' => 'success', 'message' => 'Se actualizo correctamente');
                }
                else
                {
                    $data = array('responce' => 'error', 'message' => 'No se pudo actualizar');
                }
            }
            echo json_encode($data);
        }
        else
        {
            echo 'Script fallido';
        }
    }

    public function cotizacionborrador()
    {
        $datos_cotizacion = array(
            'tipocliente_cot' => $this->input->post('select_tccliente'),
            'tpseleccionado_cot' => $this->input->post('input_tpseleccionado'),
            'idcliente_cot' => $this->input->post('input_idclientecot'),
            'nombrecliente_cot' => $this->input->post('select_clienteprod'),
            'productos_cot' => $this->input->post('input_productoscot'),
            'subtotal_cot' => $this->input->post('input_subtotalcot'),
            'iva_cot' => $this->input->post('input_ivacot'),
            'total_cot' => $this->input->post('input_totalcot'),
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
            'estado_borrador' => 'Pendiente'
        );

        $this->db->insert('cotizador_borradores', $datos_cotizacion);
        $folio_cotizacion = $this->db->insert_id();

        $datosborrador_tabla = $this->input->post('datosborrador_tabla');

        foreach($datosborrador_tabla as $producto)
        {
            $datosborrador = array(
                'folio_cotizacion' => $folio_cotizacion,
                'idproducto_cot' => $producto['tdproductoid'],
                'modeloprod_cot' => $producto['tdproductomodelo'],
                'nombreprod_cot' => $producto['tdproductotitulo'],
                'cantidadprod_cot' => $producto['tdproductocantidad'],
                'tipoprecio_cot' => $producto['tdproductotp'],
                'preciomxn_cot' => $producto['tdproductomxn'],
                'preciousd_cot' => $producto['tdproductousd']
            );

            $this->db->insert('tablahtml_borrador', $datosborrador);
        }

        echo 'Haz logrado guardar muchos datos como borrador';
    }
}
?>