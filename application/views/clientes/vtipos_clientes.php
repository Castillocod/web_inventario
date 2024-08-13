<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Clientes</title>
</head>
<body>

<div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Tipos de Clientes</h3>
                </div>
                <!-- AQUÍ INICIA EL MODAL PARA AGREGAR TIPOS DE CLIENTES -->
                <div class="modal fade" id="vtipo_agregartipocliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Registro - Tipo de Clientes
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vtipo_formregistrar" enctype="multipart/form-data">
                                    <div class="col-6">
                                        <label for="tipocliente" class="form-label">Tipo de Cliente</label>
                                        <input type="text" name="tipocliente" id="tipocliente" placeholder="Tipo de Cliente" class="form-control">
                                    </div><br>
                                    <!-- <div class="mb-3">
                                        <label for="estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="switchestadomarcas">
                                            <label id="estado_label" name="estado_label" class="form-check-label" value=""></label>
                                            <input type="hidden" id="estado" name="estado" value="">
                                        </div>
                                    </div> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vtipo_regcancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vtipo_registrar">Registrar tipo de cliente</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA AGREGAR TIPOS DE CLIENTES -->

                <!--  INICIO DE MODAL DE EDITAR TIPOS DE CLIENTES -->
                <div class="modal fade" id="vtipo_modeditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Editar Tipo de Cliente
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vtipo_formeditar" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="editid" name="editid" value="" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="edittipocliente" class="form-label">Tipo de Cliente</label>
                                        <input type="text" name="edittipocliente" id="edittipocliente" placeholder="Tipo de Cliente" class="form-control">
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vtipo_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FINAL DE MODAL DE EDITAR TIPOS DE CLIENTES -->

                <!-- AQUÍ INICIA EL MODAL PARA IMPORTAR EXCEL -->
                <div class="modal fade" id="vtipo_modexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    IMPORTACIÓN DE EXCEL
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url()?>clientes/ctipos_clientes/tiposclientesexcel" enctype="multipart/form-data" method="post">
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
                <div class="row">
                    <div>
                        <label for="dt-search-0">Buscar:</label>
                    </div>
                    <div class="col-3">
                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_vtipos" placeholder="Escriba para buscar..." aria-controls="tabla_vtipos">
                    </div>
                    <div class="col-9 d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vtipos_agregartipocliente">Agregar Tipo de Cliente</a>
                        <div style="padding-left: 10px">
                            <div class="dropdown_vtipos" id="dropdowns_vtipos">
                                <div class="select_vtipos">
                                    <span class="selected_vtipos">Imprimir reportes</span>
                                    <div class="caret_vtipos"></div>
                                </div>
                                <ul class="menu_vtipos">
                                    <li><a class="dropdown-item" href="<?= base_url() ?>clientes/ctipos_clientes/pdfacttotal_vtipos"><i class="fa-regular fa-file-pdf"></i>&nbspTipos de Clientes Activos</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>clientes/ctipos_clientes/pdfinacttotal_vtipos"><i class="fa-regular fa-file-pdf"></i>&nbspTipos de Clientes Inactivos</a></li>
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
                                <select class="form-select" id="dt-length-0" name="tabla_vtipos_length" style="border-radius: 5px;" aria-controls="tabla_vtipos">
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
                    <table class="table table-striped table-sm" id="tabla_vtipos">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Tipo de Cliente</th>
                                <th class="text-center">Cant. Clientes</th> <!-- Se rellenara cargando una carpeta de imagenes en assets -->
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width: 100px">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span id="celda_estado" style="font-weight: bold; font-size:11px"><?= $row['estado_vtipos']?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vtipo_modeditar" onclick="vtipos_editar(<?= $row['id']?>)" value="<?= $row['id']?>"></button>
                                    <button onclick="mensajeborrar_vtipos(<?= $row['id']?>)" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>
                                </td>
                            </tr>                    
                        </tbody>
                    </table>
                </div>
                <!--Aquí termina la tabla -->
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vtipos_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left:10px">
                                <a class="btn btn-sm btn-success" href="<?= base_url() ?>clientes/ctipos_clientes/exceltotal_vtipos">Exportar Excel</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" id="pagination_tiposclientes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php if ($this->session->flashdata('eliminado')) { ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Tipo Cliente Eliminado",
                text: "Tipo cliente eliminado con éxito",
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