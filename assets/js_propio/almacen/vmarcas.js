//INTERACTIVIDAD - VARIABLES DE EXPORTAR EXCEL POR TIEMPO VMARCAS
const unofecha_excelvmarcas = $('#fechauno_excelvmarcas');
const lblunofecha_excelvmarcas = $('#lblfechauno_excelvmarcas');
const dosfecha_excelvmarcas = $('#fechados_excelvmarcas');
const lbldosfecha_excelvmarcas = $('#lblfechados_excelvmarcas');
const meses_excelvmarcas = $('#mes_excelvmarcas');
const lblmeses_excelvmarcas = $('#lblmes_excelvmarcas');
const totales_excelvmarcas = $('#total_excelvmarcas');
const lbltotales_excelvmarcas = $('#lbltotal_excelvmarcas');
//INTERACTIVIDAD - VARIABLES DE EXPORTAR EXCEL POR TIEMPO VMARCAS

//INTERACTIVIDAD - VARIABLES DE REPORTES DE ACTIVOS
const unofecha_actvmarcas = $('#fechauno_actvmarcas');
const lblunofecha_actvmarcas = $('#lblfechauno_actvmarcas');
const dosfecha_actvmarcas = $('#fechados_actvmarcas');
const lbldosfecha_actvmarcas = $('#lblfechados_actvmarcas');
const meses_actvmarcas = $('#mes_actvmarcas');
const lblmeses_actvmarcas = $('#lblmes_actvmarcas');
const totales_actvmarcas = $('#total_actvmarcas');
const lbltotales_actvmarcas = $('#lbltotal_actvmarcas');
//INTERACTIVIDAD - VARIABLES DE REPORTES DE ACTIVOS

//INTERACTIVIDAD - VARIABLES DE REPORTES DE INACTIVOS
const unofecha_inactvmarcas = $('#fechauno_inactvmarcas');
const lblunofecha_inactvmarcas = $('#lblfechauno_inactvmarcas');
const dosfecha_inactvmarcas = $('#fechados_inactvmarcas');
const lbldosfecha_inactvmarcas = $('#lblfechados_inactvmarcas');
const meses_inactvmarcas = $('#mes_inactvmarcas');
const lblmeses_inactvmarcas = $('#lblmes_inactvmarcas');
const totales_inactvmarcas = $('#total_inactvmarcas');
const lbltotales_inactvmarcas = $('#lbltotal_inactvmarcas');
//INTERACTIVIDAD - VARIABLES DE REPORTES DE INACTIVOS

$(document).ready(function() 
{
    //CONFIGURACIÓN DE LA DATATABLES
    var tabla = $('#tabla_vmarcas').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'cmarcas/obtenerdatos',
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
        'columns':[
            {'data': 'id', 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'marca', 'createdCell': function(td, cellDate, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vmarcas', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vmarcas = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_vmarcas" style="font-weight: bold; font-size:11px">'+cellData+'</span>');

                if(estado_vmarcas === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vmarcas === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                    var id = rowData.id;
                    var botoneditar_vmarcas = `<button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vmarcas_modeditar" onclick="vmarcas_editar(${id})" value=""></button>`;
                    var botoneliminar_vmarcas = `<button onclick="mensajeborrar_vmarcas(${id})" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>`;
                    $(td).addClass('text-center').html(botoneditar_vmarcas+'<span style="margin-left: 5px;"></span>'+botoneliminar_vmarcas);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vmarcas');
            $('#pagination_marcas').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vprod');
            $('#pagination_marcas').html('');
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
        pagination.attr('id', 'pagination_vmarcas');
        $('#pagination_marcas').append(pagination);
    });
    //CONFIGURACIÓN DE LA DATATABLES

    //COMPROBACIÓN DE DATOS DE MARCAS
    $.ajax({
        url: 'cmarcas/comprobacionvmarcas',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data){
                $('#btnexcel_vmarcas').prop('disabled', true);
                $('[name="tabla_vmarcas_length"]').prop('disabled', true);
                $('#dropdowns_vmarcas').addClass('disabled_dropdown_vmarcas');
                $('[name="dt_buscar_vmarcas"]').prop('disabled', true);
            }
            else{
                $('#btnexcel_vmarcas').prop('disabled', false);
                $('[name="tabla_vmarcas_length"]').prop('disabled', false);
                $('#dropdowns_vmarcas').removeClass('disabled_dropdown_vmarcas');
                $('[name="dt_buscar_vmarcas"]').prop('disabled', false);   
            }
        },
    });
    //COMPROBACIÓN DE DATOS DE MARCAS

    $('#estado_lblmarcas').text('INACTIVO');
    $('#estado_vmarcas').val('INACTIVO');
    $('#switchestadomarcas').addClass('switch-inactivo');

    $('#switchestadomarcas').change(function() {
        if($(this).prop('checked'))
        {
            $('#estado_lblmarcas').text('ACTIVO');
            $('#estado_vmarcas').val('ACTIVO');
        }
        else
        {
            $('#estado_lblmarcas').text('INACTIVO');
            $('#estado_vmarcas').val('INACTIVO');
        }
    });

    $('#edit_switchestadomarcas').change(function(){
        if($(this).prop('checked'))
        {
            $('#edit_estado_lblmarcas').text('ACTIVO');
            $('#edit_estado_vmarcas').val('ACTIVO');
        }
        else
        {
            $('#edit_estado_lblmarcas').text('INACTIVO');
            $('#edit_estado_vmarcas').val('INACTIVO');
        }
    });

    //FECHA AUTOMÁTICA
    var fechaactual = new Date().toISOString().split('T')[0];
    $('#fecha_vmarcas').val(fechaactual);
    //FECHA AUTOMÁTICA

    $('#editfecha_vmarcas').datepicker({
            language: 'es',
            autoClose: true,
            format: 'yyyy-mm-dd'
    });

   //CONFIGURACIÓN DE LOS DATETIME
    $.ajax({
        url: 'cmarcas/fechasmeses_vmarcas',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            var primerfecha = data.primerfecha;
            var ultimafecha = data.ultimafecha;
            var primermes = data.primermes;
            var ultimomes = data.ultimomes;

            $('#fechauno_excelvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_excelvmarcas').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_excelvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_excelvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });

            $('#fechauno_actvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechauno = new Date(selected.date.valueOf());
                $('#fechados_actvmarcas').datepicker('setStartDate', fechauno);
            });

            $('#fechados_actvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_actvmarcas').datepicker({
                autoClose: true,
                language: 'es',
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });

            $('#fechauno_inactvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechauno = new Date(selected.date.valueOf());
                $('#fechados_inactvmarcas').datepicker('setStartDate', fechauno);
            });

            $('#fechados_inactvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_inactvmarcas').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });
        }
    });
    //CONFIGURACIÓN DE LOS DATETIME

    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO
    dosfecha_excelvmarcas.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_excelvmarcas.prop('disabled', true).css('opacity', 0.5);

    unofecha_excelvmarcas.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_excelvmarcas.prop('disabled', true).css('opacity', 0.5);
            dosfecha_excelvmarcas.prop('disabled', false).css('opacity', 1);
            lbldosfecha_excelvmarcas.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_excelvmarcas.on('click', () => except_excelvmarcas([unofecha_excelvmarcas, lblunofecha_excelvmarcas]));
    meses_excelvmarcas.on('click', () => except_excelvmarcas([meses_excelvmarcas, lblmeses_excelvmarcas]));
    totales_excelvmarcas.on('change', () => except_excelvmarcas([totales_excelvmarcas, lbltotales_excelvmarcas]));

    $('#btnexcel_vmarcas, #cancelar_excelvmarcas').click(function() {
        $('#fechauno_excelvmarcas').val('');
        $('#fechados_excelvmarcas').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_excelvmarcas').prop('disabled', true).css('opacity', 0.5);
        $('#mes_excelvmarcas').val('');
        $('#total_excelvmarcas').prop('checked', false);

        const inputs = ['#fechauno_excelvmarcas', '#mes_excelvmarcas', '#total_excelvmarcas'];
        const spans = ['#lblfechauno_excelvmarcas', '#lblmes_excelvmarcas', '#lbltotal_excelvmarcas'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO

    //INTERACTIVDAD - OPCIONES DE REPORTES DE ACTIVOS
    dosfecha_actvmarcas.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_actvmarcas.prop('disabled', true).css('opacity', 0.5);

    unofecha_actvmarcas.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_actvmarcas.prop('disabled', true).css('opacity', 0.5);
            dosfecha_actvmarcas.prop('disabled', false).css('opacity', 1);
            lbldosfecha_actvmarcas.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_actvmarcas.on('click', () => except_actvmarcas([unofecha_actvmarcas, lblunofecha_actvmarcas]));
    meses_actvmarcas.on('click', () => except_actvmarcas([meses_actvmarcas, lblmeses_actvmarcas]));
    totales_actvmarcas.on('change', () => except_actvmarcas([totales_actvmarcas, lbltotales_actvmarcas]));

    $('#btnactivos_actvmarcas, #cancelar_actvmarcas').click(function() {
        $('#fechauno_actvmarcas').val('');
        $('#fechados_actvmarcas').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_actvmarcas').prop('disabled', true).css('opacity', 0.5);
        $('#mes_actvmarcas').val('');
        $('#total_actvmarcas').prop('checked', false);

        const inputs = ['#fechauno_actvmarcas', '#mes_actvmarcas', '#total_actvmarcas'];
        const spans = ['#lblfechauno_actvmarcas', '#lblmes_actvmarcas', '#lbltotal_actvmarcas'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVDAD - OPCIONES DE REPORTES DE ACTIVOS

    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
    dosfecha_inactvmarcas.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_inactvmarcas.prop('disabled', true).css('opacity', 0.5);

    unofecha_inactvmarcas.on('change', function(){
        if($(this).val())
        {
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_inactvmarcas.prop('disabled', true).css('opacity', 0.5);
            dosfecha_inactvmarcas.prop('disabled', false).css('opacity', 1);
            lbldosfecha_inactvmarcas.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_inactvmarcas.on('click', () => except_inactvmarcas([unofecha_inactvmarcas, lblunofecha_inactvmarcas]));
    meses_inactvmarcas.on('click', () => except_inactvmarcas([meses_inactvmarcas, lblmeses_inactvmarcas]));
    totales_inactvmarcas.on('change', () => except_inactvmarcas([totales_inactvmarcas, lbltotales_inactvmarcas]));

    $('#btninactivos_inactvmarcas, #cancelar_inactvmarcas').click(function() {
        $('#fechauno_inactvmarcas').val('');
        $('#fechados_inactvmarcas').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_inactvmarcas').prop('disabled', true).css('opacity', 0.5);
        $('#mes_inactvmarcas').val('');
        $('#total_inactvmarcas').prop('checked', false);

        const inputs = ['#fechauno_inactvmarcas', '#mes_inactvmarcas', '#total_inactvmarcas'];
        const spans = ['#lblfechauno_inactvmarcas', '#lblmes_inactvmarcas', '#lbltotal_inactvmarcas'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
});

function except_excelvmarcas(excepcion_excelvmarcas)
{
    const inputs = [unofecha_excelvmarcas, dosfecha_excelvmarcas, meses_excelvmarcas, totales_excelvmarcas];
    const labels = [lblunofecha_excelvmarcas, lbldosfecha_excelvmarcas, lblmeses_excelvmarcas, lbltotales_excelvmarcas];

    inputs.forEach(input => {
        if(!excepcion_excelvmarcas.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_excelvmarcas.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function exportarexcel_vmarcas()
{
    var fechauno = $('#fechauno_excelvmarcas').val();
    var fechados = $('#fechados_excelvmarcas').val();
    var meses = $('#mes_excelvmarcas').val();
    var todoslosdatos = $('#total_excelvmarcas').prop('checked');

    if(fechauno && fechados)
    {
        excelfechas_vmarcas(fechauno, fechados);
    } else if(meses){
        excelmes_vmarcas(meses);
    } else if(todoslosdatos){
        exceltotal_vmarcas();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function excelfechas_vmarcas(fechauno, fechados)
{
    var url = 'cmarcas/excelfechas_vmarcas';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function excelmes_vmarcas(mes)
{
    var url = 'cmarcas/excelmes_vmarcas';
    window.location.href = url + '?mes=' + mes;
}

function exceltotal_vmarcas()
{
    var url = 'cmarcas/exceltotal_vmarcas';
    window.location.href = url;
}

function except_actvmarcas(excepcion_actvmarcas)
{
    const inputs = [unofecha_actvmarcas, dosfecha_actvmarcas, meses_actvmarcas, totales_actvmarcas];
    const labels = [lblunofecha_actvmarcas, lbldosfecha_actvmarcas, lblmeses_actvmarcas, lbltotales_actvmarcas];

    inputs.forEach(input => {
        if(!excepcion_actvmarcas.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_actvmarcas.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function reporteactivos_vmarcas()
{
    var fechauno = $('#fechauno_actvmarcas').val();
    var fechados = $('#fechados_actvmarcas').val();
    var meses = $('#mes_actvmarcas').val();
    var todoslosdatos = $('#total_actvmarcas').prop('checked');

    if(fechauno && fechados)
    {
        pdfactfechas_vmarcas(fechauno, fechados);
    } else if(meses){
        pdfactmes_vmarcas(meses);
    } else if(todoslosdatos){
        pdfacttotal_vmarcas();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function pdfactfechas_vmarcas(fechauno, fechados)
{
    var url = 'cmarcas/pdfactfechas_vmarcas';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function pdfactmes_vmarcas(mes)
{
    var url = 'cmarcas/pdfactmes_vmarcas';
    window.location.href = url + '?mes=' + mes;
}

function pdfacttotal_vmarcas()
{
    var url = 'cmarcas/pdfacttotal_vmarcas';
    window.location.href = url;
}

function except_inactvmarcas(excepcion_inactvmarcas)
{
    const inputs = [unofecha_inactvmarcas, dosfecha_inactvmarcas, meses_inactvmarcas, totales_inactvmarcas];
    const labels = [lblunofecha_inactvmarcas, lbldosfecha_inactvmarcas, lblmeses_inactvmarcas, lbltotales_inactvmarcas];

    inputs.forEach(input => {
        if(!excepcion_inactvmarcas.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }        
    });

    labels.forEach(label => {
        if(!excepcion_inactvmarcas.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function reporteinactivos_vmarcas()
{
    var fechauno = $('#fechauno_inactvmarcas').val();
    var fechados = $('#fechados_inactvmarcas').val();
    var meses = $('#mes_inactvmarcas').val();
    var todoslosdatos = $('#total_inactvmarcas').prop('checked');

    if(fechauno && fechados)
    {
        pdfinactfechas_vmarcas(fechauno, fechados);
    } else if(meses){
        pdfinactmes_vmarcas(meses);
    } else if(todoslosdatos){
        pdfinacttotal_vmarcas();
    }
    else
    {
        alert('Por favor, seleccione una opción');
    }
}

function pdfinactfechas_vmarcas(fechauno, fechados)
{
    var url = 'cmarcas/pdfinactfechas_vmarcas';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function pdfinactmes_vmarcas(mes)
{
    var url = 'cmarcas/pdfinactmes_vmarcas';
    window.location.href = url + '?mes=' + mes;
}

function pdfinacttotal_vmarcas()
{
    var url = 'cmarcas/pdfinacttotal_vmarcas';
    window.location.href = url;
}

//CRUD DE VMARCAS
$(document).on('click', '#vmarcas_registrar', function(e) {
    e.preventDefault();

    var marca = $('#marca').val();
    var estado_vmarcas = $('#estado_vmarcas').val();
    var fecha_vmarcas = $('#fecha_vmarcas').val();

    if(marca == "" || fecha_vmarcas == "")
    {
        alert('Se requiere llenar algunos campos');
    }
    else
    {
        $.ajax({
            url: 'cmarcas/agregarvmarcas',
            type: 'POST',
            dataType: 'JSON',
            data: {
                marca:marca,
                estado_vmarcas:estado_vmarcas,
                fecha_vmarcas:fecha_vmarcas
            },
            success: function(data){
                if(data.responce == 'success')
                {
                    $('#vmarcas_agregarmarcas').modal('hide');
                    Swal.fire({
                        title: "Marca Registrada",
                        text: "Marca registrada con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#vmarcas_formregistrar')[0].reset();
                            window.location.href = "cmarcas";
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
                    $('#vmarcas_formregistrar')[0].reset();
                }
            }
        });
    }
});

$(document).on('click', '#vmarcas_actualizar', function(e) {
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
        if(result.isConfirmed)
        {
            var editid = $('#editid').val();
            var editmarca = $('#editmarca').val();
            var edit_estado_vmarcas = $('#edit_estado_vmarcas').val();
            var editfecha_vmarcas = $('#editfecha_vmarcas').val();

            if(editmarca == "" || editfecha_vmarcas == "")
            {
                alert('Se requieren llenar algunos campos');
            }
            else
            {
                $.ajax({
                    url: 'cmarcas/actualizarvmarcas',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        editid:editid,
                        editmarca:editmarca,
                        edit_estado_vmarcas:edit_estado_vmarcas,
                        editfecha_vmarcas:editfecha_vmarcas
                    },
                    success: function(data){
                        if(data.responce == 'success')
                        {
                            $('#vmarcas_modeditar').modal('hide');
                            Swal.fire({
                                title: "Marca Actualizada",
                                text: "Marca actualizada con éxito",
                                icon: "success",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.href = "cmarcas";
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
        }
    });
});

function vmarcas_editar(id)
{
    $('#vmarcas_formeditar')[0].reset();

    $.ajax({
        url: 'cmarcas/editarvmarcas/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            $('[name="editid"]').val(data.id);
            $('[name="editmarca"]').val(data.marca);
            $('[name="edit_estado_vmarcas"]').val(data.estado_vmarcas);
            $('[name="editfecha_vmarcas"]').val(data.fecha_vmarcas);

            if(data.estado_vmarcas == 'ACTIVO')
            {
                $('#edit_estado_lblmarcas').text('ACTIVO');
                $('#edit_estado_vmarcas').val('ACTIVO');
                $('#edit_switchestadomarcas').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
            }
            else
            {
                $('#edit_estado_lblmarcas').text('INACTIVO');
                $('#edit_estado_vmarcas').val('INACTIVO');
                $('#edit_switchestadomarcas').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
            }
            $('#vmarcas_modeditar').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos:', error);
        }
    });
    $('#vmarcas_formeditar')[0].reset();
}

function mensajeborrar_vmarcas(id)
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
			window.location.href = "cmarcas/eliminarvmarcas/" + id;
		}
	});
}
//CRUD DE VMARCAS


//CONFIGURACIÓN DROPDOWN_VMARCAS
document.addEventListener('click', function(event){
    const dropdowns = document.querySelectorAll('#dropdowns_vmarcas');
    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select_vmarcas');
        const caret = dropdown.querySelector('.caret_vmarcas');
        const menu = dropdown.querySelector('.menu_vmarcas');

        if(!dropdown.contains(event.target)){
            select.classList.remove('select_clicked_vmarcas');
            caret.classList.remove('caret_rotate_vmarcas');
            menu.classList.remove('menu_vmarcas_open');
        }
    });
});

const dropdown_vmarcas = document.querySelectorAll('#dropdowns_vmarcas');

dropdown_vmarcas.forEach(dropdown => {
    const select = dropdown.querySelector('.select_vmarcas');
    const caret = dropdown.querySelector('.caret_vmarcas');
    const menu = dropdown.querySelector('.menu_vmarcas');
    const options = dropdown.querySelectorAll('.menu_vmarcas li button');
    const selected = dropdown.querySelector('.selected_vmarcas');

    select.addEventListener('click', () => {
        select.classList.toggle('select_clicked_vmarcas');
        caret.classList.toggle('caret_rotate_vmarcas');
        menu.classList.toggle('menu_vmarcas_open');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            caret.classList.remove('caret_rotate_vmarcas');
            menu.classList.remove('menu_vmarcas_open');

            options.forEach(option => {
                select.classList.toggle('select_clicked_vmarcas');
            });

            option.classList.add('active');
        });
    });
});
//CONFIGURACIÓN DROPDOWN_VMARCAS
