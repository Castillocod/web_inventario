//Variables globales
var preciodolarbd;
var tp_producto;
var tp_precioseleccionado;
var tp_precionombre;

var tipopreciocot;
var tipoprecioactual;

var conversionusd = false;
var conversionmxn = false;

var datoscotizacionlista = JSON.parse(localStorage.getItem('datoscotizacionlista'));

$(document).ready(function() 
{
    //GENERAR COTIZACION
    $('#cliente_prod, #buscar_prod, #sel_prod, #prod_cant').prop('disabled', true);
    $('#btnagregar_cot, #btncancelar_cot').css('visibility', 'hidden');
    //GENERAR COTIZACION

    //TABLA DE COTIZACION
    // Aplicar un estilo para que la tabla parezca desactivada
    $('#vgenerarcot_table').css('opacity', '0.5'); // Reducir la opacidad para dar un aspecto desactivado
    $('#vgenerarcot_table').css('pointer-events', 'none'); // Deshabilitar eventos del mouse en la tabla
    //TABLA DE COTIZACION

    // COTIZACION
    $('#btn_mxn, #btn_usd, #input_subtotal, #input_iva, #input_total').prop('disabled', true);
    $('#crearcotizacion, #guardarcotizacion, #cancelarcotizacion, #precotizacion').addClass('disabled');
    $('#input_subtotal').val('0.00');
    $('#input_iva').val('0.00');
    $('#input_total').val('0.00');
    // COTIZACION

   if(datoscotizacionlista)
   {
        actualizarlocalstorage();
   }

    $('#tc_cliente').change(function(){
        var tc_cliente = $(this).val();

        if(datoscotizacionlista)
        {
            var tipocliente_ls = datoscotizacionlista.datoscotizaciones.tipocliente_cot;
            var tpseleccionado_ls = datoscotizacionlista.datoscotizaciones.tpseleccionado_cot;
            console.log("tipocliente: ", tipocliente_ls);
            switch(tipocliente_ls){
                case 'Integrador':
                case 'Tienda':
                case 'Proyecto':
                case 'Prospecto':
                    $('input[name="numeroprecio"][value="'+tpseleccionado_ls+'"]').prop('checked', true).prop('disabled', false);
                    break;
                default:
                    break;
            }

            tp_precioseleccionado = $('input[name="numeroprecio"]:checked').val(tpseleccionado_ls);
            tp_precionombre = $('input[name="numeroprecio"]:checked').attr('data-tipoprecio');
            $('#tp_seleccionado').val(tp_precioseleccionado);
            $('#tc_cliente').prop('disabled', true);
        }
        else
        {   
            $('#modal_preciostipos').modal('show');
            $('input[name="numeroprecio"]').prop('disabled', true);
            $('#lbl_preciolista').css('opacity', '0.5', 'pointer-events', 'none');
            $('#lbl_precioespecial').css('opacity', '0.5', 'pointer-events', 'none');
            $('#lbl_preciooriginal').css('opacity', '0.5', 'pointer-events', 'none');
            $('#lbl_preciointegrador').css('opacity', '0.5', 'pointer-events', 'none');
            $('#lbl_preciotienda').css('opacity', '0.5', 'pointer-events', 'none');
            switch(tc_cliente){
                case 'Integrador':
                    $('#numeroprecio[value="4"]').prop('disabled', false);
                    $('#lbl_preciointegrador').css('opacity', '1', 'pointer-events', 'auto');
                    break;
                case 'Tienda':
                    $('#numeroprecio[value="5"]').prop('disabled', false);
                    $('#lbl_preciotienda').css('opacity', '1', 'pointer-events', 'auto');
                    break;
                case 'Proyecto':
                    $('#numeroprecio[value="1"], #numeroprecio[value="2"]').prop('disabled', false);
                    $('#lbl_preciolista').css('opacity', '1', 'pointer-events', 'auto');
                    $('#lbl_precioespecial').css('opacity', '1', 'pointer-events', 'auto');
                    break;
                case 'Prospecto':
                    $('input[name="numeroprecio"]').prop('disabled', false);
                    $('#lbl_preciolista').css('opacity', '1', 'pointer-events', 'auto');
                    $('#lbl_precioespecial').css('opacity', '1', 'pointer-events', 'auto');
                    $('#lbl_preciooriginal').css('opacity', '1', 'pointer-events', 'auto');
                    $('#lbl_preciointegrador').css('opacity', '1', 'pointer-events', 'auto');
                    $('#lbl_preciotienda').css('opacity', '1', 'pointer-events', 'auto');
                    break;
                default:
                    break;
            }
        }
        $.ajax({
            url: 'cgenerarcot/obtenerclientesxtp',
            type: 'POST',
            dataType: 'JSON',
            data: {
                tc_cliente: tc_cliente,
                tipocliente_ls: tipocliente_ls
            },
            success: function(data) {
                console.log("datos tp: ", tipocliente_ls);
                // $('#cliente_prod').empty();
                $('#cliente_prod').prop('disabled', false);
                if(data.length > 0) {
                    $.each(data, function(key, value) {
                        $('#cliente_prod').append('<option value="' + value.nombre + '">' + value.nombre + '</option>');
                    });
                }
            }
        });
    });

    $('#cliente_prod').change(function () {
        var cliente_prod = $(this).val();
        cargarProductosPorCliente(cliente_prod);
    });

    $('#vgenerar_aceptarprecios').click(function() {
        tp_precioseleccionado = $('input[name="numeroprecio"]:checked').val();
        tp_precionombre = $('input[name="numeroprecio"]:checked').attr('data-tipoprecio');
        $('#tp_seleccionado').val(tp_precioseleccionado);
        $('#tc_cliente').prop('disabled', true);
    });

    $('#vgenerar_cancelarprecios').click(function() 
    {
        reseteartodo();
    });

    // Evento cuando se ingresa texto en el input de búsqueda
    $('#buscar_prod').on('input', function() {
        var search_text = $(this).val().trim().toLowerCase();
        if (search_text === '') {
            var cliente_prod = $('#cliente_prod').val();
            cargarProductosPorCliente(cliente_prod);
        } else {
            filtrarProductos(search_text); // Filtrar productos solo si hay texto en el campo de búsqueda
        }
    });

    $('#btn_mxn').click(function() {
        if (!conversionmxn) {
            convertirprecio('mxn');
            conversionmxn = true;
            conversionusd = false;
        }
    });

    $('#btn_usd').click(function() {
        if (!conversionusd) {
            convertirprecio('usd');
            conversionusd = true;
            conversionmxn = false;
        }
    });

    // Función para convertir el precio según la moneda seleccionada
    function convertirprecio(moneda) {
        // Verifica si el tipo de cambio es válido
        if (preciodolarbd !== null) {
            var subtotal_original = parseFloat($('[name="input_subtotal"]').val());
            var total_original = parseFloat($('[name="input_total"]').val());

            if (!isNaN(subtotal_original) || !isNaN(total_original)) {
                // Actualiza el subtotal según la moneda seleccionada
                if (moneda === 'mxn') {
                    var subtotalmxn = subtotal_original * preciodolarbd;
                    $('[name="input_subtotal"]').val(subtotalmxn.toFixed(2));

                    var totalmxn = total_original * preciodolarbd;
                    $('[name="input_total"]').val(totalmxn.toFixed(2));
                } else if (moneda === 'usd') {
                    var subtotalusd = subtotal_original / preciodolarbd;
                    $('[name="input_subtotal"]').val(subtotalusd.toFixed(2));

                    var totalusd = total_original / preciodolarbd;
                    $('[name="input_total"]').val(totalusd.toFixed(2));
                }
            } else {
                console.log('El valor del subtotal no es un número válido.');
            }
        } else {
            console.log('No se pudo obtener el tipo de cambio desde la base de datos.');
        }
    }

    $('[name="tc_cliente"]').val(datoscotizacionlista.datoscotizaciones.tipocliente_cot);
    $('[name="cliente_prod"]').val(datoscotizacionlista.datoscotizaciones.nombrecliente_cot);
    $('[name="sel_prod"]').val(datoscotizacionlista.datostablahtml.nombreprod_cot);

    $('[name="idcliente_cot"]').val(datoscotizacionlista.datoscotizaciones.idcliente_cot);
    $('[name="tipocliente_cot"]').val(datoscotizacionlista.datoscotizaciones.tipocliente_cot);
    $('[name="cliente_cot"]').val(datoscotizacionlista.datoscotizaciones.nombrecliente_cot);
    $('[name="productos_cot"]').val(datoscotizacionlista.datoscotizaciones.productos_cot);

    $('[name="input_subtotal"]').val(datoscotizacionlista.datoscotizaciones.subtotal_cot);
    $('[name="input_iva"]').val(datoscotizacionlista.datoscotizaciones.iva_cot);
    $('[name="input_total"]').val(datoscotizacionlista.datoscotizaciones.total_cot);

    $('#tc_cliente').trigger('change');
    $('#cliente_prod').trigger('change');
    $('#vgenerar_aceptarprecios').trigger('click');
    $('#buscar_prod').trigger('input');
    $('#btnagregar_cot').trigger('click');

    var cotizacionlista = '';
    $.each(datoscotizacionlista.datostablahtml, function(index, value) {
        cotizacionlista += '<tr>';
        cotizacionlista += '<td style="display: none">'+value.folio_cotizacion+'</td>';
        cotizacionlista += '<td style="display: none">'+value.idproducto_cot+'</td>';
        cotizacionlista += '<td style="display: none">'+value.modeloprod_cot+'</td>';
        cotizacionlista += '<td>'+value.nombreprod_cot+'</td>';
        cotizacionlista += '<td>'+value.cantidadprod_cot+'</td>';
        cotizacionlista += '<td>'+value.tipoprecio_cot+'</td>';
        cotizacionlista += '<td>'+value.preciomxn_cot+'</td>';
        cotizacionlista += '<td>'+value.preciousd_cot+'</td>';
        cotizacionlista += '<td>'+
                                '<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#modal_vgenerarcot" onclick="llenarmodalver($(this).closest(\'tr\'))"  value="" id="btnver_producto" name="btnver_producto"></button>'+
                                '<div style="padding-top: 3px;">'+
                                    '<button class="btn btn-sm btn-danger fa-solid fa-trash-can" onclick="" id="btneliminar_producto" name="btneliminar_producto"></button>'+
                                '</div>'+
                            '</td>';
        cotizacionlista += '</tr>';
    });
    $('#vgenerarcot_table tbody').html(cotizacionlista);

    if(localStorage.getItem('datoscotizacionlista')) {
        // Si hay datos almacenados, elimínalos
        localStorage.removeItem('datoscotizacionlista');
        // window.location.href.includes('folio');
        // var urlnormal = window.location.href.split('?folio')[0];
        // window.location.href = urlnormal;
    }
});

$(document).on('click', '#btnagregar_cot', function(e) 
{
    e.preventDefault();

    var sel_prod = $('#sel_prod').val();
    var prod_cant = parseInt($('#prod_cant').val());

    if(datoscotizacionlista)
    {
        actualizardatosexistentes(sel_prod, prod_cant);
    }
    else
    {
        datosmanuales();
    }

    
    //GENERAR COTIZACIÓN
    $('#prod_cant').val('');
    $('#btncancelar_cot').hide();
    //GENERAR COTIZACIÓN

    //RESUMEN DE COTIZACIÓN
    //RESUMEN DE COTIZACIÓN

    //TABLA DE COTIZACIÓN
    $('#vgenerarcot_table').css('opacity', '1');
    $('#vgenerarcot_table').css('pointer-events', 'auto'); 
    //TABLA DE COTIZACIÓN

    //COTIZACIÓN
    $('#btn_mxn, #btn_usd, #input_subtotal, #input_iva, #input_total').prop('disabled', false);
    $('#crearcotizacion, #guardarcotizacion, #cancelarcotizacion, #precotizacion').removeClass('disabled'); 
    //COTIZACIÓN  
});

$(document).on('input', '#prod_cant', function() {
    var prod_cant = $(this).val().trim(); // Obtener el valor del input #prod_cant
    var btn_agregar = $('#btnagregar_cot'); // Obtener el botón de agregar
    var btn_eliminar = $('#btncancelar_cot'); // Obtener el botón de eliminar

    // Verificar si el valor del input es un número mayor a 0
    if (prod_cant !== "" && parseInt(prod_cant) > 0) {
        // Habilitar los botones si el valor es válido
        btn_agregar.prop('disabled', false);
        btn_eliminar.prop('disabled', false);
    } else {
        // Deshabilitar los botones si el valor no es válido
        btn_agregar.prop('disabled', true);
        btn_eliminar.prop('disabled', true);
    }
});

function resetbtnconversion() 
{
    conversionusd = false;
    conversionmxn = true;
}

function buscarproductos(buscar) {
    $.ajax({
        url: 'cgenerarcot/buscarxcod',
        type: 'POST',
        dataType: 'json',
        data: { buscar_prod: buscar },
        success: function(data) {
            console.log(data);
            $('#sel_prod').empty();
            $.each(data, function(index, value) {
                $('#sel_prod').append('<option value="' + value.id + '">' + value.modelo + '</option>');
            });
        }
    });
}

function filtrarProductos(search_text) {
    $.ajax({
        url: 'cgenerarcot/buscarxcod',
        type: 'POST',
        dataType: 'json',
        data: { buscar_prod: search_text },
        success: function(data) {
            $('#sel_prod').empty();
            if (data !== null) {
                $('#sel_prod').append('<option value="' + search_text + '">' + data + '</option>');
            }
        }
    });
}

function cargarProductosPorCliente(cliente) {
    $.ajax({
        url: 'cgenerarcot/obtenerprodxcl',
        type: 'POST',
        dataType: 'JSON',
        data: {
            cliente_prod: cliente
        },
        success: function(data) {
            // console.log(data);
            $('#sel_prod').empty();
            $('#buscar_prod, #sel_prod, #prod_cant').prop('disabled', false);
            $('#cliente_prod, #tc_cliente').prop('disabled', true);
            $('#btnagregar_cot, #btncancelar_cot').css('visibility', 'visible');
            $('#btnagregar_cot, #btncancelar_cot').prop('disabled', true);

            if(data.length > 0) {
                $.each(data, function(key, value) {
                    $('#sel_prod').append('<option value="' + value.modelo + '">' + value.modelo + '</option>');
                });
            }
        }
    });
}

function limpiartexto(){
    Swal.fire({
		title: "¿Esta seguro?",
		text: "Esta opción no puede revertirse",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Reiniciar",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
			$('#tc_cliente').prop('disabled', false);
            $('#cliente_prod, #buscar_prod, #sel_prod, #prod_cant').prop('disabled', true);
            $('#tc_cliente, #cliente_prod, #buscar_prod, #sel_prod, #prod_cant').val('');
            $('#idcliente_cot, #tipocliente_cot, #cliente_cot, #productos_cot, #descuento_cot').val('');
            $('#btnagregar_cot, #btncancelar_cot').css('visibility', 'hidden');

            $('input[name="numeroprecio"]').prop('checked', false);
            $('#tp_seleccionado').val('');
            $('#tp_prueba').val('');
            $('#tc_cliente').val('');
            $('#lbl_preciolista').prop('disabled', true);
            $('#lbl_precioespecial').prop('disabled', true);
            $('#lbl_preciooriginal').prop('disabled', true);
            $('#lbl_preciointegrador').prop('disabled', true);
            $('#lbl_preciotienda').prop('disabled', true);
		}
	});
}

function cancelarcot()
{
    Swal.fire({
		title: "¿Esta seguro?",
		text: "Esta opción no puede revertirse",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Cancelar Cotización",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
            reseteartodo();
		}
	});
}

function reseteartodo()
{
     //GENERAR COTIZACION
     $('#tc_cliente').prop('disabled', false);
     $('#cliente_prod, #buscar_prod, #sel_prod, #prod_cant').prop('disabled', true);
     $('#tc_cliente, #cliente_prod, #buscar_prod, #sel_prod, #prod_cant').val('');
     $('#btnagregar_cot, #btncancelar_cot').css('visibility', 'hidden');
     
     //GENERAR COTIZACION

     //RESUMEN DE COTIZACION
     $('#idcliente_cot, #tipocliente_cot, #cliente_cot, #productos_cot, #descuento_cot').val('');
     //RESUMEN DE COTIZACION

     //TABLA DE COTIZACION
     $('#vgenerarcot_table').css('opacity', '0.5');
     $('#vgenerarcot_table').css('pointer-events', 'none');
     $('#vgenerarcot_table tbody').empty();
     //TABLA DE COTIZACION

     //COTIZACION
     $('#btn_mxn, #btn_usd, #input_subtotal, #input_iva, #input_total, #crearcotizacion, #guardarcotizacion, #cancelarcotizacion, #precotizacion').prop('disabled', true);
     $('#crearcotizacion, #guardarcotizacion, #cancelarcotizacion, #precotizacion').addClass('disabled');
     $('#input_subtotal, #input_iva, #input_total').val('0.00');
     //COTIZACION

     //MODAL PARRA TIPO DE CLIENTES
     $('input[name="numeroprecio"]').prop('checked', false);
     $('#tp_seleccionado').val('');
     $('#tp_prueba').val('');
     $('#tc_cliente').val('');
     $('#lbl_preciolista').prop('disabled', true);
     $('#lbl_precioespecial').prop('disabled', true);
     $('#lbl_preciooriginal').prop('disabled', true);
     $('#lbl_preciointegrador').prop('disabled', true);
     $('#lbl_preciotienda').prop('disabled', true);
     //MODAL PARRA TIPO DE CLIENTES

     //EVENTOS
     location.reload();
     //EVENTOS

     // Verifica si la URL actual contiene el parámetro 'folio'
    if (window.location.search.includes('folio'))
    {
        var nuevaurl = window.location.href.split('?')[0];
        window.location.href = nuevaurl;
    }
}

function llenarmodalver(fila)
{
    var producto_modal = fila.find('td:eq(3)').text();
    var cantidad_modal = fila.find('td:eq(4)').text();
    var descuento_modal = fila.find('td:eq(5)').text();
    var preciomxn_modal = fila.find('td:eq(6)').text();
    var preciousd_modal = fila.find('td:eq(7)').text();

    // console.log(producto_modal);

    $('#producto_modal').val(producto_modal);
    $('#cantidad_modal').val(cantidad_modal);
    $('#descuento_modal').val(descuento_modal);
    $('#preciomxn_modal').val(preciomxn_modal);
    $('#preciousd_modal').val(preciousd_modal);

    $(document).on('click', '#btnver_producto', function(e) {
        e.preventDefault();

        var fila = $(this).closest('tr');
        llenarmodalver(fila);
    });   
}

//FUNCIONES PARA EL BORRADOR DE UNA COTIZACIÓN
function actualizarlocalstorage()
{
    $.each(datoscotizacionlista.datostablahtml, function(index, value)
    {
        var filaexistente = $('#vgenerarcot_table tbody tr').filter(function() {
            return $(this).find('td:eq(2)').text() === value.modeloprod_cot;
        });

        if(filaexistente.length > 0)
        {
            actualizarfila(filaexistente, value.cantidadprod_cot, value.preciomxn_cot);
        }
        else
        {
            datosmanuales();
        }
    });
}

function actualizardatosexistentes(sel_prod, prod_cant)
{
    var filaexistente = $('#vgenerarcot_table tbody tr').filter(function() {
        return $(this).find('td:eq(2)').text() === sel_prod;
    });

    if(filaexistente.length > 0)
    {
        var cantidadact = parseInt(filaexistente.find('td:eq(4)').text());
        var cantidadtotal = cantidadact + prod_cant;
        var preciooriginal = parseFloat(filaexistente.find('td:eq(6)').text());
        var preciodiv = preciooriginal / cantidadact;
        var preciototal = preciodiv * cantidadtotal;

        // console.log('Holahol', preciodiv);
        // console.log('preciodos', preciototal);
        // console.log('Cantidad Uno', cantidadact)
        // console.log('Cantidad Dos', prod_cant)
        // console.log('Cantidades', cantidadtotal);

        actualizarfila(filaexistente, cantidadtotal, preciototal.toFixed(2));
        productoscantidad();
        subtotaldato();
        $('#btnagregar_cot').prop('disabled', true);
    }
    else
    {
        datosmanuales();
    }
}

function actualizarfila(row, cantidadtotal, precio)
{ 
    row.find('td:eq(4)').text(cantidadtotal);
    row.find('td:eq(6)').text(precio);
}

function productoscantidad()
{
    var totalcantidad = 0;
    $('#vgenerarcot_table tbody tr').each(function() {
        var cantidadtable = parseInt($(this).find('td:nth-child(5)').text());
        if(!isNaN(cantidadtable))
        {
            totalcantidad += cantidadtable;
        }
    });
    $('#productos_cot').val(totalcantidad);
}

function subtotaldato()
{
    var ivainput = parseFloat($('#input_iva').val());

    var subtotal = 0;
    $('#vgenerarcot_table tbody tr').each(function() {
        var precio = parseFloat($(this).find('td:nth-child(7)').text());
        if (!isNaN(precio)) {
            subtotal += precio;
        }
    });
    $('[name="input_subtotal"]').val(subtotal.toFixed(2));
    var total = subtotal * ivainput; 
    $('[name="input_total"]').val(total.toFixed(2));
}

function datosmanuales()
{
    var tc_cliente = $('#tc_cliente').val();
    var cliente_prod = $('#cliente_prod').val();
    var sel_prod = $('#sel_prod').val();
    var buscar_prod = parseInt($('#buscar_prod').val());
    var prod_cant = parseInt($('#prod_cant').val());

    if (prod_cant === "") {
        console.log('El campo "prod_cant" no puede estar en blanco.');
        return; // Detener la ejecución si el campo está en blanco
    }

    var modelo_titulo = false;
    $('#vgenerarcot_table tbody tr').each(function() 
    {
        var id = $(this).find('td:eq(1)').text();
        var modelo = $(this).find('td:eq(2)').text();
        if(sel_prod === modelo || sel_prod === id)
        {
            var cantidadactual = parseInt($(this).find('td:nth-child(5)').text());
            var nuevacantidad = cantidadactual + parseInt(prod_cant);
            $(this).find('td:nth-child(5)').text(nuevacantidad);
            modelo_titulo = true;
            return false
        }
    });

    if(!isNaN(prod_cant)) 
    {
        var productos_cot = parseInt($('#productos_cot').val());

        if(!isNaN(productos_cot))
        {
            $('#productos_cot').val(productos_cot + prod_cant);
        }
        else
        {
            $('#productos_cot').val(prod_cant);
        }
    }
    else
    {
        console.log('El valor ingresado no es un número válido');
    }

    if (tc_cliente !== "" && cliente_prod !== "" && sel_prod !== "") 
    {
        // Obtener la información del servidor
        $.ajax({
            url: 'cgenerarcot/obtenertotalclientes',
            type: 'POST',
            dataType: 'JSON',
            data: {
                tc_cliente:tc_cliente,
                cliente_prod:cliente_prod,
                sel_prod:sel_prod,
                buscar_prod:buscar_prod
            },
            success: function(data) {
                if(data.clientes_totalclientes !== null && data.almacen_productos !== null && data.cotizador_formulas !== null)
                {
                    
                    var cliente = data.clientes_totalclientes[0];
                    var producto = data.almacen_productos[0];
                    var cotizador = data.cotizador_formulas[0];

                    $('#idcliente_cot').val(cliente.cliente_id);
                    $('#tipocliente_cot').val(cliente.tipocliente);
                    $('#cliente_cot').val(cliente.cliente_nombre); 

                    //Variables globales
                    preciodolarbd = parseFloat(cotizador.preciodolar);

                    switch (tp_precioseleccionado) {
                        case '1':
                            tp_producto = parseFloat(producto.preciolista);
                            break;
                        case '2':
                            tp_producto = parseFloat(producto.precioespecial);
                            break;
                        case '3':
                            tp_producto = parseFloat(producto.preciooriginal);
                            break;
                        case '4':
                            tp_producto = parseFloat(producto.preciointegrado);
                            break;
                        case '5':
                            tp_producto = parseFloat(producto.preciotienda);
                            break;
                        default:
                            tp_producto = parseFloat(producto.preciooriginal);
                    }

                    if(!modelo_titulo) {

                        var nuevosdatos = 
                        '<tr>'+
                            '<td style="display: none;"></td>'+
                            '<td style="display: none;">'+producto.id+'</td>'+
                            '<td style="display: none;">'+producto.modelo+'</td>'+
                            '<td>'+producto.titulo+'</td>'+
                            '<td>'+prod_cant+'</td>'+
                            '<td>'+tp_precionombre+'</td>'+
                            '<td data-precio-original="'+tp_producto.toFixed(2)+'">0</td>'+
                            '<td></td>'+
                            '<td>'+
                                '<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#modal_vgenerarcot" onclick="llenarmodalver($(this).closest(\'tr\'))"  value="" id="btnver_producto" name="btnver_producto"></button>'+
                                '<div style="padding-top: 3px;">'+
                                    '<button class="btn btn-sm btn-danger fa-solid fa-trash-can" onclick="" id="btneliminar_producto" name="btneliminar_producto"></button>'+
                                '</div>'+
                            '</td>'+
                        '</tr>';
                        $('#vgenerarcot_table tbody').append(nuevosdatos);
                    }
                    $('#btnagregar_cot').prop('disabled', true);
                    resetbtnconversion();

                    $('#vgenerarcot_table tbody tr').each(function() {
                        var id = $(this).find('td:nth-child(2)').text();
                        var modelo = $(this).find('td:nth-child(3)').text();
                        if (sel_prod === modelo || sel_prod === id) {
                            var cantidadactual = parseInt($(this).find('td:nth-child(5)').text());
                            var precioOriginal = parseFloat($(this).find('td:nth-child(7)').data('precio-original'));
                            var precionuevo = precioOriginal * cantidadactual;
                        
                            $(this).find('td:nth-child(5)').text(cantidadactual);
                            $(this).find('td:nth-child(7)').text(precionuevo.toFixed(2));
                        }
                    });

                    $('#vgenerarcot_table tbody tr').each(function() 
                    {
                        var preciomxn = parseFloat($(this).find('td:nth-child(7)').text());
                        var totalusd = preciomxn / parseFloat(cotizador.preciodolar);
                        $(this).find('td:nth-child(8)').text(totalusd.toFixed(2));
                    });

                    var iva = parseFloat(cotizador.iva);
                    $('[name="input_iva"]').val(iva);

                    var subtotal = 0;
                    $('#vgenerarcot_table tbody tr').each(function() {
                        var precio = parseFloat($(this).find('td:nth-child(7)').text());
                        if (!isNaN(precio)) {
                            subtotal += precio;
                        }
                    });
                    $('[name="input_subtotal"]').val(subtotal.toFixed(2));
                    var total = subtotal * iva; 
                    $('[name="input_total"]').val(total.toFixed(2));
                }
                else
                {
                    console.log('No se encontro ningún cliente');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos', error);
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        });
    }
    else
    {
        console.log('Los campos #tc_cliente y #cliente_prod deben contener información para buscar un cliente.');
    }
}

function precioautomatico()
{
    tp_precioseleccionado = $('input[name="numeroprecio"]:checked').val();
    tp_precionombre = $('input[name="numeroprecio"]:checked').attr('data-tipoprecio');
    $('#tp_seleccionado').val(tp_precioseleccionado);
    $('#tc_cliente').prop('disabled', true);
}
//FUNCIONES PARA EL BORRADOR DE UNA COTIZACIÓN


$(document).on('click', '#btneliminar_producto', function() {
    var fila = $(this).closest('tr');
    var cantidadeliminada = parseInt(fila.find('td:eq(4)').text()); // Obtener la cantidad de productos de la fila
    var cantprod_cot = parseInt($('#productos_cot').val());
    var iva = parseFloat($('[name="input_iva"]').val());
    Swal.fire({
        title: "¿Desea eliminar la fila?",
        text: "Esta opción no puede revertirse",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            fila.remove();
            if (!isNaN(cantprod_cot))
            {
                var nuevoresultado = cantprod_cot - cantidadeliminada;
                $('#productos_cot').val(nuevoresultado);
            }

            // Recalcular subtotal restando el precio del producto eliminado
            var subtotal = 0;
            $('#vgenerarcot_table tbody tr').each(function() {
                var precio = parseFloat($(this).find('td:nth-child(7)').text());
                if (!isNaN(precio)) {
                    subtotal += precio;
                }
            });
            $('[name="input_subtotal"]').val(subtotal.toFixed(2));

            var total = subtotal * iva;
            $('[name="input_total"]').val(total.toFixed(2));

            // Verificar si la tabla está vacía y limpiar los inputs si es así
            if ($('#vgenerarcot_table tbody tr').length === 0) {
                $('[name="input_subtotal"]').val('');
                $('[name="input_iva"]').val('');
                $('[name="input_total"]').val('');
            }
        }
    });
});

