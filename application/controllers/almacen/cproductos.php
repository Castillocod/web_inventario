<?php 

require ('vendor/autoload.php');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class cproductos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('almacen/mproductos');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['marcas'] = $this->mproductos->obtenermarcas();
        $this->data['categorias'] = $this->mproductos->obtenercategorias();
        $this->load->view('layouts/header');
        $this->load->view('layouts/content');
        $this->load->view('almacen/vproductos', $this->data);
        $this->load->view('layouts/footer');
    }

    public function obtenerdatos()
    {
        $columns = [
            'id',
            'modelo',
            'marca',
            // 'categoria',
            'titulo',
            'stock',
            'preciolista',
            'precioespecial',
            'preciooriginal',
            'preciointegrado',
            'preciotienda',
            'codigofiscal',
            'estado_prod'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        // $ordercolumns = $this->input->post('order')[0]['column'];
        // $order = $columns[$ordercolumns];
        // $dir = $this->input->post('order')[0]['dir'];

        $totaldata = $this->mproductos->all_vproductos_count();
        $totalfiltered = $totaldata;

        if(empty($this->input->post('search')['value']))
        {
            $vproductos = $this->mproductos->all_vproductos($limit, $start);
        }
        else
        {
            $search = $this->input->post('search')['value'];
            $vproductos = $this->mproductos->vproductos_search($limit, $start, $search);
            $totalfiltered = $this->mproductos->vproductos_search_count($search);
        }

        $data = array();
        if(!empty($vproductos)){
            foreach($vproductos as $vproducto){
                $vdata['id'] = $vproducto->id;
                $vdata['modelo'] = $vproducto->modelo;
                $vdata['marca'] = $vproducto->marca;
                // $vdata['categoria'] = $vproducto->categoria;
                $vdata['titulo'] = $vproducto->titulo;
                $vdata['stock'] = $vproducto->stock;
                $vdata['preciolista'] = $vproducto->preciolista;
                $vdata['precioespecial'] = $vproducto->precioespecial;
                $vdata['preciooriginal'] = $vproducto->preciooriginal;
                $vdata['preciointegrado'] = $vproducto->preciointegrado;
                $vdata['preciotienda'] = $vproducto->preciotienda;
                $vdata['codigofiscal'] = $vproducto->codigofiscal;
                $vdata['estado_prod'] = $vproducto->estado_prod;

                $data[] = $vdata;
            }
        }

        $json_data = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($totaldata),
            'recordsFiltered' => intval($totalfiltered),
            'data' => $data
        );

        echo json_encode($json_data);
    }

    public function agregarproductos()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('modelo', 'Modelo', 'required|trim');
            $this->form_validation->set_rules('marca', 'Marca', 'required|trim');
            $this->form_validation->set_rules('categoria', 'Categoria', 'required|trim');
            $this->form_validation->set_rules('titulo', 'Titulo', 'required|trim');
            $this->form_validation->set_rules('stock', 'Stock');
            $this->form_validation->set_rules('preciolista', 'Preciolista');
            $this->form_validation->set_rules('precioespecial', 'Precioespecial');
            $this->form_validation->set_rules('preciooriginal', 'Preciooriginal');
            $this->form_validation->set_rules('preciointegrado', 'Preciointegrado');
            $this->form_validation->set_rules('preciotienda', 'Preciotienda');
            $this->form_validation->set_rules('codigofiscal', 'Codigofiscal', 'required|trim');
            $this->form_validation->set_rules('estado_prod', 'Estado_prod');
            $this->form_validation->set_rules('fecha_vprod', 'Fecha_vprod', 'required');

            $this->form_validation->set_message(array(
                "required" => "<strong>{field}</strong> debe ser completado",
                "valid_email" => "Por favor, ingrese una dirección de correo electronico valida",
                "is_unique" => "Ya existe un usuario con el mismo nombre",
                "min_length" => "El número debe ser de 10 digitos"
            ));

            if($this->form_validation->run() == FALSE)
            {
                $data = array('responce' => 'error', 'message' => validation_errors());
                echo json_encode($data);
                return;
            }
            else
            {
                $ajax_data = $this->input->post();

                $productostock = $this->mproductos->productostock(
                    $ajax_data['modelo'],
                    $ajax_data['marca'],
                    $ajax_data['titulo'],
                    $ajax_data['codigofiscal']
                );

                if($productostock){
                    $actualizarstock = $ajax_data['stock'];
                    $this->mproductos->actualizarstock($productostock['id'], $actualizarstock, $ajax_data);
                    $data = array('responce' => 'success');
                }
                else
                {
                    if($this->mproductos->agregarproductos($ajax_data))
                    {
                        $data = array('responce' => 'success');
                        echo json_encode($data);
                    }
                    else
                    {
                        $data = array('responce' => 'error');
                        echo json_encode($data);
                    }
                }
            }
            echo json_encode($data);
        }
        else
        {
            echo 'Script fallido';
        }
    }

    public function actualizarproductos()
    {
        if($this->input->is_ajax_request())
        {
            $this->form_validation->set_rules('editmodelo', 'Modelo', 'required|trim');
            $this->form_validation->set_rules('editmarca', 'Marca', 'required|trim');
            $this->form_validation->set_rules('editcategoria', 'Categoria', 'required|trim');
            $this->form_validation->set_rules('edittitulo', 'Titulo', 'required|trim');
            $this->form_validation->set_rules('editstock', 'Stock');
            $this->form_validation->set_rules('editpreciolista', 'Preciolista');
            $this->form_validation->set_rules('editprecioespecial', 'Precioespecial');
            $this->form_validation->set_rules('editpreciooriginal', 'Preciooriginal');
            $this->form_validation->set_rules('editpreciointegrado', 'Preciointegrado');
            $this->form_validation->set_rules('editpreciotienda', 'Preciotienda');
            $this->form_validation->set_rules('editcodigofiscal', 'Codigofiscal', 'required|trim');
            $this->form_validation->set_rules('edit_estado_prod', 'Estado');

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
                $data['modelo'] = $this->input->post('editmodelo');
                $data['marca'] = $this->input->post('editmarca');
                $data['categoria'] = $this->input->post('editcategoria');
                $data['titulo'] = $this->input->post('edittitulo');
                $data['stock'] = $this->input->post('editstock');
                $data['preciolista'] = $this->input->post('editpreciolista');
                $data['precioespecial'] = $this->input->post('editprecioespecial');
                $data['preciooriginal'] = $this->input->post('editpreciooriginal');
                $data['preciointegrado'] = $this->input->post('editpreciointegrado');
                $data['preciotienda'] = $this->input->post('editpreciotienda');
                $data['codigofiscal'] = $this->input->post('editcodigofiscal');
                $data['estado_prod'] = $this->input->post('edit_estado_prod');

                if($this->mproductos->actualizarproductos($data))
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

    public function editarproductos($id)
    {
        $data = $this->mproductos->editarproductos($id);
        echo json_encode($data);
    }

    public function eliminar($id)
    {
        if(is_numeric($id))
        {
            $status = $this->mproductos->eliminarproductos($id);
            if($status==true)
            {
                $this->session->set_flashdata('eliminado', 'Eliminado exitosamente');
                redirect(base_url('almacen/cproductos'));
            }
            else
            {
                $this->session->set_flashdata('erroreliminar', 'Error al eliminar');
                redirect(base_url('almacen/cproductos'));
            }
        }
    }

    public function obtenerformulas()
    {
        $formulas = $this->mproductos->obtenerformulas();

        echo json_encode($formulas);
    }

    public function excelproductos()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $doc_estado = $this->productosexcelimport();
            if($doc_estado != false)
            {
                $doc_nombre = 'assets/documentos/imports/'.$doc_estado;
                $doc_tiletype = \PhpOffice\PhpSpreadsheet\IOFactory::identify($doc_nombre);
                $doc_lector = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($doc_tiletype);
                $spreadsheet = $doc_lector->load($doc_nombre);
                $document = $spreadsheet->getSheet(0);
                $count_rows = 0;

                $porcentajes = $this->mproductos->obtenerporcentajes();
                $porcentajeintegrador = $porcentajes['porcentajeintegrador'];
                $porcentajetienda = $porcentajes['porcentajetienda'];

                foreach($document->getRowIterator() as $filauno => $row)
                {
                    if($filauno === 1)
                    {
                        continue;
                    }

                    $modelo = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
                    $marca = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
                    $categoria = $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
                    $titulo = $spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());
                    $stock = $spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex())->getValue();
                    $preciolista = $spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex());
                    $precioespecial = $spreadsheet->getActiveSheet()->getCell('G'.$row->getRowIndex());
                    $preciooriginal = $spreadsheet->getActiveSheet()->getCell('H'.$row->getRowIndex())->getValue();
                    $preciointegrado = $preciooriginal * $porcentajeintegrador;
                    $preciotienda = $preciointegrado * $porcentajetienda;
                    $codigofiscal = $spreadsheet->getActiveSheet()->getCell('K'.$row->getRowIndex());
                    $estado_prod = $spreadsheet->getActiveSheet()->getCell('L'.$row->getRowIndex());

                    $productostock = $this->mproductos->productostock($modelo, $marca, $titulo, $codigofiscal);

                    if($productostock){
                        $id_producto = $productostock['id'];
                        $newstock = $productostock['stock'] + $stock;
                        $this->mproductos->actualizarstockexcel($id_producto, $newstock);
                    }
                    else
                    {
                        $datosdocumento = array(
                            'modelo' => $modelo,
                            'marca' => $marca,
                            'categoria' => $categoria,
                            'titulo' => $titulo,
                            'stock' => $stock,
                            'preciolista' => $preciolista,
                            'precioespecial' => $precioespecial,
                            'preciooriginal' => $preciooriginal,
                            'preciointegrado' => $preciointegrado,
                            'preciotienda' => $preciotienda,
                            'codigofiscal' => $codigofiscal,
                            'estado_prod' => $estado_prod
                        );
                        $this->db->insert('almacen_productos', $datosdocumento);
                    }
                    $count_rows++;
                }
                $this->session->set_flashdata('importado', 'Importación exitosa');
                redirect(base_url('almacen/cproductos'));
            }
            else
            {
                $this->session->set_Flashdata('error', 'Ha ocurrido un error al importar');
                redirect(base_url('almacen/cproductos'));
            }
        }
        else
        {
            $deexcel = true;
            $this->load->view('layouts/header');
            $this->load->view('layouts/content');
            $this->load->view('almacen/vproductos', array('deexcel' => $deexcel));
            $this->load->view('layouts/footer');
        }
    }

    function productosexcelimport()
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

    public function allproductosexcel()
    {
        $excelproductos = $this->mproductos->allproductosexcel();
        echo json_encode($excelproductos);
    }

    public function pdf_activos()
    {
        $data['almacen_productos'] = $this->mproductos->pdf_activos();
        $html = $this->load->view('almacen/reportes_vproductos/rep_activos_vprod', $data, true);
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pdf_inactivos()
    {
        $data['almacen_productos'] = $this->mproductos->pdf_inactivos();
        $html = $this->load->view('almacen/reportes_vproductos/rep_inactivos_vprod', $data, true);
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function exportar_vprod()
    {
        $this->load->library('excel');
        $objeto = new PHPExcel();

        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'Modelo',
            'Marca',
            'Categoria',
            'Titulo',
            'Stock',
            'Precio Lista',
            'Precio Especial',
            'Precio Original',
            'Precio Integrado',
            'Precio Tienda',
            'Codigo Fiscal',
            'Estado'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vproductos = $this->mproductos->exportar_vprod();   

        $celda_excel = 2;

        foreach($datos_vproductos as $row)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->modelo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->marca);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->titulo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->stock);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $celda_excel, $row->preciolista);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $celda_excel, $row->precioespecial);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(6, $celda_excel, $row->preciooriginal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(7, $celda_excel, $row->preciointegrado);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(8, $celda_excel, $row->preciotienda);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(9, $celda_excel, $row->codigofiscal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(10, $celda_excel, $row->estado_prod);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment:filename="Productos.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function exportar_vprod_fechas()
    {
        $fechainicio = $this->input->get('fechainicio');
        $fechafin = $this->input->get('fechafin');

        if(!$fechainicio || !$fechafin){
            show_error('Fechas no validas');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'Modelo',
            'Marca',
            'Categoria',
            'Titulo',
            'Stock',
            'Precio Lista',
            'Precio Especial',
            'Precio Original',
            'Precio Integrado',
            'Precio Tienda',
            'Codigo Fiscal',
            'Estado'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila)
        {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vproductos = $this->mproductos->exportar_vprod_fechas($fechainicio, $fechafin);
        $celda_excel = 2;

        foreach ($datos_vproductos as $row) {
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->modelo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->marca);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->titulo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->stock);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $celda_excel, $row->preciolista);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $celda_excel, $row->precioespecial);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(6, $celda_excel, $row->preciooriginal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(7, $celda_excel, $row->preciointegrado);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(8, $celda_excel, $row->preciotienda);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(9, $celda_excel, $row->codigofiscal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(10, $celda_excel, $row->estado_prod);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Productos.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }

    public function exportar_vprod_meses()
    {
        $mes = $this->input->get('mes');

        if(!$mes){
            show_error('Mes no valido');
        }

        $this->load->library('excel');
        $objeto = new PHPExcel();
        $objeto->setActiveSheetIndex(0);

        $columnas_tabla = array(
            'Modelo',
            'Marca',
            'Categoria',
            'Titulo',
            'Stock',
            'Precio Lista',
            'Precio Especial',
            'Precio Original',
            'Precio Integrado',
            'Precio Tienda',
            'Codigo Fiscal',
            'Estado'
        );

        $columna = 0;

        foreach($columnas_tabla as $fila){
            $objeto->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $fila);
            $columna++;
        }

        $datos_vproductos = $this->mproductos->exportar_vprod_meses($mes);
        $celda_excel = 2;

        foreach($datos_vproductos as $row){
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $celda_excel, $row->modelo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $celda_excel, $row->marca);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $celda_excel, $row->titulo);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $celda_excel, $row->stock);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $celda_excel, $row->preciolista);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $celda_excel, $row->precioespecial);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(6, $celda_excel, $row->preciooriginal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(7, $celda_excel, $row->preciointegrado);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(8, $celda_excel, $row->preciotienda);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(9, $celda_excel, $row->codigofiscal);
            $objeto->getActiveSheet()->setCellValueByColumnAndRow(10, $celda_excel, $row->estado_prod);
            $celda_excel++;
        }

        $objeto_documento = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Productos.xlsx"');
        header('Cache-Control: max-age=0');

        $objeto_documento->save('php://output');
    }
}
?>