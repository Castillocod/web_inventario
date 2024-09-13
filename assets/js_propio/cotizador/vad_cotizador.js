$(document).ready(function() {

    //CONFIGURACIÓN DE LA DATATABLES
    var tabla_totalcotizaciones = $('#tabla_totalcotizaciones').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles'
        },
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cad_cotizador/tabla_totalcotizaciones',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.xhr('XHR:', xhr);
                console.code('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'tipocliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'idcliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'hora_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_borrador = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_borrador" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');

                if(estado_borrador === 'Pendiente'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_borrador === 'Terminada'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var folio_cotizacion = rowData.folio_cotizacion;
                    var botonver_totalcotizaciones = `<button class="btn btn-success btnver_listacot fa-regular fa-eye" id="" name="btnver_listacot" data-bs-toggle="modal" data-bs-target="#modal_vercotizacion" onclick="datoscotizacion(${folio_cotizacion})" value="${folio_cotizacion}" style="width: 15px;"></button>`;
                    var botonir_totalcotizaciones = `<button class="btn btn-primary fa-solid fa-arrow-right" id="btn_mandardatoslista" name="" value="${folio_cotizacion}" onclick="datosborradorlista(${folio_cotizacion})"></button>`;
                    $(td).addClass('text-center').html(botonver_totalcotizaciones + '<div style="padding-top: 3px;">' + botonir_totalcotizaciones + '</div>');
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_totalesvcot');
            $('#pagination_totalcotizaciones').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_totalesvcot');
            $('#pagination_totalcotizaciones').html('');
        }
    });

    tabla_totalcotizaciones.on('draw', function() {
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_totalesvcot');
        $('#pagination_totalcotizaciones').append(pagination);
    });

    var tabla_totalpendientes = $('#tabla_totalpendientes').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles'
        },
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cad_cotizador/tabla_totalpendientes',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.xhr('XHR:', xhr);
                console.code('Código:', code);

                if(xhr.responseText)
                {
                    console.error('Respuesta del error', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'tipocliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'idcliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'hora_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_borrador = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_borrador" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');

                if(estado_borrador === 'Pendiente'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_borrador === 'Terminada'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var folio_cotizacion = rowData.folio_cotizacion;
                    var botonver_totalpendientes = `<button class="btn btn-success btnver_pendientes fa-regular fa-eye" id="" name="" data-bs-toggle="modal" data-bs-target="#modal_verpendientes_cot" value="${folio_cotizacion}" onclick="datospendientes(${folio_cotizacion})" style="width: 15px;"></button>`;
                    var botonir_totalpendientes = `<button class="btn btn-primary fa-solid fa-arrow-right" id="" name="" value="${folio_cotizacion}" onclick="datosborradorlista(${folio_cotizacion})"></button>`;
                    $(td).addClass('text-center').html(botonver_totalpendientes + '<div style="padding-top: 3px;">' + botonir_totalpendientes + '</div>');
                }
            }

        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_pendientesvcot');
            $('#pagination_totalpendientes').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_pendientesvcot');
            $('#pagination_totalpendientes').html('');
        }
    });

    tabla_totalpendientes.on('draw', function() {
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_pendientesvcot');
        $('#pagination_totalpendientes').append(pagination);
    });

    var tabla_totalterminadas = $('#tabla_totalterminadas').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles'
        },
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cad_cotizador/tabla_totalterminadas',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.xhr('XHR:', xhr);
                console.code('Código:', code);

                if(xhr.responseText)
                {
                    console.error('Respuesta del error', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'tipocliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'idcliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'hora_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_borrador = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_borrador" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');

                if(estado_borrador === 'Pendiente'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_borrador === 'Terminada'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var folio_cotizacion = rowData.folio_cotizacion;
                    var botonver_totalterminadas = `<button class="btn btn-success btnver_terminadas fa-regular fa-eye" id="" name="" value="${folio_cotizacion}" data-bs-toggle="modal" data-bs-target="#modal_verterminadas_cot" onclick="datosterminadas(${folio_cotizacion})" style="width: 15px;"></button>`;
                    var botonir_totalterminadas = `<button class="btn btn-primary fa-solid fa-arrow-right" id="" name="" value="${folio_cotizacion}" onclick="datosborradorlista(${folio_cotizacion})"></button>`;
                    $(td).addClass('text-center').html(botonver_totalterminadas + '<div style="padding-top: 3px;">' + botonir_totalterminadas + '</div>');
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_terminadasvcot');
            $('#pagination_totalterminadas').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_terminadasvcot');
            $('#pagination_totalterminadas').html('');
        }
    });

    tabla_totalterminadas.on('draw', function() {
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_terminadasvcot');
        $('#pagination_totalterminadas').append(pagination);
    });

    $('#dt-search-0').on('keyup', function(){
        tabla_totalcotizaciones.search(this.value).draw();
        tabla_totalpendientes.search(this.value).draw();
        tabla_totalterminadas.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function() {
        tabla_totalcotizaciones.page.len(this.value).draw();
        tabla_totalpendientes.page.len(this.value).draw();
        tabla_totalterminadas.page.len(this.value).draw();
    });
    //CONFIGURACIÓN DE LA DATATABLES

    //COMPROBACIÓN DE DATOS
    $.ajax({
        url: 'cad_cotizador/comprobacionvcot',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data)
            {
                $('[name="dt_buscar_totalcotizaciones"]').prop('disabled', true);
                $('[name="tabla_totalcotizaciones_length"]').prop('disabled', true);
            }
            else
            {
                $('[name="dt_buscar_totalcotizaciones"]').prop('disabled', false);
                $('[name="tabla_totalcotizaciones_length"]').prop('disabled', false);
            }
        }
    });
    //COMPROBACIÓN DE DATOS

    $.ajax({
        url: 'cad_cotizador/modificarformulas',
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.length > 0) {
                // Suponiendo que solo hay una fila de datos en el resultado
                var rowData = data[0];
                $('[name="form_preciodolar"]').val(rowData.preciodolar);
                $('[name="form_porcentajeintegrador"]').val(rowData.porcentajeintegrador);
                $('[name="form_porcentajetienda"]').val(rowData.porcentajetienda);
                $('[name="form_iva"]').val(rowData.iva);
            } else {
                console.error('No se encontraron datos para modificar');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los datos', error);
        }
    });

    $('.equis_cerrar').click(function() {
        $('#modal_vercotizacion').modal('hide');
        $('#vad_formcotizacion')[0].reset();
        $('#vcotizador_table tbody').html('');

        $('#modal_vadpendientes').modal('hide');
        $('#vad_formpendientes')[0].reset();
        $('#vadpendientes_formcotizacion')[0].reset();
        $('#vpendientes_table tbody').html('');

        $('#modal_vadterminadas').modal('hide');
        $('#vad_formterminadas')[0].reset();
        $('#vadterminadas_formcotizacion')[0].reset();
        $('#vterminadas_table tbody').html(''); 
        
        $('#modal_verpendientes_cot').modal('hide');
        $('#modal_verterminadas_cot').modal('hide');
    });

    $('.btnver_pendientes').click(function() {
        $('#modal_vadpendientes').modal('hide');
        $('#modal_verpendientes_cot').modal('hide');

        $('#vadpen_regresar').click(function() {
            $('#modal_vadpendientes').modal('show');
            $('#modal_verpendientes_cot').modal('hide');
        });
    });

    $('.btnver_terminadas').click(function() {
        $('#modal_vadterminadas').modal('hide');
        $('#modal_verterminadas_cot').modal('hide');
        
        $('#vadter_regresar').click(function() {
            $('#modal_vadterminadas').modal('show');
            $('#modal_verterminadas_cot').modal('hide');
        });
    });

    $('#vadpen_cerrar').click(function() {
        $('#modal_vadpendientes').modal('hide');
        $('#vad_formpendientes')[0].reset();
        $('#vadpendientes_formcotizacion')[0].reset();
        $('#vpendientes_table tbody').html('');
    });

    $('#vadter_cerrar').click(function() {
        $('#modal_vadterminadas').modal('hide');
        $('#vad_formterminadas')[0].reset();
        $('#vadterminadas_formcotizacion')[0].reset();
        $('#vterminadas_table tbody').html('');
    });

    $('.btnver_listacot').click(function() {
        $('#vad_regresar').css('visibility', 'hidden');
    });

});

$(document).on('click', '#btnactualizar_vad', function(e)
{
    e.preventDefault();

    var preciodolar = $('#preciodolar').val();
    var porcentajeintegrador = $('#porcentajeintegrador').val();
    var porcentajetienda = $('#porcentajetienda').val();
    var iva = $('#iva').val();

    if(preciodolar == "" || porcentajeintegrador == "" || porcentajetienda == "" || iva == "")
    {
        alert('Falta rellenar algunos campos obligatorios');
    }
    else
    {
        $.ajax({
            url: 'cad_cotizador/actualizarformulas',
            type: 'POST',
            dataType: 'JSON',
            data: {
                preciodolar:preciodolar,
                porcentajeintegrador:porcentajeintegrador,
                porcentajetienda:porcentajetienda,
                iva:iva
            },
            success: function(data){
                if(data.responce == 'success')
                {
                    $('#modal_vad_formulas').modal('hide');
                    Swal.fire({
                        title: "Formulas Actualizadas",
                        text: "Formulas actualizadas con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "cad_cotizador";
                        }
                    });
                }
                else
                {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algo salio mal al actualizar",
                        allowOutsideClick: false,
                    });
                }
            }
        });
    }
});

function modificarformulas()
{
    $('#form_vad_formulas')[0].reset()

    $.ajax({
        url: 'cad_cotizador/modificarformulas',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(data.length > 0)
            {
                var row = data[0];
                $('[name="preciodolar"]').val(row.preciodolar);
                $('[name="porcentajeintegrador"]').val(row.porcentajeintegrador);
                $('[name="porcentajetienda"]').val(row.porcentajetienda);
                $('[name="iva"]').val(row.iva);
                $('#modal_vad_formulas').modal();
            }
            else
            {
                console.error('No se encontraron los datos');
            }

        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos', error);
        }
    });
    $('#form_vad_formulas')[0].reset();
}

function datoscotizacion(folio_cotizacion)
{
    $('#vad_formcotizacion')[0].reset();
    $('#vcotizador_table tbody').html('');

    $.ajax({
        url: 'cad_cotizador/verdatoscotizacion/' + folio_cotizacion,
        type: 'GET',
        dataType: 'JSON',
        success: function (data){
            console.log('Datos para la lista cotizador: /n', data);
            $('[name="folio_vad"]').val(data.datoscotizaciones.folio_cotizacion);
            $('[name="idcliente_vad"]').val(data.datoscotizaciones.idcliente_cot);
            $('[name="tipocliente_vad"]').val(data.datoscotizaciones.tipocliente_cot);
            $('[name="nombrecliente_vad"]').val(data.datoscotizaciones.nombrecliente_cot);
            $('[name="subtotal_vad"]').val(data.datoscotizaciones.subtotal_cot);
            $('[name="iva_vad"]').val(data.datoscotizaciones.iva_cot);
            $('[name="total_vad"]').val(data.datoscotizaciones.total_cot);
            $('[name="fecha_vad"]').val(data.datoscotizaciones.fecha_vcot);
            $('[name="hora_vad"]').val(data.datoscotizaciones.hora_vcot);
            $('[name="estado_vad"]').val(data.datoscotizaciones.estado_borrador);

            var htmlcotizacion = '';
            $.each(data.datostablahtml, function(index, value) {
                htmlcotizacion += '<tr>';
                htmlcotizacion += '<td>'+value.folio_cotizacion+'</td>';
                htmlcotizacion += '<td style="display: none;">'+value.idproducto_cot+'</td>';
                htmlcotizacion += '<td style="display: none;">'+value.modeloprod_cot+'</td>';
                htmlcotizacion += '<td>'+value.nombreprod_cot+'</td>';
                htmlcotizacion += '<td>'+value.cantidadprod_cot+'</td>';
                htmlcotizacion += '<td>'+value.tipoprecio_cot+'</td>';
                htmlcotizacion += '<td>'+value.preciomxn_cot+'</td>';
                htmlcotizacion += '<td>'+value.preciousd_cot+'</td>';
                htmlcotizacion += '</tr>';
            });
            $('#vcotizador_table tbody').html(htmlcotizacion);

            $('#modal_vercotizacion').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos', error);
        },
    });
    $('#vad_formcotizacion')[0].reset();
    $('#vcotizador_table tbody').html('');
}

function datospendientes(folio_cotizacion)
{
    $('#vadpendientes_formcotizacion')[0].reset();
    $('#vpendientes_table tbody').html('');

    $.ajax({
        url: 'cad_cotizador/verdatoscotizacion/' + folio_cotizacion,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            console.log('Datos para la lista de pendientes /n', data);
            $('[name="folio_pen"]').val(data.datoscotizaciones.folio_cotizacion);
            $('[name="idcliente_pen"]').val(data.datoscotizaciones.idcliente_cot);
            $('[name="tipocliente_pen"]').val(data.datoscotizaciones.tipocliente_cot);
            $('[name="nombrecliente_pen"]').val(data.datoscotizaciones.nombrecliente_cot);
            $('[name="subtotal_pen"]').val(data.datoscotizaciones.subtotal_cot);
            $('[name="iva_pen"]').val(data.datoscotizaciones.iva_cot);
            $('[name="total_pen"]').val(data.datoscotizaciones.total_cot);
            $('[name="fecha_pen"]').val(data.datoscotizaciones.fecha);
            $('[name="hora_pen"]').val(data.datoscotizaciones.hora);
            $('[name="estado_pen"]').val(data.datoscotizaciones.estado_borrador);

            var htmlpendientes = '';
            $.each(data.datostablahtml, function(index, value){
                htmlpendientes += '<tr>';
                htmlpendientes += '<td>'+value.folio_cotizacion+'</td>';
                htmlpendientes += '<td style="display: none;">'+value.idproducto_cot+'</td>';
                htmlpendientes += '<td style="display: none;">'+value.modeloprod_cot+'</td>';
                htmlpendientes += '<td>'+value.nombreprod_cot+'</td>';
                htmlpendientes += '<td>'+value.cantidadprod_cot+'</td>';
                htmlpendientes += '<td>'+value.tipoprecio_cot+'</td>';
                htmlpendientes += '<td>'+value.preciomxn_cot+'</td>';
                htmlpendientes += '<td>'+value.preciousd_cot+'</td>';
                htmlpendientes += '</tr>';
            });
            $('#vpendientes_table tbody').html(htmlpendientes);
            $('#modal_verpendientes_cot').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos', error);
        },
    });

    $('#vadpendientes_formcotizacion')[0].reset();
    $('#vpendientes_table tbody').html('');
}

function datosterminadas(folio_cotizacion)
{
    $('#vadterminadas_formcotizacion')[0].reset();
    $('#vterminadas_table tbody').html('');

    $.ajax({
        url: 'cad_cotizador/verdatoscotizacion/' + folio_cotizacion,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            console.log('Datos para la lista de terminadas /n', data);
            $('[name="folio_ter"]').val(data.datoscotizaciones.folio_cotizacion);
            $('[name="idcliente_ter"]').val(data.datoscotizaciones.idcliente_cot);
            $('[name="tipocliente_ter"]').val(data.datoscotizaciones.tipocliente_cot);
            $('[name="nombrecliente_ter"]').val(data.datoscotizaciones.nombrecliente_cot);
            $('[name="subtotal_ter"]').val(data.datoscotizaciones.subtotal_cot);
            $('[name="iva_ter"]').val(data.datoscotizaciones.iva_cot);
            $('[name="total_ter"]').val(data.datoscotizaciones.total_cot);
            $('[name="fecha_ter"]').val(data.datoscotizaciones.fecha);
            $('[name="hora_ter"]').val(data.datoscotizaciones.hora);
            $('[name="estado_ter"]').val(data.datoscotizaciones.estado_borrador);

            var htmlterminadas = '';
            $.each(data.datostablahtml, function(index, value){
                htmlterminadas += '<tr>';
                htmlterminadas += '<td>'+value.folio_cotizacion+'</td>';
                htmlterminadas += '<td style="display: none;">'+value.idproducto_cot+'</td>';
                htmlterminadas += '<td style="display: none;">'+value.modeloprod_cot+'</td>';
                htmlterminadas += '<td>'+value.nombreprod_cot+'</td>';
                htmlterminadas += '<td>'+value.cantidadprod_cot+'</td>';
                htmlterminadas += '<td>'+value.tipoprecio_cot+'</td>';
                htmlterminadas += '<td>'+value.preciomxn_cot+'</td>';
                htmlterminadas += '<td>'+value.preciousd_cot+'</td>';
                htmlterminadas += '</tr>';
            });
            $('#vterminadas_table tbody').html(htmlterminadas);
            $('#modal_verterminadas_cot').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos', error);
        },


    });

    

    $('#vadterminadas_formcotizacion')[0].reset();
    $('#vterminadas_table tbody').html('');
}

function datosborradorlista(folio_cotizacion)
{
    $.ajax({
        url: 'cad_cotizador/verdatoscotizacion/' + folio_cotizacion,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            console.log("datos de cotizacion:", data.datoscotizaciones);
            console.log("datos de tablas:", data.datostablahtml);

            localStorage.setItem('datoscotizacionlista', JSON.stringify(data));
            window.location.href = "cgenerarcot?folio=" + folio_cotizacion;
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos', error);
        }
    });
}

function mensajeborrador()
{
    Swal.fire({
		title: "¿Desea Crear Un Borrador?",
		text: "Esta opción no puede revertirse",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Guardar borrador",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
            //GENERAR COTIZACION
            var select_tccliente = $('#tc_cliente').val();
            var select_clienteprod = $('#cliente_prod').val();

            //RESUMEN DE COTIZACION
            var input_idclientecot = $('#idcliente_cot').val();
            var input_productoscot = $('#productos_cot').val();

            //TIPO DE PRECIOS MODAL
            var input_tpseleccionado = $('#tp_seleccionado').val();

            //TABLA DE COTIZACION
            var datosborrador_table = [];
            $('#vgenerarcot_table tbody tr').each(function() {
                var tdproductoid = $(this).find('td:nth-child(2)').text();
                var tdproductomodelo = $(this).find('td:nth-child(3)').text();
                var tdproductotitulo = $(this).find('td:nth-child(4)').text();
                var tdproductocantidad = $(this).find('td:nth-child(5)').text();
                var tdproductotp = $(this).find('td:nth-child(6)').text();
                var tdproductomxn = $(this).find('td:nth-child(7)').text();
                var tdproductousd = $(this).find('td:nth-child(8)').text();

                if(tdproductoid.trim() !== "")
                {
                    var filaborrador = {
                        tdproductoid: tdproductoid,
                        tdproductomodelo: tdproductomodelo,
                        tdproductotitulo: tdproductotitulo,
                        tdproductocantidad: tdproductocantidad,
                        tdproductotp: tdproductotp,
                        tdproductomxn: tdproductomxn,
                        tdproductousd: tdproductousd
                    };

                    datosborrador_table.push(filaborrador);
                }
            });
            //COTIZACION
            var input_subtotalcot = $('#input_subtotal').val();
            var input_ivacot = $('#input_iva').val();
            var input_totalcot = $('#input_total').val();

            var datosborrador = {
                select_tccliente: select_tccliente,
                select_clienteprod: select_clienteprod,
                input_idclientecot: input_idclientecot,
                input_productoscot: input_productoscot,
                input_tpseleccionado: input_tpseleccionado,
                datosborrador_table: datosborrador_table,
                input_subtotalcot: input_subtotalcot,
                input_ivacot: input_ivacot,
                input_totalcot: input_totalcot
            };

            console.log('Datos borrador: ', datosborrador);

            $.ajax({
                url: 'cad_cotizador/cotizacionborrador',
                type: 'POST',
                // dataType: 'JSON',
                data: datosborrador,
                success: function(response){
                    console.log(response);
                    Swal.fire({
                        title: "Cotización Guardada",
                        text: "Cotización Guardada Con Éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "cgenerarcot";
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error){
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algo Salio Mal al Crear el Borrador",
                        allowOutsideClick: false,
                    });
                }
            });
		}
	});
}

document.addEventListener('DOMContentLoaded', function() {
    var celdaestado_cot = document.querySelectorAll('#celdaestado_cot');

    celdaestado_cot.forEach(function(celdacot){
        var estadocot = celdacot.textContent.trim();

        if (estadocot === 'Pendiente'){
            celdacot.classList.add('badge', 'badge-danger');
        } else if (estadocot === 'Terminada') {
            celdacot.classList.add('badge', 'badge-success');
        }
    });
});

