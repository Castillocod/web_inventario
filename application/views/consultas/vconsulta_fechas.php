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
                    <div class="col-3 bg-red">
                        <div class="input-group">
                            <span class="form-control col-2" id="lblfechauno_vcon"><i class="fa-regular fa-clock"></i></span>
                            <input class="form-control input-sm" type="date" id="fechauno_vcon" name="fechauno_vcon">
                        </div>
                    </div>
                    <div class="col-3 bg-yellow">
                        <div class="input-group">
                            <span class="form-control col-2" id="lblfechados_vcon"><i class="fa-regular fa-clock"></i></span>
                            <input class="form-control input-sm" type="date" id="fechados_vcon" name="fechados_vcon">
                        </div>
                    </div>
                    <div class="col-3">                        
                        <button class="btn btn-primary" id="btnconsultas_vcon">Consultar:</button>                                           
                        <button class="btn btn-danger" id="btncancel_fechasvcon">Cancelar</button>
                    </div>                                                           
                </div>
                <br>
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
                                <button class="nav-link" data-tab="eyelash-inactivos" id="eyelash_inactivos" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabinact_fechasvcon" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    INACTIVOS
                                    <span class="badge badge-warning" style="font-size: 11px; font-weight: bold;" value=""><?= $sumainactivos ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="eyelash_cotizaciones" id="eyelash_cotizaciones" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabcot_vconfechas" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    COTIZACIONES
                                    <span class="badge badge-info" style="font-weight: bold; font-size: 11px;">12</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="eyelash_clientes" id="eyelash_clientes" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    CLIENTES
                                    <span class="badge badge-secondary" style="font-weight: bold; font-size: 11px;">12</span>
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
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tablaact_fechasvcon" placeholder="Escriba para buscar..." aria-controls="tablaact_fechasvcon">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tablaact_fechasvcon_length" style="border-radius: 5px" aria-controls="tablact_fechasvcon">
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
                            <div class="tab-pane fade" id="tabinact_fechasvcon" role="tabpanel" aria-labelledby="tabinact_vconfechas">
                                <div class="row dt-search-0">
                                    <div>
                                        <label for="dt-search-0">Buscar:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tabla_inactivos" placeholder="Escriba para buscar..." aria-controls="tabla_inactivos">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tablainact_fechasvcon_length" style="border-radius: 5px;" aria-controls="tabla_inactivos">
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
                            <div class="tab-pane fade" id="tabcot_vconfechas" role="tabpanel" aria-labelledby="tabcot_vconfechas">
                                <div class="row dt-search-0">
                                    <div>
                                        <label for="dt-search-0">Buscar:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_tabla_activos" placeholder="Escriba para buscar..." aria-controls="tabla_activos">
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        <div class="dt-length text-center">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                                <select class="form-select" id="dt-length-0" name="tabla_activos_length" style="border-radius: 5px;" aria-controls="tabla_activos">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <select class="form-select" id="combo_datosact" style="border-radius: 5px;">
                                            <option value="Productos">Productos</option>
                                            <option value="Categorias">Categorias</option>
                                            <option value="Marcas">Marcas</option>
                                        </select>
                                    </div>  
                                </div><br>                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" id="tabla_inactivos">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="columna_fechasvcon text-center" value=""></th>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>