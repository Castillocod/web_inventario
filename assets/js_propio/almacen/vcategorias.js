//INTERACTIVIDAD - VARIABLES DE EXPORTAR EXCEL POR TIEMPO VCATEGORIAS
const unofecha_excelvcat = $('#fechauno_excelvcat');
const lblunofecha_excelvcat = $('#lblfechauno_excelvcat');
const dosfecha_excelvcat = $('#fechados_excelvcat');
const lbldosfecha_excelvcat = $('#lblfechados_excelvcat');
const meses_excelvcat = $('#mes_excelvcat');
const lblmeses_excelvcat = $('#lblmes_excelvcat');
const totales_excelvcat = $('#total_excelvcat');
const lbltotales_excelvcat = $('#lbltotal_excelvcat');
//INTERACTIVIDAD - VARIABLES DE EXPORTAR EXCEL POR TIEMPO VCATEGORIAS

//INTERACTIVIDAD - VARIABLES DE REPORTES DE ACTIVOS
const unofecha_actvcat = $('#fechauno_actvcat');
const lblunofecha_actvcat = $('#lblfechauno_actvcat');
const dosfecha_actvcat = $('#fechados_actvcat');
const lbldosfecha_actvcat = $('#lblfechados_actvcat');
const meses_actvcat = $('#mes_actvcat');
const lblmeses_actvcat = $('#lblmes_actvcat');
const totales_actvcat = $('#total_actvcat');
const lbltotales_actvcat = $('#lbltotal_actvcat');
//INTERACTIVIDAD - VARIABLES DE REPORTES DE ACTIVOS

//INTERACTIVIDAD - VARIABLES DE REPORTES DE INACTIVOS
const unofecha_inactvcat = $('#fechauno_inactvcat');
const lblunofecha_inactvcat = $('#lblfechauno_inactvcat');
const dosfecha_inactvcat = $('#fechados_inactvcat');
const lbldosfecha_inactvcat = $('#lblfechados_inactvcat');
const meses_inactvcat = $('#mes_inactvcat');
const lblmeses_inactvcat = $('#lblmes_inactvcat');
const totales_inactvcat = $('#total_inactvcat');
const lbltotales_inactvcat = $('#lbltotal_inactvcat');
//INTERACTIVIDAD - VARIABLES DE REPORTES DE INACTIVOS

$(document).ready(function() {
    var tabla_vcat = $('#tabla_vcat').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
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
            {'data': 'id', 'orderable': false, 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'categoria', 'orderable': false, 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vcat', 'orderable': false, 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vcat = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_vcat" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vcat === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vcat === 'INACTIVO'){
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
                    $(td).addClass('text-center').html(botoneditar_vcat +'<span style="margin-left: 5px;"></span>'+botoneliminar_vcat);
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

    $('#dt-search-0').on('keyup', function(){
        tabla_vcat.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tabla_vcat.page.len(this.value).draw();
    });

    tabla_vcat.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_vcat');
        $('#pagination_categorias').append(pagination);
    });

    $('#estado_lblcat').text('INACTIVO');
    $('#estado_vcat').val('INACTIVO');
    $('#switchestadocat').addClass('switch_inactivo');

    $('#switchestadocat').change(function() {
        if($(this).prop('checked')){
            $('#estado_lblcat').text('ACTIVO');
            $('#estado_vcat').val('ACTIVO');
        }
        else{
            $('#estado_lblcat').text('INACTIVO');
            $('#estado_vcat').val('INACTIVO');
        }
    });

    $('#edit_switchestadocat').change(function() {
        if($(this).prop('checked')){
            $('#edit_estado_lblcat').text('ACTIVO');
            $('#edit_estado_vcat').val('ACTIVO');
        }
        else{
            $('#edit_estado_lblcat').text('INACTIVO');
            $('#edit_estado_vcat').val('INACTIVO');
        }
    });

    //COMPROBACIÓN DE DATOS DE CATEGORIAS
    $.ajax({
        url: 'ccategorias/comprobacionvcat',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data)
            {
                $('#btnexcel_vcat').prop('disabled', true);
                $('[name="tabla_vcat_length"]').prop('disabled', true);
                $('#dropdown_vcategorias').addClass('disabled_dropdown_vcat');
                $('[name="dt_buscar_vcat"]').prop('disabled', true);
            }
            else
            {
                $('#btnexcel_vcat').prop('disabled', false);
                $('[name="tabla_vcat_length"]').prop('disabled', false);
                $('#dropdown_vcategorias').removeClass('disabled_dropdown_vcat');
                $('[name="dt_buscar_vcat"]').prop('disabled', false);
            }
        }
    });
    //COMPROBACIÓN DE DATOS DE CATEGORIAS

    //FECHA AUTOMATICA
    var fechaactual = new Date().toISOString().split('T')[0];
    $('#fecha_vcat').val(fechaactual);
    //FECHA AUTOMATICA

    $('#editfecha_vcat').datepicker({
        language: 'es',
        format: 'yyyy-mm-dd',
        autoClose: true
    });

    //CONFIGURACIÓN DE LOS DATETIME
    $.ajax({
        url: 'ccategorias/fechasmeses_vcat',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            var primerfecha = data.primerfecha;
            var ultimafecha = data.ultimafecha;
            var primermes = data.primermes;
            var ultimomes = data.ultimomes;

            $('#fechauno_excelvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_excelvcat').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_excelvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_excelvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                startView: 'months',
                minViewMode: 'months',
                startDate: primermes,
                endDate: ultimomes
            });

            $('#fechauno_actvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_actvcat').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_actvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_actvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm',
                minViewMode: 'months',
                startView: 'months',
                startDate: primermes,
                endDate: ultimomes
            });

            $('#fechauno_actvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                startDate: primerfecha,
                endDate: ultimafecha
            }).on('changeDate', function(selected){
                var fechainicial = new Date(selected.date.valueOf());
                $('#fechados_actvcat').datepicker('setStartDate', fechainicial);
            });

            $('#fechados_actvcat').datepicker({
                language: 'es',
                autoClose: true,
                format: 'yyyy-mm-dd',
                endDate: ultimafecha
            });

            $('#mes_actvcat').datepicker({
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
    dosfecha_excelvcat.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_excelvcat.prop('disabled', true).css('opacity', 0.5);

    unofecha_excelvcat.on('change', function(){
        if($(this).val())
        {
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_excelvcat.prop('disabled', true).css('opacity', 0.5);
            dosfecha_excelvcat.prop('disabled', false).css('opacity', 1);
            lbldosfecha_excelvcat.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_excelvcat.on('click', () => except_excelvcat([unofecha_excelvcat, lbldosfecha_excelvcat]));
    meses_excelvcat.on('click', () => except_excelvcat([meses_excelvcat, lblmeses_excelvcat]));
    totales_excelvcat.on('change', () => except_excelvcat([totales_excelvcat, lbltotales_excelvcat]));

    $('#btnexcel_vcat, #cancelar_excelvcat').click(function() {
        $('#fechauno_excelvcat').val('');
        $('#fechados_excelvcat').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_excelvcat').prop('disabled', true).css('opacity', 0.5);
        $('#mes_excelvcat').val('');
        $('#total_excelvcat').prop('checked', false);

        const inputs = ['#fechauno_excelvcat', '#mes_excelvcat', '#total_excelvcat'];
        const spans = ['#lblfechauno_excelvcat', '#lblmes_excelvcat', '#lbltotal_excelvcat'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE EXPORTAR EXCEL POR TIEMPO

    //INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS
    dosfecha_actvcat.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_actvcat.prop('disabled', true).css('opacity', 0.5);

    unofecha_actvcat.on('change', function(){
        if($(this).val()){
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_actvcat.prop('disabled', true).css('opacity', 0.5);
            dosfecha_actvcat.prop('disabled', false).css('opacity', 1);
            lbldosfecha_actvcat.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_actvcat.on('click', () => except_actvcat([unofecha_actvcat, lblunofecha_actvcat]));
    meses_actvcat.on('click', () => except_actvcat([meses_actvcat, lblmeses_actvcat]));
    totales_actvcat.on('change', () => except_actvcat([totales_actvcat, lbltotales_actvcat]));

    $('#btnactivos_actvcat, #cancelar_actvcat').click(function(){
        $('#fechauno_actvcat').val('');
        $('#fechados_actvcat').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_actvcat').prop('disabled', true).css('opacity', 0.5);
        $('#mes_actvcat').val('');
        $('#total_actvcat').prop('checked', false);

        const inputs = ['#fechauno_actvcat', '#mes_actvcat', '#total_actvcat'];
        const spans = ['#lblfechauno_actvcat', '#lblmes_actvcat', '#lbltotal_actvcat'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE REPORTES DE ACTIVOS

    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
    dosfecha_inactvcat.prop('disabled', true).css('opacity', 0.5);
    lbldosfecha_inactvcat.prop('disabled', true).css('opacity', 0.5);

    unofecha_inactvcat.on('change', function(){
        if($(this).val())
        {
            $(this).prop('disabled', true).css('opacity', 0.5);
            lblunofecha_inactvcat.prop('disabled', true).css('opacity', 0.5);
            dosfecha_inactvcat.prop('disabled', false).css('opacity', 1);
            lbldosfecha_inactvcat.prop('disabled', false).css('opacity', 1);
        }
    });

    unofecha_inactvcat.on('click', () => except_inactvcat([unofecha_inactvcat, lblunofecha_inactvcat]));
    meses_inactvcat.on('click', () => except_inactvcat([meses_inactvcat, lblmeses_inactvcat]));
    totales_inactvcat.on('change', () => except_inactvcat([totales_inactvcat, lbltotales_inactvcat]));

    $('#btninactivos_inactvcat, #cancelar_inactvcat').click(function() {
        $('#fechauno_inactvcat').val('');
        $('#fechados_inactvcat').val('').prop('disabled', true).css('opacity', 0.5);
        $('#lblfechados_inactvcat').prop('disabled', true).css('opacity', 0.5);
        $('#mes_inactvcat').val('');
        $('#total_inactvcat').prop('checked', false);

        const inputs = ['#fechauno_inactvcat', '#mes_inactvcat', '#totales_inactvcat'];
        const spans = ['#lblfechauno_inactvcat', '#lblmes_inactvcat', '#totales_inactvcat'];

        inputs.forEach(input => {
            $(input).prop('disabled', false).css('opacity', 1);
        });

        spans.forEach(span => {
            $(span).prop('disabled', false).css('opacity', 1);
        });
    });
    //INTERACTIVIDAD - OPCIONES DE REPORTES DE INACTIVOS
});

function except_excelvcat(excepcion_excelvcat)
{
    const inputs = [unofecha_excelvcat, dosfecha_excelvcat, meses_excelvcat, totales_excelvcat];
    const labels = [lblunofecha_excelvcat, lbldosfecha_excelvcat, lblmeses_excelvcat, lbltotales_excelvcat];

    inputs.forEach(input => {
        if(!excepcion_excelvcat.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_excelvcat.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function exportarexcel_vcat()
{
    var fechauno = $('#fechauno_excelvcat').val();
    var fechados = $('#fechados_excelvcat').val();
    var meses = $('#mes_excelvcat').val();
    var todoslosdatos = $('#total_excelvcat').prop('checked');

    if(fechauno && fechados)
    {
        excelfechas_vcat(fechauno, fechados);
    } else if(meses){
        excelmes_vcat(meses);
    } else if (todoslosdatos){
        exceltotal_vcat();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function excelfechas_vcat(fechauno, fechados)
{
    var url = 'ccategorias/excelfechas_vcat';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function excelmes_vcat(mes)
{
    var url = 'ccategorias/excelmes_vcat';
    window.location.href = url + '?mes=' + mes;
}

function exceltotal_vcat()
{
    var url = 'ccategorias/exceltotal_vcat';
    window.location.href = url;
}

function except_actvcat(excepcion_actvcat)
{
    const inputs = [unofecha_actvcat, dosfecha_actvcat, meses_actvcat, totales_actvcat];
    const labels = [lblunofecha_actvcat, lbldosfecha_actvcat, lblmeses_actvcat, lbltotales_actvcat];

    inputs.forEach(input => {
        if(!excepcion_actvcat.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_actvcat.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function reporteactivos_vcat()
{
    var fechauno = $('#fechauno_actvcat').val();
    var fechados = $('#fechados_actvcat').val();
    var meses = $('#mes_actvcat').val();
    var todoslosdatos = $('#total_actvcat').prop('checked');

    if(fechauno && fechados)
    {
        pdfactfechas_vcat(fechauno, fechados);
    } else if(meses){
        pdfactmes_vcat(meses);
    } else if(todoslosdatos){
        pdfacttotal_vcat();
    }
    else
    {
        alert('Por favor, selecciona una opción');
    }
}

function pdfactfechas_vcat(fechauno, fechados)
{
    var url = 'ccategorias/pdfactfechas_vcat';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function pdfactmes_vcat(mes)
{
    var url = 'ccategorias/pdfactmes_vcat';
    window.location.href = url + '?mes=' + mes;
}

function pdfacttotal_vcat()
{
    var url = 'ccategorias/pdffacttotal_vcat';
    window.location.href = url;
}

function except_inactvcat(excepcion_inactvcat)
{
    const inputs = [unofecha_inactvcat, dosfecha_inactvcat, meses_inactvcat, totales_inactvcat];
    const labels = [lblunofecha_inactvcat, lbldosfecha_inactvcat, lblmeses_inactvcat, lbltotales_inactvcat];

    inputs.forEach(input => {
        if(!excepcion_inactvcat.includes(input))
        {
            input.prop('disabled', true).css('opacity', 0.5).val('');
        }
        else
        {
            input.prop('disabled', false);
        }
    });

    labels.forEach(label => {
        if(!excepcion_inactvcat.includes(label))
        {
            label.addClass('disabled').css('opacity', 0.5);
        }
        else
        {
            label.removeClass('disabled').css('opacity', 1);
        }
    });
}

function reporteinactivos_vcat()
{
    var fechauno = $('#fechauno_inactvcat').val();
    var fechados = $('#fechados_inactvcat').val();
    var meses = $('#mes_inactvcat').val();
    var todoslosdatos = $('#total_inactvcat').prop('checked');

    if(fechauno && fechados)
    {
        pdfinactfechas_vcat(fechauno, fechados);
    } else if(meses){
        pdfinactmes_vcat(meses);
    } else if(todoslosdatos){
        pdfinacttotal_vcat();
    }
    else
    {
        alert('Por favor, seleccione una opción');
    }
}

function pdfinactfechas_vcat(fechauno, fechados)
{
    var url = 'ccategorias/pdfinactfechas_vcat';
    window.location.href = url + '?fechauno=' + fechauno + '&fechados=' + fechados;
}

function pdfinactmes_vcat(mes)
{
    var url = 'ccategorias/pdfinactmes_vcat';
    window.location.href = url + '?mes=' + mes;
}

function pdfinacttotal_vcat()
{
    var url = 'ccategorias/pdfinacttotal_vcat';
    window.location.href = url;
}

$(document).on('click', '#vcat_registrar', function(e){
    e.preventDefault();

    var categoria = $('#categoria').val();
    var estado_vcat = $('#estado_vcat').val();
    var fecha_vcat = $('#fecha_vcat').val();

    if(categoria == "" || fecha_vcat == ""){
        alert('Se requiere llenar algunos campos');
    }
    else{
        $.ajax({
            url: 'ccategorias/agregarcategorias',
            type: 'POST',
            dataType: 'JSON',
            data:{
                categoria:categoria,
                estado_vcat:estado_vcat,
                fecha_vcat:fecha_vcat
            },
            success: function(data){
                if(data.responce == 'success'){
                    $('#vcat_agregarcategorias').modal('hide');
                    Swal.fire({
                        title: "Categoría Agregada",
                        text: "Categoría agregada con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#vcat_formregistrar')[0].reset();
                            window.location.href = "ccategorias";
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
                    $('#vcat_formregistrar')[0].reset();
                }
            }
        });
    }
});

$(document).on('click', '#vcat_actualizar', function(e){
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
		if (result.isConfirmed) 
        {
            var editid = $('#editid').val();
            var editcategoria = $('#editcategoria').val();
            var edit_estado_vcat = $('#edit_estado_vcat').val();
            var editfecha_vcat = $('#editfecha_vcat').val();
        
            if(editcategoria == "" || editfecha_vcat == "")
            {
                alert('Se requiere llenar algunos campos');
            }
            else
            {
                $.ajax({
                    url: 'ccategorias/actualizarcategorias',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        editid:editid,
                        editcategoria:editcategoria,
                        edit_estado_vcat:edit_estado_vcat,
                        editfecha_vcat:editfecha_vcat
                    },
                    success: function(data)
                    {
                        if(data.responce == 'success'){
                            $('#vcat_modeditar').modal('hide');
                            Swal.fire({
                                title: "Categoría Actualizada",
                                text: "Categoría actualizada con éxito",
                                icon: "success",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.href = "ccategorias";
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

function vcat_editar(id)
{
    $('#vcat_formeditar')[0].reset();

    $.ajax({
        url: 'ccategorias/editarcategorias/'+id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data)
        {
            $('[name="editid"]').val(data.id);
            $('[name="editcategoria"]').val(data.categoria);
            $('[name="edit_estado_vcat"]').val(data.estado_vcat);
            $('[name="editfecha_vcat"]').val(data.fecha_vcat);

            if(data.estado_vcat == 'ACTIVO'){
                $('#edit_estado_lblcat').text('ACTIVO');
                $('#edit_estado_vcat').val('ACTIVO');
                $('#edit_switchestadocat').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
            }
            else{
                $('#edit_estado_lblcat').text('INACTIVO');
                $('#edit_estado_vcat').val('INACTIVO');
                $('#edit_switchestadocat').removeClass('switch-activo').addClass('switch-inactivo').prop('checked', false);
            }
            $('#vcat_modeeditar').modal();
        },
        error: function(xhr, status, error){
            console.error('Error al obtener los datos de las categorias', error);
        }
    });
    $('#vcat_formeditar')[0].reset();
}

function mensajeborrar_vcat(id)
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
			window.location.href = "ccategorias/eliminarcategorias/" + id;
		}
	});
}

document.addEventListener('click', function(event){
    const dropdowns = document.querySelectorAll('#dropdown_vcategorias');
    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select_vcat');
        const caret = dropdown.querySelector('.caret_vcat');
        const menu = dropdown.querySelector('.menu_vcat');

        if(!dropdown.contains(event.target)){
            select.classList.remove('select_clicked_vcat');
            caret.classList.remove('caret_rotate_vcat');
            menu.classList.remove('menu_vcat_open');
        }
    });
});

const dropdown_vcategorias = document.querySelectorAll('#dropdown_vcategorias');

dropdown_vcategorias.forEach(dropdown => {
    const select = dropdown.querySelector('.select_vcat');
    const caret = dropdown.querySelector('.caret_vcat');
    const menu = dropdown.querySelector('.menu_vcat');
    const options = dropdown.querySelectorAll('.menu_vcat li button');
    const selected = dropdown.querySelector('.selected_vcat');

    select.addEventListener('click', () => {
        select.classList.toggle('select_clicked_vcat');
        caret.classList.toggle('caret_rotate_vcat');
        menu.classList.toggle('menu_vcat_open');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            caret.classList.remove('caret_rotate_vcat');
            menu.classList.remove('menu_vcat_open');

            options.forEach(option => {
                select.classList.toggle('select_clicked_vcat');
            });

            option.classList.add('active');
        });
    });
});