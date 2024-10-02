<?php
require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class cconsulta_fechas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('consultas/mconsulta_fechas');
    }

    public function index()
    {
        $this->data['sumaactivos'] = $this->mconsulta_fechas->sumaactivos();
        $this->data['sumainactivos'] = $this->mconsulta_fechas->sumainactivos();
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('consultas/vconsulta_fechas', $this->data);
        $this->load->view('layouts/footer');
    }

    public function tablaprodact_fechasvcon()
    {
        $columnas = [
            'id',
            'modelo',
            'estado_prod',
            'fecha_vprod'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mconsulta_fechas->all_tablaprodact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablaprodact = $this->mconsulta_fechas->all_tablaprodact($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablaprodact = $this->mconsulta_fechas->tablaprodact_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablaprodact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablaprodact))
        {
            foreach($tablaprodact as $tablaprodac){
                $vdata['id'] = $tablaprodac->id;
                $vdata['modelo'] = $tablaprodac->modelo;
                $vdata['estado_prod'] = $tablaprodac->estado_prod;
                $vdata['fecha_vprod'] = $tablaprodac->fecha_vprod;

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

    public function tablacatact_fechasvcon()
    {
        $columnas = [
            'id',
            'categoria',
            'estado_vcat',
            'fecha_vcat'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mconsulta_fechas->all_tablacatact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablacatact = $this->mconsulta_fechas->all_tablacatact($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablacatact = $this->mconsulta_fechas->tablacatact_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablacatact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablacatact))
        {
            foreach($tablacatact as $tablacatac){
                $vdata['id'] = $tablacatac->id;
                $vdata['categoria'] = $tablacatac->categoria;
                $vdata['estado_vcat'] = $tablacatac->estado_vcat;
                $vdata['fecha_vcat'] = $tablacatac->fecha_vcat;

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

    public function tablamarcasact_fechasvcon()
    {
        $columnas = [
            'id',
            'marca',
            'estado_vmarcas',
            'fecha_vmarcas'            
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_fechas->all_tablamarcasact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablamarcasact = $this->mconsulta_fechas->all_tablamarcasact($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablamarcasact = $this->mconsulta_fechas->tablamarcasact_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablamarcasact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablamarcasact))
        {
            foreach($tablamarcasact as $tablamarcasac){
                $vdata['id'] = $tablamarcasac->id;
                $vdata['marca'] = $tablamarcasac->marca;
                $vdata['estado_vmarcas'] = $tablamarcasac->estado_vmarcas;
                $vdata['fecha_vmarcas'] = $tablamarcasac->fecha_vmarcas;

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

    public function tablatiposact_fechasvcon()
    {
        $columnas = [
            'id',
            'tipocliente',
            'estado_vtipos'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_fechas->all_tablatiposact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablatiposact = $this->mconsulta_fechas->all_tablatiposact($iniciar, $limite);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablatiposact = $this->mconsulta_fechas->tablatiposact_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablatiposact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablatiposact))
        {
            foreach($tablatiposact as $tablatiposac){
                $vdata['id'] = $tablatiposac->id;
                $vdata['tipocliente'] = $tablatiposac->tipocliente;
                $vdata['estado_vtipos'] = $tablatiposac->estado_vtipos;

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

    public function tablaprodinact_fechasvcon()
    {
        $columnas = [
            'id',
            'modelo',
            'estado_prod',
            'fecha_vprod'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_fechas->all_tablaprodinact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablaprodinact = $this->mconsulta_fechas->all_tablaprodinact($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablaprodinact = $this->mconsulta_fechas->tablaprodinact_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablaprodinact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablaprodinact))
        {
            foreach($tablaprodinact as $tablaprodinac)
            {
                $vdata['id'] = $tablaprodinac->id;
                $vdata['modelo'] = $tablaprodinac->modelo;
                $vdata['estado_prod'] = $tablaprodinac->estado_prod;
                $vdata['fecha_vprod'] = $tablaprodinac->fecha_vprod;
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

    public function tablacatinact_fechasvcon()
    {
        $columnas = [
            'id',
            'categoria',
            'estado_vcat',
            'fecha_vcat'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_fechas->all_tablacatinact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablacatinact = $this->mconsulta_fechas->all_tablacatinact($iniciar, $limite);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablacatinact = $this->mconsulta_fechas->tablacatinact_search($iniciar, $limite, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablacatinact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablacatinact))
        {
            foreach($tablacatinact as $tablacatinac){
                $vdata['id'] = $tablacatinac->id;
                $vdata['categoria'] = $tablacatinac->categoria;
                $vdata['estado_vcat'] = $tablacatinac->estado_vcat;
                $vdata['fecha_vcat'] = $tablacatinac->fecha_vcat;
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

    public function tablamarcasinact_fechasvcon()
    {
        $columnas = [
            'id',
            'marca',
            'estado_vmarcas',
            'fecha_vmarcas'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_fechas->all_tablamarcasinact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablamarcasinact = $this->mconsulta_fechas->all_tablamarcasinact($iniciar, $limite);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablamarcasinact = $this->mconsulta_fechas->tablamarcasinact_search($iniciar, $limite, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablamarcasinact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablamarcasinact))
        {
            foreach($tablamarcasinact as $tablamarcasinac){
                $vdata['id'] = $tablamarcasinac->id;
                $vdata['marca'] = $tablamarcasinac->marca;
                $vdata['estado_vmarcas'] = $tablamarcasinac->estado_vmarcas;
                $vdata['fecha_vmarcas'] = $tablamarcasinac->fecha_vmarcas;
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

    public function tablatiposinact_fechasvcon()
    {
        $columnas = [
            'id',
            'tipocliente',
            'estado_vtipos'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_fechas->all_tablatiposinact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablatiposinact = $this->mconsulta_fechas->all_tablatiposinact($iniciar, $limite);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablatiposinact = $this->mconsulta_fechas->tablatiposinact_search($iniciar, $limite, $buscar);
            $totalfiltered = $this->mconsulta_fechas->tablatiposinact_search_count($buscar);
        }

        $datos = array();
        if(!empty($tablatiposinact))
        {
            foreach($tablatiposinact as $tablatiposinac){
                $vdata['id'] = $tablatiposinac->id;
                $vdata['tipocliente'] = $tablatiposinac->tipocliente;
                $vdata['estado_vtipos'] = $tablatiposinac->estado_vtipos;
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
}
?>