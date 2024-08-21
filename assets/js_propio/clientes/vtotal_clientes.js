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
                var fechainicial = new Date(selected.date.valueOF());
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
        }
    });
});

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