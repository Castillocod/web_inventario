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

    public function obtenerdatos()
    {
        $columnas = [
            'id',
            'marca',
            'estado_vmarcas'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mmarcas->all_vmarcas_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $vmarcas = $this->mmarcas->all_vmarcas($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $vmarcas = $this->mmarcas->vmarcas_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mmarcas->vmarcas_search_count($buscar);
        }

        $datos = array();
        if(!empty($vmarcas))
        {
            foreach($vmarcas as $vmarca){
                $vdata['id'] = $vmarca->id;
                $vdata['marca'] = $vmarca->marca;
                $vdata['estado_vmarcas'] = $vmarca->estado_vmarcas;

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

    public function comprobacionvmarcas()
    {
        $comprobacionvmarcas = $this->mmarcas->comprobacionvmarcas();
        echo json_encode($comprobacionvmarcas > 0);
    }

    public function agregarvmarcas()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('marca', 'Marca', 'required|trim');
            $this->form_validation->set_rules('estado_vmarcas', 'Estado', 'trim');
            $this->form_validation->set_rules('fecha_vmarcas', 'Fecha_vmarcas', 'required');

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
                $ajax_data = $this->input->post();
                if($this->mmarcas->agregarvmarcas($ajax_data))
                {
                    $data = array('responce' => 'success');
                }
                else
                {
                    $data = array('responce' => 'error');
                }
            }
            echo json_encode($data);
        }
        else
        {
            echo 'Script fallido';
        }
    }

    public function editarvmarcas($id)
    {
        $data = $this->mmarcas->editarvmarcas($id);
        echo json_encode($data);
    }

    public function actualizarvmarcas()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('editmarca', 'Marca', 'required|trim');
            $this->form_validation->set_rules('edit_estado_vmarcas', 'Estado', 'trim');
            $this->form_validation->set_rules('editfecha_vmarcas', 'Fecha_vmarcas', 'required');

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
                $data['id'] = $this->input->post('editid');
                $data['marca'] = $this->input->post('editmarca');
                $data['estado_vmarcas'] = $this->input->post('edit_estado_vmarcas');
                $data['fecha_vmarcas'] = $this->input->post('editfecha_vmarcas');

                if($this->mmarcas->actualizarvmarcas($data))
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

    public function eliminarvmarcas($id)
    {
        if(is_numeric($id))
        {
            $status = $this->mmarcas->eliminarvmarcas($id);
            if($status == true)
            {
                $this->session->set_flashdata('eliminado', 'Eliminado exitosamente');
                redirect(base_url('almacen/cmarcas'));
            }
            else
            {
                $this->session->set_flashdata('erroreliminar', 'Error al eliminar');
                redirect(base_url('almacen/cmarcas'));
            }
        }
    }

    public function fechasmeses_vmarcas()
    {
        $primerfecha = $this->mmarcas->primerfecha();
        $ultimafecha = $this->mmarcas->ultimafecha();
        $primermes = $this->mmarcas->primermes();
        $ultimomes = $this->mmarcas->ultimomes();

        echo json_encode(array(
            'primerfecha' => $primerfecha,
            'ultimafecha' => $ultimafecha,
            'primermes' => $primermes,
            'ultimomes' => $ultimomes
        ));
    }
}
?>