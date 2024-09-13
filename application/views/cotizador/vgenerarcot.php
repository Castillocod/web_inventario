<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar cotización</title>
</head>
<body>

<div class="row text-center">
    <!-- GENERAR COTIZACIÓN -->
    <div class="col-6" style="padding-top: 8px; padding-left:23px">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Generar Cotización</h3>
                </div><br>

                <div class="row">
                    <div class="col-6">
                        
                        <select name="tc_cliente" id="tc_cliente" class="form-control">
                            <option value="" disabled selected>Tipo de Cliente</option>
                                <?php if(!empty($tipoclientes) && is_array($tipoclientes)) {?>
                                    <?php foreach ($tipoclientes as $tipocliente) {?>
                                    <option value="<?= $tipocliente['tipocliente']?>"><?= $tipocliente['tipocliente']?></option> 
                                    <?php } ?>
                                <?php } ?>
                        </select>
                        
                    </div>
                    <div class="col-6">
                        <select name="cliente_prod" id="cliente_prod" class="form-control">
                            <option value="" disabled selected>Cliente</option>
                            <!-- <option value=""></option> -->
                        </select><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div style="padding-bottom: 5px">
                            <input type="text" id="buscar_prod" name="buscar_prod" placeholder="Escriba para buscar..." class="form-control">
                        </div>
                        <select name="sel_prod" id="sel_prod" class="form-control sel_prod" >
                            <option value="" disabled selected >Seleccione producto</option>
                            <!-- <option value="" ></option> -->
                        </select>
                    </div>
                    <div class="col-6"><br>
                        <div class="d-flex justify-content-start">
                            <div style="width:90px">
                                <input class="form-control" id="" name="" value="Cantidad" readonly style="background-color: transparent; border: none; pointer-events: none;">
                            </div>
                            <div class="col-4" style="padding-left:0px">
                                <input type="number" id="prod_cant" name="prod_cant" class="form-control" min="0">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                
                <button class="btn btn-primary" id="btnagregar_cot" name="btnagregar_cot">Agregar</button>
                <button class="btn btn-danger" id="btncancelar_cot" name="btncancelar_cot" onclick="limpiartexto()">Cancelar</button><br><br>
            </div>
        </div>
    </div>
    <!-- GENERAR COTIZACIÓN -->

    <!-- MODAL PARA TIPO DE CLIENTES-->
    <div class="modal fade" id="modal_preciostipos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" style="width: 350px">
            <div class="modal-content">
                <div class="modal-header d-block">
                <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                    <h4 class="modal-title text-center">
                        Elegir Tipo de Precio
                    </h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="vgenerar_preciostipos" enctype="multipart/form-data">
                        <div class="row d-flex justify-content-center">
                            
                            <div class="col-12 d-flex justify-content-center">
                                <div class="text-left">                                    
                                    <label id="lbl_preciolista" name="lbl_preciolista" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px"><input type="radio" id="numeroprecio" name="numeroprecio" value="1" data-tipoprecio="Precio Lista"> Precio Lista</label><br>
                                    <label id="lbl_precioespecial" name="lbl_precioespecial" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px"><input type="radio" id="numeroprecio" name="numeroprecio" value="2" data-tipoprecio="Precio Especial"> Precio Especial</label><br>
                                    <label id="lbl_preciooriginal" name="lbl_preciooriginal" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px"><input type="radio" id="numeroprecio" name="numeroprecio" value="3" data-tipoprecio="Precio Original"> Precio Original</label><br>
                                    <label id="lbl_preciointegrador" name="lbl_preciointegrador" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px"><input type="radio" id="numeroprecio" name="numeroprecio" value="4" data-tipoprecio="Precio Integrador"> Precio Integrador</label><br>
                                    <label id="lbl_preciotienda" name="lbl_preciotienda" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px"><input type="radio" id="numeroprecio" name="numeroprecio" value="5" data-tipoprecio="Precio Tienda"> Precio Tienda</label>
                                    <input type="hidden" id="tp_seleccionado" name="tp_seleccionado">
                                </div>                                
                            </div>
                        </div><br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="vgenerar_cancelarprecios">Cancelar</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-primary" id="vgenerar_aceptarprecios">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL PARA TIPO DE CLIENTES-->

    <!-- RESUMEN DE COTIZACIÓN -->
    <div class="col-6" style="padding-top: 8px; padding-right:23px; padding-left:0px;">
        <div class="card">
            <div class="card-body" style="height:284px">
                <div class="panel-heading d-flex justify-content-center">
                    <h3 class="panel-title">Resumen de Cotización</h3>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-start ">
                        <input class="form-control" type="text" value="ID Cliente:" style="width:100px; background-color: transparent; border: none; pointer-events: none;" readonly>
                        <input class="form-control" type="text" value="" name="idcliente_cot" id="idcliente_cot" style="background-color: transparent; border: none; pointer-events: none;" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="Tipo de Cliente:" style="width:132px; background-color: transparent; border: none; pointer-events: none;" readonly>
                        <input class="form-control" type="text" value="" name="tipocliente_cot" id="tipocliente_cot" style="background-color: transparent; border: none; pointer-events: none;" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="Nombre del Cliente:" style="width:165px; background-color: transparent; border: none; pointer-events: none;" readonly>
                        <input class="form-control" type="text" value="" name="cliente_cot" id="cliente_cot" style="background-color: transparent; border: none; pointer-events: none;" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="Productos:" style="width:100px; background-color: transparent; border: none; pointer-events: none;" readonly>
                        <input class="form-control" type="text" value="" name="productos_cot" id="productos_cot" style="background-color: transparent; border: none; pointer-events: none;" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="Descuento:" style="width:100px; background-color: transparent; border: none; pointer-events: none;" readonly>
                        <input class="form-control" type="text" value="" name="descuento_cot" id="descuento_cot" style="background-color: transparent; border: none; pointer-events: none;" readonly>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
    <!-- RESUMEN DE COTIZACIÓN -->
</div>



<div class="row">
    <!-- TABLA DE COTIZACIÓN -->
    <div class="col-9" style="padding-left:23px;">
        <div class="card">
            <div class="card-body">
                <!-- MODAL PARA VER Y ACTUALIZAR -->
                <div class="modal fade" id="modal_vgenerarcot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                            <button class="close" type="button" data-bs-dismiss="modal" style="font-size: 20px; color:black;"><i class="fa-solid fa-xmark"></i></button>
                                <h4 class="modal-title text-center">
                                    Productos Cotizados
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="form_vgenerarcot" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="producto_modal" class="form-label">Producto</label>
                                            <select name="producto_modal" id="producto_modal" class="form-control">
                                                <?php if(!empty($almacen_productos) && is_array($almacen_productos)) { ?>
                                                    <?php foreach($almacen_productos as $row) { ?>
                                                        <option value="<?= $row['titulo']?>"><?= $row['titulo']?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="cantidad_modal" class="form-label">Cantidad</label>
                                            <input class="form-control" value="" type="number" name="cantidad_modal" id="cantidad_modal" placeholder="Cantidad">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="preciomxn_modal" class="form-label">Precio MXN</label>
                                            <input class="form-control" value="" type="text" name="preciomxn_modal" id="preciomxn_modal" placeholder="Precio MXN" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label for="preciousd_modal" class="form-label">Precio USD</label>
                                            <input class="form-control" value="" type="text" name="preciousd_modal" id="preciousd_modal" placeholder="Precio USD" readonly>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6 text-center">
                                            <label for="descuento_modal" class="form-label">Descuento</label>
                                            <input class="form-control" value="" type="text" name="descuento_modal" id="descuento_modal" placeholder="Descuento" readonly>
                                        </div>
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="vgenerarcot_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL PARA VER Y ACTUALIZAR -->
                <!--Aquí inicia la tabla -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="vgenerarcot_table">
                        <thead>
                            <tr>
                                <th style="display: none">Folio</th>
                                <th style="display: none">ID Producto</th>
                                <th style="display: none;">Modelo</th>
                                <th>Producto</th>
                                <th>Cantidad</th> <!-- Se rellenara cargando una carpeta de imagenes en assets -->
                                <th>Tipo de Precio</th>
                                <th>Precio MXN</th>
                                <th>Precio USD</th>
                                <th style="width: 100px">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--Aquí termina la tabla -->
                <!-- <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#vprod_modexcel">Importar excel</button>
                            </div>
                            <div style="padding-left:10px">
                                <a class="btn btn-success" href="<?= base_url() ?>almacen/cproductos/exportarexcel">Exportar Excel</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- TABLA DE COTIZACIÓN -->

    <!-- COTIZACIÓN -->
    <div class="col-3" style="padding-right:23px; padding-left:0px">
        <div class="card">
            <div class="card-body">
                <div class="panel-heading d-flex justify-content-center">
                    <h4 class="panel-title">Cotización</h4>
                </div>
                <div class="row">
                    <center><label for="">MONEDA</label></center>
                    <div class="text-center">
                        <div class="col-12">
                            <button class="btn btn-success" id="btn_mxn" name="btn_mxn">MXN</button>
                            <button class="btn btn-primary" id="btn_usd" name="btn_usd">USD</button>
                        </div>
                    </div>&nbsp;
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="Sub-Total:" style="width:96px; background-color: transparent; border:none; pointer-events: none" readonly>
                        <input class="form-control" type="text" value="" id="input_subtotal" name="input_subtotal" style="background-color: transparent; border:none; pointer-events: none" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="I.V.A:" style="width: 60px; background-color: transparent; border:none; pointer-events: none" readonly>
                        <input class="form-control" type="text" value="" id="input_iva" name="input_iva" style="background-color: transparent; border:none; pointer-events: none" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input class="form-control" type="text" value="Total:" style="width: 64px; background-color: transparent; border:none; pointer-events: none" readonly>
                        <input class="form-control" type="text" value="" id="input_total" name="input_total" style="background-color: transparent; border:none; pointer-events: none" readonly>
                    </div>&nbsp;
                    <div>
                        <a class="btn btn-primary" style="margin-bottom: 10px; width:100%" id="crearcotizacion" name="creacotizacion" href="<?= base_url()?>cotizador/cgenerarcot/crearcotizacion">Crear Cotización</a>
                        <a class="btn btn-secondary" style="margin-bottom: 10px; width:100%" id="guardarcotizacion" name="guardarcotizacion" onclick="mensajeborrador()">Guardar Cotización</a>
                        <a class="btn btn-danger" style="margin-bottom: 10px; width:100%" id="cancelarcotizacion" name="cancelarcotizacion" onclick="cancelarcot()">Cancelar Cotización</a>
                        <a class="btn btn-info" style="margin-bottom: 10px; width:100%" id="precotizacion" name="precotizacion">Pre-Cotización</a>
                    </div>                    
                </div>    
            </div>
        </div>
    </div>
    <!-- COTIZACIÓN -->
</div>
</body>
</html>