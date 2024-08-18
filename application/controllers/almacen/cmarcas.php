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

    public function importexcel_vmarcas()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $doc_estado = $this->vmarcas_importexcel();
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

                    $marca = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
                    $estado_vmarcas = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
                    $fecha_vmarcas = date('Y-m-d');

                    $datosdocumento = array(
                        'marca' => $marca,
                        'estado_vmarcas' => $estado_vmarcas,
                        'fecha_vmarcas' => $fecha_vmarcas
                    );

                    $this->db->insert('almacen_marcas', $datosdocumento);
                    $count_rows++;
                }
                $this->session->set_flashdata('importado', 'Importación exitosa');
                redirect(base_url('almacen/cmarcas'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Ha ocurrido un error al importar');
                redirect(base_url('almacen/cmarcas'));
            }
        }
        else
        {
            $this->load->view('layouts/header');
            $this->load->view('layouts/content');
            $this->load->view('almacen/vmarcas');
            $this->load->view('layouts/footer');
        }
    }

    public function vmarcas_importexcel()
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
            return $nombre_archivo('file_name');
        }
        else
        {
            return false;
        }
    }

    public function excelfechas_vmarcas()
    {
        $fechauno_excelvmarcas = $this->input->get('fechauno');
        $fechados_excelvmarcas = $this->input->get('fechados');

        if(!$fechauno_excelvmarcas || !$fechados_excelvmarcas)
        {
            show_error('Fechas no validas');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Marca',
            'Estado',
            'Fecha de Registro'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vmarcas = $this->mmarcas->excelfechas_vmarcas($fechauno_excelvmarcas, $fechados_excelvmarcas);
        $celda_excel = 2;

        foreach($datos_vmarcas as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->marca);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vmarcas);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->fecha_vmarcas);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Marcas.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function excelmes_vmarcas()
    {
        $mes_excelvmarcas = $this->input->get('mes');

        if(!$mes_excelvmarcas)
        {
            show_error("Falta recibir parametros");
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Marca',
            'Estado',
            'Fecha de Registro'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vmarcas = $this->mmarcas->excelmes_vmarcas($mes_excelvmarcas);
        $celda_excel = 2;

        foreach($datos_vmarcas as $row){
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->marca);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vmarcas);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->fecha_vmarcas);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="marcas.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function exceltotal_vmarcas()
    {
        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Marca',
            'Estado',
            'Fecha de Registro'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vmarcas = $this->mmarcas->exceltotal_vmarcas();
        $celda_excel = 2;

        foreach($datos_vmarcas as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->marca);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vmarcas);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->fecha_vmarcas);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="marcas.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function pdfactfechas_vmarcas()
    {
        $fechauno_actvmarcas = $this->input->get('fechauno');
        $fechados_actvmarcas = $this->input->get('fechados');

        if($fechauno_actvmarcas && $fechados_actvmarcas)
        {
            $data['almacen_marcas'] = $this->mmarcas->pdfactfechas_vmarcas($fechauno_actvmarcas, $fechados_actvmarcas);
            $html = $this->load->view('almacen/reportes_vmarcas/rep_activos_vmarcas', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir las fechas';
        }
    }

    public function pdfactmes_vmarcas()
    {
        $mes_actvmarcas = $this->input->get('mes');

        if($mes_actvmarcas)
        {
            $data['almacen_marcas'] = $this->mmarcas->pdfactmes_vmarcas($mes_actvmarcas);
            $html = $this->load->view('almacen/reportes_vmarcas/rep_activos_vmarcas', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir el mes';
        }
    }

    public function pdfacttotal_vmarcas()
    {
        $data['almacen_marcas'] = $this->mmarcas->pdfacttotal_vmarcas();
        $html = $this->load->view('almacen/reportes_vmarcas/rep_activos_vmarcas', $data, true);
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pdfinactfechas_vmarcas()
    {
        $fechauno_inactvmarcas = $this->input->get('fechauno');
        $fechados_inactvmarcas = $this->input->get('fechados');

        if($fechauno_inactvmarcas && $fechados_inactvmarcas)
        {
            $data['almacen_marcas'] = $this->mmarcas->pdfinactfechas_vmarcas($fechauno_inactvmarcas, $fechados_inactvmarcas);
            $html = $this->load->view('almacen/reportes_vmarcas/rep_inactivos_vmarcas', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir las fechas';
        }
    }

    public function pdfinactmes_vmarcas()
    {
        $mes_inactvmarcas = $this->input->get('mes');

        if($mes_inactvmarcas)
        {
            $data['almacen_marcas'] = $this->mmarcas->pdfinactmes_vmarcas($mes_inactvmarcas);
            $html = $this->load->view('almacen/reportes_vmarcas/rep_inactivos_vmarcas', $data, true);
            $mpdf = new Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir el mes';
        }
    }

    public function pdfinacttotal_vmarcas()
    {
        $data['almacen_marcas'] = $this->mmarcas->pdfinacttotal_vmarcas();
        $html = $this->load->view('almacen/reportes_vmarcas/rep_inactivos_vmarcas', $data, true);
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
?>