const lblfechauno_fechasvcon = $('#lblfechauno_vcon');
const fechauno_fechasvcon = $('#fechauno_vcon');

const lblfechados_fechasvcon = $('#lblfechados_vcon');
const fechados_fechasvcon = $('#fechados_vcon');

const btnconsultas_fechasvcon = $('#btnconsultas_vcon');
const btncancel_fechasvcon = $('#btncancel_fechasvcon');

// let tablaact_fechasvcon_glob = false;
// let tablainact_fechasvcon_glob = false;
// let tablacot_fechasvcon_glob = false;
// let funcion_ajax = null;

$(document).ready(function() {
    prodact_fechasvcon();

    lblfechados_fechasvcon.prop('disabled', true).css('opacity', 0.5);
    fechados_fechasvcon.prop('disabled', true).css('opacity', 0.5);
    btnconsultas_fechasvcon.prop('disabled', true).css('opacity', 0.5);
    btncancel_fechasvcon.prop('disabled', true).css('opacity', 0.5);

    fechauno_fechasvcon.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblfechauno_fechasvcon.prop('disabled', true).css('opacity', 0.5);
            lblfechados_fechasvcon.prop('disabled', false).css('opacity', 1);
            fechados_fechasvcon.prop('disabled', false).css('opacity', 1);
            btnconsultas_fechasvcon.prop('disabled', false).css('opacity', 1);
            btncancel_fechasvcon.prop('disabled', false).css('opacity', 1);
        }
    });
    
    $('#btncancel_fechasvcon').click(function(){
        $('#btnconsultas_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#fechados_vcon').prop('disabled', true).css('opacity', 0.5).val('');
        $('#btncancel_fechasvcon').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechauno_vcon').prop('disabled', false).css('opacity', 1);
        $('#fechauno_vcon').prop('disabled', false).css('opacity', 1).val('');

    });

    $('#btnconsultas_vcon').click(function(){
        $('#lblfechauno_vcon').prop('disabled', false).css('opacity', 1);
        $('#fechauno_vcon').prop('disabled', false).css('opacity', 1).val('');
        $('#lblfechados_vcon').prop('disabled', true).css('opacity', 0.5);
        $('#fechados_vcon').prop('disabled', true).css('opacity', 0.5).val('');
        $('#btnconsultas_vcon').prop('disabled', true).css('opacity', 0.5);
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

    $('#combocot_fechasvcon').change(function(){
        var datocombo = $(this).val();
        $('#colcot_fechasvcon').text(datocombo);

        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }

        $('#tablacot_fechasvcon tbody').empty();

        if(datocombo === 'Pendientes'){
            cotpen_fechasvcon();
        } else if(datocombo === 'Terminadas'){
            cotter_fechasvcon();
        }
    });
    
    $('#comboclientes_fechasvcon').change(function(){
        var datocombo = $(this).val();
        
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }

        $('#tablaclientes_fechasvcon tbody').empty();

        if(datocombo === 'Disponibles'){
            clientesdisp_fechasvcon();
        } else if(datocombo === 'No Disponibles'){
            clientesnodisp_fechasvcon();
        }
    });

    $('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', async function (e) {
        // limpiarfunciones();

        var target = $(e.target).attr("data-bs-target");     
        
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){            
            $('#tablaact_fechasvcon tbody').empty();
        }

        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){            
            $('#tablainact_fechasvcon tbody').empty();
        }

        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){            
            $('#tablacot_fechasvcon tbody').empty();
        }

        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){            
            $('#tablaclientes_fechasvcon tbody').empty();
        }

        if (target === '#tabact_fechasvcon') {
            prodact_fechasvcon();
            $('#comboact_fechasvcon').val('Productos');
            $('#colact_fechasvcon').text('Productos');
            $('[name="dt_buscar_tablaact"]').val('');
        } else if (target === '#tabinact_fechasvcon') {
            prodinact_fechasvcon();
            $('#comboinact_fechasvcon').val('Productos');
            $('#colinact_fechasvcon').text('Productos');
            $('[name="dt_buscar_tablainact"]').val('');
        } else if (target === '#tabcot_fechasvcon') { 
            cotpen_fechasvcon();  
            $('#combocot_fechasvcon').val('Pendientes');
            $('#colcot_fechasvcon').text('Pendientes');
            $('[name="dt_buscar_tablacot"]').val('');
        } else 
        if (target === '#tabclientes_fechasvcon'){
            clientesdisp_fechasvcon();
            $('#comboclientes_fechasvcon').val('Disponibles');
            $('[name="dt_buscar_tablaclientes"]').val('');
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

    var combocot_fechasvcon = $('#combocot_fechasvcon').val();
    $('#colcot_fechasvcon').text(combocot_fechasvcon);    
});

function inicio_fechasvcon()
{
    var fechauno_vcon = $('#fechauno_vcon').val();
    var fechados_vcon = $('#fechados_vcon').val();
    var comboact = $('#comboact_fechasvcon').val();
    var comboinact = $('#comboinact_fechasvcon').val();
    var combocot = $('#combocot_fechasvcon').val();
    var comboclientes = $('#comboclientes_fechasvcon').val();

    if(fechauno_vcon && fechados_vcon)
    {      
        var tab_fechasvcon = $('#myTab button.active').attr('data-bs-target');

        if(tab_fechasvcon === '#tabact_fechasvcon')
        {
            if(comboact === 'Productos'){
                prodact_fechasvcon(fechauno_vcon, fechados_vcon);
            } else if(comboact === 'Categorias'){
                catact_fechasvcon(fechauno_vcon, fechados_vcon);
            } else if(comboact === 'Marcas'){
                marcasact_fechasvcon(fechauno_vcon, fechados_vcon);
            } 
        }   
        
        if(tab_fechasvcon === '#tabinact_fechasvcon')
        {
            if(comboinact === 'Productos'){
                prodinact_fechasvcon(fechauno_vcon, fechados_vcon);
            } else if(comboinact === 'Categorias'){
                catinact_fechasvcon(fechauno_vcon, fechados_vcon);
            } else if(comboinact === 'Marcas'){
                marcasinact_fechasvcon(fechauno_vcon, fechados_vcon);
            } 
        }
        
        if(tab_fechasvcon === '#tabcot_fechasvcon')
        {
            if(combocot === 'Pendientes'){
                cotpen_fechasvcon(fechauno_vcon, fechados_vcon);
            } else if(combocot === 'Terminadas'){
                cotter_fechasvcon(fechauno_vcon, fechados_vcon);
            }
        }

        if(tab_fechasvcon === '#tabclientes_fechasvcon')
        {
            if(comboclientes === 'Disponibles'){
                clientesdisp_fechasvcon(fechauno_vcon, fechados_vcon);
            } else if(comboclientes === 'No Disponibles'){
                clientesnodisp_fechasvcon(fechauno_vcon, fechados_vcon);
            }
        }
    }
    else
    {
        alert('Por favor, selecciona un rango de fechas correcto');
    }    
}

//FUNCIONES PARA ACTIVOS        
    function prodact_fechasvcon(fechauno, fechados)
    {    
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }     
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }

        $('[name="tablaact_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();        
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },            
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
                        var id_prodactinact = rowData.id;
                        var prodeditar_fechasvcon = ``;
                        var prodver_fechasvcon = `<button id="prodver_fechasvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#prodactinact_modfechasvcon" onclick="verprodactinact_fechasvcon(${id_prodactinact})"></button>`;
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
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_prod = $('[name="dt_buscar_tablaact"]').val().length;

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
                        $('#tablaact_fechasvcon').DataTable().destroy();
                        $('#tablaact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablaact"]').val('');                    
                        fechauno = '';
                        fechados = '';
                        prodact_fechasvcon(fechauno, fechados);
                    }, 2000 );                            
                } 
                            
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actfechasvcon');
                $('#pagination_act_fechasvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact"]').on('keyup', function(){
            tablaprodact_fechasvcon.search(this.value).draw();
        });

        $('[name="tablaact_fechasvcon_length"]').on('change', function(){
            tablaprodact_fechasvcon.page.len(this.value).draw();
        });

        tablaprodact_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        });
    }

    function catact_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
        
        $('[name="tablaact_fechasvcon_length"]').val('10');
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },
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
                        var id_catactinact = rowData.id;                        
                        var catver_fechasvcon = `<button id="catver_fechasvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#catactinact_modfechasvcon" onclick="vercatactinact_fechasvcon(${id_catactinact})"></button>`;
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
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_catact = $('[name="dt_buscar_tablaact"]').val().length;

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
                        $('#tablaact_fechasvcon').DataTable().destroy();
                        $('#tablaact_fechasvcon tbody').empty(); 
                        $('[name="dt_buscar_tablaact"]').val('');
                        fechauno = '';
                        fechados = '';
                        catact_fechasvcon(fechauno, fechados);
                    }, 2000 );                
                }             

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actfechasvcon');
                $('#pagination_act_fechasvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact"]').on('keyup', function(){
            tablacatact_fechasvcon.search(this.value).draw();
        });

        $('[name="tablaact_fechasvcon_length"]').on('change', function(){
            tablacatact_fechasvcon.page.len(this.value).draw();
        });

        tablacatact_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        });
    }

    function marcasact_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }

        $('[name="tablaact_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                'data': {
                    'fechauno': fechauno,
                    'fechados': fechados
                },
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
                        var id_marcasactinact = rowData.id;
                        var prodeditar_fechasvcon = ``;
                        var marcasver_fechasvcon = `<button id="marcasver_fechasvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#marcasactinact_modfechasvcon" onclick="vermarcasactinact_fechasvcon(${id_marcasactinact})"></button>`;
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
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_marcasact = $('[name="dt_buscar_tablaact"]').val().length;

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
                        $('#tablaact_fechasvcon').DataTable().destroy();
                        $('#tablaact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablaact"]').val('');
                        fechauno = '';
                        fechados = '';
                        marcasact_fechasvcon(fechauno, fechados);
                    }, 2000 );                
                } 

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actfechasvcon');
                $('#pagination_act_fechasvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact"]').on('keyup', function(){
            tablamarcasact_fechasvcon.search(this.value).draw();
        });

        $('[name="tablaact_fechasvcon_length"]').on('change', function(){
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
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }

        $('[name="tablaact_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty(); 
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                        var id_tiposactinact = rowData.id;
                        var tiposver_fechasvcon = `<button id="tiposver_fechasvcon" class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#tiposactinact_modfechasvcon" onclick="vertiposactinact_fechasvcon(${id_tiposactinact})"></button>`;
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
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_tiposact = $('[name="dt_buscar_tablaact"]').val().length;

                if(rows === 0 && buscador_tiposact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });

                    setTimeout(function(){
                        $('#tablaact_fechasvcon').DataTable().destroy();
                        $('#tablaact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablaact"]').val('');
                        tcact_fechasvcon();
                    }, 2000);
                } 

                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_actfechasvcon');
                $('#pagination_act_fechasvcon').html('');
            }
        });

        $('[name="dt_buscar_tablaact"]').on('keyup', function(){
            tablatiposact_fechasvcon.search(this.value).draw();
        });

        $('[name="tablaact_fechasvcon_length"]').on('change', function(){
            tablatiposact_fechasvcon.page.len(this.value).draw();
        });

        tablatiposact_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_actfechasvcon');
            $('#pagination_act_fechasvcon').append(pagination);
        });
    }    
//FUNCIONES PARA ACTIVOS

//FUNCIONES PARA INACTIVOS 
    function prodinact_fechasvcon(fechauno, fechados)
    {   
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
        $('[name="tablainact_fechasvcon_length"]').val('10');  
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();        
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
            'ajax': {
                'url': 'cconsulta_fechas/tablaprodinact_fechasvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data': {
                    'fechauno': fechauno,
                    'fechados': fechados
                },        
                'error': function(xhr, code, error){
                    alert('Error al hacer una busqueda');
                    console.error('ERROR:', error);
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
                        var id_prodactinact = rowData.id;
                        var prodver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#prodactinact_modfechasvcon" onclick="verprodactinact_fechasvcon(${id_prodactinact})"></button>`;
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
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_prodinact = $('[name="dt_buscar_tablainact"]').val().length;
    
                if(rows === 0 && buscador_prodinact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
    
                    setTimeout(function(){
                        $('#tablainact_fechasvcon').DataTable().destroy();
                        $('#tablainact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablainact"]').val('');
                        fechauno = '';
                        fechados = '';
                        prodinact_fechasvcon(fechauno, fechados);
                    }, 2000 );                
                }    
                
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inacfechasvcon');
                $('#pagination_inact_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablainact"]').on('keyup', function(){
            tablaprodinact_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablainact_fechasvcon_length"]').on('change', function(){
            tablaprodinact_fechasvcon.page.len(this.value).draw();
        });
    
        tablaprodinact_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        });
    }
    
    function catinact_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }        
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
         
        $('[name="tablainact_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },
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
                        var id_catactinact = rowData.id;
                        var catver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#catactinact_modfechasvcon" onclick="vercatactinact_fechasvcon(${id_catactinact})"></button>`;
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
    
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_catinact = $('[name="dt_buscar_tablainact"]').val().length;
    
                if(rows === 0 && buscador_catinact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
    
                    setTimeout(function(){
                        $('#tablainact_fechasvcon').DataTable().destroy();
                        $('#tablainact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablainact"]').val('');
                        fechauno = '';
                        fechados = '';
                        catinact_fechasvcon(fechauno, fechados);
                    }, 2000 );                
                }         
                
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inacfechasvcon');
                $('#pagination_inact_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablainact"]').on('keyup', function(){
            tablacatinact_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablainact_fechasvcon_length"]').on('change', function(){
            tablacatinact_fechasvcon.page.len(this.value).draw();
        });
    
        tablacatinact_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        });
    }
    
    function marcasinact_fechasvcon(fechauno, fechados)
    { 
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }    
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
        
        $('[name="tablainact_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },
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
                        var id_marcasactinact = rowData.id;
                        var marcasver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#marcasactinact_fechasvcon" onclick="vermarcasactinact_fechasvcon(${id_marcasactinact})"></button>`;
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
    
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_marcasinact = $('[name="dt_buscar_tablainact"]').val().length;
    
                if(rows === 0 && buscador_marcasinact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
    
                    setTimeout(function(){
                        $('#tablainact_fechasvcon').DataTable().destroy();
                        $('#tablainact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablainact"]').val('');
                        fechauno = '';
                        fechados = '';
                        marcasinact_fechasvcon(fechauno, fechados);
                    }, 2000 );                
                }              
    
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inacfechasvcon');
                $('#pagination_inact_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablainact"]').on('keyup', function(){
            tablamarcasinact_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablainact_fechasvcon_length"]').on('change', function(){
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
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
        
        $('[name="tablainact_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
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
                        var id_tiposactinact = rowData.id;
                        var tiposver_fechasvcon = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#tiposactinact_modfechasvcon" onclick="vertiposactinact_fechasvcon(${id_tiposactinact})"></button>`;
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
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_tiposinact = $('[name="dt_buscar_tablainact"]').val().length;
    
                if(rows === 0 && buscador_tiposinact > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
    
                    setTimeout(function(){
                        $('#tablainact_fechasvcon').DataTable().destroy();
                        $('#tablainact_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablainact"]').val('');
                        tcinact_fechasvcon();
                    }, 2000);
                } 
    
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_inactfechasvcon');
                $('#pagination_inact_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablainact"]').on('keyup', function(){
            tablatiposinact_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablainact_fechasvcon_length"]').on('change', function(){
            tablatiposinact_fechasvcon.page.len(this.value).draw();
        });
    
        tablatiposinact_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_inactfechasvcon');
            $('#pagination_inact_fechasvcon').append(pagination);
        });
    }
//FUNCIONES PARA INACTIVOS

//FUNCIONES PARA VER DATOS ACTIVOS E INACTIVOS
    function verprodactinact_fechasvcon(id_prodactinact)
    {
        $('#prodactinact_formfechasvcon')[0].reset();        
                        
        $.ajax({
            url: 'cconsulta_fechas/verprodactinact_fechasvcon/' + id_prodactinact,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                $('[name="prodid_fechasvcon"]').val(data.id);
                $('[name="vermodelo_fechasvcon"]').val(data.modelo);
                $('[name="vermarca_fechasvcon"]').val(data.marca);
                $('[name="vertitulo_fechasvcon"]').val(data.titulo);
                $('[name="vercat_fechasvcon"]').val(data.categoria);
                $('[name="verstock_fechasvcon"]').val(data.stock);
                $('[name="verpreciolista_fechasvcon"]').val(data.preciolista);
                $('[name="verprecioespecial_fechasvcon"]').val(data.precioespecial);
                $('[name="verpreciooriginal_fechasvcon"]').val(data.preciooriginal);
                $('[name="verpreciointegrado_fechasvcon"]').val(data.preciointegrado);
                $('[name="verpreciotienda_fechasvcon"]').val(data.preciotienda);
                $('[name="vercodigofiscal_fechasvcon"]').val(data.codigofiscal);
                $('[name="verfechavprod_fechasvcon"]').val(data.fecha_vprod);

                if(data.estado_prod == 'ACTIVO'){
                    $('#ver_estadolblprod_fechasvcon').text('ACTIVO');
                    $('#ver_estadoprod_fechasvcon').val('ACTIVO');
                    $('#verswitchestadoproductos').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
                }
                else
                {
                    $('#ver_estadolblprod_fechasvcon').text('INACTIVO');
                    $('#ver_estadoprod_fechasvcon').val('INACTIVO');
                    $('#verswitchestadoproductos').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
                }
                $('#prodactinact_modfechasvcon').modal();
            },
            error: function(xhr, status, error){
                console.error('Error al obtener los datos del producto', error);
            }
        });                
    }
    
    function vercatactinact_fechasvcon(id_catactinact)
    {
        $('#catactinact_formfechasvcon')[0].reset();

        $.ajax({
            url: 'cconsulta_fechas/vercatactinact_fechasvcon/' + id_catactinact,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log('ID NULL??? ==', data);
                $('[name="catid_fechasvcon"]').val(data.id);
                $('[name="categoria_fechasvcon"]').val(data.categoria);
                $('[name="fecha_vcat_fechasvcon"]').val(data.fecha_vcat);
                
                if(data.estado_vcat == 'ACTIVO')
                {
                    $('#estadolblvcat_fechasvcon').text('ACTIVO');
                    $('#estadovcat_fechasvcon').val('ACTIVO');
                    $('#switchestadovcat_fechasvcon').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
                }
                else
                {
                    $('#estadolblvcat_fechasvcon').text('INACTIVO');
                    $('#estadovcat_fechasvcon').val('INACTIVO');
                    $('#switchestadovcat_fechasvcon').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
                }
                $('#catactinact_modfechasvcon').modal();
            },
            error: function(xhr, status, error){
                console.error('Error al obtener los datos de la categoría', error);
            }
        });
    }

    function vermarcasactinact_fechasvcon(id_marcasactinact)
    {
        $('#marcasactinact_formfechasvcon')[0].reset();

        $.ajax({
            url: 'cconsulta_fechas/vermarcasactinact_fechasvcon/' + id_marcasactinact,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                $('[name="marcasid_fechasvcon"]').val(data.id);
                $('[name="marca_fechasvcon"]').val(data.marca);
                $('[name="estado_vmarcas_fechasvcon"]').val(data.estado_vmarcas_fechasvcon);
                $('[name="fecha_vmarcas_fechasvcon"]').val(data.fecha_vmarcas);

                if(data.estado_vmarcas == 'ACTIVO')
                {
                    $('#estadolblvmarcas_fechasvcon').text('ACTIVO');
                    $('#estadovmarcas_fechasvcon').val('ACTIVO');
                    $('#switchestadovmarcas_fechasvcon').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
                }
                else
                {
                    $('#estadolblvmarcas_fechasvcon').text('INACTIVO');
                    $('#estadovmarcas_fechasvcon').val('INACTIVO');
                    $('#switchesadovmarcas_fechasvcon').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
                }

                $('#marcasactinact_modfechasvcon').modal();
            },
            error: function(xhr, status, error){
                console.error('Error al obtener los datos de la marca');
            }
        });
    }

    function vertiposactinact_fechasvcon(id_tiposactinact)
    {
        $('#tiposactinact_formfechasvcon')[0].reset();

        $.ajax({
            url: 'cconsulta_fechas/vertiposactinact_fechasvcon/' + id_tiposactinact,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                $('[name="tiposid_fechasvcon"]').val(data.id);
                $('[name="tipocliente_fechasvcon"]').val(data.tipocliente);
                $('#tiposactinact_modfechasvcon').modal();
            },
            error: function(xhr, status, error, code)
            {
                console.error('Error al obtener los datos del tipo de cliente', error);
            }
        });
    }
//FUNCIONES PARA VER DATOS ACTIVOS E INACTIVOS

//FUNCIONES PARA COTIZACIONES    
    function cotpen_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }     
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        } 
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
    
        $('[name="tablacot_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
        $('#tablacot_fechasvcon tbody').empty();
    
        var tablacotpen_fechasvcon = $('#tablacot_fechasvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_fechas/tablacotpen_fechasvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },
                'error': function(xhr, error, code, status){
                    alert('Error al hacer la petición');
                    console.error('Error:', error);
                    console.error('XHR:', xhr);
                    console.error('CODE:', code);
    
                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, col, row){
                    var estado_borrador = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_estado_pendiente" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');
    
                    if(estado_borrador === 'Pendiente'){
                        $(td).find('span').addClass('badge badge-danger');
                    } else if(estado_borrador === 'Terminada'){
                        $(td).find('span').addClass('badge badge-success');
                    }
                }},
                {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var folio_cotpenter = rowData.folio_cotizacion;
                        var botonver_pendientes = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#verpenter_modfechasvcon" onclick="vercotpenter_fechasvcon(${folio_cotpenter})"></button>`;
                        $(td).addClass('text-center').html(botonver_pendientes);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotfechasvcon');
                $('#pagination_cot_fechasvcon').append(pagination);
            },
            'drawCallback': function(settings){
                
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_cotpen = $('[name="dt_buscar_tablacot"]').val().length;
    
                if(rows === 0 && buscador_cotpen > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
                    
                    setTimeout(function(){
                        $('#tablacot_fechasvcon').DataTable().destroy();
                        $('#tablacot_fechasvcon tbody').empty();
                        $('#dt_buscar_tablacot').val('');
                        fechauno = '';
                        fechados = '';
                        cotpen_fechasvcon(fechauno, fechados);
                    }, 2000);
                } 
    
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotfechasvcon');
                $('#pagination_cot_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablacot"]').on('keyup', function(){
            tablacotpen_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablacot_fechasvcon_length"]').on('change', function(){
            tablacotpen_fechasvcon.page.len(this.value).draw();
        });
    
        tablacotpen_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_cotfechasvcon');
            $('#pagination_cot_fechasvcon').append(pagination);
        });
    }
    
    function cotter_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
    
        $('[name="tablacot_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
        $('#tablacot_fechasvcon tbody').empty();
    
        var tablacotter_fechasvcon = $('#tablacot_fechasvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_fechas/tablacotter_fechasvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },
                'error': function(xhr, status, error, code){
                    alert('Error al hacer la petición de cotizaciones');
                    console.error('Error:', error);
                    console.error('XHR:', xhr);
                    console.error('CODE:', code);
    
                    if(xhr.responseText){
                        console.error('Respuesta del error:', xhr.responseText);
                    }
                }
            },
            'columns':[
                {'data': 'folio_cotizacion', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': 'nombrecliente_cot', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': 'estado_borrador', 'createdCell': function(td, cellData, rowData, col, row){
                    var estado_borrador = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_estado_terminada" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');
    
                    if(estado_borrador === 'Pendiente'){
                        $(td).find('span').addClass('badge badge-danger');
                    } else if(estado_borrador === 'Terminada'){
                        $(td).find('span').addClass('badge badge-success');
                    }
                }},
                {'data': 'fecha_vcot', 'createdCell': function(td, cellData, rowData, col, row){
                    $(td).addClass('text-center');
                }},
                {'data': null,
                    'orderable': false,
                    'searchable': false,
                    'createdCell': function(td, cellData, rowData, row, col)
                    {
                        var folio_cotpenter = rowData.folio_cotizacion;
                        var botonver_terminadas = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#verpenter_modfechasvcon" onclick="vercotpenter_fechasvcon(${folio_cotpenter})"></button>`;
                        $(td).addClass('text-center').html(botonver_terminadas);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotfechasvcon');
                $('#pagination_cot_fechasvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_cotter = $('[name="dt_buscar_tablacot"]').val().length;
    
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
                        $('#tablacot_fechasvcon').DataTable().destroy();
                        $('#tablacot_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablacot"]').val();
                        fechauno = '';
                        fechados = '';
                        cotter_fechasvcon(fechauno, fechados);
                    }, 2000);
                }            
    
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_cotfechasvcon');
                $('#pagination_cot_fechasvcon').html('');
            }        
        });
    
        $('[name="dt_buscar_tablacot"]').on('keyup', function(){
            tablacotter_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablacot_fechasvcon_length"]').on('change', function(){
            tablacotter_fechasvcon.page.len(this.value).draw();
        });
    
        tablacotter_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_cotfechasvcon');
            $('#pagination_cot_fechasvcon').append(pagination);
        });
    }

    function vercotpenter_fechasvcon(folio_cotpenter)
    {
        $('#verpenter_formfechasvcon')[0].reset();
        $('#tablaverpenter_fechasvcon tbody').html('');

        $.ajax({
            url: 'cconsulta_fechas/datoscotpenter_fechasvcon/' + folio_cotpenter,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                $('[name="folio_fechasvcon"]').val(data.datoscotizaciones.folio_cotizacion);
                $('[name="idcliente_fechasvcon"]').val(data.datoscotizaciones.idcliente_cot);
                $('[name="tipocliente_fechasvcon"]').val(data.datoscotizaciones.tipocliente_cot);
                $('[name="nombrecliente_fechasvcon"]').val(data.datoscotizaciones.nombrecliente_cot);
                $('[name="subtotal_fechasvcon"]').val(data.datoscotizaciones.subtotal_cot);
                $('[name="iva_fechasvcon"]').val(data.datoscotizaciones.iva_cot);
                $('[name="total_fechasvcon"]').val(data.datoscotizaciones.total_cot);
                $('[name="fechapenter_fechasvcon"]').val(data.datoscotizaciones.fecha_vcot);
                $('[name="horapenter_fechasvcon"]').val(data.datoscotizaciones.hora_vcot);
                $('[name="estadopenter_fechasvcon"]').val(data.datoscotizaciones.estado_borrador);

                var htmlcotizaciones = '';
                $.each(data.datostablahtml, function(index, value){
                    htmlcotizaciones += '<tr>';
                        htmlcotizaciones += '<td class="text-center">'+value.folio_cotizacion+'</td>';
                        htmlcotizaciones += '<td class="text-center" style="display: none;">'+value.idproducto_cot+'</td>';
                        htmlcotizaciones += '<td class="text-center" style="display: none;">'+value.modeloprod_cot+'</td>';
                        htmlcotizaciones += '<td class="text-center">'+value.nombreprod_cot+'</td>';
                        htmlcotizaciones += '<td class="text-center">'+value.cantidadprod_cot+'</td>';
                        htmlcotizaciones += '<td class="text-center">'+value.tipoprecio_cot+'</td>';
                        htmlcotizaciones += '<td class="text-center">'+value.preciomxn_cot+'</td>';
                        htmlcotizaciones += '<td class="text-center">'+value.preciousd_cot+'</td>';
                    htmlcotizaciones += '</tr>';
                });

                $('#tablaverpenter_fechasvcon tbody').html(htmlcotizaciones);
                $('#verpenter_modfechasvcon').modal();
            },
            error: function(xhr, status, error){
                console.error('Error al obtener los datos', error);
            }
        });

        $('#verpenter_formfechasvcon')[0].reset();
        $('#tablaverpenter_fechasvcon tbody').html('');

    }
//FUNCIONES PARA COTIZACIONES

//FUNCIONES PARA CLIENTES  
    function clientesdisp_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
    
        $('[name="tablaclientes_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();        
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
        $('#tablaclientes_fechasvcon tbody').empty();        
    
        var tablaclientesdisp_fechasvcon = $('#tablaclientes_fechasvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,        
            'ajax':{
                'url': 'cconsulta_fechas/tablaclientesdisp_fechasvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data': {
                    'fechauno': fechauno,
                    'fechados': fechados
                },            
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
                {'data': 'nombre', 'createdCell': function(td, cellData, rowData, row, col){
                    $(td).addClass('text-center');
                }},
                {'data': 'disponible_vtotal', 'createdCell': function(td, cellData, rowData, row, col){
                    var disponible_vtotal = cellData.trim();
                    $(td).addClass('text-center').html('<span id="celda_disponible_vtotal" style="font-weight: bold; font-size: 11px">'+cellData+'</span>');
    
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
                        var disponibles_ver = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#clientesdispnodisp_modfechasvcon" onclick="verclientesdispnodisp_fechasvcon(${id_clientesdispnodisp})"></button>`;
                        $(td).addClass('text-center').html(disponibles_ver);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesfechasvcon');
                $('#pagination_clientes_fechasvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
    
                console.log('Pruebas:', rows);
                var buscador_disp = $('[name="dt_buscar_tablaclientes"]').val().length;
    
                if(rows === 0 && buscador_disp > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
    
                    setTimeout(function(){
                        $('#tablaclientes_fechasvcon').DataTable().destroy();
                        $('#tablaclientes_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablaclientes"]').val('');
                        fechauno = '';
                        fechados = '';
                        clientesdisp_fechasvcon(fechauno, fechados);
                    }, 2000);
                }
    
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesfechasvcon');
                $('#pagination_clientes_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablaclientes"]').on('keyup', function(){
            tablaclientesdisp_fechasvcon.search(this.value).draw();
        });    
    
        $('[name="tablaclientes_fechasvcon_length"]').on('change', function(){
            tablaclientesdisp_fechasvcon.page.len(this.value).draw();
        });    
    
        tablaclientesdisp_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_clientesfechasvcon');
            $('#pagination_clientes_fechasvcon').append(pagination);
        });
    }
    
    function clientesnodisp_fechasvcon(fechauno, fechados)
    {
        if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
            $('#tablaact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
            $('#tablainact_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
            $('#tablacot_fechasvcon').DataTable().destroy();
        }
        if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
            $('#tablaclientes_fechasvcon').DataTable().destroy();
        }
    
        $('[name="tablaclientes_fechasvcon_length"]').val('10');
        $('#pagination_act_fechasvcon').empty();
        $('#pagination_inact_fechasvcon').empty();        
        $('#pagination_cot_fechasvcon').empty();
        $('#pagination_clientes_fechasvcon').empty();
        $('#tablaclientes_fechasvcon tbody').empty();
    
        var tablaclientesnodisp_fechasvcon = $('#tablaclientes_fechasvcon').DataTable({
            language:{
                'zeroRecords': 'No se encontraron coincidencias',
                'emptyTable': 'No hay datos disponibles'
            },
            'autoWidth': false,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'ajax':{
                'url': 'cconsulta_fechas/tablaclientesnodisp_fechasvcon',
                'type': 'POST',
                'dataType': 'JSON',
                'data':{
                    'fechauno': fechauno,
                    'fechados': fechados
                },
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
                        var disponible_ver = `<button class="btn btn-sm btn-success fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#clientesdispnodisp_modfechasvcon" onclick="verclientesdispnodisp_fechasvcon(${id_clientesdispnodisp})"></button>`;
                        $(td).addClass('text-center').html(disponible_ver);
                    }
                }
            ],
            'dom': 'rt<"bottom"p>',
            'initComplete': function(){
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesfechasvcon');
                $('#pagination_clientes_fechasvcon').append(pagination);
            },
            'drawCallback': function(settings){
                var api = this.api();
                var rows = api.rows({page: 'current'}).data().length;
                var buscador_nodisp = $('[name="dt_buscar_tablaclientes"]').val().length;
    
                if(rows === 0 && buscador_nodisp > 5){
                    Swal.fire({
                        title: "Petición no Concedida",
                        text: "No se encontraron datos",
                        icon: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000
                    });
                    
                    setTimeout(function(){
                        $('#tablaclientes_fechasvcon').DataTable().destroy();
                        $('#tablaclientes_fechasvcon tbody').empty();
                        $('[name="dt_buscar_tablaclientes"]').val('');
                        fechauno = '';
                        fechados = '';
                        clientesnodisp_fechasvcon(fechauno, fechados);
                    }, 2000);
                }
    
                var pagination = $('.pagination');
                pagination.attr('id', 'pagination_clientesfechasvcon');
                $('#pagination_clientes_fechasvcon').html('');
            }
        });
    
        $('[name="dt_buscar_tablaclientes"]').on('keyup', function(){
            tablaclientesnodisp_fechasvcon.search(this.value).draw();
        });
    
        $('[name="tablaclientes_fechasvcon_length"]').on('change', function(){
            tablaclientesnodisp_fechasvcon.page.len(this.value).draw();
        });
    
        tablaclientesnodisp_fechasvcon.on('draw', function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_clientesfechasvcon');
            $('#pagination_clientes_fechasvcon').append(pagination);
        });
    }

    function verclientesdispnodisp_fechasvcon(id_clientesdispnodisp)
    {
        $('#verclientesdispnodisp_formfechasvcon')[0].reset();

        $.ajax({
            url: 'cconsulta_fechas/verclientesdispnodisp_fechasvcon/' + id_clientesdispnodisp,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log('DATOS CLIENTES:', data);
                $('[name="clientesid_fechasvcon"]').val(data.id);
                $('[name="nombre_fechasvcon"]').val(data.nombre);
                $('[name="tipocliente_fechasvcon"]').val(data.tipocliente);
                $('[name="correo_fechasvcon"]').val(data.correo);
                $('[name="telefono_fechasvcon"]').val(data.telefono);
                $('[name="ciudad_fechasvcon"]').val(data.ciudad);
                $('[name="estadoclientes_fechasvcon"]').val(data.estado_vtotal);
                $('[name="pais_fechasvcon"]').val(data.pais);
                $('[name="direccion_fechasvcon"]').val(data.direccion);
                $('[name="fechaclientes_fechasvcon"]').val(data.fecha_vtotal);
                $('[name="empresa_fechasvcon"]').val(data.empresa);
                $('[name="rfc_fechasvcon"]').val(data.rfc);

                if(data.disponible_vtotal == 'DISPONIBLE')
                {                    
                    $('#disponiblelblclientes_fechasvcon').text('DISPONIBLE');
                    $('#disponibleclientes_fechasvcon').val('DISPONIBLE');
                    $('#switchdisponible_fechasvcon').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
                }
                else
                {                    
                    $('#disponiblelblclientes_fechasvcon').text('NO DISPONIBLE');
                    $('#disponibleclientes_fechasvcon').val('NO DISPONIBLE');
                    $('#switchdisponible_fechasvcon').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
                }

                $('#clientesdispnodisp_modfechasvcon').modal();
            },
            error: function(xhr, status, error){
                console.error('Error al obtener datos de los clientes');
            }
        });
    }
//FUNCIONES PARA CLIENTES

function restauracion_fechasvcon()
{
    var comboact = $('#comboact_fechasvcon').val();
    var comboinact = $('#comboinact_fechasvcon').val();
    var combocot = $('#combocot_fechasvcon').val();
    var comboclientes = $('#comboclientes_fechasvcon').val();
    var tab_fechasvcon = $('#myTab button.active').attr('data-bs-target');
            
    // restaurando = true; 
    
    if($.fn.DataTable.isDataTable('#tablaact_fechasvcon')){
        $('#tablaact_fechasvcon').DataTable().destroy();
    }
    if($.fn.DataTable.isDataTable('#tablainact_fechasvcon')){
        $('#tablainact_fechasvcon').DataTable().destroy();
    }
    if($.fn.DataTable.isDataTable('#tablacot_fechasvcon')){
        $('#tablacot_fechasvcon').DataTable().destroy();
    }
    if($.fn.DataTable.isDataTable('#tablaclientes_fechasvcon')){
        $('#tablaclientes_fechasvcon').DataTable().destroy();
    }
    
    $('#tablaact_fechasvcon tbody').empty();
    $('#tablainact_fechasvcon tbody').empty();
    $('#tablacot_fechasvcon tbody').empty();
    $('#tablaclientes_fechasvcon tbody').empty();

    if(tab_fechasvcon === '#tabact_fechasvcon')
    {        
        if(comboact === 'Productos'){
            prodact_fechasvcon();
        } else if(comboact === 'Categorias'){
            catact_fechasvcon();
        } else if(comboact === 'Marcas'){
            marcasact_fechasvcon();
        } else if(comboact === 'Tipo de Cliente'){
            tcact_fechasvcon();
        }     
    }
    
    if(tab_fechasvcon === '#tabinact_fechasvcon')
    {        
        if(comboinact === 'Productos'){
            prodinact_fechasvcon();
        } else if(comboinact === 'Categorias'){
            catinact_fechasvcon();
        } else if(comboinact === 'Marcas'){
            marcasinact_fechasvcon();
        } else if(comboinact === 'Tipo de Cliente'){
            tcinact_fechasvcon();
        } 
    } 
    
    if(tab_fechasvcon === '#tabcot_fechasvcon')
    {        
        if(combocot === 'Pendientes'){
            cotpen_fechasvcon();
        } else if(combocot === 'Terminadas'){
            cotter_fechasvcon();
        }
    }

    if(tab_fechasvcon === '#tabclientes_fechasvcon')
    {        
        if(comboclientes === 'Disponibles'){
            clientesdisp_fechasvcon();
        } else if(comboclientes === 'No Disponibles'){
            clientesnodisp_fechasvcon();
        }
    }
}