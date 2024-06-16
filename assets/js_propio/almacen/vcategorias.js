$(document).ready(function() {
    var tabla_vcat = $('#tabla_vcat').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax':{
            'url': 'ccategorias/datoscategorias',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición para ccategorias');
                console.error('Error:', error);
                console.error('XHR:', xhr);
                console.error('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns':[
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'categoria', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'estado_vcat', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vcat = cellData.trim();
                $(td).html('<span id="celda_estado_vcat" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vcat === 'Activo'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vcat === 'Inactivo'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var botoneditar_vcat = `<button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vcat_modeditar" onclick="vcat_editar(${id})"></button>`;
                    var botoneliminar_vcat = `<button onclick="mensajeborrar_vcat(${id})" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>`;
                    $(td).html(botoneditar_vcat +'<span style="margin-left: 5px;"></span>'+botoneliminar_vcat);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vcat');
            $('#pagination_categorias').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vcat');
            $('#pagination_categorias').html('');
        }
    });

    new $.fn.dataTable.Buttons(tabla_vcat, {
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success',
                action: function(e, dt, node, config){
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
                }
            }
        ]
    });

    $('#dt-search-0').on('keyup', function(){
        tabla_vcat.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tabla_vcat.page.len(this.value).draw();
    });

    $('#btn-excel').on('click', function(){
        tabla_vcat.button('.buttons-excel').trigger();
    });

    tabla_vcat.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_vcat');
        $('#content_pagination').append(pagination);
    });
});