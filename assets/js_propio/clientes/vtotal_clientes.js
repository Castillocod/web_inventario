//INTERACTIVIDAD - VARIABLES DE EXPORTAR EXCEL POR TIEMPO VTOTAL
const unofecha_excelvtotal = $('#fechauno_excelvtotal');
const lblunofecha_excelvtotal = $('#lblfechauno_excelvtotal');
const dosfecha_excelvtotal = $('#fechados_excelvtotal');
const lbldosfecha_excelvtotal = $('#lblfechados_excelvtotal');
const meses_excelvtotal = $('#mes_excelvtotal');
const lblmeses_excelvtotal = $('#lblmes_excelvtotal');
const totales_excelvtotal = $('#total_excelvtotal');
const lbltotales_excelvtotal = $('#lbltotal_excelvtotal');
//INTERACTIVIDAD - VARIABLES DE EXPORTAR EXCEL POR TIEMPO VTOTAL

//INTERACTIVIDAD - VARIABLES DE REPORTES DE ACTIVOS
const unofecha_actvtotal = $('#fechauno_actvtotal');
const lblunofecha_actvtotal = $('#lblfechauno_actvtotal');
const dosfecha_actvtotal = $('#fechados_actvtotal');
const lbldosfecha_actvtotal = $('#lblfechados_actvtotal');
const meses_actvtotal = $('#mes_actvtotal');
const lblmeses_actvtotal = $('#lblmes_actvtotal');
const totales_actvtotal = $('#total_actvtotal');
const lbltotales_actvtotal = $('#lbltotal_actvtotal');
//INTERACTIVIDAD - VARIABLES DE REPORTES DE ACTIVOS

//INTERACTIVIDAD - VARIABLES DE REPORTES DE INACTIVOS
const unofecha_inactvtotal = $('#fechauno_inactvtotal');
const lblunofecha_inactvtotal = $('#lblfechauno_inactvtotal');
const dosfecha_inactvtotal = $('#fechados_inactvtotal');
const lbldosfecha_inactvtotal = $('#lblfechados_inactvtotal');
const meses_inactvtotal = $('#mes_inactvtotal');
const lblmeses_inactvtotal = $('#lblmes_inactvtotal');
const totales_inactvtotal = $('#total_inactvtotal');
const lbltotales_inactvtotal = $('#lbltotal_inactvtotal');
//INTERACTIVIDAD - VARIABLES DE REPORTES DE INACTIVOS


$(document).ready(function() 
{
    //CONFIGURACIÓN DE DATATABLES
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
    //CONFIGURACIÓN DE DATATABLES

    //COMPROBACIÓN DE DATOS DE TOTALCLIENTES
    $.ajax({
        url: 'ctotal_clientes/comprobacionvtotal',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data)
            {
                $('#btnexcel_vtotal').prop('disabled', true);
                $('[name="tabla_vtotal_length"]').prop('disabled', true);
                $('#dropdowns_vtotal').addClass('disabled_dropdown_vtotal');
                $('[name="dt_buscar_vtotal"]').prop('disabled', true);
            }
            else
            {
                $('#btnexcel_vtotal').prop('disabled', false);
                $('[name="tabla_vtotal_length"]').prop('disabled', false);
                $('#dropdowns_vtotal').removeClass('disabled_dropdown_vtotal');
                $('[name="dt_buscar_vtotal"]').prop('disabled', false);
            }
        }
    });
    //COMPROBACIÓN DE DATOS DE TOTALCLIENTES
    $('#disponible_lblvtotal').text('INACTIVO');
    $('#disponible_vtotal').val('INACTIVO');
    $('#switchdisponiblevtotal').addClass('switch-inactivo');

    $('#switchdisponiblevtotal').change(function(){
        if($(this).prop('checked'))
        {
            $('#disponible_lblvtotal').text('ACTIVO');
            $('#disponible_vtotal').val('ACTIVO');
        }
        else
        {
            $('#disponible_lblvtotal').text('INACTIVO');
            $('#disponible_vtotal').val('INACTIVO');
        }
    });

    $('#edit_switchdisponiblevtotal').change(function() {
        if($(this).prop('checked'))
        {
            $('#edit_disponible_lblvtotal').text('ACTIVO');
            $('#edit_disponible_vtotal').val('ACTIVO');
        }
        else
        {
            $('#edit_disponible_lblvtotal').text('INACTIVO');
            $('#edit_disponible_vtotal').val('INACTIVO');
        }
    });

    var fechaactual = new Date().toISOString().split('T')[0];
    $('#fecha_vtotal').val(fechaactual);

    $('#editfecha_vtotal').datepicker({
        language: 'es',
        autoClose: true,
        format: 'yyyy-mm-dd'
    });

    //CONFIGURACIÓN DE LOS DATETIME
    $.ajax({
        url: 'ctotal_clientes/fechasmeses_vtotal',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            var primerfecha = data.primerfecha;
            var ultimafecha = data.ultimafecha;
            var primermes = data.primermes;
            var ultimomes = data.ultimomes;

            $('#fechauno_excelvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_excelvtotal').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_excelvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_excelvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                startview: 'months',
                minViewode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });

            $('#fechauno_actvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_actvtotal').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_actvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_actvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });

            $('#fechauno_inactvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_inactvtotal').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_inactvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_inactvtotal').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                startViewMode: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });
        },
        error: function(xhr, status, error, code){
            console.error('Error al obtener las fechas', error);
        }
    });
    //CONFIGURACIÓN DE LOS DATETIME

    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO
    dosfecha_excelvtotal.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_excelvtotal.prop('disabled', true).css('opacity', 0.5);

    unofecha_excelvtotal.on('change', function(){
        if($(this).val())
        {
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_excelvtotal.prop('disabled', true).css('opacity', 0.5);
            dosfecha_excelvtotal.prop('disabled', false).css('opacity', 1);
            lbldosfecha_excelvtotal.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_excelvtotal.on('click', () => except_excelvtotal([unofecha_excelvtotal, lblunofecha_excelvtotal]));
    meses_excelvtotal.on('click', () => except_excelvtotal([meses_excelvtotal, lblmeses_excelvtotal]));
    totales_excelvtotal.on('change', () => except_excelvtotal([totales_excelvtotal, lbltotales_excelvtotal]));

    $('#btnexcel_vtotal, #cancelar_excelvtotal').click(function() {
        $('#fechauno_excelvtotal').val('');
        $('#fechados_excelvtotal').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_excelvtotal').prop('disabled', true).css('opacity', 0.5);
        $('#mes_excelvtotal').val('');
        $('#total_excelvtotal').prop('checked', false);

        const inputs = ['#fechauno_excelvtotal', '#mes_excelvtotal', '#total_excelvtotal'];
        const spans = ['#lblfechauno_excelvtotal', '#lblmes_excelvtotal', '#lbltotal_excelvtotal'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO

    //INTERACTIVDAD - OPCIONES DE REPORTES DE ACTIVOS
    dosfecha_actvtotal.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_actvtotal.prop('disabled', true).css('opacity', 0.5);

    unofecha_actvtotal.on('change', function() {
        if($(this).val())
        {
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_actvtotal.prop('disabled', true).css('opacity', 0.5);
            dosfecha_actvtotal.prop('disabled', false).css('opacity', 1);
            lbldosfecha_actvtotal.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_actvtotal.on('click', () => except_actvtotal([unofecha_actvtotal, lblunofecha_actvtotal]));
    meses_actvtotal.on('click', () => except_actvtotal([meses_actvtotal, lblmeses_actvtotal]));
    totales_actvtotal.on('change', () => except_actvtotal([totales_actvtotal, lbltotales_actvtotal]));

    $('#btnactivos_actvtotal, #cancelar_actvtotal').click(function() {
        $('#fechauno_actvtotal').val('');
        $('#fechados_actvtotal').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_actvtotal').prop('disabled', true).css('opacity', 0.5);
        $('#mes_actvtotal').val('');
        $('#total_actvtotal').prop('checked', false);

        const inputs = ['#fechauno_actvtotal', '#mes_actvtotal', '#total_actvtotal'];
        const spans = ['#lblfechauno_actvtotal', '#lblmes_actvtotal', '#lbltotal_actvtotal'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVDAD - OPCIONES DE REPORTES DE ACTIVOS

    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
    dosfecha_inactvtotal.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_inactvtotal.prop('disabled', true).css('opacity', 0.5);

    unofecha_inactvtotal.on('change', function() {
        if($(this).val())
        {
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_inactvtotal.prop('disabled', true).css('opacity', 0.5);
            dosfecha_inactvtotal.prop('disabled', false).css('opacity', 1);
            lbldosfecha_inactvtotal.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_inactvtotal.on('click', () => except_inactvtotal([unofecha_inactvtotal, lblunofecha_inactvtotal]));
    meses_inactvtotal.on('click', () => except_inactvtotal([meses_inactvtotal, lblmeses_inactvtotal]));
    totales_inactvtotal.on('change', () => except_inactvtotal([totales_inactvtotal, lbltotales_inactvtotal]));

    $('#btninactivos_inactvtotal, #cancelar_inactvtotal').click(function(){
        $('#fechauno_inactvtotal').val('');
        $('#fechados_inactvtotal').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_inactvtotal').prop('disabled', true).css('opacity', 0.5);
        $('#mes_inactvtotal').val('');
        $('#total_inactvtotal').prop('checked', false);

        const inputs = ['#fechauno_inactvtotal', '#mes_inactvtotal', '#total_inactvtotal'];
        const spans = ['#lblfechauno_inactvtotal', '#lblmes_inactvtotal', '#lbltotal_inactvtotal'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
});

function except_excelvtotal(excepcion_excelvtotal)
{
    const inputs = [unofecha_excelvtotal, dosfecha_excelvtotal, meses_excelvtotal, totales_excelvtotal];
    const labels = [lblunofecha_excelvtotal, lbldosfecha_excelvtotal, lblmeses_excelvtotal, lbltotales_excelvtotal];

    inputs.forEach(input => {
        if(!excepcion_excelvtotal.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_excelvtotal.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function exportarexcel_vtotal()
{
    var fechauno = $('#fechauno_excelvtotal').val();
    var fechados = $('#fechados_excelvtotal').val();
    var meses = $('#mes_excelvtotal').val();
    var todoslosdatos = $('#total_excelvtotal').prop('checked');

    if(fechauno && fechados)
    {
        excelfechas_vtotal(fechauno, fechados);
    } else if(meses){
        excelmes_vtotal(meses);
    } else if(todoslosdatos){
        exceltotal_vtotal();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function excelfechas_vtotal(fechauno, fechados)
{
    var url = 'ctotal_clientes/excelfechas_vtotal';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function excelmes_vtotal(mes)
{
    var url = 'ctotal_clientes/excelmes_vtotal';
    window.location.href = url + '?mes=' + mes;
}

function exceltotal_vtotal()
{
    var url = 'ctotal_clientes/exceltotal_vtotal';
    window.location.href = url;
}

function except_actvtotal(excepcion_actvtotal)
{
    const inputs = [unofecha_actvtotal, dosfecha_actvtotal, meses_actvtotal, totales_actvtotal];
    const labels = [lblunofecha_actvtotal, lbldosfecha_actvtotal, lblmeses_actvtotal, lbltotales_actvtotal];

    inputs.forEach(input => {
        if(!excepcion_actvtotal.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_actvtotal.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function reporteactivos_vtotal()
{
    var fechauno = $('#fechauno_actvtotal').val();
    var fechados = $('#fechados_actvtotal').val();
    var meses = $('#mes_actvtotal').val();
    var todoslosdatos = $('#total_actvtotal').prop('checked');

    if(fechauno && fechados)
    {
        pdfactfechas_vtotal(fechauno, fechados);
    } else if(meses){
        pdfactmes_vtotal(meses);
    } else if(todoslosdatos){
        pdfacttotal_vtotal();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function pdfactfechas_vtotal(fechauno, fechados)
{
    var url = 'ctotal_clientes/pdfactfechas_vtotal';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function pdfactmes_vtotal(mes)
{
    var url = 'ctotal_clientes/pdfactmes_vtotal';
    window.location.href = url + '?mes=' + mes;
}

function pdfacttotal_vtotal()
{
    var url = 'ctotal_clientes/pdfacttotal_vtotal';
    window.location.href = url;
}

function except_inactvtotal(excepcion_inactvtotal)
{
    const inputs = [unofecha_inactvtotal, dosfecha_inactvtotal, meses_inactvtotal, totales_inactvtotal];
    const labels = [lblunofecha_inactvtotal, lbldosfecha_inactvtotal, lblmeses_inactvtotal, lbltotales_inactvtotal];

    inputs.forEach(input => {
        if(!excepcion_inactvtotal.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_inactvtotal.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function reporteinactivos_vtotal()
{
    var fechauno = $('#fechauno_inactvtotal').val();
    var fechados = $('#fechados_inactvtotal').val();
    var meses = $('#mes_inactvtotal').val();
    var todoslosdatos = $('#total_inactvtotal').prop('checked');

    if(fechauno && fechados)
    {
        pdfinactfechas_vtotal(fechauno, fechados);
    } else if(meses){
        pdfinactmes_vtotal(meses);
    } else if(todoslosdatos){
        pdfinacttotal_vtotal();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function pdfinactfechas_vtotal(fechauno, fechados)
{
    var url = 'ctotal_clientes/pdfinactfechas_vtotal';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function pdfinactmes_vtotal(mes)
{
    var url = 'ctotal_clientes/pdfinactmes_vtotal';
    window.location.href = url + '?mes=' + mes;
}

function pdfinacttotal_vtotal()
{
    var url = 'ctotal_clientes/pdfinacttotal_vtotal';
    window.location.href = url;
}

$(document).on('click', '#vtotal_registrar', function(e){
    e.preventDefault();

    var nombre = $('#nombre').val();
    var tipocliente = $('#tipocliente').val();
    var ciudad = $('#ciudad').val();
    var estado_vtotal = $('#estado_vtotal').val();
    var fecha_vtotal = $('#fecha_vtotal').val();
    var pais = $('#pais').val();
    var direccion = $('#direccion').val();
    var correo = $('#correo').val();
    var telefono = $('#telefono').val();
    var empresa = $('#empresa').val();
    var rfc = $('#rfc').val();
    var disponible_vtotal = $('#disponible_vtotal').val();

    if(nombre == "" || direccion == "" || correo == "" || telefono == "" || rfc == "")
    {
        alert('Se require llenar algunos campos obligatorios');
    }
    else
    {
        $.ajax({
            url: 'ctotal_clientes/agregarvtotal',
            type: 'POST',
            dataType: 'JSON',
            data: {
                nombre:nombre,
                tipocliente:tipocliente,
                ciudad:ciudad,
                estado_vtotal:estado_vtotal,
                fecha_vtotal:fecha_vtotal,
                pais:pais,
                direccion:direccion,
                correo:correo,
                telefono:telefono,
                empresa:empresa,
                rfc:rfc,
                disponible_vtotal:disponible_vtotal
            },
            success: function(data){
                if(data.responce == 'success')
                {
                    $('#vtotal_agregarclientes').modal('hide');
                    Swal.fire({
                        title: "Cliente Agregado",
                        text: "Cliente agregado con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#vtotal_formregistrar')[0].reset();
                            window.location.href = "ctotal_clientes";
                        }
                    });
                }
                else
                {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algo salio mal al agregar",
                        allowOutsideClick: false,
                    });
                    $('#vtotal_formregistrar')[0].reset();
                }
            }
        });
    }
});

$(document).on('click', '#vtotal_actualizar', function(e)
{
    e.preventDefault(e);

    var editnombre = $('#editnombre').val();
    var edittipocliente = $('#edittipocliente').val();
    var editciudad = $('#editciudad').val();
    var editestado_vtotal = $('#editestado_vtotal').val();
    var editfecha_vtotal = $('#editfecha_vtotal').val();
    var editpais = $('#editpais').val();
    var editdireccion = $('#editdireccion').val();
    var editcorreo = $('#editcorreo').val();
    var edittelefono = $('#edittelefono').val();
    var editempresa = $('#editempresa').val();
    var editrfc = $('#editrfc').val();
    var editdisponible_vtotal = $('#editdisponible_vtotal').val();

    if(editnombre == "" || editdireccion == "" || editcorreo == "" || edittelefono == "" || editrfc == "")
    {
        alert('Se requiere llenar algunos campos obligatorios');
    }
    else
    {
        $.ajax({
            url: 'ctotal_clientes/actualizarvtotal',
            type: 'POST',
            dataType: 'JSON',
            data: {
                editnombre:editnombre,
                edittipocliente:edittipocliente,
                editciudad:editciudad,
                editestado_vtotal:editestado_vtotal,
                editfecha_vtotal:editfecha_vtotal,
                editpais:editpais,
                editdireccion:editdireccion,
                editcorreo:editcorreo,
                edittelefono:edittelefono,
                editempresa:editempresa,
                editrfc:editrfc,
                editdisponible_vtotal:editdisponible_vtotal
            },
            success: function(data){
                if(data.responce == "success")
                {
                    $('#vtotal_modeditar').modal('hide');
                    Swal.fire({
                        title: "Cliente Actualizado",
                        text: "Cliente actualizado con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "ctotal_clientes";
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

function vtotal_editar(id)
{
    $('#vtotal_formeditar')[0].reset();

    $.ajax({
        url: 'ctotal_clientes/editarvtotal/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            $('[name="editnombre"]').val(data.id);
            $('[name="edittipocliente"]').val(data.tipocliente);
            $('[name="editciudad"]').val(data.ciudad);
            $('[name="editestado_vtotal"]').val(data.estado_vtotal);
            $('[name="editfecha_vtotal"]').val(data.fecha_vtotal);
            $('[name="editpais"]').val(data.pais);
            $('[name="editdireccion"]').val(data.direccion);
            $('[name="editcorreo"]').val(data.correo);
            $('[name="edittelefono"]').val(data.telefono);
            $('[name="editempresa"]').val(data.empresa);
            $('[name="editrfc"]').val(data.rfc);
            

            if(data.disponible_vtotal == 'ACTIVO')
            {
                $('#edit_disponible_lblvtotal').text('ACTIVO');
                $('#edit_disponible_vtotal').val('ACTIVO');
                $('#edit_switchdisponiblevtotal').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
            }
            else
            {
                $('#edit_disponible_lblvtotal').text('INACTIVO');
                $('#edit_disponible_vtotal').val('INACTIVO');
                $('#edit_switchdisponiblevtotal').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
            }
            $('#vtotal_modeditar').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener datos del clientes', error);
        }
    });
    $('#vtotal_formeditar')[0].reset();
}

function mensajeborrar_vtotal(id)
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
			window.location.href = "ctotal_clientes/eliminarvtotal/" + id;
		}
	});
}

document.addEventListener('click', function(event){
    const dropdowns = document.querySelectorAll('#dropdowns_vtotal');
    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select_vtotal');
        const caret = dropdown.querySelector('.caret_vtotal');
        const menu = dropdown.querySelector('.menu_vtotal');

        if(!dropdown.contains(event.target)){
            select.classList.remove('select_clicked_vtotal');
            caret.classList.remove('caret_rotate_vtotal');
            menu.classList.remove('menu_vtotal_open');
        }
    });
});

const dropdown_vtotal = document.querySelectorAll('#dropdowns_vtotal');

dropdown_vtotal.forEach(dropdown => {
    const select = dropdown.querySelector('.select_vtotal');
    const caret = dropdown.querySelector('.caret_vtotal');
    const menu = dropdown.querySelector('.menu_vtotal');
    const options = dropdown.querySelectorAll('.menu_vtotal li button');
    const selected = dropdown.querySelector('.selected_vtotal');

    select.addEventListener('click', () => {
        select.classList.toggle('select_clicked_vtotal');
        caret.classList.toggle('caret_rotate_vtotal');
        menu.classList.toggle('menu_vtotal_open');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            caret.classList.remove('caret_rotate_vtotal');
            menu.classList.remove('menu_vtotal_open');

            options.forEach(option => {
                select.classList.toggle('select_clicked_vtotal');
            });

            option.classList.add('active');
        });
    });
});