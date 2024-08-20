$(document).ready(function() {
    var tabla = $('#tabla_vtotal').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles'
        },
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'ctotal_clientes/obtenerdatos',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, status, error, code){
                alert('Error al hacer la petición');
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
            {'data': 'tipocliente', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'ciudad', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center')
            }},
            {'data': 'pais', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'empresa', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'disponible_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                var dispnible_vtotal = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_disponible_vtotal" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(dispnible_vtotal === 'ACTIVO')
                {
                    $(td).find('span').addClass('badge badge-success');
                } else if(dispnible_vtotal === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var botoneditar_vtotal = `<button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vtotal_modeditar" onclick="vtotal_editar(${id})" value=""></button>`;
                    var botoneliminar_vtotal = `<button onclick="mensajeborrar_vtotal(${id})" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>`;
                    $(td).addClass('text-center').html(botoneditar_vtotal + '<div style="padding-top: 3px;">' + botoneliminar_vtotal + '</div>');
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vtotal');
            $('#pagination_totalclientes').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vtotal');
            $('#pagination_totalclientes').html('');
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
        pagination.attr('id', 'pagination_vtotal');
        $('#pagination_totalclientes').append(pagination);
    });
});