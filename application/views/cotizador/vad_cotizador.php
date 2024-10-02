<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Cotizador</title>
</head>
<body>
    <div class="row">
        
        <div class="col-9" style="padding-top: 8px; padding-left: 23px;">
            <!-- TOTAL DE COTIZACIONES -->
            <div class="row text-center">
                <div class="col-12" >
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-heading d-flex justify-content-center">
                                <h3 class="panel-title">Cotizaciones</h3>
                            </div><br>
                            <div class="row">
                                <div class="col-5 d-flex justify-content-start">
                                    <h1>Total de Cotizaciones</h1>
                                </div>
                                <div class="col-2 d-flex justify-content-start">
                                    <input class="form-control" type="text" style="font-size: 60px; width:200px; height: 110px;  border: none; background-color: transparent; pointer-events: none" value="<?= $totalcotizaciones ?>" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-3" >
                                    <!-- small box -->
                                    <div class="small-box bg-red">
                                        <div class="inner d-flex justify-content-start">
                                            <h3><?= $totalpendientes ?></h3>
                                        </div>
                                        <div class="inner d-flex justify-content-start">
                                            <h5>Pendientes</h5>
                                        </div>
                                        
                                        <div class="icon">
                                            <i class="fa-regular fa-clock"></i>
                                        </div>
                                        <a id="btn_pendientes" name="btn_pendientes" data-bs-toggle="modal" data-bs-target="#modal_vadpendientes" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-3" >
                                    <!-- small box -->
                                    <div class="small-box bg-green">
                                        <div class="inner d-flex justify-content-start">
                                            <h3><?= $totalterminadas ?></h3>
                                        </div>
                                        <div class="inner d-flex justify-content-start">
                                            <h5>Terminadas</h5>
                                        </div>
                                        
                                        <div class="icon">
                                        <i class="fa-solid fa-check"></i>
                                        </div>
                                        <a id="btn_realizadas" name="btn_realizadas" data-bs-toggle="modal" data-bs-target="#modal_vadterminadas" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- TOTAL DE COTIZACIONES -->

            <!-- LISTA DE COTIZACIONES -->
            <div class="row text-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-heading d-flex justify-content-center">
                                <h3 class="panel-title">Lista de Cotizaciones</h3>
                            </div><br>
                            <div class="row dt-search">
                                <div class="d-flex justify-content-start">
                                    <label for="dt-search-0">Buscar:</label>                                    
                                </div>
                                <div class="col-4">
                                    <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_totalcotizaciones" placeholder="Escriba para buscar..." aria-controls="tabla_totalcotizaciones">
                                </div>
                                <div class="col-8 d-flex justify-content-end">
                                    <div class="dt-length text-center">
                                        <div class="input-group">
                                            <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                            <select class="form-select" id="dt-length-0" name="tabla_totalcotizaciones_length" style="border-radius: 5px;" aria-controls="tabla_totalcotizaciones">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><br>                            
                            <div class="table-responsive">
                                <table class="table table-striped" id="tabla_totalcotizaciones">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Folio</th>
                                            <th class="text-center">Tipo de Cliente</th>
                                            <th class="text-center">ID de Cliente</th>
                                            <th class="text-center">Nombre del Cliente</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Hora</th>
                                            <th class="text-center">Estado</th>
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
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="row">
                                <div class="d-flex justify-content-end" id="pagination_totalcotizaciones">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LISTA DE COTIZACIONES -->
        </div> 

        <!-- FORMULAS -->
        <div class="col-3" style="padding-top: 8px; padding-left: 0px; padding-right: 23px">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading d-flex justify-content-center">
                        <h3 class="panel-title">Formulas</h3>
                    </div><br>

                    <div class="row align-items-center d-flex justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <h5>Precio del Dolar (USD)</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <div class="input-group">
                                <span class="form-control col-4"><i class="fa-solid fa-dollar-sign"></i></span>
                                <input class="form-control" type="text" value="" name="form_preciodolar" id="form_preciodolar" style="pointer-events: none;" readonly>
                            </div>
                        </div>
                    </div><br>

                    <div class="row align-items-center d-flex justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <h5>I.V.A</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <div class="input-group">           
                                <input class="form-control" type="text" value="" name="form_iva" id="form_iva" style="pointer-events: none;" readonly>
                                <span class="form-control col-5"><i class="fa-solid fa-percent"></i></span>
                            </div>
                        </div>
                    </div><br>

                    <div class="row align-items-center d-flex justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <h5>Precio Integrador</h5>
                        </div>
                        <div class="col-8 d-flex justify-content-end">
                            <div class="input-group">                                
                                <input class="form-control" type="text" value="Precio Original" name="form_preciointegrador" id="form_preciointegrador" style="pointer-events: none;" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <span><i class="fa-solid fa-xmark"></i></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <div class="input-group" >
                                <input class="form-control" type="text" value="" name="form_porcentajeintegrador" id="form_porcentajeintegrador" style="pointer-events: none;" readonly>
                                <span class="form-control col-5"><i class="fa-solid fa-percent"></i></span>
                            </div>
                        </div>
                    </div><br>

                    <div class="row align-items-center d-flex justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <h5>Precio Tienda</h5>
                        </div>
                        <div class="col-9 d-flex justify-content-end">
                            <div class="input-group">
                                <input class="form-control" type="text" value="Precio Integrador" name="form_preciotienda" id="form_preciotienda" style="pointer-events: none;" readonly>
                            </div>   
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <span><i class="fa-solid fa-xmark"></i></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <div class="input-group" >
                                <input class="form-control" type="text" value="" name="form_porcentajetienda" id="form_porcentajetienda" style="pointer-events: none;" readonly>
                                <span class="form-control col-5"><i class="fa-solid fa-percent"></i></span>
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" id="btnmodificar_vad" name="btnmodificar_vad" data-bs-toggle="modal" data-bs-target="#modal_vad_formulas" onclick="modificarformulas()">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- FORMULAS --> 
        
        <!-- MODAL DE FORMULAS -->
        <div class="modal fade" id="modal_vad_formulas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-block">
                    <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                        <h4 class="modal-title text-center">
                            Editar Formulas
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="form_vad_formulas" enctype="multipart/form-data">
                            <div class="row d-flex justify-content-center text-center">
                                <div class="col-6 ">
                                    <h5>Precio del Dolar</h5>
                                    <div class="input-group">
                                        <span class="form-control col-2"><i class="fa-solid fa-dollar-sign"></i></span>
                                        <input class="form-control" value="" type="text" name="preciodolar" id="preciodolar" placeholder="Precio del Dolar">
                                    </div>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-center text-center">
                                <div class="col-6 ">
                                    <h5>I.V.A</h5>
                                    <div class="input-group">
                                        <input class="form-control" value="" type="text" name="iva" id="iva" placeholder="I.V.A">
                                        <span class="form-control col-2"><i class="fa-solid fa-percent"></i></span>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-center text-center">
                                <h5>Precio Integrador</h5>
                                <div class="col-6">                                 
                                    <div class="input-group">
                                        <input class="form-control col-12" value="" type="text" name="porcentajeintegrador" id="porcentajeintegrador" placeholder="Ingrese Porcentaje">
                                        <span class="form-control col-2"><i class="fa-solid fa-percent"></i></span>
                                    </div>    
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-center text-center">
                                <h5>Precio Tienda</h5>
                                <div class="col-6">
                                    <div class="input-group">
                                        <input class="form-control col-12" value="" type="text" name="porcentajetienda" id="porcentajetienda" placeholder="Ingrese Porcentaje">
                                        <span class="form-control col-2"><i class="fa-solid fa-percent"></i></span>
                                    </div>
                                </div>
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="btnactualizar_vad">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE FORMULAS -->

        <!-- MODAL PARA VER DATOS -->
        <div class="modal fade" id="modal_vercotizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                        <h4 class="modal-title text-center">
                            Datos Adicionales - Cotización
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="vad_formcotizacion" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <label for="folio_vad" class="form-label">Folio</label>
                                    <input type="text" name="folio_vad" id="folio_vad" value="" placeholder="Folio" class="form-control" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="idcliente_vad" class="form-label">ID Cliente</label>
                                    <input type="text" name="idcliente_vad" id="idcliente_vad" value="" class="form-control" placeholder="ID Cliente"readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="tipocliente_vad" class="form-label">Tipo de Cliente</label>
                                    <input type="text" name="tipocliente_vad" id="tipocliente_vad" value="" class="form-control" placeholder="Tipo de Cliente" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="nombrecliente_vad" class="form-label">Nombre del Cliente</label>
                                    <input type="text" name="nombrecliente_vad" id="nombrecliente_vad" value="" class="form-control" placeholder="Nombre del Cliente" readonly>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablaver_cotizaciones">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Folio</th>
                                                <th class="text-center" style="display: none;">ID Producto</th>
                                                <th class="text-center" style="display: none;">Modelo</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Cantidad</th> <!-- Se rellenara cargando una carpeta de imagenes en assets -->
                                                <th class="text-center">Tipo de Precio</th>
                                                <th class="text-center">Precio MXN</th>
                                                <th class="text-center">Precio USD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-4">
                                    <label for="subtotal_vad" class="form-label">Subtotal</label>
                                    <input type="text" name="subtotal_vad" id="subtotal_vad" value="" placeholder="Subtotal" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="iva_vad" class="form-label">IVA</label>
                                    <input type="text" name="iva_vad" id="iva_vad" value="" placeholder="IVA" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="total_vad" class="form-label">Total</label>
                                    <input type="text" name="total_vad" id="total_vad" value="" placeholder="Total" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-4">
                                    <label for="fecha_vad" class="form-label">Fecha</label>
                                    <input type="text" name="fecha_vad" id="fecha_vad" value="" placeholder="Fecha" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="hora_vad" class="form-label">Hora</label>
                                    <input type="text" name="hora_vad" id="hora_vad" value="" placeholder="Hora" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="estado_vad" class="form-label">Estado</label>
                                    <input type="text" name="estado_vad" id="estado_vad" value="" placeholder="Estado" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="vad_regresar">Regresar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vad_cerrar">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PARA VER DATOS -->

        <!-- MODAL PARA VER PENDIENTES -->
        <div class="modal fade" id="modal_vadpendientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                        <h4 class="modal-title text-center">
                            Cotizaciones Pendientes
                        </h4>
                    </div>
                    <div class="modal-body">                        
                        <form method="post" action="" id="vad_formpendientes" enctype="multipart/form-data">
                            <div class="row dt-search">
                                <div class="d-flex justify-content-start">
                                    <label for="dt-search-0">Buscar:</label>
                                </div>
                                <div class="col-4">
                                    <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_totalpendientes" placeholder="Escriba para buscar..." aria-controls="tabla_totalpendientes">
                                </div>
                                <div class="col-8 d-flex justify-content-end">
                                    <div class="dt-length text-center">
                                        <div class="input-group">
                                            <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                            <select class="form-select" id="dt-length-0" name="tabla_totalpendientes_length" style="border-radius: 5px;" aria-controls="tabla_totalpendientes">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><br>  
                            <div class="table-responsive">
                                <table class="table table-striped" id="tabla_totalpendientes">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Folio</th>
                                            <th class="text-center">Tipo de Cliente</th>
                                            <th class="text-center">ID de Cliente</th>
                                            <th class="text-center">Nombre del Cliente</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Hora</th>
                                            <th class="text-center">Estado</th>
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                                      
                            <br>
                            <div class="row">
                                <div class="d-flex justify-content-end" id="pagination_totalpendientes">

                                </div>
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="pendientes_cerrar">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PARA VER PENDIENTES -->

        <!-- MODAL PARA VER DATOS PENDIENTES-->
        <div class="modal fade" id="modal_verpendientes_cot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button id="" class="close equis_cerrar" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                        <h4 class="modal-title text-center">
                            Datos Adicionales - Cotizaciones Pendientes
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="vadpendientes_formcotizacion" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <label for="folio_pen" class="form-label">Folio</label>
                                    <input type="text" name="folio_pen" id="folio_pen" value="" placeholder="Folio" class="form-control" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="idcliente_pen" class="form-label">ID Cliente</label>
                                    <input type="text" name="idcliente_pen" id="idcliente_pen" value="" class="form-control" placeholder="ID Cliente" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="tipocliente_pen" class="form-label">Tipo de Cliente</label>
                                    <input type="text" name="tipocliente_pen" id="tipocliente_pen" value="" class="form-control" placeholder="Tipo de Cliente" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="nombrecliente_pen" class="form-label">Nombre del Cliente</label>
                                    <input type="text" name="nombrecliente_pen" id="nombrecliente_pen" value="" class="form-control" placeholder="Nombre del Cliente" readonly>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablaver_pendientes">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Folio</th>
                                                <th class="text-center" style="display: none;">ID Producto</th>
                                                <th class="text-center" style="display: none;">Modelo</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Cantidad</th> <!-- Se rellenara cargando una carpeta de imagenes en assets -->
                                                <th class="text-center">Tipo de Precio</th>
                                                <th class="text-center">Precio MXN</th>
                                                <th class="text-center">Precio USD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-4">
                                    <label for="subtotal_pen" class="form-label">Subtotal</label>
                                    <input type="text" name="subtotal_pen" id="subtotal_pen" value="" placeholder="Subtotal" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="iva_pen" class="form-label">IVA</label>
                                    <input type="text" name="iva_pen" id="iva_pen" value="" placeholder="IVA" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="total_pen" class="form-label">Total</label>
                                    <input type="text" name="total_pen" id="total_pen" value="" placeholder="Total" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-4">
                                    <label for="fecha_pen" class="form-label">Fecha</label>
                                    <input type="text" name="fecha_pen" id="fecha_pen" value="" placeholder="Fecha" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="hora_pen" class="form-label">Hora</label>
                                    <input type="text" name="hora_pen" id="hora_pen" value="" placeholder="Hora" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="estado_pen" class="form-label">Estado</label>
                                    <input type="text" name="estado_pen" id="estado_pen" value="" placeholder="Estado" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="vadpen_regresar">Regresar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vadpen_cerrar">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PARA VER DATOS PENDIENTES-->

        <!-- MODAL PARA VER TERMINADAS -->
        <div class="modal fade" id="modal_vadterminadas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                        <h4 class="modal-title text-center">
                            Cotizaciones Terminadas
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="vad_formterminadas" enctype="multipart/form-data">
                            <div class="row dt-search">                        
                                <div>
                                    <label for="dt-search-0">Buscar:</label>
                                </div>
                                <div class="col-3">
                                    <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_totalterminadas" placeholder="Escriba para buscar..." aria-controls="tabla_totalterminadas">
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="dt-length text-center">
                                        <div class="input-group">
                                            <h5 style="padding-top: 5px; padding-right: 5px">Ver:</h5>
                                            <select class="form-select" id="dt-length-0" name="tabla_totalterminadas_length" style="border-radius: 5px" aria-controls="tabla_totalterminadas">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="tabla_totalterminadas">
                                    <thead>
                                        <tr>
                                            <th class=text-center>Folio</th>
                                            <th class="text-center">Tipo de Cliente</th>
                                            <th class="text-center">ID de Cliente</th>
                                            <th class="text-center">Nombre del Cliente</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Hora</th>
                                            <th class="text-center">Estado</th>
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
                                        </tr>                                            
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="row">
                                <div class="d-flex justify-content-end" id="pagination_totalterminadas">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="terminadas_regresar">Regresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PARA VER TERMINADAS -->

        <!-- MODAL PARA VER DATOS TERMINADAS-->
        <div class="modal fade" id="modal_verterminadas_cot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button id="" class="close equis_cerrar" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                        <h4 class="modal-title text-center">
                            Datos Adicionales - Cotización
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="vadterminadas_formcotizacion" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <label for="folio_ter" class="form-label">Folio</label>
                                    <input type="text" name="folio_ter" id="folio_ter" value="" placeholder="Folio" class="form-control" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="idcliente_ter" class="form-label">ID Cliente</label>
                                    <input type="text" name="idcliente_ter" id="idcliente_ter" value="" class="form-control" placeholder="ID Cliente" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="tipocliente_ter" class="form-label">Tipo de Cliente</label>
                                    <input type="text" name="tipocliente_ter" id="tipocliente_ter" value="" class="form-control" placeholder="Tipo de Cliente" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="nombrecliente_ter" class="form-label">Nombre del Cliente</label>
                                    <input type="text" name="nombrecliente_ter" id="nombrecliente_ter" value="" class="form-control" placeholder="Nombre del Cliente" readonly>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablaver_terminadas">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Folio</th>
                                                <th class="text-center" style="display: none;">ID Producto</th>
                                                <th class="text-center" style="display: none;">Modelo</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Cantidad</th> <!-- Se rellenara cargando una carpeta de imagenes en assets -->
                                                <th class="text-center">Tipo de Precio</th>
                                                <th class="text-center">Precio MXN</th>
                                                <th class="text-center">Precio USD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-4">
                                    <label for="subtotal_ter" class="form-label">Subtotal</label>
                                    <input type="text" name="subtotal_ter" id="subtotal_ter" value="" placeholder="Subtotal" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="iva_ter" class="form-label">IVA</label>
                                    <input type="text" name="iva_ter" id="iva_ter" value="" placeholder="IVA" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="total_ter" class="form-label">Total</label>
                                    <input type="text" name="total_ter" id="total_ter" value="" placeholder="Total" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-4">
                                    <label for="fecha_ter" class="form-label">Fecha</label>
                                    <input type="text" name="fecha_ter" id="fecha_ter" value="" placeholder="Fecha" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="hora_ter" class="form-label">Hora</label>
                                    <input type="text" name="hora_ter" id="hora_ter" value="" placeholder="Hora" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="estado_ter" class="form-label">Estado</label>
                                    <input type="text" name="estado_ter" id="estado_ter" value="" placeholder="Estado" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="vadter_regresar">Regresar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vadter_cerrar">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PARA VER DATOS TERMINADAS-->
    </div>
</body>
</html>