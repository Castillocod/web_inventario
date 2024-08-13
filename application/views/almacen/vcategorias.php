<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen - Categorias</title>
</head>
<body>
    <div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Categorias de Productos</h3>
                </div>
                <!-- AQUÍ INICIA EL MODAL PARA AGREGAR CATEGORIAS -->
                <div class="modal fade" id="vcat_agregarcategorias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Registro de Categorias
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vcat_formregistrar" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="categoria" class="form-label">Categoría</label>
                                            <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoría">
                                        </div>
                                        <div class="col-6">
                                            <label for="fecha_vcat" class="form-label">Fecha</label>
                                            <input type="text" name="fecha_vcat" id="fecha_vcat" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="estado_cat" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" type="checkbox" id="switchestadocat">
                                            <label id="estado_lblcat" name="estado_lblcat" class="form-check-label" value=""></label>
                                            <input type="hidden" id="estado_vcat" name="estado_vcat" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vcat_regcancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vcat_registrar">Registrar categoria</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA AGREGAR CATEGORIAS -->

                <!--  INICIO DE MODAL DE EDITAR CATEGORIAS -->
                <div class="modal fade" id="vcat_modeditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Editar Categoría
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vcat_formeditar" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="editid" name="editid" value="" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="editcategoria" class="form-label">Categoria</label>
                                            <input type="text" name="editcategoria" id="editcategoria" class="form-control" placeholder="Categoría">
                                        </div>
                                        <div class="col-6">
                                            <label for="editfecha_vcat">Fecha</label>
                                            <input type="text" name="editfecha_vcat" id="editfecha_vcat" class="form-control" placeholder="Fecha">
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="edit_estado_cat" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" type="checkbox" id="edit_switchestadocat">
                                            <label id="edit_estado_lblcat" name="edit_estado_lblcat" class="form-check-label" value=""></label>
                                            <input type="hidden" id="edit_estado_vcat" name="edit_estado_vcat" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vcat_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FINAL DE MODAL DE EDITAR CATEGORIAS -->

                <!-- AQUÍ INICIA EL MODAL PARA IMPORTAR EXCEL -->
                <div class="modal fade" id="vcat_modexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    IMPORTACIÓN DE EXCEL
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url()?>almacen/ccategorias/importexcel_vcat" enctype="multipart/form-data" method="post">
                                    <div class="mb-3">
                                    <input type="file" name="file_excel" required />
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    <button class="btn btn-success" type="submit" name="excel_submit">Importar</button>
                                    </div>
                                    <?php if($this->session->flashdata('importado')) { ?>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    title: "Importación exitosa",
                                                    text: "Archivo importado con éxito",
                                                    icon: "success",
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    timer: 1500
                                                });
                                            });
                                        </script>
                                    <?php } ?>
                                    <?php if($this->session->flashdata('error')) { ?>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Oops...",
                                                    text: "Algo salio mal al importar",
                                                    allowOutsideClick: false,
                                                    timer: 3000
                                                });
                                            });
                                        </script>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA IMPORTAR EXCEL -->
                 <!-- AQUÍ INICIA EL MODAL PARA EXPORTAR POR MES Y DIAS -->
                <div class="modal fade" id="vcat_exportarexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Exportación por Tiempo
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de exportación</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Datos por Fecha</legend></fieldset>
                                    <div class="row d-flex justify-content-between">                                    
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_excelvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_excelvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_excelvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_excelvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Datos por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_excelvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_excelvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Todos los Datos</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_excelvcat" id="total_excelvcat" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_excelvcat">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_excelvcat">Cancelar</button>
                                <button class="btn btn-success" id="crear_excelvcat" onclick="exportarexcel_vcat()">Exportar datos</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA EXPORTAR POR MES Y DIAS -->
                 <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_actvcat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Categorias Activas
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_actvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_actvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_actvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_actvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_actvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_actvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvcat" id="total_actvcat" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_actvcat">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_actvcat">Cancelar</button>
                                <button class="btn btn-success" id="crear_actvcat" onclick="reporteactivos_vcat()">Crear Reporte</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->
                <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE INACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_inactvcat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Categorias Inactivas
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_inactvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_inactvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_inactvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_inactvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_inactvcat"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_inactvcat" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvcat" id="total_inactvcat" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_inactvcat">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_inactvcat">Cancelar</button>
                                <button class="btn btn-success" id="crear_inactvcat" onclick="reporteinactivos_vcat()">Crear Reporte</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA REPORTES DE INACTIVOS POR MES Y DIAS -->
                <div class="row dt-search">
                    <div>
                        <label for="dt-search-0">Buscar:</label>
                    </div>
                    <div class="col-3">
                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_vcat" placeholder="Escriba para buscar..." aria-controls="tabla_vcat">
                    </div>
                    <div class="col-9 d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vcat_agregarcategorias">Registrar Categorias</a>
                        <div style="padding-left: 10px">
                            <div class="dropdown_cat" id="dropdown_vcategorias">
                                <div class="select_vcat">
                                    <span class="selected_vcat">Imprimir reportes</span>
                                    <div class="caret_vcat"></div>
                                </div>
                                <ul class="menu_vcat">
                                    <li><button class="btn btn-default" id="btnactivos_actvcat" data-bs-toggle="modal" data-bs-target="#reportespdf_actvcat"><i class="fa-regular fa-file-pdf"></i>&nbspCategorias Activas</button></li>
                                    <li><button class="btn btn-default" id="btninactivos_inactvcat" data-bs-toggle="modal" data-bs-target="#reportespdf_inactvcat"><i class="fa-regular fa-file-pdf"></i>&nbspCategorias Inactivas</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <div class="dt-length text-center">
                            <div class="input-group">
                                <h5 style="padding-top: 5px; padding-right: 5px">Ver:</h5>
                                <select class="form-select" id="dt-length-0" name="tabla_vcat_length" style="border-radius: 5px;" aria-controls="tabla_vcat">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <!--Aquí inicia la tabla -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tabla_vcat">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Estado</th> <!-- Aquí indicara si estara activo o no -->
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div><br>
                <!--Aquí termina la tabla -->
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vcat_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left: 10px;">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vcat_exportarexcel" id="btnexcel_vcat" name="btnexcel_vcat">
                                    <span>Exportar Excel</span>
                                </button>
                            </div>
                        </div> 
                        <div class="d-flex justify-content-end" id="pagination_categorias">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php if ($this->session->flashdata('eliminado')) { ?> <!--  Este mensaje de alerta si esta en funcionamiento -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Categoría eliminada",
                text: "Categoría eliminada con éxito",
                icon: "success",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1500
            });
        });
    </script> 
<?php } ?>

<?php if($this->session->flashdata('erroreliminar')) {?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Algo salio mal al eliminar",
                allowOutsideClick: false,
                timer: 3000
            });
        });
    </script>
<?php } ?>
</html>