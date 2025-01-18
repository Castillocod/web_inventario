<?php 
require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class cconsulta_meses extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('consultas/mconsulta_meses');
        $this->load->model('consultas/mconsulta_fechas');
    }

    public function index()
    {
        $this->data['sumaactivos'] = $this->mconsulta_fechas->sumaactivos();
        $this->data['sumainactivos'] = $this->mconsulta_fechas->sumainactivos();
        $this->data['cotizaciones'] = $this->mconsulta_fechas->sumacotizaciones();  
        $this->data['clientes'] = $this->mconsulta_fechas->sumaclientes();
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('consultas/vconsulta_meses', $this->data);
        $this->load->view('layouts/footer');
    }

    public function tablaprodact_mesesvcon()
    {
        $columnas = [
            'id',
            'modelo',
            'estado_prod',
            'fecha_vprod'
        ];
        
        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablaprodact_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablaprodact = $this->mconsulta_meses->all_tablaprodact($limite, $iniciar, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablaprodact = $this->mconsulta_meses->tablaprodact_search($limite, $iniciar, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablaprodact_search_count($buscar, $meses_vcon);
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

    public function tablacatact_mesesvcon()
    {
        $columnas = [
            'id',
            'categoria',
            'estado_vcat',
            'fecha_vcat'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablacatact_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablacatact = $this->mconsulta_meses->all_tablacatact($limite, $iniciar, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablacatact = $this->mconsulta_meses->tablacatact_search($limite, $iniciar, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablacatact_search_count($buscar, $meses_vcon);
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

    public function tablamarcasact_mesesvcon()
    {
        $columnas = [
            'id',
            'marca',
            'estado_vmarcas',
            'fecha_vmarcas'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablamarcasact_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablamarcasact = $this->mconsulta_meses->all_tablamarcasact($limite, $iniciar, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablamarcasact = $this->mconsulta_meses->tablamarcasact_search($limite, $iniciar, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablamarcasact_search_count($buscar, $meses_vcon);
        }

        $datos = array();
        if(!empty($tablamarcasact))
        {
            foreach($tablamarcasact as $tablamarcasac){
                $vdata['id'] = $tablamarcasact->id;
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

    public function tablatiposact_mesesvcon()
    {
        $columnas = [
            'id',
            'tipocliente',
            'estado_vtipos'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_meses->all_tablatiposact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablatiposact = $this->mconsulta_meses->all_tablatiposact($iniciar, $limite);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablatiposact = $this->mconsulta_meses->tablatiposact_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mconsulta_meses->tablatiposact_search_count($buscar);
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

    public function tablaprodinact_mesesvcon()
    {
        $columnas = [
            'id',
            'modelo',
            'estado_prod',
            'fecha_vprod'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablatiposact_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablaprodinact = $this->mconsulta_meses->all_tablaprodinact($iniciar, $limite, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablaprodinact = $this->mconsulta_meses->tablaprodinact_search($iniciar, $limite, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablaprodinact_search_count($buscar, $meses_vcon);
        }

        $datos = array();
        if(!empty($tablaprodinact))
        {
            foreach($tablaprodinact as $tablaprodinac){
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

    public function tablacatinact_mesesvcon()
    {
        $columnas = [
            'id',
            'categoria',
            'estado_vcat',
            'fecha_vcat'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablacatinact_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablacatinact = $this->mconsulta_meses->all_tablacatinact($iniciar, $limite, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablacatinact = $this->mconsulta_meses->tablacatinact_search($iniciar, $limite, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablacatinact_search_count($buscar, $meses_vcon);
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

    public function tablamarcasinact_mesesvcon()
    {
        $columnas = [
            'id',
            'marca',
            'estado_vmarcas',
            'fecha_vmarcas'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablamarcasinact_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablamarcasinact = $this->mconsulta_meses->all_tablamarcasinact($iniciar, $limite, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablamarcasinact = $this->mconsulta_meses->tablamarcasinact_search($iniciar, $limite, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablamarcasinact_search_count($buscar, $meses_vcon);
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

    public function tablatiposinact_mesesvcon()
    {
        $columnas = [
            'id',
            'tipocliente',
            'estado_vtipos'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');

        $totaldata = $this->mconsulta_meses->all_tablatiposinact_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablatiposinact = $this->mconsulta_meses->all_tablatiposinact($iniciar, $limite); 
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablatiposinact = $this->mconsulta_meses->tablatiposinact_search($iniciar, $limite, $buscar);
            $totalfiltered = $this->mconsulta_meses->tablatiposinact_search_count($buscar);
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

    public function tablacotpen_mesesvcon()
    {
        $columnas = [
            'folio_cotizacion',
            'nombrecliente_cot',
            'estado_borrador',
            'fecha_vcot'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablacotpen_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablacotpen = $this->mconsulta_meses->all_tablacotpen($iniciar, $limite, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablacotpen = $this->mconsulta_meses->tablacotpen_search($iniciar, $limite, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablacotpen_search_count($buscar, $meses_vcon);
        }

        $datos = array();
        if(!empty($tablacotpen))
        {
            foreach($tablacotpen as $tablacotpend){
                $vdata['folio_cotizacion'] = $tablacotpend->folio_cotizacion;
                $vdata['nombrecliente_cot'] = $tablacotpend->nombrecliente_cot;
                $vdata['estado_borrador'] = $tablacotpend->estado_borrador;
                $vdata['fecha_vcot'] = $tablacotpend->fecha_vcot;
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

    public function tablacotter_mesesvcon()
    {
        $columnas = [
            'folio_cotizacion',
            'nombrecliente_cot',
            'estado_borrador',
            'fecha_vcot'
        ];

        $iniciar = $this->input->post('start');
        $limite = $this->input->post('length');
        $meses_vcon = $this->input->post('meses_vcon');

        $totaldata = $this->mconsulta_meses->all_tablacotter_count($meses_vcon);
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $tablacotter = $this->mconsulta_meses->all_tablacotter($iniciar, $limite, $meses_vcon);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $tablacotter = $this->mconsulta_meses->tablacotter_search($iniciar, $limite, $buscar, $meses_vcon);
            $totalfiltered = $this->mconsulta_meses->tablacotter_search_count($buscar, $meses_vcon);
        }

        $datos = array();
        if(!empty($tablacotter))
        {
            foreach($tablacotter as $tablacotterm)
            {
                $vdata['folio_cotizacion'] = $tablacotterm->folio_cotizacion;
                $vdata['nombrecliente_cot'] = $tablacotterm->nombrecliente_cot;
                $vdata['estado_borrador'] = $tablacotterm->estado_borrador;
                $vdata['fecha_vcot'] = $tablacotterm->fecha_vcot;
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

    public function tablaclientesdisp_mesesvcon()
    {
        $columnas = [
            'id',
            'nombre',
            'fecha_vtotal',
            'disponible_vtotal'
        ];
    }

    public function tablaclientesnodisp_mesesvcon()
    {

    }
}
?>