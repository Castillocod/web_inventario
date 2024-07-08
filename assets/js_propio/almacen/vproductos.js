const datefechas = $('#datefechas');
const datefechasdos = $('#datefechasdos');
const datemes = $('#datemes');
const totaldatos = $('#totaldatos');
const lbldatefechas = $('#lbldatefechas');
const lbldatefechasdos = $('#lbldatefechasdos');
const lbldatemes = $('#lbldatemes');
const lbltotaldatos = $('#lbltotaldatos');

$(document).ready(function() {
    //CONFIGURACIÓN DE LA DATATABLES
    var table = $("#tabla_vprod").DataTable({
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
                console.error('XHR:', xhr);
                console.error('Code:', code);

                if(xhr.responseText){
                    console.error('Respuesta del error: ', xhr.responseText);
                }
            }
        },
        'columns': [
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'modelo', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'marca', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            // {'data': 'categoria'},
            {'data': 'titulo', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'stock', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'preciolista', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'precioespecial', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'preciooriginal', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'preciointegrado', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'preciotienda', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('preciosvproductos').attr('data-preciosvproductos', cellData);
            }},
            {'data': 'codigofiscal', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'estado_prod', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vprod = cellData.trim();
                $(td).html('<span id="celda_estado_vprod" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vprod === 'Activo'){
                    $(td).find('span').addClass('badge badge-success');
                } else if (estado_vprod === 'Inactivo'){
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
                    $(td).html(botoneditar_vprod + '<div style="padding-top: 3px;">' + botoneliminar_vprod + '</div>');
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

    new $.fn.dataTable.Buttons(table, {
        buttons: [
            // {
            //     extend: 'copy',
            //     text: 'Copy',
            //     className: 'btn btn-secondary',
            //     action: function(e, dt, node, config){
            //         $.fn.dataTable.ext.buttons.copyHtml5.action.call(this, e, dt, node, config);
            //     }
            // },
            // {
            //     extend: 'csv',
            //     text: 'CSV',
            //     className: 'btn btn-secondary',
            //     action: function(e, dt, node, config){
            //         $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config);
            //     }
            // },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success',
                action: function(e, dt, node, config)
                {
                    $.ajax({
                        url: 'cproductos/allproductosexcel',
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data)
                        {


                            var excelproductos = data.data;
                            var ws_data = [];
                            var header = [];

                            // Obtener encabezados de la tabla
                            table.columns().header().to$().each(function() {
                                header.push($(this).text());
                            });
                            ws_data.push(header);

                            // Llenar datos de la tabla
                            $.each(excelproductos, function(i, row) {
                                var rowData = [];
                                table.columns().header().to$().each(function(j) {
                                    rowData.push(row[table.column(j).dataSrc()]);
                                });
                                ws_data.push(rowData);
                            });

                            // Crear hoja de trabajo y libro
                            var ws = XLSX.utils.aoa_to_sheet(ws_data);
                            var wb = XLSX.utils.book_new();
                            XLSX.utils.book_append_sheet(wb, ws, 'Productos');

                            // Descargar archivo Excel
                            XLSX.writeFile(wb, 'Productos.xlsx');



                            // var excelproductos = data.data;
                            // var tabla_allproductos = $('<table>').attr('id', 'tabla_allproductos');

                            // var thead = $('<thead>').appendTo(tabla_allproductos); 
                            // var headerrow = $('<tr>').appendTo(thead);
                            // table.columns().header().to$().each(function() {
                            //     $('<th>').text($(this).text()).appendTo(headerrow);
                            // });

                            // var tbody = $('<tbody>').appendTo(tabla_allproductos);
                            // $.each(excelproductos, function(i, row){
                            //     var datarow = $('<tr>').appendTo(tbody);
                            //     table.columns().header().to$().each(function(j){
                            //         $('<td>').text(row[table.column(j).dataSrc()]).appendTo(datarow);
                            //     });
                            // });
                            // $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, $.extend({}, dt, {settings: {aoData: tabla_allproductos.find('tr').toArray()}}), node, config);

                            // var temptable = $(tabla_allproductos).DataTable({
                            //     dom: 'Bfrtip',
                            //     buttons: [
                            //         {
                            //             extend: 'excelHtml5',
                            //             exportOptions:{
                            //                 columns: ':visible'
                            //             }
                            //         }
                            //     ]
                            // });

                            // temptable.button('.buttons-excel').trigger();
                        },
                        error: function(xhr, error, code)
                        {
                            alert('Error al hacer la petición');
                            console.error('Error', error);
                            console.code('Codigo', code);
                            console.xhr('xhr', xhr);
        
                            if(xhr.responseText){
                                console.error('Respuesta del error', xhr.responseText);
                            }
                        }
                    });
                }
            },
            // {
            //     extend: 'pdf',
            //     text: 'Pdf',
            //     className: 'btn btn-secondary',
            //     action: function(e, dt, node, config){
            //         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);
            //     }
            // },
            // {
            //     extend: 'print',
            //     text: 'Print',
            //     className: 'btn btn-secondary',
            //     action: function(e, dt, node, config){
            //         $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, node, config);
            //     }
            // }
        ]
    });

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

    $('#btn-excel').on('click', function(){
        table.button('.buttons-excel').trigger();
    });

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
        },
        error(xhr, status, error){
            console.error('Error al cargar las formulas', error);
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

    $('#estado_lblprod').text('Inactivo');
    $('#estado_prod').val('Inactivo');
    $('#switchestadoproductos').addClass('switch-inactivo');

    $('#switchestadoproductos').change(function(){
        if($(this).prop('checked')){
            $('#estado_lblprod').text('Activo');
            $('#estado_prod').val('Activo');
        }
        else{
            $('#estado_lblprod').text('Inactivo');
            $('#estado_prod').val('Inactivo');
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
            $('#edit_estado_lblprod').text('Activo');
            $('#edit_estado_prod').val('Activo');
        }
        else{
            $('#edit_estado_lblprod').text('Inactivo');
            $('#edit_estado_prod').val('Inactivo');
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

    $('#datefechas').datepicker({
        language: 'es'
    });

    $('#datefechasdos').datepicker({
        language: 'es'
    });

    $('#datemes').datepicker({
        format: 'mm/yyyy',
        startView: 'months',
        minViewMode: 'months',
        autoclose: true,
        language: 'es'
    });

    $('#editfecha_vprod').datepicker({
        language: 'es'
    });

    var fechactual = new Date().toISOString().split('T')[0];
    console.log('FECHA ACTUAL:', fechactual);
    $('#fecha_vprod').val(fechactual);

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
        $('#datefechasdos').val('');
        $('#datemes').val('');
        $('#totaldatos').prop('checked', false);

        $('#datefechasdos').prop('disabled', true).css('opacity', 0.5);
        $('#lbldatefechasdos').prop('disabled', true).css('opacity', 0.5);

        const inputs = ['#datefechas', '#datemes', '#totaldatos'];
        const spans = ['#lbldatefechas', '#lbldatemes', '#lbltotaldatos'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });

    $('#datefechas').change(function() {
        var mindate = $(this).val();
        $('#datefechasdos').attr('min', mindate);
    });

    // $('#exportarexcel_vprod').click(function() {
    //     const todoslosdatos = $('input[name="totaldatos"]:checked').val();
    //     const fechauno = $('#datefechas').val();
    //     const fechados = $('#datefechasdos').val();
    //     const meses = $('#datemes').val();

    //     let alertaexportacion;

    //     if (todoslosdatos === 'total'){
    //         alertaexportacion = 'Exportando todos los datos';
    //     } else if (fechauno && fechados){
    //         alertaexportacion = `Exportando datos desde ${fechauno} hasta ${fechados}`;
    //     } else if (meses){
    //         alertaexportacion = `Exportando datos del mes ${meses}`;
    //     } else{
    //         alertaexportacion = 'Por favor, selecciona una opción de exportación válida';
    //         alert(alertaexportacion);
    //         return;
    //     }

    //     $.ajax({
    //         url: 'cproducto/exportar_vprod',
    //         type: 'POST',
    //         data:{
    //             todoslosdatos:todoslosdatos,
    //             fechauno:fechauno,
    //             fechados:fechados,
    //             meses:meses
    //         },
    //         success: function(response){
    //             console.log('Respuesta datos:', response);
    //             alert(alertaexportacion + '\nExportación exitosa');
    //         },
    //         error: function(xhr, status, error){
    //             console.error('Error al exportar', error);
    //         }
    //     });
    // });
});

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
        alert('Por favor, selecciona una opción');
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
                edit_estado_prod:edit_estado_prod
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
});

function excepciones(excepciones)
{
    const inputs = [datefechas, datefechasdos, datemes, totaldatos];
    const labels = [lbldatefechas, lbldatefechasdos, lbldatemes, lbltotaldatos];
    inputs.forEach(input => {
        if(!excepciones.includes(input))
        {
            input.prop('disabled', true).val('');
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

            if(data.estado_prod == 'Activo'){
                $('#edit_estado_lblprod').text('Activo');
                $('#edit_estado_prod').val('Activo');
                $('#edit_switchestadoproductos').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
            }
            else{
                $('#edit_estado_lblprod').text('Inactivo');
                $('#edit_estado_prod').val('Inactivo');
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
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Eliminar",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = "cproductos/eliminar/" + id;
		}
	});
}

function resetbtnconversion()
{
    conversionvprodusd = false;
    conversionvprodmxn = true;
}

var dropdown_vprod = document.querySelectorAll('#dropdown_vproductos');

document.addEventListener('click', function(event){
    dropdown_vprod.forEach(dropdown => {
        const select = dropdown.querySelector('.select');
        const caret = dropdown.querySelector('.caret');
        const menu = dropdown.querySelector('.menu');

        if(!dropdown.contains(event.target)){
            select.classList.remove('select-clicked');
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
        }
    });
});

dropdown_vprod.forEach(dropdown => {
    const select = dropdown.querySelector('.select');
    const caret = dropdown.querySelector('.caret');
    const menu = dropdown.querySelector('.menu');
    const options = dropdown.querySelectorAll('.menu li a');
    const selected = dropdown.querySelector('.selected');

    select.addEventListener('click', () => {
        select.classList.toggle('select-clicked');
        caret.classList.toggle('caret-rotate');
        menu.classList.toggle('menu-open');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');

            options.forEach(option => {
                select.classList.toggle('select-clicked');
            });

            option.classList.add('active');
        });
    });
});



