<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Adicionales - Clientes</title>
</head>
<body>
<div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Datos Adicionales - Clientes</h3>
                </div>
                <div class="modal fade" id="vadi_mostrarclientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Datos adicionales
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="vadi_formmostrar" enctype="multipart/form-data">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6">
                                            <label for="id" class="form-label">ID</label>
                                            <input type="text" name="id" id="id" placeholder="ID" maxlength="6" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <input type="email" name="direccion" id="direccion" placeholder="Dirección" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="text" name="correo" id="correo" placeholder="Correo" class="form-control" style="pointer-events: none" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="text" name="telefono" id="telefono" placeholder="Telefono" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="rfc" class="form-label">RFC</label>
                                            <input type="text" name="rfc" id="rfc" placeholder="RFC" class="form-control" style="pointer-events: none;" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="fecha_vadi" class="form-label">Fecha</label><br>
                                            <input type="text" name="fecha_vadi" id="fecha_vadi" placeholder="Fecha" class="form-control" style="pointer-events: none;" readonly>
                                        </div>                                        
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnvadi_cancelar">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row dt-search">
                    <div>
                        <label for="dt-search-0">Buscar:</label>
                    </div>
                    <div class="col-3">
                        <input type="search" class="form-control" id="dt-search-0" name="dt_buscar_vadi" placeholder="Escriba para buscar..." aria-controls="tabla_vadi">
                    </div>
                    <div class=" col-9 d-flex justify-content-end">
                        <div class="dt-legnth text-center">
                            <div class="input-group">
                                <h5 style="padding-top: 5px; padding-right: 5px;">Ver:</h5>
                                <select class="form-select" id="dt-length-0" name="tabla_vadi_length" style="border-radius: 5px;" aria-controls="tabla_vadi">
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
                    <table class="table table-striped table-sm" id="tabla_vadi">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">RFC</th>
                                <th class="text-center">Fecha de Registro</th>
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
                <div class="d-flex justify-content-end" id="pagination_adiclientes">
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>