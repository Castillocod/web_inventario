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

    public function comprobacionvcat()
    {
        $comprobacionvcat = $this->mcategorias->comprobacionvcat();
        echo json_encode($comprobacionvcat > 0);
    }

    public function agregarcategorias()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('categoria', 'Categoria', 'required|trim');
            $this->form_validation->set_rules('estado_vcat', 'Estado', 'trim');
            $this->form_validation->set_rules('fecha_vcat', 'Fecha_vcat', 'required');

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
            $this->form_validation->set_rules('editfecha_vcat', 'Fecha_vcat', 'required');

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
                $data['fecha_vcat'] = $this->input->post('editfecha_vcat');

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

    public function importexcel_vcat()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $doc_estado = $this->vcat_importexcel();
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

    public function vcat_importexcel()
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

    public function excelfechas_vcat()
    {
        $fechauno_excelvcat = $this->input->get('fechauno');
        $fechados_excelvcat = $this->input->get('fechados');

        if(!$fechauno_excelvcat || !$fechados_excelvcat)
        {
            show_error('Fechas no validas');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Categoria',
            'Estado',
            'Fecha de Registro'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vcat = $this->mcategorias->excelfechas_vcat($fechauno_excelvcat, $fechados_excelvcat); 
        $celda_excel = 2;

        foreach($datos_vcat as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->categoria);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vcat);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->fecha_vcat);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Categorias.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function excelmes_vcat()
    {
        $mes_excelvcat = $this->input->get('mes');

        if(!$mes_excelvcat)
        {
            show_error('Mes no valido');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Categoria',
            'Estado',
            'Fecha de Registro'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vcat = $this->mcategorias->excelmes_vcat($mes_excelvcat);
        $celda_excel = 2;

        foreach($datos_vcat as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->categoria);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vcat);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->fecha_vcat);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Categorias.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function exceltotal_vcat()
    {
        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'ID',
            'Categoria',
            'Estado',
            'Fecha de Registro'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vcat = $this->mcategorias->exceltotal_vcat();
        $celda_excel = 2;

        foreach($datos_vcat as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->id);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->categoria);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->estado_vcat);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->fecha_vcat);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="total_categorias.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function pdfactfechas_vcat()
    {
        $fechauno_actvcat = $this->input->get('fechauno');
        $fechados_actvcat = $this->input->get('fechados');

        if($fechauno_actvcat && $fechados_actvcat)
        {
            $data['almacen_categorias'] = $this->mcategorias->pdfactfechas_vcat($fechauno_actvcat, $fechados_actvcat) ?? [];
            $html = $this->load->view('almacen/reportes_vcategorias/rep_activos_vcat', $data, true);
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->writeHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir las fechas';
        }
    }

    public function pdfactmes_vcat()
    {
        $mes_actvcat = $this->input->get('mes');

        if($mes_actvcat)
        {
            $data['almacen_categorias'] = $this->mcategorias->pdfactmes_vcat($mes_actvcat) ?? [];
            $html = $this->load->view('almacen/reportes_vcategorias/rep_activos_vcat', $data, true);
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->writeHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir el mes';
        }
    }

    public function pdfacttotal_vcat()
    {
        $data['almacen_categorias'] = $this->mcategorias->pdfacttotal_vcat() ?? [];
        $html = $this->load->view('almacen/reportes_vcategorias/rep_activos_vcat', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pdfinactfechas_vcat()
    {
        $fechauno_inactvcat = $this->input->get('fechauno');
        $fechados_inactvcat = $this->input->get('fechados');

        if($fechauno_inactvcat && $fechados_inactvcat)
        {
            $data['almacen_categorias'] = $this->mcategorias->pdfinactfechas_vcat($fechauno_inactvcat, $fechados_inactvcat) ?? [];
            $html = $this->load->view('almacen/reportes_vcategorias/rep_inactivos_vcat', $data, true);
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->writeHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir las fechas';
        }
    }

    public function pdfinactmes_vcat()
    {
        $mes_inactvcat = $this->input->get('mes');

        if($mes_inactvcat)
        {
            $data['almacen_categorias'] = $this->mcategorias->pdfinactmes_vcat($mes_inactvcat) ?? [];
            $html = $this->load->view('almacen/reportes_vcategorias/rep_inactivos_vcat', $data, true);
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else
        {
            echo 'Fallo al recibir el mes';
        }
    }

    public function pdfinacttotal_vcat()
    {
        $data['almacen_categorias'] = $this->mcategorias->pdfinacttotal_vcat() ?? [];
        $html = $this->load->view('almacen/reportes_vcategorias/rep_inactivos_vcat', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function fechasmeses_vcat()
    {
        $primerfecha = $this->mcategorias->primerfecha();
        $ultimafecha = $this->mcategorias->ultimafecha();
        $primermes = $this->mcategorias->primermes();
        $ultimomes = $this->mcategorias->ultimomes();

        echo json_encode(array(
            'primerfecha' => $primerfecha,
            'ultimafecha' => $ultimafecha,
            'primermes' => $primermes,
            'ultimomes' => $ultimomes
        ));
    }
}
?>