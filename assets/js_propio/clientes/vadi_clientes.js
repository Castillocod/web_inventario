$(document).ready(function()
{
    //CONFIGURACIÓN DE DATATABLES
    var tabla = $('#tabla_vadi').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontrarion coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cadi_clientes/obtenerdatos',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, status, error, code){
                console.error('Error:', error);
                console.xhr('XHR:', xhr);
                console.code('Code:', code);
                console.status('Status:', status);

                if(xhr.responseText)
                {
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns':[
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'nombre', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'direccion', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'correo', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'telefono', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'rfc', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'fecha_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var botonver = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#vadi_mostrarclientes" onclick="ver_vadi(${id})"></button>`;
                    $(td).addClass('text-center').html(botonver);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vadi');
            $('#pagination_adiclientes').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vadi');
            $('#pagination_adiclientes').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tabla.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tabla.page.len(this.value).draw();
    });

    tabla.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_vadi');
        $('#pagination_adiclientes').append(pagination);
    });
    //CONFIGURACIÓN DE DATATABLES

    //COMPROBACIÓN DE DATOS DE ADICLIENTES
    $.ajax({
        url: 'cadi_clientes/comprobacionvadi',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data)
            {
                $('[name="dt_buscar_vadi"]').prop('disabled', true);
                $('[name="tabla_vadi_length"]').prop('disabled', true);
            }
            else
            {
                $('[name="dt_buscar_vadi"]').prop('disabled', false);
                $('[name="tabla_vadi_length"]').prop('disabled', false);
            }
        }
    });
    //COMPROBACIÓN DE DATOS DE ADICLIENTES

    $('#btnvadi_cancelar').click(function() {
        $('#id').val('');
        $('#nombre').val('');
        $('#direccion').val('');
        $('#correo').val('');
        $('#telefono').val('');
        $('#rfc').val('');
        $('#fecha_vadi').val('');
    });
});

function ver_vadi(id)
{
    $('#vadi_formmostrar')[0].reset();

    $.ajax({
        url: 'cadi_clientes/ver_vadi/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            $('[name="id"]').val(data.id);
            $('[name="nombre"]').val(data.nombre);
            $('[name="direccion"]').val(data.direccion);
            $('[name="correo"]').val(data.correo);
            $('[name="telefono"]').val(data.telefono);
            $('[name="rfc"]').val(data.rfc);
            $('[name="fecha_vadi"]').val(data.fecha_vtotal);

            $('#vadi_mostrarclientes').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos', error);
        }
    });
    $('#vadi_formostrar')[0].reset();
}