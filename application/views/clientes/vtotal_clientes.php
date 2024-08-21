<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total - Clientes</title>
</head>

<body>

    <div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Total de Clientes</h3>
                </div>
                <!-- AQUÍ INICIA EL MODAL PARA AGREGAR PRODUCTOS -->
                <div class="modal fade" id="vtotal_agregarclientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Registro de Cliente
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="vtotal_formregistrar" enctype="multipart/form-data">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="tipocliente" class="form-label">Tipo de Cliente</label>
                                            <!-- <input type="text" name="tipocliente" id="tipocliente" placeholder="Tipo de Cliente" class="form-control"> -->
                                            <select name="tipocliente" id="tipocliente" class="form-control">
                                                <option value="" disabled selected>Selecciona el tipo de cliente</option>
                                                <?php if(!empty($tipoclientes) && is_array($tipoclientes)) { ?>
                                                    <?php foreach ($tipoclientes as $tipocliente) { ?>
                                                        <option value="<?= $tipocliente['tipocliente']?>"><?= $tipocliente['tipocliente']?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" name="correo" id="correo" placeholder="Correo" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="text" maxlength="10" name="telefono" id="telefono" class="form-control" placeholder="Telefono">
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="ciudad" class="form-label">Ciudad</label>
                                            <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="estado" class="form-label">Estado</label>
                                            <input type="text" name="estado_vtotal" id="estado_vtotal" placeholder="Estado" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="pais" class="form-label">País</label>
                                        <input type="text" name="pais" id="pais" placeholder="País" class="form-control">
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <input type="text" name="direccion" id="direccion" placeholder="Dirección" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="fecha_vtotal">Fecha</label>
                                            <input type="text" name="fecha_vtotal" id="fecha_vtotal" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div>                                                           
                                    <div class="mb-3">
                                        <label for="empresa" class="form-label">Empresa</label>
                                        <input type="text" name="empresa" id="empresa" placeholder="Empresa" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rfc" class="form-label">RFC</label>
                                        <input type="text" name="rfc" id="rfc" placeholder="RFC" maxlength="13" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                    <label for="disponible_vtotal" style="padding-right: 60px">Disponible</label>
                                        <div class="form-check form-switch d-flex align-item-center">
                                            <input class="form-check-input" type="checkbox" id="switchdisponiblevtotal">
                                            <label id="disponible_lblvtotal" name="disponible_lblvtotal" class="form-check-label" value=""></label>
                                            <input type="hidden" id="disponible_vtotal" name="disponible_vtotal" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vtotal_regcancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vtotal_registrar">Registrar Cliente</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA AGREGAR PRODUCTOS -->

                <!--  INICIO DE MODAL DE EDITAR PRODUCTOS -->
                <div class="modal fade" id="vtotal_modeditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Editar Cliente
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vtotal_formeditar" enctype="multipart/form-data">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <input type="hidden" name="editid" id="editid" placeholder="ID" maxlength="6" class="form-control">
                                            <label for="editnombre" class="form-label">Nombre</label>
                                            <input type="text" name="editnombre" id="editnombre" placeholder="Nombre" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="edittipocliente" class="form-label">Tipo de Cliente</label>
                                            <!-- <input type="text" name="tipocliente" id="tipocliente" placeholder="Tipo de Cliente" class="form-control"> -->
                                            <select name="edittipocliente" id="edittipocliente" class="form-control">
                                                <!-- <option value="" disabled selected>Selecciona el tipo de cliente</option> -->
                                                <?php if (!empty($tipoclientes) && is_array($tipoclientes)) {?>
                                                    <?php foreach ($tipoclientes as $tipocliente) { ?>
                                                        <option value="<?= $tipocliente['tipocliente']?>"><?= $tipocliente['tipocliente']?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="editcorreo" class="form-label">Correo</label>
                                            <input type="email" name="editcorreo" id="editcorreo" placeholder="Correo" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="edittelefono" class="form-label">Telefono</label>
                                            <input type="text" maxlength="10" name="edittelefono" id="edittelefono" class="form-control" placeholder="Telefono">
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="editciudad" class="form-label">Ciudad</label>
                                            <input type="text" name="editciudad" id="editciudad" placeholder="Ciudad" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="editestado" class="form-label">Estado</label>
                                            <input type="text" name="editestado" id="editestado" placeholder="Estado" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="editpais" class="form-label">País</label>
                                        <input type="text" name="editpais" id="editpais" placeholder="País" class="form-control">
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="editdireccion" class="form-label">Dirección</label>
                                            <input type="text" name="editdireccion" id="editdireccion" placeholder="Dirección" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="editfecha_vtotal">Fecha</label>
                                            <input type="text" name="editfecha_vtotal" id="editfecha_vtotal" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div>                                                                       
                                    <div class="mb-3">
                                        <label for="editempresa" class="form-label">Empresa</label>
                                        <input type="text" name="editempresa" id="editempresa" placeholder="Empresa" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editrfc" class="form-label">RFC</label>
                                        <input type="text" name="editrfc" id="editrfc" placeholder="RFC" maxlength="13" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                    <label for="edit_disponible" style="padding-right: 60px">Disponible</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="edit_switchdisponiblevtotal">
                                            <label id="editdisponible_lblvtotal" name="editdisponible_lblvtotal" class="form-check-label" value=""></label>
                                            <input type="hidden" id="editdisponible_vtotal" name="editdisponible_vtotal" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vtotal_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FINAL DE MODAL DE EDITAR PRODUCTOS -->

                <!-- AQUÍ INICIA EL MODAL PARA IMPORTAR EXCEL -->
                <div class="modal fade" id="vtotal_modexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    IMPORTACIÓN DE EXCEL
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url() ?>clientes/ctotal_clientes/importexcel_vtotal" enctype="multipart/form-data" method="post">
                                    <div class="mb-3">
                                        <input type="file" name="file_excel" required />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-success" type="submit" name="excel_submit">Importar</button>
                                    </div>
                                    <?php if ($this->session->flashdata('importado')) { ?>
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
                                    <?php if ($this->session->flashdata('error')) { ?>
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
                <div class="modal fade" id="vtotal_exportarexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
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
                                                <span class="form-control col-3" id="lblfechauno_excelvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_excelvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_excelvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_excelvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Datos por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_excelvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_excelvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Todos los Datos</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_excelvtotal" id="total_excelvtotal" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_excelvtotal">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_excelvtotal">Cancelar</button>
                                <button class="btn btn-success" id="crear_excelvtotal" onclick="exportarexcel_vtotal()">Exportar datos</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA EXPORTAR POR MES Y DIAS -->

                <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_actvtotal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Clientes Activos
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_actvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_actvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_actvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_actvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_actvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_actvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvtotal" id="total_actvtotal" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_actvtotal">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_actvtotal">Cancelar</button>
                                <button class="btn btn-success" id="crear_actvtotal" onclick="reporteactivos_vtotal()">Crear Reporte</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->

                <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE INACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_inactvtotal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Clientes Inactivos
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_inactvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_inactvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_inactvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_inactvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_inactvtotal"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_inactvtotal" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvtotal" id="total_inactvtotal" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_inactvtotal">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_inactvtotal">Cancelar</button>
                                <button class="btn btn-success" id="crear_inactvtotal" onclick="reporteinactivos_vtotal()">Crear Reporte</button>
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
                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_vtotal" placeholder="Escriba para buscar..." aria-controls="tabla_vtotal">
                    </div>
                    <div class="col-9 d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vtotal_agregarclientes">Agregar Clientes</a>
                        <div style="padding-left: 10px">
                            <div class="dropdown_vtotal" id="dropdowns_vtotal">
                                <div class="select_vtotal">
                                    <span class="selected_vtotal">Imprimir reportes</span>
                                    <div class="caret_vtotal"></div>
                                </div>
                                <ul class="menu_vtotal">
                                    <li><button class="btn btn-default" id="btnactivos_actvtotal" data-bs-toggle="modal" data-bs-target="#reportespdf_actvtotal"><i class="fa-regular fa-file-pdf"></i>&nbspClientes Activos</button></li>
                                    <li><button class="btn btn-default" id="btninactivos_inactvtotal"><i class="fa-regular fa-file-pdf" data-bs-target="#reportespdf_inactvtotal"></i>&nbspClientes Inactivos</button></li>
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
                                <select class="form-select" id="dt-length-0" name="tabla_vtotal_length" style="border-radius: 5px;" aria-controls="tabla_vtotal">
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
                    <table class="table table-striped table-sm" id="tabla_vtotal">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Tipo de Cliente</th>
                                <th class="text-center">Ciudad</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">País</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Disponible</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--Aquí termina la tabla -->
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#vtotal_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left:10px">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#vtotal_exportarexcel" id="btnexcel_vtotal">Exportar Excel</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" id="pagination_totalclientes">
                            
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
                title: "Cliente Eliminado",
                text: "Cliente eliminado con éxito",
                icon: "success",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1500
            });
        });
    </script> 
<?php } ?>
<?php if($this->session->flashdata('erroreliminar')) { ?>
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