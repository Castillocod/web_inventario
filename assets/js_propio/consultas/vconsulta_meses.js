const lblmes_mesesvcon = $('#lblmes_vcon');
const mes_mesesvcon = $('#mes_vcon');

const btnconsultas_mesesvcon = $('#btnconsultasmes_vcon');
const btncancel_mesesvcon = $('#btncancel_mesesvcon');

$(document).ready(function() {
    prodact_mesesvcon()

    lblmes_mesesvcon.prop('disabled', true).css('opacity', 0.5);
    mes_mesesvcon.prop('disabled', true).css('opacity', 0.5);

    mes_mesesvcon.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblmes_mesesvcon.prop('disabled', true).css('opacity', 0.5);
            btnconsultas_mesesvcon.prop('disabled', false).css('opacity', 1);
            btncancel_mesesvcon.prop('disabled', false).css('opacity', 1);
        }
    });

    $('#btncancel_mesesvcon').click(function(){
        $('#btnconsultasmes_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#btncancel_mesesvcon').prop('disabled', true).css('opacity', 0.5);
        $('#lblmes_vcon').prop('disabled', false).css('opacity', 1);
        $('#mes_vcon').prop('disabled', false).css('opacity', 1).val('');
    });

    $('#btnconsultasmes_vcon').click(function() {
        $('#btnconsultasmes_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#btncancel_mesesvcon').prop('disabled', true).css('opacity', 0.5);
        $('#lblmes_vcon').prop('disabled', false).css('opacity', 1);
        $('#mes_vcon').prop('disabled', false).css('opacity', 1).val('');
    });

    $('#comboact_mesesvcon').change(function() {
        var datocombo = $(this).val();

        $('#colact_mesesvcon').text(datocombo);

        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        $('#tablaact_mesesvcon tbody').empty();

        if(datocombo === 'Productos'){
            prodact_mesesvcon();
        } else if(datocombo === 'Categorias'){
            catact_mesesvcon();
        } else if(datocombo === 'Marcas'){
            marcasact_mesesvcon();
        } else if(datocombo === 'Tipo de Cliente'){
            tcact_mesesvcon();
        }
    });

    $('#comboinact_mesesvcon').change(function() {
        var datocombo = $(this).val();

        $('#colinact_mesesvcon').text(datocombo);

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        $('#tablainact_mesesvcon tbody').empty();

        if(datocombo === 'Productos'){
            prodinact_mesesvcon();
        } else if(datocombo === 'Categorias'){
            catinact_mesesvcon();
        } else if(datocombo === 'Marcas'){
            marcasinact_mesesvcon();
        } else if(datocombo === 'Tipo de Cliente'){
            tcinact_mesesvcon();
        }
    });

    $('#combocot_mesesvcon').change(function() {
        var datocombo = $(this).val();

        $('#colcot_mesesvcon').text(datocombo);

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        $('#tablacot_mesesvcon tbody').empty();

        if(datocombo === 'Pendientes'){
            cotpen_mesesvcon();
        } else if(datocombo === 'Terminadas'){
            cotter_mesesvcon();
        }
    });

    $('#comboclientes_mesesvcon').change(function() {
        var datocombo = $(this).val();

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('#tablaclientes_mesesvcon tbody').empty();

        if(datocombo === 'Disponibles'){
            clientesdisp_mesesvcon();
        } else if(datocombo === 'No Disponibles'){
            clientesnodisp_mesesvcon();
        }                        
    });

    $('#mes_vcon').datepicker({
        language: 'es',
        autoClose: true,
        format: 'yyyy-mm',
        startView: 'months',
        minViewMode: 'months'
    });

    var comboact_mesesvcon = $('#comboact_mesesvcon').val();
    $('#colact_mesesvcon').text(comboact_mesesvcon);

    var comboinact_mesesvcon = $('#comboinact_mesesvcon').val();
    $('#colinact_mesesvcon').text(comboinact_mesesvcon);

    var combocot_mesesvcon = $('#combocot_mesesvcon').val();
    $('#colcot_mesesvcon').text(combocot_mesesvcon);
});

function inicio_mesesvcon()
{
    var meses_vcon = $('#mes_vcon').val();
    var comboact_mesesvcon = $('#comboact_mesesvcon').val();
    var comboinact_mesesvcon = $('#comboinact_mesesvcon').val();
    var combocot_mesesvcon = $('#combocot_mesesvcon').val();
    var comboclientes_mesesvcon = $('#comboclientes_mesesvcon').val();

    if(meses_vcon)
    {
        var tab_mesesvcon = $('#myTab button.active').attr('data-bs-target');

        if(tab_mesesvcon === '#tabact_mesesvcon')
        {
            if(comboact_mesesvcon === 'Productos'){
                prodact_mesesvcon(meses_vcon);
            } else if(comboact_mesesvcon === 'Categorias'){
                catact_mesesvcon(meses_vcon);
            } else if(comboact_mesesvcon === 'Marcas'){
                marcasact_mesesvcon(meses_vcon);
            }
        }

        if(tab_mesesvcon === '#tabinact_mesesvcon')
        {
            if(comboinact_mesesvcon === 'Productos'){
                prodinact_mesesvcon(meses_vcon);
            } else if(comboinact_mesesvcon === 'Categorias'){
                catinact_mesesvcon(meses_vcon);
            } else if(comboinact_mesesvcon === 'Marcas'){
                marcasinact_mesesvcon(meses_vcon);
            }
        }

        if(tab_mesesvcon === '#tabcot_mesesvcon')
        {
            if(combocot_mesesvcon === 'Pendientes'){
                cotpen_mesesvcon(meses_vcon);
            } else if(combocot_mesesvcon === 'Terminadas'){
                cotter_mesesvcon(meses_vcon);
            }
        }

        if(tab_mesesvcon === '#tabclientes_mesesvcon')
        {
            if(comboclientes_mesesvcon === 'Disponibles'){
                clientesdisp_mesesvcon(meses_vcon);
            } else if(comboclientes_mesesvcon === 'No Disponibles'){
                clientesnodisp_mesesvcon(meses_vcon);
            }
        }
    }
    else
    {
        alert('Por favor, selecciona un mes correcto');
    }
}
// FUNCIONES PARA ACTIVOS
    function prodact_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablaact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablaact_mesesvcon tbody').empty();

        var tablaprodact_mesesvcon = $('#tablaact_mesesvcon').DataTable({
            language:{
                'emptyTable': 'No hay datos disponibles',
                'zeroRecords': 'No se encontraron coincidencias'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax': {
                'url': 'cconsulta_meses/tablaprodact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon            
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablaprodact_mesesvcon');
                    console.error('Error prodact_mesesvcon:', error);

                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'id', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': 'modelo', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_vprod', 'createdCell': function(td, cellData, rowData, row, col){
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
                    'createdCell': function(td, cellData, rowData, col, row)
                    {
                        var id_prodactinact = rowData.id;
                        var prodver_mesesvcon = `<button id="prodver_mesesvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#prodactinact_modmesesvcon" onclick="verprodactinact_mesesvcon(${id_prodactinact})"></button>`;
                        $(td).addClass('text-center').html(prodver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_prod = $('[name="dt_buscar_tablaact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_prod > 5){
                    Swal.fire({
                            title: "Petición no Concedida",
                            text: "No se encontraron datos",
                            icon: "warning",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablaact_mesesvcon').DataTable().destroy();
                        $('#tablaact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablaact_mesesvcon"]').val('');
                        meses_vcon = '';
                        prodact_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact_mesesvcon"]').on('keyup', function(){
            tablaprodact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablaact_mesesvcon_length"]').on('change', function(){
            tablaprodact_mesesvcon.page.len(this.value).draw();
        });

        tablaprodact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actmesesvcon');
            $('#pagination_act_mesesvcon').append(pagination);
        });
    }

    function catact_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablaact_mesesvcon_length"]').val('10');
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
        $('#tablaact_mesesvcon tbody').empty();

        var tablacatact_mesesvcon = $('#tablaact_mesesvcon').DataTable({
            language:{
                'emptyTable': 'No hay datos disponibles',
                'zeroRecords': 'No se encontraron coincidencias'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax': {
                'url': 'cconsulta_meses/tablacatact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablacatact_mesesvcon');
                    console.error('Error catact_mesesvcon:', error);

                    if(xhr.responseText){
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
                    $(td).addClass('text-center').html('<span id="celda_estado_tablacat" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                    if(estado_vcat === 'ACTIVO'){
                        $(td).find('span').addClass('badge badge-success');
                    } else if(estado_vcat === 'INACTIVO'){
                        $(td).find('span').addClass('badge badge-warning');
                    }
                }},
                {'data': 'fecha_vcat', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col){
                        var id_catactinact = rowData.id;
                        var catver_mesesvcon = `<button id="catver_mesesvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#catactinact_modmesesvcon" onclick="vercatactinact_mesesvcon(${id_catactinact})"></button>`;
                        $(td).addClass('text-center').html(catver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_catact = $('[name="dt_buscar_tablaact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_catact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablaact_mesesvcon').DataTable().destroy();
                        $('#tablaact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablaact_mesesvcon"]').val('');
                        meses_vcon = '';
                        catact_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact_mesesvcon"]').on('keyup', function(){
            tablacatact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablaact_mesesvcon_length"]').on('change', function(){
            tablacatact_mesesvcon.page.len(this.value).draw();
        });

        tablacatact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actmesesvcon');
            $('#pagination_act_mesesvcon').append(pagination);
        });
    }

    function marcasact_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablaact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablaact_mesesvcon tbody').empty(); 
        
        var tablamarcasact_mesesvcon = $('#tablaact_mesesvcon').DataTable({
            language:{
                'emptyTable': 'No hay datos disponibles',
                'zeroRecords': 'No se encontraron coincidencias'
            },
            'autoWidth': false,
            'serverSide': true,
            'processing': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablamarcasact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablamarcasact_mesesvcon');
                    console.error('Error marcasact_mesesvcon:', error);

                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
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
                    'createdCell': function(td, cellData, rowData, row, col){
                        var id_marcasactinact = rowData.id;
                        var marcasver_mesesvcon = `<button id="marcasver_mesesvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#marcasactinact_modmesesvcon" onclick="vermarcasactinact_mesesvcon(${id_marcasactinact})"></button>`;
                        $(td).addClass('text-center').html(marcasver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_marcasact = $('[name="dt_buscar_tablaact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_marcasact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablaact_mesesvcon').DataTable().destroy();
                        $('#tablaact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablaact_mesesvcon"]').val('');
                        meses_vcon = '';
                        marcasact_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact_mesesvcon"]').on('keyup', function(){
            tablamarcasact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablaact_mesesvcon_length"]').on('change', function(){
            tablamarcasact_mesesvcon.page.len(this.value).draw();
        });

        tablamarcasact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actmesesvcon');
            $('#pagination_act_mesesvcon').append(pagination);
        });
    }

    function tcact_mesesvcon()
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablaact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablaact_mesesvcon tbody').empty();

        var tablatiposact_mesesvcon = $('#tablaact_mesesvcon').DataTable({
            language:{
                'emptyTable': 'No hay datos disponibles',
                'zeroRecords': 'No se encontraron coincidencias'
            },
            'autoWidth': false,
            'serverSide': true,
            'processing': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablatiposact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablatiposact_mesesvcon');
                    console.error('Error:', error);

                    if(xhr.responseText){
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
                    'createdCell': function(td, cellData, rowData, row, col){
                        var id_tiposactinact = rowData.id;
                        var tiposver_mesesvcon = `<button id="tiposver_mesesvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#tiposactinact_modmesesvcon" onclick="vertiposactinact_mesesvcon(${id_tiposactinact})"></button>`;
                        $(td).addClass('text-center').html(tiposver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_tiposact = $('[name="dt_buscar_tablaact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_tiposact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function() {
                        $('#tablaact_mesesvcon').DataTable().destroy();
                        $('#tablaact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablaact_mesesvcon"]').val('');
                        tcact_mesesvcon();
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actmesesvcon');
                $('#pagination_act_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact_mesesvcon"]').on('keyup', function(){
            tablatiposact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablaact_mesesvcon_length"]').on('change', function(){
            tablatiposact_mesesvcon.page.len(this.value).draw();
        });

        tablatiposact_mesesvcon.on('draw', function() {
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actmesesvcon');
            $('#pagination_act_mesesvcon').append(pagination);
        });
    }
// FUNCIONES PARA ACTIVOS

//FUNCIONES PARA INACTIVOS
    function prodinact_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablainact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablainact_mesesvcon tbody').empty();

        var tablaprodinact_mesesvcon = $('#tablainact_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablaprodinact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablaprodinact_mesesvcon');
                    console.error('Error prodinact_mesesvcon:', error);

                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'modelo', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_prod', 'createdCell': function(td, cellData, rowData, row, col){
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
                        var id_prodactinact = rowData.id;
                        var prodver_mesesvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#prodactinact_modmesesvcon" onclick="verprodactinact_mesesvcon(${id_prodactinact})"></button>`;
                        $(td).addClass('text-center').html(prodver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_prodinact = $('[name="dt_buscar_tablainact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_prodinact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function() {
                        $('#tablainact_mesesvcon').DataTable().destroy();
                        $('#tablainact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablainact_mesesvcon"]').val('');
                        meses_vcon = '';
                        prodinact_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablainact_mesesvcon"]').on('keyup', function(){
            tablaprodinact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablainact_mesesvcon_length"]').on('change', function(){
            tablaprodinact_mesesvcon.page.len(this.value).draw();
        });

        tablaprodinact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactmesesvcon');
            $('#pagination_inact_mesesvcon').append(pagination);
        });
    }

    function catinact_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablainact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablainact_mesesvcon tbody').empty();

        var tablacatinact_mesesvcon = $('#tablainact_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'serverSide': true,
            'processing': true,
            'ordering': false,
            'ajax': {
                'url': 'cconsulta_meses/tablacatinact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, status, error, code){
                    alert('Error al hacer la petición tablacatinact_mesesvcon');
                    console.error('Error catinact_mesesvcon:', error);

                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'categoria', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_vcat', 'createdCell': function(td, cellData, rowData, row, col){
                    var estado_vcat = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_est_tablacatinact" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');

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
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var id_catactinact = rowData.id;
                        var catver_mesesvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#catactinact_modmesesvcon" onclick="vercatactinact_mesesvcon(${id_catactinact})"></button>`;
                        $(td).addClass('text-center').html(catver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_catinact = $('[name="dt_buscar_tablainact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_catinact > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablainact_mesesvcon').DataTable().destroy();
                        $('#tablainacy_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablainact_mesesvcon"]').val('');
                        meses_vcon = '';
                        catinact_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablainact_mesesvcon"]').on('keyup', function(){
            tablacatinact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablainact_mesesvcon_length"]').on('change', function(){
            tablacatinact_mesesvcon.page.len(this.value).draw();
        });

        tablacatinact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactmesesvcon');
            $('#pagination_inact_mesesvcon').append(pagination);
        });
    }

    function marcasinact_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablainact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablainact_mesesvcon tbody').empty(); 
        
        var tablamarcasinact_mesesvcon = $('#tablainact_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablamarcasinact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablamarcasinact_mesesvcon');
                    console.error('Error en marcas:', error);

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
                {'data': 'marca', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_vmarcas', 'createdCell': function(td, cellData, rowData, row, col){
                    var estado_vmarcas = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_est_tablamarcasinact" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');

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
                    'ordering': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var id_marcasactinact = rowData.id;
                        var marcasver_mesesvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#marcasactinact_mesesvcon" onclick="vermarcasactinact_mesesvcon(${id_marcasactinact})"></button>`;
                        $(td).addClass('text-center').html(marcasver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_marcasinact = $('[name="dt_buscar_tablainact_mesesvcon"]').val().length;

                if(rows === 0 && buscador_marcasinact > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablainact_mesesvcon').DataTable().destroy();
                        $('#tablainact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablainact_mesesvcon"]').val('');
                        meses_vcon = '';
                        marcasinact_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablainact_mesesvcon"]').on('keyup', function(){
            tablamarcasinact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablainact_mesesvcon_length"]').on('change', function(){
            tablamarcasinact_mesesvcon.page.len(this.value).draw();
        });

        tablamarcasinact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactmesesvcon');
            $('#pagination_inact_mesesvcon').append(pagination);
        });
    }

    function tcinact_mesesvcon()
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablainact_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablainact_mesesvcon tbody').empty();

        var tablatiposinact_mesesvcon = $('#tablainact_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyRecords': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'serverSide': true,
            'processing': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablatiposinact_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablatiposinact_mesesvcon');
                    console.error('Error en tcinact_mesesvcon:', error);

                    if(xhr.responseText){
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
                {'data': null, 'visible': false},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var id_tiposactinact = rowData.id;
                        var tiposver_mesesvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#tiposactinact_modmesesvcon" onclick="vertiposactinact_mesesvcon(${id_tiposactinact})"></button>`;
                        $(td).addClass('text-center').html(tiposver_mesesvcon);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_tiposinact = $('[name="dt_buscar_tablainact"]').val().length;

                if(rows === 0 && buscador_tiposinact > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablainact_mesesvcon').DataTable().destroy();
                        $('#tablainact_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablainact_mesesvcon"]').val('');
                        tcinact_mesesvcon();
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactmesesvcon');
                $('#pagination_inact_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablainact"]').on('keyup', function(){
            tablatiposinact_mesesvcon.search(this.value).draw();
        });

        $('[name="tablainact_mesesvcon_length"]').on('change', function(){
            tablatiposinact_mesesvcon.page.len(this.value).draw();
        });

        tablatiposinact_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactmesesvcon');
            $('#pagination_inact_mesesvcon').append(pagination);
        });
    }
//FUNCIONES PARA INACTIVOS

//FUNCIONES PARA COTIZACIONES
    function cotpen_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablacot_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablacot_mesesvcon tbody').empty();

        var tablacotpen_mesesvcon = $('#tablacot_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'serverSide': true,
            'processing': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablacotpen_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablacotpen_mesesvcon');
                    console.error('Error cotpen_mesesvcon:', error);

                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, row, col){
                    var estado_borrador = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_estado_pendiente" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                    if(estado_borrador === 'Pendiente'){
                        $(td).find('span').addClass('badge badge-danger');
                    } else if(estado_borrador === 'Terminada'){
                        $(td).find('span').addClass('badge badge-success');
                    }
                }},
                {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var folio_cotpenter = rowData.folio_cotizacion;
                        var botonver_pendientes = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#verpenter_modmesesvcon" onclick="vercotpenter_mesesvcon(${folio_cotpenter})"></button>`;
                        $(td).addClass('text-center').html(botonver_pendientes);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotmesesvcon');
                $('#pagination_cot_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_cotpen = $('[name="dt_buscar_tablacot_mesesvcon"]').val().length;

                if(rows === 0 && buscador_cotpen > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablacot_mesesvcon').DataTable().destroy();
                        $('#tablacot_mesesvcon tbody').empty();
                        $('#dt_buscar_tablacot_mesesvcon').val('');
                        meses_vcon = '';
                        cotpen_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotmesesvcon');
                $('#pagination_cot_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablacot_mesesvcon"]').on('keyup', function(){
            tablacotpen_mesesvcon.search(this.value).draw();
        });

        $('[name="tablacot_mesesvcon_length"]').on('change', function(){
            tablacotpen_mesesvcon.page.len(this.value).draw();
        });

        tablacotpen_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_cotmesesvcon');
            $('#pagination_cot_mesesvcon').append(pagination);
        });
    }

    function cotter_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablacot_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablacot_mesesvcon tbody').empty();

        var tablacotter_mesesvcon = $('#tablacot_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablacotter_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablacotter_mesesvcon');
                    console.error('Error cotter_mesesvcon:', error);

                    if(xhr.responseText){
                        console.error(xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, row, col){
                    var estado_borrador = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_estado_terminada" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                    if(estado_borrador === 'Pendiente'){
                        $(td).find('span').addClass('badge badge-danger');
                    } else if(estado_borrador === 'Terminada'){
                        $(td).find('span').addClass('badge badge-success');
                    }
                }},
                {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var folio_cotpenter = rowData.folio_cotizacion;
                        var botonver_terminadas = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#verpenter_modmesesvcon" onclick="vercotpenter_mesesvcon(${folio_cotpenter})"></button>`;
                        $(td).addClass('text-center').html(botonver_terminadas);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotmesesvcon');
                $('#pagintion_cot_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_cotter = $('[name="dt_buscar_tablacot_mesesvcon"]').val().length;

                if(rows === 0 && buscador_cotter > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablacot_mesesvcon').DataTable().destroy();
                        $('#tablacot_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablacot_mesesvcon"]').val();
                        meses_vcon = '';
                        cotter_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotmesesvcon');
                $('#pagination_cot_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablacot_mesesvcon"]').on('keyup', function(){
            tablacotter_mesesvcon.search(this.value).draw();
        });

        $('[name="tablacot_mesesvcon_length"]').on('change', function(){
            tablacotter_mesesvcon.page.len(this.value).draw();
        });

        tablacotter_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_cotmesesvcon');
            $('#pagination_cot_mesesvcon').append(pagination);
        });
    }
//FUNCIONES PARA COTIZACIONES


//FUNCIONES PARA CLIENTES
    function clientesdisp_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablaclientes_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();        
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablaclientes_mesesvcon tbody').empty(); 

        var tablaclientesdisp_mesesvcon = $('#tablaclientes_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablaclientesdisp_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablaclientesdisp_mesesvcon');
                    console.error('Error clientesdisp_mesesvcon:', error);

                    if(xhr.responseText){
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
                {'data': 'disponible_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                    var disponible_vtotal = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_disponible_vtotal" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                    if(disponible_vtotal === 'DISPONIBLE'){
                        $(td).find('span').addClass('badge badge-primary');
                    }
                }},
                {'data': 'fecha_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var id_clientesdispnodisp = rowData.id;
                        var disponible_ver = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#clientesdispnodisp_modmesesvcon" onclick="verclientesdispnodisp_mesesvcon(${id_clientesdispnodisp})"></button>`;
                        $(td).addClass('text-center').html(disponible_ver);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesmesesvcon');
                $('#pagination_clientes_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_disp = $('[name="dt_buscar_tablaclientes_mesesvcon"]').val().length;

                if(rows === 0 && buscador_disp > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablaclientes_mesesvcon').DataTable().destroy();
                        $('#tablaclientes_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablaclientes_mesesvcon"]').val('');
                        meses_vcon = '';
                        clientesdisp_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesmesesvcon');
                $('#pagination_clientes_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaclientes_mesesvcon"]').on('keyup', function(){
            tablaclientesdisp_mesesvcon.search(this.value).draw();
        });

        $('[name="tablaclientes_mesesvcon_length"]').on('change', function(){
            tablaclientesdisp_mesesvcon.page.len(this.value).draw();
        });

        tablaclientesdisp_mesesvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_clientesmesesvcon');
            $('#pagination_clientes_mesesvcon').append(pagination);
        });
    }

    function clientesnodisp_mesesvcon(meses_vcon)
    {
        if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
            $('#tablaact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
            $('#tablainact_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
            $('#tablacot_mesesvcon').DataTable().destroy();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
            $('#tablaclientes_mesesvcon').DataTable().destroy();
        }

        $('[name="tablaclientes_mesesvcon_length"]').val('10');
        $('#pagination_act_mesesvcon').empty();
        $('#pagination_inact_mesesvcon').empty();        
        $('#pagination_cot_mesesvcon').empty();
        $('#pagination_clientes_mesesvcon').empty();
        $('#tablaclientes_mesesvcon tbody').empty();

        var tablaclientesnodisp_mesesvcon = $('#tablaclientes_mesesvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_meses/tablaclientesnodisp_mesesvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'meses_vcon': meses_vcon
                },
                'error': function(xhr, error, code){
                    alert('Error al hacer la petición tablaclientesnodisp_mesesvcon');
                    console.error('Error clientesnodisp_mesesvcon:', error);

                    if(xhr.responseText){
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
                {'data': 'disponible_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                    var disponible_vtotal = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_disponible_vtotal" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');

                    if(disponible_vtotal === 'DISPONIBLE'){
                        $(td).find('span').addClass('badge badge-primary');
                    } else if(disponible_vtotal === 'NO DISPONIBLE'){
                        $(td).find('span').addClass('badge badge-dark');
                    }
                }},
                {'data': 'fecha_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var id_clientesdispnodisp = rowData.id;
                        var disponible_ver = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#clientesdispnodisp_modmesesvcon" onclick="verclientesdispnodisp_mesesvcon(${id_clientesdispnodisp})"></button>`;
                        $(td).addClass('text-center').html(disponible_ver);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesmesesvcon');
                $('#pagination_clientes_mesesvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_nodisp = $('[name="dt_buscar_tablaclientes_mesesvcon"]').val().length;

                if(rows === 0 && buscador_nodisp > 5)
                {
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function() {
                        $('#tablaclientes_mesesvcon').DataTable().destroy();
                        $('#tablaclientes_mesesvcon tbody').empty();
                        $('[name="dt_buscar_tablaclientes_mesesvcon"]').val('');
                        meses_vcon = '';
                        clientesnodisp_mesesvcon(meses_vcon);
                    }, 2000);
                }

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesmesesvcon');
                $('#pagination_clientes_mesesvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaclientes_mesesvcon"]').on('keyup', function(){
            tablaclientesnodisp_mesesvcon.search(this.value).draw();
        });

        $('[name="tablaclientes_mesesvcon_length"]').on('change', function(){
            tablaclientesnodisp_mesesvcon.page.len(this.value).draw();
        });

        tablaclientesnodisp_mesesvcon.on('draw', function() {
            var pagination = $('.pagintaion');
            pagination.attr('id', 'pagination_clientesmesesvcon');
            $('#pagination_clientes_mesesvcon').append(pagination);
        });
    }
//FUNCIONES PARA CLIENTES

function restaurancion_mesesvcon()
{
    var comboact_mesesvcon = $('#comboact_mesesvcon').val();
    var comboinact_mesesvcon = $('#comboinact_mesesvcon').val();
    var combocot_mesesvcon = $('#combocot_mesesvcon').val();
    var comboclientes_mesesvcon = $('#comboclientes_mesesvcon').val();
    var tab_mesesvcon = $('#myTab button.active').attr('data-bs-target');

    if($.fn.DataTable.isDataTable('#tablaact_mesesvcon')){
        $('#tablaact_mesesvcon').DataTable().destroy();
    }

    if($.fn.DataTable.isDataTable('#tablainact_mesesvcon')){
        $('#tablainact_mesesvcon').DataTable().destroy();
    }

    if($.fn.DataTable.isDataTable('#tablacot_mesesvcon')){
        $('#tablacot_mesesvcon').DataTable().destroy();
    }

    if($.fn.DataTable.isDataTable('#tablaclientes_mesesvcon')){
        $('#tablaclientes_mesesvcon').DataTable().destroy();
    }

    $('#tablaact_mesesvcon tbody').empty();
    $('#tablainact_mesesvcon tbody').empty();
    $('#tablacot_mesesvcon tbody').empty();
    $('#tablaclientes_mesesvcon tbody').empty();

    if(tab_mesesvcon === '#tabact_mesesvcon')
    {
        if(comboact_mesesvcon === 'Productos'){
            prodact_mesesvcon();
        } else if(comboact_mesesvcon === 'Categorias'){
            catact_mesesvcon();
        } else if(comboact_mesesvcon === 'Marcas'){
            marcasact_mesesvcon();
        }
    }

    if(tab_mesesvcon === '#tabinact_mesesvcon')
    {
        if(comboinact_mesesvcon === 'Productos'){
            prodinact_mesesvcon();
        } else if(comboinact_mesesvcon === 'Categorias'){
            catinact_mesesvcon();
        } else if(comboinact_mesesvcon === 'Marcas'){
            marcasinact_mesesvcon();
        }
    }

    if(tab_mesesvcon === '#tabcot_mesesvcon')
    {        
        if(combocot_mesesvcon === 'Pendientes'){
            cotpen_mesesvcon();
        } else if(combocot_mesesvcon === 'Terminadas'){
            cotter_mesesvcon();
        }
    }

    if(tab_mesesvcon === '#tabclientes_mesesvcon')
    {
        if(comboclientes_mesesvcon === 'Disponibles'){
            clientesdisp_mesesvcon();
        } else if(comboclientes_mesesvcon === 'No Disponibles'){
            clientesnodisp_mesesvcon();
        }
    }
}