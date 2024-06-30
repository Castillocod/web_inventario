<?php 
require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ccategorias extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('almacen/mcategorias');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('almacen/vcategorias');
        $this->load->view('layouts/footer');
    }

    public function datoscategorias()
    {
        $columnas = [
            'id',
            'categorias',
            'estado_vcat'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');
        // $ordencolumnas = $this->input->post('order')[0]['column'];
        // $orden = $columnas[$ordencolumnas];
        // $dir = $this->input->post('order')[0]['dir'];

        $datostotal = $this->mcategorias->conteocategorias();
        $datosfiltrados = $datostotal;

        if(empty($this->input->post('search')['value']))
        {
            $categorias = $this->mcategorias->totalcategorias($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $categorias = $this->mcategorias->buscar_categorias($limite, $iniciar, $buscar);
            $datosfiltrados = $this->mcategorias->conteocategorias_buscar($buscar);
        }

        $datos = array();
        if(!empty($categorias))
        {
            foreach($categorias as $vcategorias)
            {
                $vdatos['id'] = $vcategorias->id;
                $vdatos['categoria'] = $vcategorias->categoria;
                $vdatos['estado_vcat'] = $vcategorias->estado_vcat;

                $datos[] = $vdatos;
            }
        }

        $datos_json = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($datostotal),
            'recordsFiltered' => intval($datosfiltrados),
            'data' => $datos
        );

        echo json_encode($datos_json);
    }
    public function agregarcategorias()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('categoria', 'Categoria', 'required|trim');
            $this->form_validation->set_rules('estado_vcat', 'Estado', 'trim');

            $this->form_validation->set_message(array(
                "required" => "<strong>{field}</strong> debe ser completado",
                "valid_email" => "Por favor, ingrese una dirección de correo electronico valida",
                "is_unique" => "Ya existe un usuario con el mismo nombre",
                "min_length" => "El número debe ser de 10 digitos"
            ));

            if($this->form_validation->run() == false)
            {
                $data = array('responce' => 'error', 'message' => validation_errors());
                echo json_encode($data);
                return;
            }
            else
            {
                $ajax_data = $this->input->post();
                if($this->mcategorias->agregarcategorias($ajax_data))
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

    public function actualizarcategorias()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('editcategoria', 'Categoria', 'required|trim');
            $this->form_validation->set_rules('edit_estado_vcat', 'Estado', 'trim');

            $this->form_validation->set_message(array(
                "required" => "<strong>{field}</strong> debe ser completado",
                "valid_email" => "Por favor, ingrese una dirección de correo electronico valida",
                "is_unique" => "Ya existe un usuario con el mismo nombre",
                "min_length" => "El número debe ser de 10 digitos"
            ));

            if($this->form_validation->run() == false)
            {
                $data = array('responce' => 'error', 'message' => validation_errors());
            }
            else
            {
                $data['id'] = $this->input->post('editid');
                $data['categoria'] = $this->input->post('editcategoria');
                $data['estado_vcat'] = $this->input->post('edit_estado_vcat');

                if($this->mcategorias->actualizarcategorias($data))
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

    public function editarcategorias($id)
    {
        $data = $this->mcategorias->editarcategorias($id);
        echo json_encode($data);
    }

    public function eliminarcategorias($id)
    {
        if(is_numeric($id))  
        {
            $status = $this->mcategorias->eliminarcategorias($id);
            if($status==true)
            {
                $this->session->set_flashdata('eliminado', 'Eliminado exitosamente');
                redirect(base_url('almacen/ccategorias'));
            }
            else
            {
                $this->session->set_flashdata('erroreliminar', 'Error al eliminar');
                redirect(base_url('almacen/ccategorias'));
            }
        } 
    }

    public function categoriasexcel()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $doc_estado = $this->categoriasexcelimport();
            if($doc_estado != false)
            {
                $doc_nombre = 'assets/documentos/imports/'.$doc_estado;
                $doc_tiletype = \PhpOffice\PhpSpreadsheet\IOFactory::identify($doc_nombre);
                $doc_lector = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($doc_tiletype);
                $spreadsheet = $doc_lector->load($doc_nombre);
                $document = $spreadsheet->getSheet(0);
                $count_rows = 0;

                foreach($document->getRowIterator() as $filauno => $row)
                {
                    if($filauno === 1)
                    {
                        continue;
                    }

                    $categoria = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
                    $estado_vcat = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());

                    $datosdocumento = array(
                        'categoria' => $categoria,
                        'estado_vcat' => $estado_vcat
                    );

                    $this->db->insert('almacen_categorias', $datosdocumento);
                    $count_rows++;
                }
                $this->session->set_flashdata('importado', 'Importación exitosa');
                redirect(base_url('almacen/ccategorias'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Ha ocurrido un error');
                redirect(base_url('almacen/ccategorias'));
            }
        }
        else
        {
            $this->load->view('layouts/header');
            $this->load->view('layouts/content');
            $this->load->view('almacen/vcategorias');
            $this->load->view('layouts/footer');
        }
    }

    public function categoriasexcelimport()
    {
        $subirexcel = 'assets/documentos/imports/';
        if(!is_Dir($subirexcel))
        {
            mkdir($subirexcel, 0777, true);
        }

        $config['upload_path'] = $subirexcel;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('file_excel'))
        {
            $nombre_archivo = $this->upload->data();
            return $nombre_archivo['file_name'];
        }
        else
        {
            return false;
        }
    }

    public function pdf_categorias_activas()
    {
        $data['almacen_categorias'] = $this->mcategorias->pdf_categorias_activas();
        $html = $this->load->view('almacen/reportes_vcategorias/rep_activos_vcat', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->writeHTML($html);
        $mpdf->Output();
    }

    public function pdf_categorias_inactivas()
    {
        $data['almacen_categorias'] = $this->mcategorias->pdf_categorias_inactivas();
        $html = $this->load->view('almacen/reportes_vcategorias/rep_inactivos_vcat', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->writeHTML($html);
        $mpdf->Output();
    }
}
?>