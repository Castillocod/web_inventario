<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen - Marcas</title>
</head>
<body>
    <div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Marcas de Productos</h3>
                </div>
                <!-- AQUÍ INICIA EL MODAL PARA AGREGAR MARCAS -->
                <div class="modal fade" id="vmarcas_agregarmarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Registro de Marcas
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="vmarcas_formregistrar" enctype="multipart/form-data">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="marca" class="form-label">Marca</label>
                                            <input type="text" name="marca" id="marca" class="form-control" placeholder="Marca">
                                        </div>
                                        <div class="col-6">
                                            <label for="fecha_vmarcas">Fecha</label>
                                            <input type="text" name="fecha_vmarcas" id="fecha_vmarcas" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="col-12">
                                        <label for="estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="switchestadomarcas">
                                            <label id="estado_lblmarcas" name="estado_lblmarcas" class="form-check-label" value=""></label>
                                            <input type="hidden" id="estado_vmarcas" name="estado_vmarcas" value="">
                                        </div>
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vmarcas_regcancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vmarcas_registrar">Registrar marca</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA AGREGAR MARCAS -->

                <!--  INICIO DE MODAL DE EDITAR MARCAS -->
                <div class="modal fade" id="vmarcas_modeditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Editar Marca de Productos
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vmarcas_formeditar" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="editid" name="editid" value="" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="editmarca" class="form-label">Marca</label>
                                            <input type="text" name="editmarca" id="editmarca" class="form-control" placeholder="Marca">
                                        </div>
                                        <div class="col-6">
                                            <label for="editfecha_vmarcas">Fecha</label>
                                            <input type="text" name="editfecha_vmarcas" id="editfecha_vmarcas" placeholder="Fecha" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="col-12">
                                        <label for="edit_estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="edit_switchestadomarcas">
                                            <label id="edit_estado_lblmarcas" name="edit_estado_lblmarcas" class="form-check-label" value=""></label>
                                            <input type="hidden" id="edit_estado_vmarcas" name="edit_estado_vmarcas" value="">
                                        </div>
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vmarcas_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FINAL DE MODAL DE EDITAR MARCAS -->

                <!-- AQUÍ INICIA EL MODAL PARA IMPORTAR EXCEL -->
                <div class="modal fade" id="vmarcas_modexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    IMPORTACIÓN DE EXCEL
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url()?>almacen/cmarcas/importexcel_vmarcas" enctype="multipart/form-data" method="post">
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
                <div class="modal fade" id="vmarcas_exportarexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
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
                                                <span class="form-control col-3" id="lblfechauno_excelvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_excelvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_excelvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_excelvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Datos por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_excelvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_excelvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Todos los Datos</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_excelvmarcas" id="total_excelvmarcas" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_excelvmarcas">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_excelvmarcas">Cancelar</button>
                                <button class="btn btn-success" id="crear_excelvmarcas" onclick="exportarexcel_vmarcas()">Exportar datos</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA EXPORTAR POR MES Y DIAS -->
                <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_actvmarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Marcas Activas
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_actvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_actvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_actvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_actvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_actvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_actvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvmarcas" id="total_actvmarcas" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_actvmarcas">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_actvmarcas">Cancelar</button>
                                <button class="btn btn-success" id="crear_actvmarcas" onclick="reporteactivos_vmarcas()">Crear Reporte</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->

                <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE INACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_inactvmarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Marcas Inactivas
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_inactvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_inactvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_inactvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_inactvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_inactvmarcas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_inactvmarcas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvmarcas" id="total_inactvmarcas" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_inactvmarcas">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_inactvmarcas">Cancelar</button>
                                <button class="btn btn-success" id="crear_inactvmarcas" onclick="reporteinactivos_vmarcas()">Crear Reporte</button>
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
                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_vmarcas" placeholder="Escriba para buscar..." aria-controls="tabla_vmarcas">
                    </div>
                    <div class="col-9 d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vmarcas_agregarmarcas">Registrar Marcas</a>
                        <div style="padding-left: 10px">
                            <div class="dropdown_vmarcas" id="dropdowns_vmarcas">
                                <div class="select_vmarcas">
                                    <span class="selected_vmarcas">Imprimir reportes</span>
                                    <div class="caret_vmarcas"></div>
                                </div>
                                <ul class="menu_vmarcas">
                                    <li><button class="btn btn-default" id="btnactivos_actvmarcas" data-bs-toggle="modal" data-bs-target="#reportespdf_actvmarcas"><i class="fa-regular fa-file-pdf"></i>&nbspMarcas Activas</button></li>
                                    <li><button class="btn btn-default" id="btninactivos_inactvmarcas" data-bs-toggle="modal" data-bs-target="#reportespdf_inactvmarcas"><i class="fa-regular fa-file-pdf"></i>&nbspMarcas Inactivas</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <div class="dt-length text-center">
                            <div class="input-group">
                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                <select class="form-select" id="dt-length-0" name="tabla_vmarcas_length" style="border-radius: 5px;" aria-controls="tabla_vmarcas">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <!--Aquí inicia la tabla -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tabla_vmarcas">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Estado</th> <!-- Aquí indicara si estara activo o no -->
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div><br>
                <!--Aquí termina la tabla -->
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vmarcas_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left: 10px;">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vmarcas_exportarexcel" id="btnexcel_vmarcas" name="btnexcel_vmarcas">
                                    Exportar Excel
                                </button>                                
                            </div>
                        </div> 
                    </div>
                    <div class="d-flex justify-content-end" id="pagination_marcas">
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
                title: "Marca eliminada",
                text: "Marca eliminada con éxito",
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