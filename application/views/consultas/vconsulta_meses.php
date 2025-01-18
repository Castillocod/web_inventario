<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas por Mes</title>
</head>
<body>
    <div class="container" style="padding-top: 8px;">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Consultas por Mes</h3>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <div class="input-group">
                            <span class="form-control col-2" id="lblmes_vcon"><i class="fa-regular fa-clock"></i></span>
                            <input class="fomr-control input-sm" type="text" id="mes_vcon" name="mes_vcon">
                        </div>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary" id="btnconsultasmes_vcon" onclick="inicio_mesesvcon()">Consultar:</button>
                        <button class="btn btn-danger" id="btncancel_mesesvcon">Cancelar</button>
                    </div>                    
                </div><br>
                <div class="container">
                    <div class="row">
                        <ul class="nav nav-tabs nav-tabs-highlight" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">                                
                                <button class="nav-link active" data-tab="pestact_mesesvcon" id="pestact_mesesvcon" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabact_mesesvcon" type="button" role="tab" aria-controls="pestact_mesesvcon" aria-selected="true">
                                    ACTIVOS
                                    <span class="badge badge-success" style="font-size: 11px; font-weight: bold;" value=""><?= $sumaactivos ?></span>                                                      
                                </button>                                
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="pestinact_mesesvcon" id="pestinact_mesesvcon" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabinact_fechasvcon" type="button" role="tab" aria-controls="pestinact_mesesvcon" aria-selected="false">
                                    INACTIVOS
                                    <span class="badge badge-warning" style="font-size: 11px; font-weight: bold;" value=""><?= $sumainactivos ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="pestcot_mesesvcon" id="pestcot_mesesvcon" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabcot_fechasvcon" type="button" role="tab" aria-controls="pestcot_mesesvcon" aria-selected="false">
                                    COTIZACIONES
                                    <span class="badge badge-info" style="font-weight: bold; font-size: 11px;" value=""><?= $cotizaciones ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-tab="pestclientes_mesesvcon" id="pestclientes_mesesvcon" style="font-weight: bold; color: black;" data-bs-toggle="tab" data-bs-target="#tabclientes_fechasvcon" type="button" role="tab" aria-controls="pestclientes_mesesvcon" aria-selected="false">
                                    CLIENTES
                                    <span class="badge badge-secondary" style="font-weight: bold; font-size: 11px;" value=""><?= $clientes ?></span>
                                </button>
                            </li>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>