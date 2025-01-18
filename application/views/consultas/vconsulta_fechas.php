<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas por Fecha</title>
</head>
<body>
    <div class="container" style="padding-top: 8px">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Consultas por Fechas</h3>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <div class="input-group">
                            <span class="form-control col-2" id="lblfechauno_vcon"><i class="fa-regular fa-clock"></i></span>
                            <input class="form-control input-sm" type="text" id="fechauno_vcon" name="fechauno_vcon">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <span class="form-control col-2" id="lblfechados_vcon"><i class="fa-regular fa-clock"></i></span>
                            <input class="form-control input-sm" type="text" id="fechados_vcon" name="fechados_vcon">
                        </div>
                    </div>
                    <div class="col-3">                        
                        <button class="btn btn-primary" id="btnconsultas_vcon" onclick="inicio_fechasvcon()">Consultar:</button>                                           
                        <button class="btn btn-danger" id="btncancel_fechasvcon">Cancelar</button>
                    </div>                                                           
                </div><br>
                <div class="container">
                    <div class="row">
                        <ul class="nav nav-tabs nav-tabs-highlight" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">                                
                                <button class="nav-link active" data-tab="pestact_fechasvcon" id="pestact_fechasvcon" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabact_fechasvcon" type="button" role="tab" aria-controls="pestact_fechasvcon" aria-selected="true">
                                    ACTIVOS
                                    <span class="badge badge-success" style="font-size: 11px; font-weight: bold;" value=""><?= $sumaactivos ?></span>                                                      
                                </button>                                
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="eyelash-inactivos" id="eyelash_inactivos" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabinact_fechasvcon" type="button" role="tab" aria-controls="eyelash_inactivos" aria-selected="false">
                                    INACTIVOS
                                    <span class="badge badge-warning" style="font-size: 11px; font-weight: bold;" value=""><?= $sumainactivos ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="eyelash_cotizaciones" id="eyelash_cotizaciones" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabcot_fechasvcon" type="button" role="tab" aria-controls="eyelash_cotizaciones" aria-selected="false">
                                    COTIZACIONES
                                    <span class="badge badge-info" style="font-weight: bold; font-size: 11px;" value=""><?= $cotizaciones ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="eyelash_clientes" id="eyelash_clientes" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabclientes_fechasvcon" type="button" role="tab" aria-controls="eyelash_clientes" aria-selected="false">
                                    CLIENTES
                                    <span class="badge badge-secondary" style="font-weight: bold; font-size: 11px;" value=""><?= $clientes ?></span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <br>
                            <div class="tab-pane fade show active" id="tabact_fechasvcon" role="tabpanel" aria-labelledby="tabact_fechasvcon">
                                <div class="row dt-search-0">
                                    <div>
                                        <label for="dt-search-0">Buscar:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tablaact" placeholder="Escriba para buscar..." aria-controls="tablaact_fechasvcon">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tablaact_fechasvcon_length" style="border-radius: 5px" aria-controls="tablaact_fechasvcon">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <select class="form-select" id="comboact_fechasvcon" style="border-radius: 5px; width: 200px;">
                                                <option value="Productos">Productos</option>
                                                <option value="Categorias">Categorias</option>
                                                <option value="Marcas">Marcas</option> 
                                                <option value="Tipo de Cliente">Tipo de Cliente</option>
                                        </select>
                                    </div>  
                                </div><br>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-secondary" id="btnrest_actfechasvcon" title="Restaurar la tabla" onclick="restauracion_fechasvcon()"><i class="fa-solid fa-repeat"></i></button>
                                </div><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablaact_fechasvcon">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center" id="colact_fechasvcon" value=""></th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Fecha</th>
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
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                </div><br>
                                <div class="d-flex justify-content-end" id="pagination_act_fechasvcon">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabinact_fechasvcon" role="tabpanel" aria-labelledby="tabinact_fechasvcon">
                                <div class="row dt-search-0">
                                    <div>
                                        <label for="dt-search-0">Buscar:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tablainact" placeholder="Escriba para buscar..." aria-controls="tablainact_fechasvcon">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tablainact_fechasvcon_length" style="border-radius: 5px;" aria-controls="tablainact_fechasvcon">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <select class="form-select" id="comboinact_fechasvcon" style="border-radius: 5px;">
                                            <option value="Productos">Productos</option>
                                            <option value="Categorias">Categorias</option>
                                            <option value="Marcas">Marcas</option>   
                                            <option value="Tipo de Cliente">Tipo de Cliente</option>
                                        </select>
                                    </div>  
                                </div><br>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-secondary" id="btnrest_inactfechasvcon" title="Restaurar la tabla" onclick="restauracion_fechasvcon()"><i class="fa-solid fa-repeat"></i></button>
                                </div><br>                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablainact_fechasvcon">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center" id="colinact_fechasvcon" value=""></th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Fecha</th>
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
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                </div><br>
                                <div class="d-flex justify-content-end" id="pagination_inact_fechasvcon">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabcot_fechasvcon" role="tabpanel" aria-labelledby="tabcot_fechasvcon">
                                <div class="row dt-search-0">
                                    <div>
                                        <label for="dt-search-0">Buscar:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tablacot" placeholder="Escriba para buscar..." aria-controls="tablacot_fechasvcon">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tablacot_fechasvcon_length" style="border-radius: 5px;" aria-controls="tablacot_fechasvcon">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <select class="form-select" id="combocot_fechasvcon" style="border-radius: 5px;">
                                            <option value="Pendientes">Pendientes</option>
                                            <option value="Terminadas">Terminadas</option>                                            
                                        </select>
                                    </div>  
                                </div><br>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-secondary" id="btnrest_cotfechasvcon" title="Restaurar la tabla" onclick="restauracion_fechasvcon()"><i class="fa-solid fa-repeat"></i></button>
                                </div><br>                                 
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablacot_fechasvcon">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center" id="colcot_fechasvcon" value=""></th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Fecha</th>
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
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                </div><br>
                                <div class="d-flex justify-content-end" id="pagination_cot_fechasvcon">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabclientes_fechasvcon" role="tabpanel" aria-labelledby="tabclientes_fechasvcon">
                                <div class="row dt-search-0">
                                    <div>
                                        <label for="dt-search-0">Buscar:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tablaclientes" placeholder="Escriba para buscar..." aria-controls="tablaclientes_fechasvcon">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tablaclientes_fechasvcon_length" style="border-radius: 5px;" aria-controls="tablaclientes_fechasvcon">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <select class="form-select" id="comboclientes_fechasvcon" style="border-radius: 5px;">
                                            <option value="Disponibles">Disponibles</option>
                                            <option value="No Disponibles">No Disponibles</option>                                            
                                        </select>
                                    </div>  
                                </div><br>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-secondary" id="btnrest_clientesfechasvcon" title="Restaurar la tabla" onclick="restauracion_fechasvcon()"><i class="fa-solid fa-repeat"></i></button>
                                </div><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tablaclientes_fechasvcon">
                                        <thead>
                                            <tr>
                                                <th class="text-center" value="">ID</th>
                                                <th class="text-center" value="">Nombre</th>
                                                <th class="text-center" value="">Estado</th>
                                                <th class="text-center" value="">Fecha</th>
                                                <th class="text-center" value="">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                </div><br>    
                                <div class="d-flex justify-content-end" id="pagination_clientes_fechasvcon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="prodactinact_modfechasvcon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Información Total
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="prodactinact_formfechasvcon" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="prodid_fechasvcon" name="verid_fechasvcon" value="" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="vermodelo_fechasvcon" class="form-label">Modelo</label>
                                            <input type="text" id="vermodelo_fechasvcon" name="vermodelo_fechasvcon" placeholder="Modelo" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="vermarca_fechasvcon" class="form-label">Marca</label>                                            
                                            <input type="text" id="vermarca_fechasvcon" name="vermarca_fechasvcon" placeholder="Marca" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="vertitulo_fechasvcon" class="form-label">Título</label>
                                            <input type="text" id="vertitulo_fechasvcon" name="vertitulo_fechasvcon" placeholder="Titulo" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="vercat_fechasvcon" class="form-label">Categoría</label>
                                            <input type="text" id="vercat_fechasvcon" name="vercat_fechasvcon" placeholder="Categoría" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="verstock_fechasvcon" class="form-label">Stock</label>
                                            <div class="input-group">
                                                <span class="form-control col-3"><i class="fa-solid fa-box-archive"></i></span>
                                                <input type="number" id="verstock_fechasvcon" name="verstock_fechasvcon" placeholder="Stock" class="form-control" style="pointer-events:none;" readonly>
                                            </div>                                            
                                        </div>
                                        <div class="col-6">
                                            <label for="verpreciolista_fechasvcon" class="form-label">Precio Lista</label>
                                            <div class="input-group">
                                                <span class="form-control col-2"><i class="fa-solid fa-dollar-sign"></i></span>
                                                <input type="text" id="verpreciolista_fechasvcon"  name="verpreciolista_fechasvcon" placeholder="Precio de lista" class="form-control" style="pointer-events:none;" readonly>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="verprecioespecial_fechasvcon" class="form-label">Precio Especial</label>
                                            <div class="input-group">
                                                <span class="form-control col-2"><i class="fa-solid fa-dollar-sign"></i></span>
                                                <input type="text" id="verprecioespecial_fechasvcon" name="verprecioespecial_fechasvcon" placeholder="Precio Especial" class="form-control" style="pointer-events:none;" readonly>
                                            </div>                                            
                                        </div>
                                        <div class="col-6">
                                            <label for="verpreciooriginal_fechasvcon" class="form-label">Precio Original</label>
                                            <div class="input-group">
                                                <span class="form-control col-2"><i class="fa-solid fa-dollar-sign"></i></span>
                                                <input type="text" id="verpreciooriginal_fechasvcon" name="verpreciooriginal_fechasvcon" placeholder="Precio Original" class="form-control" style="pointer-events:none;" readonly>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="verpreciointegrado_fechasvcon" class="form-label">Precio Integrador</label>
                                            <div class="input-group">
                                                <span class="form-control col-2"><i class="fa-solid fa-dollar-sign"></i></span>
                                                <input type="text" id="verpreciointegrado_fechasvcon" name="verpreciointegrado_fechasvcon" placeholder="Precio Integrado" class="form-control" style="pointer-events:none;" readonly>
                                            </div>                            
                                        </div>
                                        <div class="col-6">
                                            <label for="verpreciotienda_fechasvcon" class="form-label">Precio Tienda</label>
                                            <div class="input-group">
                                                <span class="form-control col-2"><i class="fa-solid fa-dollar-sign"></i></span>
                                                <input type="text" id="verpreciotienda_fechasvcon" name="verpreciotienda_fechasvcon" placeholder="Precio de Tienda" class="form-control" style="pointer-events:none;" readonly>
                                            </div>                                            
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-5">
                                            <label for="vercodigofiscal_fechasvcon" class="form-label">Código Fiscal</label>
                                            <input type="text" maxlength="10" id="vercodigofiscal_fechasvcon" name="vercodigofiscal_fechasvcon" placeholder="Código Fiscal" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-5">
                                            <label for="verfechavprod_fechasvcon" class="form-label">Fecha</label>
                                            <input type="text" id="verfechavprod_fechasvcon" name="verfechavprod_fechasvcon" placeholder="Fecha" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="col-12">
                                        <label for="verestadovprod_fechasvcon" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="verswitchestadoproductos" style="pointer-events:none;" readonly>
                                            <span style="font-weight:normal;" id="ver_estadolblprod_fechasvcon" name="ver_estadolblprod_fechasvcon" class="form-check-label" value="" style="pointer-events:none;" readonly></span>                                
                                            <input type="hidden" id="ver_estadoprod_fechasvcon" name="ver_estadoprod_fechasvcon" value="" style="pointer-events:none;" readonly> 
                                        </div>                                                                                 
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="catactinact_modfechasvcon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Información Total
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="catactinact_formfechasvcon" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="catid_fechasvcon" name="catid_fechasvcon" value="" class="form-control" style="pointer-events:none;" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="categoria_fechasvcon" class="form-label">Categoria</label>
                                            <input type="text" id="categoria_fechasvcon" name="categoria_fechasvcon" class="form-control" placeholder="Categoría" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="fecha_vcat_fechasvcon">Fecha</label>
                                            <input type="text" id="fecha_vcat_fechasvcon" name="fecha_vcat_fechasvcon" class="form-control" placeholder="Fecha" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="estado_vcat_fechasvcon" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" type="checkbox" id="switchestadovcat_fechasvcon" style="pointer-events:none;" readonly>
                                            <label id="estadolblvcat_fechasvcon" name="estadolblvcat_fechasvcon" class="form-check-label" value="" style="pointer-events:none;" readonly></label>
                                            <input type="hidden" id="estadovcat_fechasvcon" name="estadovcat_fechasvcon" value="" style="pointer-events:none;" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="marcasactinact_modfechasvcon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Información Total
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="marcasactinact_formfechasvcon" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="marcasid_fechasvcon" name="marcasid_fechasvcon" value="" class="form-control" style="pointer-events:none;" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="marca_fechasvcon" class="form-label">Marca</label>
                                            <input type="text" id="marca_fechasvcon" name="marca_fechasvcon" class="form-control" placeholder="Marca" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="fecha_vmarcas_fechasvcon">Fecha</label>
                                            <input type="text" id="fecha_vmarcas_fechasvcon" name="fecha_vmarcas_fechasvcon" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="col-12">
                                        <label for="edit_estado" style="padding-right: 60px">Estado</label>
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="switchestadovmarcas_fechasvcon" style="pointer-events:none;" readonly>
                                            <label id="estadolblvmarcas_fechasvcon" name="estadolblvmarcas_fechasvcon" class="form-check-label" value="" style="pointer-events:none;" readonly></label>
                                            <input type="hidden" id="estadovmarcas_fechasvcon" name="estadovmarcas_fechasvcon" value="" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="tiposactinact_modfechasvcon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Información Total
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="tiposactinact_formfechasvcon" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" id="tiposid_fechasvcon" name="tiposid_fechasvcon" value="" class="form-control" style="pointer-events:none;" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="tipocliente_fechasvcon" class="form-label">Tipo de Cliente</label>
                                        <input type="text" id="tipocliente_fechasvcon" name="tipocliente_fechasvcon" placeholder="Tipo de Cliente" class="form-control" style="pointer-events:none;" readonly>
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="verpenter_modfechasvcon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-xl" style="max-width: 70%;">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button id="" class="close equis_cerrar" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Información Total
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="verpenter_formfechasvcon" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="folio_fechasvcon" class="form-label">Folio</label>
                                            <input type="text" id="folio_fechasvcon" name="folio_fechasvcon" value="" placeholder="Folio" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="idcliente_fechasvcon" class="form-label">ID Cliente</label>
                                            <input type="text" id="idcliente_fechasvcon" name="idcliente_fechasvcon" value="" class="form-control" placeholder="ID Cliente" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="tipocliente_fechasvcon" class="form-label">Tipo de Cliente</label>
                                            <input type="text" id="tipocliente_fechasvcon" name="tipocliente_fechasvcon" value="" class="form-control" placeholder="Tipo de Cliente" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="nombrecliente_fechasvcon" class="form-label">Nombre del Cliente</label>
                                            <input type="text" id="nombrecliente_fechasvcon" name="nombrecliente_fechasvcon" value="" class="form-control" placeholder="Nombre del Cliente" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm" id="tablaverpenter_fechasvcon">
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
                                            <label for="subtotal_fechasvcon" class="form-label">Subtotal</label>
                                            <input type="text" id="subtotal_fechasvcon" name="subtotal_fechasvcon" value="" placeholder="Subtotal" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label for="iva_fechasvcon" class="form-label">IVA</label>
                                            <input type="text" id="iva_fechasvcon" name="iva_fechasvcon" value="" placeholder="IVA" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label for="total_fechasvcon" class="form-label">Total</label>
                                            <input type="text" id="total_fechasvcon" name="total_fechasvcon" value="" placeholder="Total" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-4">
                                            <label for="fechapenter_fechasvcon" class="form-label">Fecha</label>
                                            <input type="text" id="fechapenter_fechasvcon" name="fechapenter_fechasvcon" value="" placeholder="Fecha" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label for="horapenter_fechasvcon" class="form-label">Hora</label>
                                            <input type="text" id="horapenter_fechasvcon" name="horapenter_fechasvcon" value="" placeholder="Hora" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label for="estadopenter_fechasvcon" class="form-label">Estado</label>
                                            <input type="text" id="estadopenter_fechasvcon" name="estadopenter_fechasvcon" value="" placeholder="Estado" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="modal-footer">                                        
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="clientesdispnodisp_modfechasvcon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Información Total
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="verclientesdispnodisp_formfechasvcon" enctype="multipart/form-data">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <input type="hidden" id="clientesid_fechasvcon" name="clientesid_fechasvcon" placeholder="ID" maxlength="6" class="form-control" style="pointer-events: none;" readonly>
                                            <label for="nombre_fechasvcon" class="form-label">Nombre</label>
                                            <input type="text" name="nombre_fechasvcon" id="nombre_fechasvcon" placeholder="Nombre" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="tipocliente_fechasvcon" class="form-label">Tipo de Cliente</label>                                            
                                            <input id="tipocliente_fechasvcon" name="tipocliente_fechasvcon" class="form-control" placeholder="Tipo de Cliente" class="form-control" style="pointer-events:none;" readonly>                                            
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="correo_fechasvcon" class="form-label">Correo</label>
                                            <input type="email" id="correo_fechasvcon" name="correo_fechasvcon" placeholder="Correo" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="telefono_fechasvcon" class="form-label">Telefono</label>
                                            <input type="text" maxlength="10" id="telefono_fechasvcon" name="telefono_fechasvcon" placeholder="Telefono" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="ciudad_fechasvcon" class="form-label">Ciudad</label>
                                            <input type="text" id="ciudad_fechasvcon" name="ciudad_fechasvcon" placeholder="Ciudad" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="estadoclientes_fechasvcon" class="form-label">Estado</label>
                                            <input type="text" id="estadoclientes_fechasvcon" name="estadoclientes_fechasvcon" placeholder="Estado" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="pais_fechasvcon" class="form-label">País</label>
                                        <input type="text" id="pais_fechasvcon" name="pais_fechasvcon" placeholder="País" class="form-control" style="pointer-events:none;" readonly>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="direccion_fechasvcon" class="form-label">Dirección</label>
                                            <input type="text" id="direccion_fechasvcon" name="direccion_fechasvcon" placeholder="Dirección" class="form-control" style="pointer-events:none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="fechaclientes_fechasvcon">Fecha</label>
                                            <input type="text" id="fechaclientes_fechasvcon" name="fechaclientes_fechasvcon" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div>                                                                       
                                    <div class="mb-3">
                                        <label for="empresa_fechasvcon" class="form-label">Empresa</label>
                                        <input type="text" id="empresa_fechasvcon" name="empresa_fechasvcon" placeholder="Empresa" class="form-control" style="pointer-events: none;" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rfc_fechasvcon" class="form-label">RFC</label>
                                        <input type="text" id="rfc_fechasvcon" name="rfc_fechasvcon" placeholder="RFC" maxlength="13" class="form-control" style="pointer-events: none;" readonly>
                                    </div>
                                    <div class="mb-3">
                                    <label for="disponibleclientes_fechasvcon" style="padding-right: 60px">Disponible</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="switchdisponible_fechasvcon" style="pointer-events:none;" readonly>
                                            <label id="disponiblelblclientes_fechasvcon" name="disponiblelblclientes_fechasvcon" class="form-check-label" style="pointer-events:none;" readonly></label>
                                            <input type="hidden" id="disponibleclientes_fechasvcon" name="disponibleclientes_fechasvcon" style="pointer-events:none;" readonly>
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
            </div>
        </div>
    </div>
</body>
</html>