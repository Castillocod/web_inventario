<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen - Productos</title>
</head>

<body>

    <div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Total de Productos</h3>
                </div>
                <!-- AQUÍ INICIA EL MODAL PARA AGREGAR PRODUCTOS -->
                <div class="modal fade" id="vprod_agregarproductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Registro de Productos
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vprod_formregistrar" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="modelo" class="form-label">Modelo</label>
                                            <input type="text" name="modelo" id="modelo" placeholder="Modelo" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="marca" class="form-label">Marca</label>
                                            <!-- <input type="text" name="marca" id="marca" class="form-control" placeholder="Marca"> -->
                                            <select name="marca" id="marca" class="form-control">
                                                <option value="" disabled selected>Selecciona una marca</option>
                                                <?php foreach ($marcas as $marca) { ?>
                                                    <option value="<?= $marca['marca']?>"><?= $marca['marca']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="titulo" class="form-label">Título</label>
                                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="titulo">
                                        </div>
                                        <div class="col-6">
                                            <label for="categoria" class="form-label">Categoría</label>
                                            <select name="categoria" id="categoria" class="form-control">
                                                <option value="" disabled selected>Selecciona una categoría</option>
                                                <?php foreach ($categorias as $categoria) { ?>
                                                    <option value="<?= $categoria['categoria']?>"><?= $categoria['categoria']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="stock" class="form-label">Stock</label>
                                            <input type="number" name="stock" id="stock" placeholder="Stock" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <label for="preciolista" class="form-label">Precio Lista</label>
                                            <input type="text" name="preciolista" id="preciolista" placeholder="Precio de lista" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="precioespecial" class="form-label">Precio Especial</label>
                                            <input type="text" name="precioespecial" id="precioespecial" placeholder="Precio Especial" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <label for="preciooriginal" class="form-label">Precio Original</label>
                                            <input type="text" name="preciooriginal" id="preciooriginal" placeholder="Precio Original" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="preciointegrado" class="form-label">Precio Integrador</label>
                                            <input type="text" name="preciointegrado" value="" id="preciointegrado" placeholder="Precio Integrado" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-5">
                                            <label for="preciotienda" class="form-label">Precio Tienda</label>
                                            <input type="text" name="preciotienda" value="" id="preciotienda" placeholder="Precio de Tienda" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="codigofiscal" class="form-label">Código Fiscal</label>
                                            <input type="text" maxlength="10" name="codigofiscal" id="codigofiscal" placeholder="Código Fiscal" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <label for="fecha_vprod" class="form-label">Fecha</label>
                                            <input type="text" name="fecha_vprod" id="fecha_vprod" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="switchestadoproductos">
                                            <label id="estado_lblprod" name="estado_label" class="form-check-label" value=""></label>
                                            <input type="hidden" id="estado_prod" name="estado_prod" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vprod_regcancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vprod_registrar">Registrar producto</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA AGREGAR PRODUCTOS -->

                <!--  INICIO DE MODAL DE EDITAR PRODUCTOS -->
                <div class="modal fade" id="vprod_modeditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Editar Productos
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vprod_formeditar" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="editid" name="editid" value="" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="editmodelo" class="form-label">Modelo</label>
                                            <input type="text" name="editmodelo" id="editmodelo" placeholder="Modelo" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="editmarca" class="form-label">Marca</label>
                                            <!-- <input type="text" name="editmarca" id="editmarca" class="form-control" placeholder="Marca"> -->
                                            <select name="editmarca" id="editmarca" class="form-control">
                                                <?php foreach ($marcas as $marca) { ?>
                                                    <option value="<?= $marca['marca']?>"><?= $marca['marca']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="edittitulo" class="form-label">Título</label>
                                            <input type="text" name="edittitulo" id="edittitulo" class="form-control" placeholder="titulo">
                                        </div>
                                        <div class="col-6">
                                            <label for="editcategoria" class="form-label">Categoría</label>
                                            <select name="editcategoria" id="editcategoria" class="form-control">
                                                <?php foreach ($categorias as $categoria) { ?>
                                                    <option value="<?= $categoria['categoria']?>"><?= $categoria['categoria']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="editstock" class="form-label">Stock</label>
                                            <input type="number" name="editstock" id="editstock" placeholder="Stock" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <label for="editpreciolista" class="form-label">Precio Lista</label>
                                            <input type="text" name="editpreciolista" id="editpreciolista" placeholder="Precio de lista" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="editprecioespecial" class="form-label">Precio Especial</label>
                                            <input type="text" name="editprecioespecial" id="editprecioespecial" placeholder="Precio Especial" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <label for="editpreciooriginal" class="form-label">Precio Original</label>
                                            <input type="text" name="editpreciooriginal" id="editpreciooriginal" placeholder="Precio Original" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="editpreciointegrado" class="form-label">Precio Integrador</label>
                                            <input type="text" name="editpreciointegrado" id="editpreciointegrado" placeholder="Precio Integrado" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-5">
                                            <label for="editpreciotienda" class="form-label">Precio Tienda</label>
                                            <input type="text" name="editpreciotienda" id="editpreciotienda" placeholder="Precio de Tienda" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="editcodigofiscal" class="form-label">Código Fiscal</label>
                                            <input type="text" maxlength="10" name="editcodigofiscal" id="editcodigofiscal" placeholder="Código Fiscal" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <label for="editfecha_vprod" class="form-label">Fecha</label>
                                            <input type="text" name="editfecha_vprod" id="editfecha_vprod" placeholder="Fecha" class="form-control">
                                        </div>
                                    </div><br>
                                    <div class="col-12">
                                        <label for="edit_estado" style="padding-right: 60px">Estado</label>
                                         
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="edit_switchestadoproductos">
                                            <span style="font-weight:normal;" id="edit_estado_lblprod" name="edit_estado_lblprod" class="form-check-label" value=""></span>                                
                                            <input type="hidden" id="edit_estado_prod" name="edit_estado_prod" value=""> 
                                        </div>                                                                                 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vprod_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FINAL DE MODAL DE EDITAR PRODUCTOS -->

                <!-- AQUÍ INICIA EL MODAL PARA IMPORTAR EXCEL -->
                <div class="modal fade" id="vprod_modexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    IMPORTACIÓN DE EXCEL
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url()?>almacen/cproductos/excelproductos" enctype="multipart/form-data" method="post">
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
                <div class="modal fade" id="vprod_exportarexcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
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
                                                <span class="form-control col-3" id="lbldatefechas"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="datefechas" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lbldatefechasdos"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="datefechasdos" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Datos por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lbldatemes"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="datemes" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Todos los Datos</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="totaldatos" id="totaldatos" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotaldatos">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelexcel_vprod">Cancelar</button>
                                <button class="btn btn-success" id="exportarexcel_vprod" onclick="exportardatos()">Exportar datos</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA EXPORTAR POR MES Y DIAS -->
                 <!-- AQUÍ INICIA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS -->
                <div class="modal fade" id="reportespdf_actvprod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog col-xl">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">
                                    Reportes de Productos Activos
                                </h4>
                            </div>
                            <div class="modal-body">
                                <center><h4>Selecciona el tipo de reporte</h4></center>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Fechas</legend></fieldset>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechauno_actvprod"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechauno_actvprod" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblfechados_actvprod"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="fechados_actvprod" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte por Mes</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">                                    
                                            <div class="input-group">
                                                <span class="form-control col-3" id="lblmes_actvprod"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input class="form-control col-12" id="mes_actvprod" style="text-transform:uppercase;" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset><legend>Reporte Total</legend></fieldset>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">
                                                <input type="radio" name="total_actvprod" id="total_actvprod" value="">
                                                <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="lbltotal_actvprod">Total de Datos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="cancelar_actvprod">Cancelar</button>
                                <button class="btn btn-success" id="crear_actvprod" onclick="reporteactivos_vprod()">Crear Reporte</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AQUÍ TERMINA EL MODAL PARA REPORTES DE ACTIVOS POR MES Y DIAS --></thead>
                <div class="row dt-search">
                    <div>
                        <label for="dt-search-0">Buscar:</label>
                    </div>
                    <div class="col-3">
                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_vprod" placeholder="Escriba para buscar..." aria-controls="tabla_vprod">
                    </div>
                    <div class="col-9 d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vprod_agregarproductos">Agregar productos</a>
                        <div style="padding-left: 10px">
                            <div class="dropdown_vprod" id="dropdown_vproductos">
                                <div class="select_vprod">
                                    <span class="selected_vprod">Imprimir reportes</span>
                                    <div class="caret_vprod"></div>
                                </div>
                                <ul class="menu_vprod">
                                    <li><button class="btn btn-default" id="btnactivos_actvprod" data-bs-toggle="modal" data-bs-target="#reportespdf_actvprod"><i class="fa-regular fa-file-pdf"></i>&nbspProductos Activos</></li>
                                    <li><button class="btn btn-default"><i class="fa-regular fa-file-pdf"></i>&nbspProductos Inactivos</butt></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="col-6 text-center d-flex justify-content-start">
                            <div>
                                <label for="">MONEDA</label>
                                <button class="btn btn-sm btn-success" id="btn_vproductosmxn" name="btn_vproductosmxn">MXN</button>
                                <button class="btn btn-sm btn-primary" id="btn_vproductosusd" name="btn_vproductosusd">USD</button>
                            </div>
                        </div>
                        <div class="dt-length text-center">
                            <div class="input-group">
                                <h5 style="padding-top: 5px; padding-right: 5px">Ver:</h5>
                                <select class="form-select" id="dt-length-0" name="tabla_vprod_length" style="border-radius: 5px;" aria-controls="tabla_vprod">
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
                    <table class="table table-striped table-sm" id="tabla_vprod">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Modelo</th>
                                <!-- <th>Imagen</th> Se rellenara cargando una carpeta de imagenes en assets -->
                                <th class="text-center">Marca</th>
                                <th class="text-center">Titulo</th>
                                <th class="text-center">Stock</th> <!-- Aquí se indicará la cantidad de productos que hay y si hay menos de 10 mostrara un mensaje "Por agotarse", cuando haya cero "Agotado" -->
                                <th class="text-center">Precio Lista</th>
                                <th class="text-center">Precio especial</th>
                                <th class="text-center">Precio Original</th>
                                <th class="text-center">Precio Integrado</th>
                                <th class="text-center">Precio Tienda</th>
                                <th class="text-center">Código Fiscal</th>
                                <th class="text-center">Estado</th> <!-- Aquí indicara si estara activo o no -->
                                <th class="text-center" style="width: 100px">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <!-- <td></td> -->
                                <td></td>
                                <td></td>
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
                </div><br>
                <!--Aquí termina la tabla -->
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vprod_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left: 10px;">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vprod_exportarexcel" id="btnexcel_vprod" name="btnexcel_vprod">
                                    Exportar Excel
                                </button>
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-end" id="content_pagination">

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
                title: "Producto eliminado",
                text: "Producto eliminado con éxito",
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