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
                                <form method="post" action="" id="vmarcas_formregistrar" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="marca" class="form-label">Marca</label>
                                            <input type="text" name="marca" id="marca" class="form-control" placeholder="Marca">
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" type="checkbox" id="switchestadomarcas">
                                            <label id="estado_lblmarcas" name="estado_lblmarcas" class="form-check-label" value=""></label>
                                            <input type="hidden" id="estado_vmarcas" name="estado_vmarcas" value="">
                                        </div>
                                    </div>
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
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="edit_estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" type="checkbox" id="edit_switchestadomarcas">
                                            <label id="edit_estado_lblmarcas" name="edit_estado_lblmarcas" class="form-check-label" value=""></label>
                                            <input type="hidden" id="edit_estado_vmarcas" name="edit_estado_vmarcas" value="">
                                        </div>
                                    </div>
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
                                <form action="<?= base_url()?>almacen/cmarcas/marcasexcel" enctype="multipart/form-data" method="post">
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
                        <label for="vmarcas_buscar">Buscar:</label>
                    </div>
                    <div class="col-3">
                        <input type="text" id="vmarcas_buscar" name="vmarcas_buscar" placeholder="Escriba para buscar..." class="form-control">
                    </div>
                    <div class="col-9 d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vmarcas_agregarmarcas">Registrar Marcas</a>
                        <div style="padding-left: 10px">
                            <div class="dropdown" id="dropdown_vmarcas">
                                <div class="select">
                                    <span class="selected">Imprimir reportes</span>
                                    <div class="caret"></div>
                                </div>
                                <ul class="menu">
                                    <li><a class="dropdown-item" href="<?= base_url() ?>almacen/cmarcas/pdf_marcas_activas"><i class="fa-regular fa-file-pdf"></i>&nbspMarcas Activas</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>almacen/cmarcas/pdf_marcas_inactivas"><i class="fa-regular fa-file-pdf"></i>&nbspMarcas Inactivas</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <div class="text-center">
                            <div class="input-group">
                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                <select name="vmarcas_infoxpage" id="vmarcas_infoxpage" style="border-radius: 5px;" class="form-select">
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
                    <table class="table table-striped table-sm" id="vmarcas_table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marca</th>
                                <th>Estado</th> <!-- Aquí indicara si estara activo o no -->
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($almacen_marcas as $row) { ?>
                            <tr>
                                <td><?= $row['id']?></td>
                                <td><?= $row['marca']?></td>
                                <td><span id="celda_estado" style="font-weight: bold; font-size:11px"><?= $row['estado_vmarcas']?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vmarcas_modeditar" onclick="vmarcas_editar(<?= $row['id']?>)" value="<?= $row['id']?>"></button>
                                    <button onclick="mensajeborrar_vmarcas(<?= $row['id']?>)" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!--Aquí termina la tabla -->
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#vmarcas_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left: 10px;">
                                <a class="btn btn-success" href="<?= base_url() ?>almacen/cmarcas/exportarexcel">Exportar Excel</a>
                            </div>
                        </div> 
                    </div>
                    <div class="d-flex justify-content-end">
                            <?= $links ?>
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