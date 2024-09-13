//INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO
const datefechas = $('#datefechas');
const datefechasdos = $('#datefechasdos');
const datemes = $('#datemes');
const totaldatos = $('#totaldatos');
const lbldatefechas = $('#lbldatefechas');
const lbldatefechasdos = $('#lbldatefechasdos');
const lbldatemes = $('#lbldatemes');
const lbltotaldatos = $('#lbltotaldatos');
//INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO

//INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS
const unofecha_actvprod = $('#fechauno_actvprod');
const lblunofecha_actvprod = $('#lblfechauno_actvprod');
const dosfecha_actvprod = $('#fechados_actvprod');
const lbldosfecha_actvprod = $('#lblfechados_actvprod');
const meses_actvprod = $('#mes_actvprod');
const lblmeses_actvprod = $('#lblmes_actvprod');
const totales_actvprod = $('#total_actvprod');
const lbltotales_actvprod = $('#lbltotal_actvprod');
//INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS

//INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
const unofecha_inactvprod = $('#fechauno_inactvprod');
const lblunofecha_inactvprod = $('#lblfechauno_inactvprod');
const dosfecha_inactvprod = $('#fechados_inactvprod');
const lbldosfecha_inactvprod = $('#lblfechados_inactvprod');
const meses_inactvprod = $('#mes_inactvprod');
const lblmeses_inactvprod = $('#lblmes_inactvprod');
const totales_inactvprod = $('#total_inactvprod');
const lbltotales_inactvprod = $('#lbltotal_inactvprod');
//INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS

$(document).ready(function() {
    //CONFIGURACIÓN DE LA DATATABLES
    var table = $("#tabla_vprod").DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles'
        },
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax': {
            'url': 'cproductos/obtenerdatos',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.xhr('XHR:', xhr);
                console.code('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error: ', xhr.responseText);
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
            {'data': 'marca', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            // {'data': 'categoria'},
            {'data': 'titulo', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'stock', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'preciolista', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos text-center').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'precioespecial', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos text-center').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'preciooriginal', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos text-center').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'preciointegrado', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos text-center').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'preciotienda', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos text-center').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'codigofiscal', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_prod', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vprod = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_vprod" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vprod === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if (estado_vprod === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var botoneditar_vprod = `<button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vprod_modeditar" onclick="vprod_editar(${id})"></button>`;
                    var botoneliminar_vprod = `<button onclick="mensajeborrar_vprod(${id})" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>`;
                    $(td).addClass('text-center').html(botoneditar_vprod + '<div style="padding-top: 3px;">' + botoneliminar_vprod + '</div>');
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vprod');
            $('#content_pagination').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vprod');
            $('#content_pagination').html('');
        }
    });

    // // new $.fn.dataTable.Buttons(table, {
    // //     buttons: [
    // //         // {
    // //         //     extend: 'copy',
    // //         //     text: 'Copy',
    // //         //     className: 'btn btn-secondary',
    // //         //     action: function(e, dt, node, config){
    // //         //         $.fn.dataTable.ext.buttons.copyHtml5.action.call(this, e, dt, node, config);
    // //         //     }
    // //         // },
    // //         // {
    // //         //     extend: 'csv',
    // //         //     text: 'CSV',
    // //         //     className: 'btn btn-secondary',
    // //         //     action: function(e, dt, node, config){
    // //         //         $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config);
    // //         //     }
    // //         // },
    // //         {
    // //             extend: 'excel',
    // //             text: 'Excel',
    // //             className: 'btn btn-success',
    // //             action: function(e, dt, node, config)
    // //             {
    // //                 $.ajax({
    // //                     url: 'cproductos/allproductosexcel',
    // //                     type: 'GET',
    // //                     dataType: 'JSON',
    // //                     success: function(data)
    // //                     {


    // //                         var excelproductos = data.data;
    // //                         var ws_data = [];
    // //                         var header = [];

    // //                         // Obtener encabezados de la tabla
    // //                         table.columns().header().to$().each(function() {
    // //                             header.push($(this).text());
    // //                         });
    // //                         ws_data.push(header);

    // //                         // Llenar datos de la tabla
    // //                         $.each(excelproductos, function(i, row) {
    // //                             var rowData = [];
    // //                             table.columns().header().to$().each(function(j) {
    // //                                 rowData.push(row[table.column(j).dataSrc()]);
    // //                             });
    // //                             ws_data.push(rowData);
    // //                         });

    // //                         // Crear hoja de trabajo y libro
    // //                         var ws = XLSX.utils.aoa_to_sheet(ws_data);
    // //                         var wb = XLSX.utils.book_new();
    // //                         XLSX.utils.book_append_sheet(wb, ws, 'Productos');

    // //                         // Descargar archivo Excel
    // //                         XLSX.writeFile(wb, 'Productos.xlsx');



    // //                         // var excelproductos = data.data;
    // //                         // var tabla_allproductos = $('<table>').attr('id', 'tabla_allproductos');

    // //                         // var thead = $('<thead>').appendTo(tabla_allproductos); 
    // //                         // var headerrow = $('<tr>').appendTo(thead);
    // //                         // table.columns().header().to$().each(function() {
    // //                         //     $('<th>').text($(this).text()).appendTo(headerrow);
    // //                         // });

    // //                         // var tbody = $('<tbody>').appendTo(tabla_allproductos);
    // //                         // $.each(excelproductos, function(i, row){
    // //                         //     var datarow = $('<tr>').appendTo(tbody);
    // //                         //     table.columns().header().to$().each(function(j){
    // //                         //         $('<td>').text(row[table.column(j).dataSrc()]).appendTo(datarow);
    // //                         //     });
    // //                         // });
    // //                         // $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, $.extend({}, dt, {settings: {aoData: tabla_allproductos.find('tr').toArray()}}), node, config);

    // //                         // var temptable = $(tabla_allproductos).DataTable({
    // //                         //     dom: 'Bfrtip',
    // //                         //     buttons: [
    // //                         //         {
    // //                         //             extend: 'excelHtml5',
    // //                         //             exportOptions:{
    // //                         //                 columns: ':visible'
    // //                         //             }
    // //                         //         }
    // //                         //     ]
    // //                         // });

    // //                         // temptable.button('.buttons-excel').trigger();
    // //                     },
    // //                     error: function(xhr, error, code)
    // //                     {
    // //                         alert('Error al hacer la petición');
    // //                         console.error('Error', error);
    // //                         console.code('Codigo', code);
    // //                         console.xhr('xhr', xhr);
        
    // //                         if(xhr.responseText){
    // //                             console.error('Respuesta del error', xhr.responseText);
    // //                         }
    // //                     }
    // //                 });
    // //             }
    // //         },
    // //         // {
    // //         //     extend: 'pdf',
    // //         //     text: 'Pdf',
    // //         //     className: 'btn btn-secondary',
    // //         //     action: function(e, dt, node, config){
    // //         //         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);
    // //         //     }
    // //         // },
    // //         // {
    // //         //     extend: 'print',
    // //         //     text: 'Print',
    // //         //     className: 'btn btn-secondary',
    // //         //     action: function(e, dt, node, config){
    // //         //         $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, node, config);
    // //         //     }
    // //         // }
    // //     ]
    // // });

    $('#dt-search-0').on('keyup', function(){
        table.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function()
    {
        table.page.len(this.value).draw(); 
    });

    // $('#btn-copy').on('click', function(){
    //     table.button('.buttons-copy').trigger();
    // });

    // $('#btn-csv').on('click', function(){
    //     table.button('.buttons-csv').trigger();
    // });

    // $('#btn-excel').on('click', function(){
    //     table.button('.buttons-excel').trigger();
    // });

    // $('#btn-pdf').on('click', function(){
    //     table.button('.buttons-pdf').trigger();
    // });

    // $('#btn-print').on('click', function(){
    //     table.button('.buttons-print').trigger();
    // });

    table.on('draw', function(){
        var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vprod');
            // pagination.find('ul.pagination').addClass('pagination_vprod');
            $('#content_pagination').append(pagination);
    });
    //CONFIGURACIÓN DE LA DATATABLES

    //COMPROBACIÓN DE DATOS
    $.ajax({
        url: 'cproductos/comprobacionprod',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data){
                $('#btnexcel_vprod').prop('disabled', true);
                $('[name="tabla_vprod_length"]').prop('disabled', true);
                $('#btn_vproductosmxn').prop('disabled', true);
                $('#btn_vproductosusd').prop('disabled', true);
                $('#dropdown_vproductos').addClass('disabled_dropdown_vprod');
                $('[name="dt_buscar_vprod"]').prop('disabled', true);

            }
            else{
                $('#btnexcel_vprod').prop('disabled', false);
                $('[name="tabla_vprod_length"]').prop('disabled', false);
                $('#btn_vproductosmxn').prop('disabled', false);
                $('#btn_vproductosusd').prop('disabled', false);
                $('#dropdown_vproductos').removeClass('disabled_dropdown_vprod');
                $('[name="dt_buscar_vprod"]').prop('disabled', false);
            }
        }
    });
    //COMPROBACIÓN DE DATOS

    var porcentajeintegrador;
    var porcentajetienda;
    var valordeldolar;
    var editporcentajeintegrador;
    var editporcentajetienda;

    var conversionvprodusd = false;
    var conversionvprodmxn = "<?= ($deexcel) ? 'true' : 'false'?>";

    $.ajax({
        url: 'cproductos/obtenerformulas',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(data.length > 0){
                $.each(data, function(key, value){
                    porcentajeintegrador = value.porcentajeintegrador;
                    porcentajetienda = value.porcentajetienda;
                    editporcentajeintegrador = value.porcentajeintegrador;
                    editporcentajetienda = value.porcentajetienda;
                    valordeldolar = value.preciodolar;
                });
            }
        }
    });

    $('#btn_vproductosmxn').click(function(){
        if(!conversionvprodmxn){
            convertirprecio('vprodmxn');
            conversionvprodmxn = true;
            conversionvprodusd = false;
        }
    });

    $('#btn_vproductosusd').click(function(){
        if(!conversionvprodusd){
            convertirprecio('vprodusd');
            conversionvprodusd = true;
            conversionvprodmxn = false;
        }
    });

    function convertirprecio(moneda)
    {
        $('.preciosvproductos').each(function() {
            var preciosnormales = parseFloat($(this).data('preciosvproductos'));

            if(!isNaN(preciosnormales)){
                if(moneda === 'vprodmxn'){
                    var vprodusd = preciosnormales / valordeldolar;
                    $(this).text((vprodusd * valordeldolar).toFixed(2));
                } else if(moneda === 'vprodusd') {
                    $(this).text((preciosnormales / valordeldolar).toFixed(2));
                }
            }
        });
    }

    $('#estado_lblprod').text('INACTIVO');
    $('#estado_prod').val('INACTIVO');
    $('#switchestadoproductos').addClass('switch-inactivo');

    $('#switchestadoproductos').change(function(){
        if($(this).prop('checked')){
            $('#estado_lblprod').text('ACTIVO');
            $('#estado_prod').val('ACTIVO');
        }
        else{
            $('#estado_lblprod').text('INACTIVO');
            $('#estado_prod').val('INACTIVO');
        }
    });

    $('#marca').change(function() {
        var marcaseleccionada = $(this).val();
    });

    $('#categoria').change(function() {
        var categoriaseleccionada = $(this).val();
    });

    $('#preciooriginal').change(function() {
        var preciooriginal = parseFloat($(this).val());
        if(!isNaN(preciooriginal) && porcentajeintegrador !== undefined && porcentajetienda !== undefined){
            var formulaintegrador = preciooriginal * parseFloat(porcentajeintegrador);
            $('#preciointegrado').val(formulaintegrador.toFixed(2));

            var formulatienda = formulaintegrador * parseFloat(porcentajetienda);
            $('#preciotienda').val(formulatienda.toFixed(2));
        }
        else{
            console.error('Los porcentajes no están definidos o el precio original no es un número válido');
            $('#preciointegrado').val('');
            $('#preciotienda').val('');
        }
    });

    $('#edit_switchestadoproductos').change(function() {
        if($(this).prop('checked')){
            $('#edit_estado_lblprod').text('ACTIVO');
            $('#edit_estado_prod').val('ACTIVO');
        }
        else{
            $('#edit_estado_lblprod').text('INACTIVO');
            $('#edit_estado_prod').val('INACTIVO');
        }
    });

    $('#editmarca').change(function(){
        var editmarca = $(this).val();
    });

    $('#editcategoria').change(function(){
        var editcategoria = $(this).val();
    });

    $('#editpreciooriginal').change(function(){
        var editpreciooriginal = parseFloat($(this).val());
        if(!isNaN(editpreciooriginal) && editporcentajeintegrador !== undefined && editporcentajetienda !== undefined){
            var editformulaintegrador = editpreciooriginal * parseFloat(editporcentajeintegrador);
            $('#editpreciointegrado').val(editformulaintegrador.toFixed(2));

            var editformulatienda = editformulaintegrador * parseFloat(editporcentajetienda);
            $('#editpreciotienda').val(editformulatienda.toFixed(2));
        }
        else{
            console.error('Los porcentajes no están definidos o el precio original no es un número válido');
            $('#editpreciointegrado').val('');
            $('#editpreciotienda').val('');
        }
    });
    
    //CONFIGURACIÓN DE LOS DATETIME
    $.ajax({
        url: 'cproductos/fechasmeses_vprod',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            var ultimafecha = data.ultimafecha;
            var primerfecha = data.primerfecha;
            var ultimomes = data.ultimomes;
            var primermes = data.primermes;

            $('#datefechas').datepicker({
                language: 'es',
                format: 'yyyy-mm-dd',
                endDate: ultimafecha,
                startDate: primerfecha,
                autoclose: true
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#datefechasdos').datepicker('setStartDate', fechainicial);
            });
        
            $('#datefechasdos').datepicker({
                language: 'es',
                format: 'yyyy-mm-dd',
                endDate: ultimafecha,
                autoclose: true
            });

            $('#datemes').datepicker({
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,   
                endDate: ultimomes,
                autoclose: true,
                language: 'es'
            });

            $('#fechauno_actvprod').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha,
            }).on('changeDate', function(selected){
                var fechauno = new Date(selected.date.valueOf());
                $('#fechados_actvprod').datepicker('setStartDate', fechauno);
            });

            $('#fechados_actvprod').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_actvprod').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });
            
            $('#fechauno_inactvprod').datepicker({
                language: 'es',
                format: 'yyyy-mm-dd',
                autoclose: true,
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechauno = new Date(selected.date.valueOf());
                $('#fechados_inactvprod').datepicker('setStartDate', fechauno);
            });

            $('#fechados_inactvprod').datepicker({
                language: 'es',
                autoclose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_inactvprod').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });
        }
    });
    //CONFIGURACIÓN DE LOS DATETIME

    $('#editfecha_vprod').datepicker({
        language: 'es',
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    //FECHA AUTOMÁTICA
    var fechactual = new Date().toISOString().split('T')[0];
    $('#fecha_vprod').val(fechactual);
    //FECHA AUTOMÁTICA

    //CONFIGURACIÓN DE LA EXPORTACIÓN EXCEL POR TIEMPO

    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO
    datefechasdos.prop('disabled', true).css('opacity', 0.5);
    lbldatefechasdos.prop('disabled', true).css('opacity', 0.5);

    datefechas.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lbldatefechas.prop('disabled', true).css('opacity', 0.5);
            datefechasdos.prop('disabled', false).css('opacity', 1);
            lbldatefechasdos.prop('disabled', false).css('opacity', 1);
        }
    });

    datefechas.on('click', () => excepciones([datefechas, lbldatefechas]));
    datemes.on('click', () => excepciones([datemes, lbldatemes]));
    totaldatos.on('change', () => excepciones([totaldatos, lbltotaldatos]));

    $('#btnexcel_vprod, #cancelexcel_vprod').click(function() {
        $('#datefechas').val('');
        $('#datefechasdos').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lbldatefechasdos').prop('disabled', true).css('opacity', 0.5);
        $('#datemes').val('');
        $('#totaldatos').prop('checked', false);

        const inputs = ['#datefechas', '#datemes', '#totaldatos'];
        const spans = ['#lbldatefechas', '#lbldatemes', '#lbltotaldatos'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO

    //INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS
    dosfecha_actvprod.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_actvprod.prop('disabled', true).css('opacity', 0.5);

    unofecha_actvprod.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_actvprod.prop('disabled', true).css('opacity', 0.5);
            dosfecha_actvprod.prop('disabled', false).css('opacity', 1);
            lbldosfecha_actvprod.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_actvprod.on('click', () => except_actvprod([unofecha_actvprod, lblunofecha_actvprod]));
    meses_actvprod.on('click', () => except_actvprod([meses_actvprod, lblmeses_actvprod]));
    totales_actvprod.on('change', () => except_actvprod([totales_actvprod, lbltotales_actvprod]));

    $('#btnactivos_actvprod, #cancelar_actvprod').click(function() {
        $('#fechauno_actvprod').val('');
        $('#fechados_actvprod').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_actvprod').prop('disabled', true).css('opacity', 0.5);
        $('#mes_actvprod').val('');
        $('#total_actvprod').prop('checked', false);

        const inputs = ['#fechauno_actvprod', '#mes_actvprod', '#total_actvprod'];
        const spans = ['#lblfechauno_actvprod', '#lblmes_actvprod', '#lbltotal_actvprod'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS

    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
    dosfecha_inactvprod.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_inactvprod.prop('disabled', true).css('opacity', 0.5);

    unofecha_inactvprod.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_inactvprod.prop('disabled', true).css('opacity', 0.5);
            dosfecha_inactvprod.prop('disabled', false).css('opacity', 1);
            lbldosfecha_inactvprod.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_inactvprod.on('click', () => except_inactvprod([unofecha_inactvprod, lblunofecha_inactvprod]));
    meses_inactvprod.on('click', () => except_inactvprod([meses_inactvprod, lblmeses_inactvprod]));
    totales_inactvprod.on('change', () => except_inactvprod([totales_inactvprod, lbltotales_inactvprod]));

    $('#btninactivos_inactvprod, #cancelar_inactvprod').click(function() {
        $('#fechauno_inactvprod').val('');
        $('#fechados_inactvprod').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_inactvprod').prop('disabled', true).css('opacity', 0.5);
        $('#mes_inactvprod').val('');
        $('#total_inactvprod').prop('checked', false);

        const inputs = ['#fechauno_inactvprod', '#mes_inactvprod', '#total_inactvprod'];
        const spans = ['#lblfechauno_inactvprod', '#lblmes_inactvprod', '#lbltotal_inactvprod'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
});

//CONFIGURACIÓN DE LA EXPORTACIÓN EXCEL POR TIEMPO
function exportardatos()
{
    var fechauno = $('#datefechas').val();
    var fechados = $('#datefechasdos').val();
    var meses = $('#datemes').val();
    var todoslosdatos = $('#totaldatos').prop('checked');

    if(fechauno && fechados)
    {
        exportarporfechas(fechauno, fechados);
    }   else if(meses){
            exportarpormes(meses);
        } else if (todoslosdatos){
            exportartodoslosdatos();
        }
    else
    {
        alert('Por favor, seleccione una opción');
    }
}

function exportarporfechas(fechainicio, fechafin)
{
    var url = "cproductos/exportar_vprod_fechas"
    window.location.href = url + "?fechainicio=" + fechainicio + "&fechafin=" + fechafin;
}

function exportarpormes(mes)
{
    var url = "cproductos/exportar_vprod_meses";
    window.location.href = url + "?mes=" + mes;
}

function exportartodoslosdatos()
{
    var url = "cproductos/exportar_vprod";
    window.location.href = url;
}
//CONFIGURACIÓN DE LA EXPORTACIÓN EXCEL POR TIEMPO

//CONFIGURACIÓN - FUNCIONES DE REPORTES DE ACTIVOS
function reporteactivos_vprod()
{
    var fechauno_actvprod = $('#fechauno_actvprod').val();
    var fechados_actvprod = $('#fechados_actvprod').val();
    var mes_actvprod = $('#mes_actvprod').val();
    var total_actvprod = $('#total_actvprod').prop('checked');

    if(fechauno_actvprod && fechados_actvprod){
        activos_vprod_fechas(fechauno_actvprod, fechados_actvprod);
    }   else if(mes_actvprod){
            activos_vprod_meses(mes_actvprod);
        } else if(total_actvprod){
            totalactivos_vprod();
        }
    else{
        alert('Por favor, seleccione una opción');
    }
}

function activos_vprod_fechas(fechauno_act_vprod, fechados_act_vprod)
{
    var url = 'cproductos/pdf_actvprodfechas';
    window.location.href = url + "?fechauno_act_vprod=" + fechauno_act_vprod + "&fechados_act_vprod=" + fechados_act_vprod;
}

function activos_vprod_meses(mes_actvprod)
{
    var url = 'cproductos/pdf_actvprodmeses';
    window.location.href = url + "?mes_actvprod=" + mes_actvprod;
}

function totalactivos_vprod()
{
    var url = 'cproductos/pdf_actvprodtotales';
    window.location.href = url;
}
//CONFIGURACIÓN - FUNCIONES DE REPORTES DE ACTIVOS

//CONFIGURACIÓN - FUNCIONES DE REPORTES DE INACTIVOS
function reporteinactivos_vprod()
{
    var fechauno_inactvprod = $('#fechauno_inactvprod').val();
    var fechados_inactvprod = $('#fechados_inactvprod').val();
    var mes_inactvprod = $('#mes_inactvprod').val();
    var total_inactvprod = $('#total_inactvprod').prop('checked');

    if(fechauno_inactvprod && fechados_inactvprod){
        inactivos_vprod_fechas(fechauno_inactvprod, fechados_inactvprod);
    } else if (mes_inactvprod){
        inactivos_vprod_meses(mes_inactvprod);
    } else if (total_inactvprod){
        totalinactivos_vprod();
    }
    else{
        alert('Por favor, seleccione una opción');
    }
}

function inactivos_vprod_fechas(fechauno_inactvprod, fechados_inactvprod)
{
    var url = 'cproductos/pdf_inactvprodfechas';
    window.location.href = url + '?fechauno_inactvprod=' + fechauno_inactvprod + '&fechados_inactvprod=' + fechados_inactvprod;
}

function inactivos_vprod_meses(mes_inactvprod)
{
    var url = 'cproductos/pdf_inactvprodmeses';
    window.location.href = url + '?mes_inactvprod=' + mes_inactvprod;
}

function totalinactivos_vprod()
{
    var url = 'cproductos/pdf_inactvprodtotales';
    window.location.href = url;
}
//CONFIGURACIÓN - FUNCIONES DE REPORTES DE INACTIVOS

//INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO
function excepciones(excepciones)
{
    const inputs = [datefechas, datefechasdos, datemes, totaldatos];
    const labels = [lbldatefechas, lbldatefechasdos, lbldatemes, lbltotaldatos];
    inputs.forEach(input => {
        if(!excepciones.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepciones.includes(label)){
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}
//INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO

//INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS
function except_actvprod(except_actvprod)
{
    const inputs = [unofecha_actvprod, dosfecha_actvprod, meses_actvprod, totales_actvprod];
    const labels = [lblunofecha_actvprod, lbldosfecha_actvprod, lblmeses_actvprod, lbltotales_actvprod];

    inputs.forEach(input => {
        if(!except_actvprod.includes(input)){
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else{
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!except_actvprod.includes(label)){
            label.addClass('disabled').css('opacity', 0.5);
        }
        else{
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}
//INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS

//INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
function except_inactvprod(except_inactvprod)
{
    const inputs = [unofecha_inactvprod, dosfecha_inactvprod, meses_inactvprod, totales_inactvprod];
    const labels = [lblunofecha_inactvprod, lbldosfecha_inactvprod, lblmeses_inactvprod, lbltotales_inactvprod];

    inputs.forEach(input => {
        if(!except_inactvprod.includes(input)){
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else{
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!except_inactvprod.includes(label)){
            label.addClass('disabled').css('opacity', 0.5);
        }
        else{
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}
//INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS

//CRUD DE VPRODUCTOS
$(document).on('click', '#vprod_registrar', function(e){
    e.preventDefault();

    var modelo = $('#modelo').val();
    var marca = $('#marca').val();
    var categoria = $('#categoria').val();
    var titulo = $('#titulo').val();
    var stock = $('#stock').val();
    var preciolista = $('#preciolista').val();
    var precioespecial = $('#precioespecial').val();
    var preciooriginal = $('#preciooriginal').val();
    var preciointegrado = $('#preciointegrado').val();
    var preciotienda = $('#preciotienda').val();
    var codigofiscal = $('#codigofiscal').val();
    var estado_prod = $('#estado_prod').val();
    var fecha_vprod = $('#fecha_vprod').val();

    if(modelo == "" || marca == "" || titulo == "" || codigofiscal == ""){
        alert("Se requiere llenar algunos campos obligatorios");
    }
    else{
        $.ajax({
            url: 'cproductos/agregarproductos',
            type: 'POST',
            dataType: 'JSON',
            data: {
                modelo:modelo,
                marca:marca,
                categoria:categoria,
                titulo:titulo,
                stock:stock,
                preciolista:preciolista,
                precioespecial:precioespecial,
                preciooriginal:preciooriginal,
                preciointegrado:preciointegrado,
                preciotienda:preciotienda,
                codigofiscal:codigofiscal,
                estado_prod:estado_prod,
                fecha_vprod:fecha_vprod
            },
            success: function(data){
                console.log("Resultado de agregarproductos:", data);
                if(data.responce == 'success'){
                    $('#vprod_agregarproductos').modal('hide');
                    Swal.fire({
                        title: "Producto Agregado",
                        text: "Producto agregado con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#vprod_formregistrar')[0].reset();
                            window.location.href = "cproductos";
                        }
                    });
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algo salio mal al agregar",
                        allowOutsideClick: false,
                    });
                    $('#vprod_formregistrar')[0].reset();
                }
            }
        });
    }
});

$(document).on('click', '#vprod_actualizar', function(e){
    e.preventDefault();

    Swal.fire({
		title: "¿Desea actualizar los datos?",
		text: "Esta opción no puede revertirse",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#0DC408",
		confirmButtonText: "Aceptar",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
            var editid = $('#editid').val();
            var editmodelo = $('#editmodelo').val();
            var editmarca = $('#editmarca').val();
            var editcategoria = $('#editcategoria').val();
            var edittitulo = $('#edittitulo').val();
            var editstock = $('#editstock').val();
            var editpreciolista = $('#editpreciolista').val();
            var editprecioespecial = $('#editprecioespecial').val();
            var editpreciooriginal = $('#editpreciooriginal').val();
            var editpreciointegrado = $('#editpreciointegrado').val();
            var editpreciotienda = $('#editpreciotienda').val();
            var editcodigofiscal = $('#editcodigofiscal').val();
            var edit_estado_prod = $('#edit_estado_prod').val();
            var editfecha_vprod = $('#editfecha_vprod').val();
        
            if(editmodelo == "" || editmarca == "" || edittitulo == "" || editcodigofiscal == "" || editcategoria == ""){
                alert('Se requieren llenar algunos campos obligatorios');
            }
            else{
                $.ajax({
                    url: 'cproductos/actualizarproductos',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        editid:editid,
                        editmodelo:editmodelo,
                        editmarca:editmarca,
                        editcategoria:editcategoria,
                        edittitulo:edittitulo,
                        editstock:editstock,
                        editpreciolista:editpreciolista,
                        editprecioespecial:editprecioespecial,
                        editpreciooriginal:editpreciooriginal,
                        editpreciointegrado:editpreciointegrado,
                        editpreciotienda:editpreciotienda,
                        editcodigofiscal:editcodigofiscal,
                        edit_estado_prod:edit_estado_prod,
                        editfecha_vprod:editfecha_vprod
                    },
                    success: function(data){
                        if(data.responce == 'success'){
                            $('#vprod_modeditar').modal('hide');
                            Swal.fire({
                                title: "Producto Actualizado",
                                text: "Producto actualizado con éxito",
                                icon: "success",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.href = "cproductos";
                                }
                            });
                        }
                        else{
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
		}
	});
});

function vprod_editar(id)
{
    $('#vprod_formeditar')[0].reset();

    $.ajax({
        url: 'cproductos/editarproductos/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            $('[name="editid"]').val(data.id);
            $('[name="editmodelo"]').val(data.modelo);
            $('[name="editmarca"]').val(data.marca);
            $('[name="editcategoria"]').val(data.categoria);
            $('[name="edittitulo"]').val(data.titulo);
            $('[name="editstock"]').val(data.stock);
            $('[name="editpreciolista"]').val(data.preciolista);
            $('[name="editprecioespecial"]').val(data.precioespecial);
            $('[name="editpreciooriginal"]').val(data.preciooriginal);
            $('[name="editpreciointegrado"]').val(data.preciointegrado);
            $('[name="editpreciotienda"]').val(data.preciotienda);
            $('[name="editcodigofiscal"]').val(data.codigofiscal);
            $('[name="editfecha_vprod"]').val(data.fecha_vprod);

            if(data.estado_prod == 'ACTIVO'){
                $('#edit_estado_lblprod').text('ACTIVO');
                $('#edit_estado_prod').val('ACTIVO');
                $('#edit_switchestadoproductos').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
            }
            else{
                $('#edit_estado_lblprod').text('INACTIVO');
                $('#edit_estado_prod').val('INACTIVO');
                $('#edit_switchestadoproductos').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
            }
            $('#vprod_modeeditar').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos editables del productos', error);
        },
    });
}

function mensajeborrar_vprod(id)
{
    Swal.fire({
		title: "¿Esta seguro?",
		text: "Esta opción no puede revertirse",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		confirmButtonText: "Eliminar",
		cancelButtonColor: "#3085d6",
		cancelButtonText: "Cancelar",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = "cproductos/eliminar/" + id;
		}
	});
}
//CRUD DE VPRODUCTOS

//CONFIGURACIÓN DROPDOWN_VPRODUCTOS
document.addEventListener('click', function(event){
    const dropdowns = document.querySelectorAll('#dropdown_vproductos');
    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select_vprod');
        const caret = dropdown.querySelector('.caret_vprod');
        const menu = dropdown.querySelector('.menu_vprod');

        if(!dropdown.contains(event.target)){
            select.classList.remove('select_clicked_vprod');
            caret.classList.remove('caret_rotate_vprod');
            menu.classList.remove('menu_vprod_open');
        }
    });
});

const dropdown_vprod = document.querySelectorAll('#dropdown_vproductos');

dropdown_vprod.forEach(dropdown => {
    const select = dropdown.querySelector('.select_vprod');
    const caret = dropdown.querySelector('.caret_vprod');
    const menu = dropdown.querySelector('.menu_vprod');
    const options = dropdown.querySelectorAll('.menu_vprod li button');
    const selected = dropdown.querySelector('.selected_vprod');

    select.addEventListener('click', () => {
        select.classList.toggle('select_clicked_vprod');
        caret.classList.toggle('caret_rotate_vprod');
        menu.classList.toggle('menu_vprod_open');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            caret.classList.remove('caret_rotate_vprod');
            menu.classList.remove('menu_vprod_open');

            options.forEach(option => {
                select.classList.toggle('select_clicked_vprod');
            });

            option.classList.add('active');
        });
    });
});
//CONFIGURACIÓN DROPDOWN_VPRODUCTOS



