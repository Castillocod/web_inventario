<?php 
class cadi_clientes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('clientes/madi_clientes');
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('clientes/vadi_clientes');
        $this->load->view('layouts/footer');
    }

    public function comprobacionvadi()
    {
        $comprobacionvadi = $this->madi_clientes->comprobacionvadi();
        echo json_encode($comprobacionvadi > 0);
    }

    public function obtenerdatos()
    {
        $columnas = array(
            'id',
            'nombre',
            'direccion',
            'correo',
            'telefono',
            'rfc',
            'fecha_vtotal'
        );

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->madi_clientes->all_vadi_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $vadi = $this->madi_clientes->all_vadi($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $vadi = $this->madi_clientes->vadi_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->madi_clientes->vadi_search_count($buscar);
        }

        $datos = array();
        if(!empty($vadi))
        {
            foreach($vadi as $vad)
            {
                $vdata['id'] = $vad->id;
                $vdata['nombre'] = $vad->nombre;
                $vdata['direccion'] = $vad->direccion;
                $vdata['correo'] = $vad->correo;
                $vdata['telefono'] = $vad->telefono;
                $vdata['rfc'] = $vad->rfc;
                $vdata['fecha_vtotal'] = $vad->fecha_vtotal;

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

    public function ver_vadi($id)
    {
        $solover = $this->madi_clientes->ver_vadi($id);
        echo json_encode($solover);
    }
}
?>