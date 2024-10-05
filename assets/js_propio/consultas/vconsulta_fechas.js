
$(document).ready(function() {
    prodact_fechasvcon(); 
    
    $('#btncancel_fechasvcon').click(function(){
        $('#btnconsultas_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#fechados_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#btncancel_fechasvcon').prop('disabled', true).css('opacity', 0.5);

    });

    $('#comboact_fechasvcon').change(function(){
        var datocombo = $(this).val();

        $('#colact_fechasvcon').text(datocombo);

        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }

        $('#tablaact_fechasvcon tbody').empty();

        if(datocombo === 'Productos'){
            prodact_fechasvcon();
        } else if(datocombo === 'Categorias'){
            catact_fechasvcon();
        } else if(datocombo === 'Marcas'){
            marcasact_fechasvcon();
        } else if(datocombo === 'Tipo de Cliente'){
            tcact_fechasvcon();
        }
    });

    $('#comboinact_fechasvcon').change(function(){
        var datocombo = $(this).val();

        $('#colinact_fechasvcon').text(datocombo);

        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }

        $('#tablainact_fechasvcon tbody').empty();

        if(datocombo === 'Productos'){
            prodinact_fechasvcon();
        } else if(datocombo === 'Categorias'){
            catinact_fechasvcon();
        } else if(datocombo === 'Marcas'){
            marcasinact_fechasvcon();
        } else if(datocombo === 'Tipo de Cliente'){
            tcinact_fechasvcon();
        }
    });

    $('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("data-bs-target");

        if (target === '#tabact_fechasvcon') {                        
            prodact_fechasvcon();
        } else if(target === '#tabinact_fechasvcon'){                  
            prodinact_fechasvcon();
        }
    }); 

    $('#fechauno_vcon').datepicker({
        language: 'es',
        autoClose: true,
        format: 'yyyy-mm-dd',
    }).on('changeDate', function(selected){
        var fechainicial = new Date(selected.date.valueOf());
        $('#fechados_vcon').datepicker('setStartDate', fechainicial);
    });

    $('#fechados_vcon').datepicker({
        language: 'es',
        autoClose: true,
        format: 'yyyy-mm-dd',
    });

    var comboact_fechasvcon = $('#comboact_fechasvcon').val();
    $('#colact_fechasvcon').text(comboact_fechasvcon);

    var comboinact_fechasvcon = $('#comboinact_fechasvcon').val();
    $('#colinact_fechasvcon').text(comboinact_fechasvcon);
});

function prodact_fechasvcon()
{
    $('[name="tablaact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablaact_fechasvcon').DataTable().destroy();
    $('#tablaact_fechasvcon tbody').empty();

    var tablaprodact_fechasvcon = $('#tablaact_fechasvcon').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cconsulta_fechas/tablaprodact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición de productos');
                console.error('Error:', error);
                console.error('XHR:', xhr);
                console.error('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'modelo', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_prod', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vprod = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_tablaprod" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vprod === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vprod === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': 'fecha_vprod', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    // var prodeditar_fechasvcon = ``;
                    var prodver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(prodver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablaprodact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablaprodact_fechasvcon.page.len(this.value).draw();
    })

    tablaprodact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_actfechasvcon');
        $('#pagination_act_fechasvcon').append(pagination);
    });
}

function catact_fechasvcon()
{
    $('[name="tablaact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablaact_fechasvcon').DataTable().destroy();
    $('#tablaact_fechasvcon tbody').empty();

    var tablacatact_fechasvcon = $('#tablaact_fechasvcon').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cconsulta_fechas/tablacatact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.error('XHR:', xhr);
                console.error('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'categoria', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vcat', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vcat = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_tablacat" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vcat === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vcat === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': 'fecha_vcat', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    // var prodeditar_fechasvcon = ``;
                    var catver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(catver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablacatact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablacatact_fechasvcon.page.len(this.value).draw();
    })

    tablacatact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_actfechasvcon');
        $('#pagination_act_fechasvcon').append(pagination);
    });
}

function marcasact_fechasvcon()
{
    $('[name="tablaact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablaact_fechasvcon').DataTable().destroy();
    $('#tablaact_fechasvcon tbody').empty();

    var tablamarcasact_fechasvcon = $('#tablaact_fechasvcon').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cconsulta_fechas/tablamarcasact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.error('XHR:', xhr);
                console.error('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'marca', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vmarcas', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vmarcas = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_tablamarcas" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vmarcas === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vmarcas === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': 'fecha_vmarcas', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    // var prodeditar_fechasvcon = ``;
                    var marcasver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(marcasver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablamarcasact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablamarcasact_fechasvcon.page.len(this.value).draw();
    });

    tablamarcasact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_actfechasvcon');
        $('#pagination_act_fechasvcon').append(pagination);
    });
}

function tcact_fechasvcon()
{
    $('[name="tablaact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablaact_fechasvcon').DataTable().destroy();
    $('#tablaact_fechasvcon tbody').empty();

    var tablatiposact_fechasvcon = $('#tablaact_fechasvcon').DataTable({
        language: {
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cconsulta_fechas/tablatiposact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                console.error('Error:', error);
                console.error('XHR:', xhr);
                console.error('CODE:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'id', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'tipocliente', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vtipos', 'createdCell': function(td, cellData, rowData, col, row){
                var estado_vtipos = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_tablatipos" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vtipos === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vtipos === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null, 'visible': false},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var tiposver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(tiposver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablatiposact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablatiposact_fechasvcon.page.len(this.value).draw();
    });

    tablatiposact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_actfechasvcon');
        $('#pagination_act_fechasvcon').append(pagination);
    });
}

function prodinact_fechasvcon()
{
    $('[name="tablainact_fechasvcon_length"]').val('10');  
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablainact_fechasvcon').DataTable().destroy();
    $('#tablainact_fechasvcon tbody').empty();

    var tablaprodinact_fechasvcon = $('#tablainact_fechasvcon').DataTable({
        language: {
            'zeroRecords': 'No se encontraron coincidencias',
            'emptyTable': 'No hay datos disponibles'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cconsulta_fechas/tablaprodinact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, code, error){
                console.error('XHR:', xhr);
                console.error('CODE:', code);
                console.error('ERROR:', error);

                if(xhr.responseText){
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns':[
            {'data': 'id', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'modelo', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_prod', 'createdCell': function(td, cellData, rowData, col, row){
                var estado_vprod = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_est_tablaprodinact" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vprod === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vprod === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': 'fecha_vprod', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var prodver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(prodver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inacfechasvcon');
            $('#pagination_inact_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablaprodinact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablaprodinact_fechasvcon.page.len(this.value).draw();
    });

    tablaprodinact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_inactfechasvcon');
        $('#pagination_inact_fechasvcon').append(pagination);
    });
}

function catinact_fechasvcon()
{
    $('[name="tablainact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablainact_fechasvcon').DataTable().destroy();
    $('#tablainact_fechasvcon tbody').empty();

    var tablacatinact_fechasvcon = $('#tablainact_fechasvcon').DataTable({
        language: {
            'zeroRecords': 'No se encontraron coincidencias',
            'emptyTable': 'No hay datos disponibles'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cconsulta_fechas/tablacatinact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, status, error, code){
                console.error('XHR:', xhr);
                console.error('STATUS:', status);
                console.error('CODE:', code);
                console.error('ERROR:', error);

                if(xhr.responseText)
                {
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns':[
            {'data': 'id', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'categoria', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vcat', 'createdCell': function(td, cellData, rowData, col, row){
                var estado_vcat = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_est_tablacatinact" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vcat === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vcat === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': 'fecha_vcat', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'ordering': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, col, row)
                {
                    var id = rowData.id;
                    var catver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(catver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inacfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablacatinact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablacatinact_fechasvcon.page.len(this.value).draw();
    });

    tablacatinact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_inactfechasvcon');
        $('#pagination_inact_fechasvcon').append(pagination);
    });
}

function marcasinact_fechasvcon()
{
    $('[name="tablainact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablainact_fechasvcon').DataTable().destroy();
    $('#tablainact_fechasvcon tbody').empty();

    var tablamarcasinact_fechasvcon = $('#tablainact_fechasvcon').DataTable({
        language: {
            'zeroRecords': 'No se encontraron coincidencias',
            'emptyTable': 'No hay datos disponibles'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cconsulta_fechas/tablamarcasinact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, status, code){
                console.error('XHR:', xhr);
                console.error('ERROR:', error);
                console.error('STATUS:', status);
                console.error('CODE:', code);

                if(xhr.responseText)
                {
                    console.error('Respuesta del error:', xhr.responseText);
                }
            }
        },
        'columns':[
            {'data': 'id', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'marca', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vmarcas', 'createdCell': function(td, cellData, rowData, col, row){
                var estado_vmarcas = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_est_tablamarcasinact" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vmarcas === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vmarcas === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': 'fecha_vmarcas', 'createdCell': function(td, cellData, rowData, col, row){
                $(td).addClass('text-center');
            }},
            {'data': null,
                'ordering': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, col, row){
                    var id = rowData.id;
                    var marcasver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(marcasver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablamarcasinact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablamarcasinact_fechasvcon.page.len(this.value).draw();
    });

    tablamarcasinact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_inactfechasvcon');
        $('#pagination_inact_fechasvcon').append(pagination);
    });
}

function tcinact_fechasvcon()
{
    $('[name="tablainact_fechasvcon_length"]').val('10');
    $('#pagination_inact_fechasvcon').empty();    
    $('#pagination_act_fechasvcon').empty();
    $('#tablainact_fechasvcon').DataTable().destroy();
    $('#tablainact_fechasvcon tbody').empty();

    var tablatiposinact_fechasvcon = $('#tablainact_fechasvcon').DataTable({
        language:{
            'zeroRecords': 'No se encontraron coincidencias',
            'emptyTable': 'No hay datos disponibles'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cconsulta_fechas/tablatiposinact_fechasvcon',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, status, error, code){
                console.error('XHR:', xhr);
                console.error('STATUS:', status);
                console.error('ERROR:', error);
                console.error('CODE:', code);

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
            {'data': 'tipocliente', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},            
            {'data': 'estado_vtipos', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vtipos = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_est_tablatiposinact" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vtipos === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success')
                } else if(estado_vtipos === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null, 'visible': false},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col){
                    var id = rowData.id;
                    var tiposver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#" onclick="ver_vconfechas(${id})"></button>`;
                    $(td).addClass('text-center').html(tiposver_fechasvcon);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').html('');
        }
    });

    $('#dt-search-0').on('keyup', function(){
        tablatiposinact_fechasvcon.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tablatiposinact_fechasvcon.page.len(this.value).draw();
    });

    tablatiposinact_fechasvcon.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_inactfechasvcon');
        $('#pagination_inact_fechasvcon').append(pagination);
    });
}