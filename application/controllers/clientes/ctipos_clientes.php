<?php

require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $this->mtipos_clientes->actualizarestado();
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('clientes/vtipos_clientes');
        $this->load->view('layouts/footer');
    }

    public function obtenerdatos()
    {
        $columns = [
            'id',
            'tipocliente',
            'cantclientes',
            'estado_vtipos'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mtipos_clientes->all_vtipos_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $vtipos = $this->mtipos_clientes->all_vtipos($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $vtipos = $this->mtipos_clientes->vtipos_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mtipos_clientes->vtipos_search_count($buscar);
        }

        $datos = array();
        if(!empty($vtipos))
        {
            foreach($vtipos as $vtipo)
            {
                $vdata['id'] = $vtipo->id;
                $vdata['tipocliente'] = $vtipo->tipocliente;
                $vdata['cantclientes'] = $vtipo->cantclientes;
                $vdata['estado_vtipos'] = $vtipo->estado_vtipos;

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

    public function agregarvtipos()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('tipocliente', 'Tipocliente', 'required|trim');   

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
                $ajax_data = $this->input->post();
                $ajax_data['estado_vtipos'] = 'INACTIVO';
                if($this->mtipos_clientes->agregarvtipos($ajax_data))
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

    public function editarvtipos($id)
    {
        $data = $this->mtipos_clientes->editarvtipos($id);
        echo json_encode($data);
    }

    public function actualizarvtipos()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('edittipocliente', 'Tipocliente', 'required|trim');

            $this->form_validation->set_message(array(
                "required" => "<strong>{field}</strong> debe ser completado",
                "valid_email" => "Por favor, ingrese una dirección de correo electronico valida",
                "is_unique" => "Ya existe un usuario con el mismo nombre",
                "min_length" => "El número debe ser de 10 digitos"
            ));

            if($this->form_validation->run() == false)
            {
                $data = array('responce' => 'success', 'message' => 'Se actualizo correctamente');
            }
            else
            {
                $data['id'] = $this->input->post('editid');
                $data['tipocliente'] = $this->input->post('edittipocliente');

                if($this->mtipos_clientes->actualizarvtipos($data))
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

    public function eliminarvtipos($id)
    {
        if(is_numeric($id))
        {
            $status = $this->mtipos_clientes->eliminarvtipos($id);
            if($status == true)
            {
                $this->session->set_flashdata('eliminado', 'Eliminado correctamente');
                redirect(base_url('clientes/ctipos_clientes'));
            }
            else
            {
                $this->session->set_flashdata('erroreliminar', 'Error al eliminar');
                redirect(base_url('clientes/ctipos_clientes'));
            }
        }
    }

    public function eliminar_cliente($id)
    {
        $cliente = $this->mtotal_clientes->eliminarvtotal();
        $tipo_cliente = $cliente['tipocliente'];

        $this->mtotal_clientes->eliminarvtotal($id);

        $this->db->select('cantclientes');
        $this->db->from('clientes_tiposclientes');
        $this->db->where('tipocliente', $tipo_cliente);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $result = $query->row_array();
            $cantidad_actual_clientes = $result['cantclientes'];

            $nueva_cantidad_clientes = $cantidad_actual_clientes - 1;

            $this->db->set('cantclientes', $nueva_cantidad_clientes);
            $this->db->where('tipocliente', $tipo_cliente);
            $this->db->update('clientes_tiposclientes');
        }
    }

    public function exceltotal_vtipos()
    {
        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'Tipo de Cliente',
            'Cant. Clientes',
            'Estado'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vtipos = $this->mtipos_clientes->exceltotal_vtipos();
        $celda_excel = 2;

        foreach($datos_vtipos as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->tipocliente);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->cantclientes);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vtipos);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Tipos_clientes.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }
    
    public function importexcel_vtipos()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $doc_estado = $this->vtipos_importexcel();
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

                    $tipocliente = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
                    $estado_vtipos = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
                    $datosdocumento = array(
                        'tipocliente' => $tipocliente,
                        'estado_vtipos' => $estado_vtipos
                    );

                    $this->db->insert('clientes_tiposclientes', $datosdocumento);
                    $count_rows++;
                }

                $this->session->set_flashdata('importado', 'Importación exitosa');
                redirect(base_url('clientes/ctipos_clientes'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Ha ocurrido un error al importar');
                redirect(base_url('clientes/ctipos_clientes'));
            }
        }
        else
        {
            $this->load->view('layouts/header');
            $this->load->view('layouts/content');
            $this->load->view('clientes/vtipos_clientes');
            $this->load->view('layouts/footer');
        }
    }

    public function vtipos_importexcel()
    {
        $subirexcel = 'assets/documentos/imports/';
        if(!is_dir($subirexcel))
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

    public function pdfacttotal_vtipos()
    {
        $data['clientes_tiposclientes'] = $this->mtipos_clientes->pdfacttotal_vtipos() ?? [];
        $html = $this->load->view('clientes/reportes_vtipos_clientes/rep_activos_vtipos', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pdfinacttotal_vtipos()
    {
        $data['clientes_tiposclientes'] = $this->mtipos_clientes->pdfinacttotal_vtipos() ?? [];
        $html = $this->load->view('clientes/reportes_vtipos_clientes/rep_inactivos_vtipos', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
?>