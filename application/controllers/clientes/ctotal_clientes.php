<?php 

require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ctotal_clientes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('clientes/mtotal_clientes');
        $this->load->model('clientes/mtipos_clientes');
    }

    public function index()
    {
        $this->data['tipoclientes'] = $this->mtotal_clientes->obtenertipoclientes() ?? [];
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('clientes/vtotal_clientes', $this->data);
        $this->load->view('layouts/footer');
    }

    public function comprobacionvtotal()
    {
        $comprobacionvtotal = $this->mtotal_clientes->comprobacionvtotal();
        echo json_encode($comprobacionvtotal > 0);
    }

    public function obtenerdatos()
    {
        $columnas = [
            'id',
            'nombre',
            'tipocliente',
            'ciudad',
            'estado_vtotal',
            'pais',
            'empresa',
            'disponible_vtotal'
        ];

        $limite = $this->input->post('length');
        $iniciar = $this->input->post('start');

        $totaldata = $this->mtotal_clientes->all_vtotal_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $vtotal = $this->mtotal_clientes->all_vtotal($limite, $iniciar);
        }
        else
        {
            $buscar = $this->input->post('search')['value'];
            $vtotal = $this->mtotal_clientes->vtotal_search($limite, $iniciar, $buscar);
            $totalfiltered = $this->mtotal_clientes->vtotal_search_count($buscar);
        }

        $datos = array();
        if(!empty($vtotal))
        {
            foreach($vtotal as $vtota)
            {
                $vdata['id'] = $vtota->id;
                $vdata['nombre'] = $vtota->nombre;
                $vdata['tipocliente'] = $vtota->tipocliente;
                $vdata['ciudad'] = $vtota->ciudad;
                $vdata['estado_vtotal'] = $vtota->estado_vtotal;
                $vdata['pais'] = $vtota->pais;
                $vdata['empresa'] = $vtota->empresa;
                $vdata['disponible_vtotal'] = $vtota->disponible_vtotal;

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

    public function importexcel_vtotal()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $doc_estado = $this->vtotal_importexcel();
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

                    $nombre = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
                    $tipocliente = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
                    $ciudad = $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
                    $estado_vtotal = $spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());
                    $fecha_vtotal = date('Y-m-d');
                    $pais = $spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex());
                    $empresa = $spreadsheet->getActiveSheet()->getCell('G'.$row->getRowIndex());
                    $disponible_vtotal = $spreadsheet->getActiveSheet()->getCell('H'.$row->getRowIndex());
                    $direccion = $spreadsheet->getActiveSheet()->getCell('I'.$row->getRowIndex());
                    $correo = $spreadsheet->getActiveSheet()->getCell('J'.$row->getRowIndex());
                    $telefono = $spreadsheet->getActiveSheet()->getCell('K'.$row->getRowIndex());
                    $rfc = $spreadsheet->getActiveSheet()->getCell('L'.$row->getRowIndex());

                    $datosdocumento = array(
                        'nombre' => $nombre,
                        'tipocliente' => $tipocliente,
                        'ciudad' => $ciudad,
                        'estado_vtotal' => $estado_vtotal,
                        'fecha_vtotal' => $fecha_vtotal,
                        'pais' => $pais,
                        'empresa' => $empresa,
                        'disponible_vtotal' => $disponible_vtotal,
                        'direccion' => $direccion,
                        'correo' => $correo,
                        'telefono' => $telefono,
                        'rfc' => $rfc
                    );

                    $this->db->insert('clientes_totalclientes', $datosdocumento);

                    $tipocliente = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
                    $this->actualizarcantclientes($tipocliente);
                    $count_rows++;
                }
                $this->session->set_flashdata('importado', 'Importación exitosa');
                redirect(base_url('clientes/ctotal_clientes'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Ha ocurrido un error al importar');
                redirect(base_url('clientes/ctotal_clientes'));
            }
        }
        else
        {
            $this->load->view('layouts/header');
            $this->load->view('layouts/content');
            $this->load->view('clientes/vtotal_clientes');
            $this->load->view('layouts/footer');
        }
    }

    private function actualizarcantclientes($tipocliente)
    {
        $this->db->where('tipocliente', $tipocliente);
        $query = $this->db->get('clientes_totalclientes');
        $cantclientes = $query->num_rows();

        $this->db->set('cantclientes', $cantclientes);
        $this->db->where('tipocliente', $tipocliente);
        $this->db->update('clientes_tiposclientes');
    }

    public function vtotal_importexcel()
    {
        $subirexcel = 'assets/documentos/imports/';
        if(!is_dir($subirexcel))
        {
            mkdir($subirexcel, 0777, true);
        }

        $config['upload_path'] = $subirexcel;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max-size'] = 1000000;
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

    public function excelfechas_vtotal()
    {
        $fechauno_excelvtotal = $this->input->get('fechauno');
        $fechados_excelvtotal = $this->input->get('fechados');

        if(!$fechauno_excelvtotal || !$fechados_excelvtotal)
        {
            show_error('Fechas no validas');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Nombre',
            'Tipo de Cliente',
            'Ciudad',
            'Estado del Cliente',
            'Fecha de Registro',
            'País',
            'Dirección',
            'Correo',
            'Telefono',
            'Empresa',
            'RFC',
            'Disponibilidad'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vtotal = $this->mtotal_clientes->excelfechas_vtotal($fechauno_excelvtotal, $fechados_excelvtotal);
        $celda_excel = 2;

        foreach($datos_vtotal as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->nombre);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->tipocliente);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->ciudad);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $celda_excel, $row->estado_vtotal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $celda_excel, $row->fecha_vtotal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(6, $celda_excel, $row->pais);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(7, $celda_excel, $row->direccion);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(8, $celda_excel, $row->correo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(9, $celda_excel, $row->telefono);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(10, $celda_excel, $row->empresa);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(11, $celda_excel, $row->rfc);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(12, $celda_excel, $row->disponible_vtotal);            
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Total_clientes.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function excelmes_vtotal()
    {
        $mes_excelvtotal = $this->input->get('mes');

        if(!$mes_excelvtotal)
        {
            show_error('Falta recibir parametros');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Nombre',
            'Tipo de Cliente',
            'Ciudad',
            'Estado del Cliente',
            'Fecha de Registro',
            'País',
            'Dirección',
            'Correo',
            'Telefono',
            'Empresa',
            'RFC',
            'Disponibilidad'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vtotal = $this->mtotal_clientes->excelmes_vtotal($mes_excelvtotal);
        $celda_excel = 2;

        foreach($datos_vtotal as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->nombre);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->tipocliente);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->ciudad);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $celda_excel, $row->estado_vtotal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $celda_excel, $row->fecha_vtotal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(6, $celda_excel, $row->pais);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(7, $celda_excel, $row->direccion);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(8, $celda_excel, $row->correo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(9, $celda_excel, $row->telefono);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(10, $celda_excel, $row->empresa);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(11, $celda_excel, $row->rfc);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(12, $celda_excel, $row->disponible_vtotal);            
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="total_clientes.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output'); 
    }

    public function exceltotal_vtotal()
    {
        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Nombre',
            'Tipo de Cliente',
            'Ciudad',
            'Estado del Cliente',
            'Fecha de Registro',
            'País',
            'Dirección',
            'Correo',
            'Telefono',
            'Empresa',
            'RFC',
            'Disponibilidad'  
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vtotal = $this->mtotal_clientes->exceltotal_vtotal();
        $celda_excel = 2;

        foreach($datos_vtotal as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->nombre);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->tipocliente);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->ciudad);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $celda_excel, $row->estado_vtotal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $celda_excel, $row->fecha_vtotal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(6, $celda_excel, $row->pais);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(7, $celda_excel, $row->direccion);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(8, $celda_excel, $row->correo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(9, $celda_excel, $row->telefono);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(10, $celda_excel, $row->empresa);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(11, $celda_excel, $row->rfc);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(12, $celda_excel, $row->disponible_vtotal);            
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="total_clientes.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function pdfactfechas_vtotal()
    {
        $fechauno_actvtotal = $this->input->get('fechauno');
        $fechados_actvtotal = $this->input->get('fechados');

        if($fechauno_actvtotal && $fechados_actvtotal)
        {
            $data['clientes_totalclientes'] = $this->mtotal_clientes->pdfactfechas_vtotal($fechauno_actvtotal, $fechados_actvtotal);
            $html = $this->load->view('clientes/reportes_vtotal_clientes/rep_activos_vtotal', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir las fechas';
        }        
    }

    public function pdfactmes_vtotal()
    {
        $mes_actvtotal = $this->input->get('mes');

        if($mes_actvtotal)
        {
            $data['clientes_totalclientes'] = $this->mtotal_clientes->pdfactmes_vtotal($mes_actvtotal);
            $html = $this->load->view('clientes/reportes_vtotal_clientes/rep_activos_vtotal', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir el mes';
        }
    }

    public function pdfacttotal_vtotal()
    {
        $data['clientes_totalclientes'] = $this->mtotal_clientes->pdffacttotal_vtotal();
        $html = $this->load->view('clientes/reportes_vtotal_clientes/rep_activos_vtotal', $data, true);
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pdfinactfechas_vtotal()
    {
        $fechauno_inactvtotal = $this->input->get('fechauno');
        $fechados_inactvtotal = $this->input->get('fechados');

        if($fechauno_inactvtotal && $fechados_inactvtotal)
        {
            $data['clientes_totalclientes'] = $this->mtotal_clientes->pdfinactfechas_vtotal($fechauno_inactvtotal, $fechados_inactvtotal);
            $html = $this->load->view('clientes/reportes_vtotal_clientes/rep_inactivos_vtotal', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir las fechas';
        }
    }

    public function pdfinactmes_vtotal()
    {
        $mes_inactvtotal = $this->input->get('mes');

        if($mes_inactvtotal)
        {
            $data['clientes_totalclientes'] = $this->mtotal_clientes->pdfinactmes_vtotal($mes_inactvtotal);
            $html = $this->load->view('clientes/reportes_vtotal_clientes/rep_inactivos_vtotal', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir el mes';
        }
    }

    public function pdfinacttotal_vtotal()
    {
        $data['clientes_totalclientes'] = $this->mtotal_clientes->pdfinacttotal_vtotal();
        $html = $this->load->view('clientes/reportes_vtotal_clientes/rep_inactivos_vtotal', $data, true);
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function fechasmeses_vtotal()
    {
        $primerfecha = $this->mtotal_clientes->primerfecha();
        $ultimafecha = $this->mtotal_clientes->ultimafecha();
        $primermes = $this->mtotal_clientes->primermes();
        $ultimomes = $this->mtotal_clientes->ultimomes();

        echo json_encode(array(
            'primerfecha' => $primerfecha,
            'ultimafecha' => $ultimafecha,
            'primermes' => $primermes,
            'ultimomes' => $ultimomes
        ));
    }

    public function agregarvtotal()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
            $this->form_validation->set_rules('tipocliente', 'Tipocliente', 'required|trim');
            $this->form_validation->set_rules('ciudad', 'Ciudad', 'required|trim');
            $this->form_validation->set_rules('estado_vtotal', 'Estado_vtotal', 'required');
            $this->form_validation->set_rules('fecha_vtotal', 'Fecha_vtotal', 'required');
            $this->form_validation->set_rules('pais', 'Pais', 'required|trim');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required|trim');
            $this->form_validation->set_rules('correo', 'Correo', 'required|trim|valid_email');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required|trim|min_length[10]');
            $this->form_validation->set_rules('empresa', 'Empresa', 'required|trim');
            $this->form_validation->set_rules('rfc', 'RFC', 'required|trim');
            $this->form_validation->set_rules('disponible_vtotal', 'Disponible_vtotal');

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
                if($this->mtotal_clientes->agregarvtotal($ajax_data))
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

    public function editarvtotal($id)
    {
        $data = $this->mtotal_clientes->editarvtotal($id);
        echo json_encode($data);
    }

    public function actualizarvtotal()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('editnombre', 'Nombre', 'required|trim');
            $this->form_validation->set_rules('edittipocliente', 'Tipocliente', 'required|trim');
            $this->form_validation->set_rules('editciudad', 'Ciudad', 'required|trim');
            $this->form_validation->set_rules('editestado_vtotal', 'Estado_vtotal', 'required|trim');
            $this->form_validation->set_rules('editfecha_vtotal', 'Fecha_vtotal', 'required|trim');
            $this->form_validation->set_rules('editpais', 'Pais', 'required|trim');
            $this->form_validation->set_rules('editdireccion', 'Direccion', 'required|trim');
            $this->form_validation->set_rules('editcorreo', 'Correo', 'required|trim|valid_email');
            $this->form_validation->set_rules('edittelefono', 'Telefono', 'required|trim|min-length[10]');
            $this->form_validation->set_rules('editempresa', 'Empresa', 'required|trim');            
            $this->form_validation->set_rules('editrfc', 'Rfc', 'required|trim');
            $this->form_validation->set_rules('editdisponible_vtotal', 'Disponible_vtotal');

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
                $data['nombre'] = $this->input->post('editnombre');
                $data['tipocliente'] = $this->input->post('edittipocliente');
                $data['ciudad'] = $this->input->post('editciudad');
                $data['estado_vtotal'] = $this->input->post('editestado_vtotal');
                $data['fecha_vtotal'] = $this->input->post('editfecha_vtotal');
                $data['pais'] = $this->input->post('editpais');
                $data['direccion'] = $this->input->post('editdireccion');
                $data['correo'] = $this->input->post('editcorreo');
                $data['telefono'] = $this->input->post('edittelefono');
                $data['empresa'] = $this->input->post('editempresa');
                $data['rfc'] = $this->input->post('editrfc');
                $data['disponible_vtotal'] = $this->input->post('editdisponible_vtotal');

                if($this->mtotal_clientes->actualizarvtotal($data))
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

    public function eliminarvtotal($id)
    {
        if(is_numeric($id))
        {
            $status = $this->mtotal_clientes->eliminarvtotal($id);
            if($status==true)
            {
                $this->session->set_flashdata('eliminado', 'Eliminado correctamente');
                redirect(base_url('clientes/ctotal_clientes'));
            }
            else
            {
                $this->session->set_flashdata('erroreliminar', 'Error al eliminar');
                redirect(base_url('clientes/ctotal_clientes'));
            }
        }
    }
}

?>