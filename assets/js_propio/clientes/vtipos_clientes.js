$(document).ready(function() 
{
    //CONFIGURACIÓN DE DATATABLES
    var tabla = $('#tabla_vtipos').DataTable({
        language:{
            'emptyTable': 'No hay datos disponibles',
            'zeroRecords': 'No se encontraron coincidencias'
        },
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'ajax':{
            'url': 'ctipos_clientes/obtenerdatos',
            'type': 'POST',
            'dataType': 'JSON',
            'error': function(xhr, status, error, code){
                alert('Error al hacer la petición');
                console.error('Error:', error);
                console.xhr('XHR:', xhr);
                console.code('Code:', code);
                console.status('Status:', status);

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
            {'data': 'cantclientes', 'createdCell': function(td, celldata, rowData, row, col){
                $(td).addClass('text-center');
            }},
            {'data': 'estado_vtipos', 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vtipos = cellData.trim();
                $(td).addClass('text-center').html('<span id="celda_estado_vtipos" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vtipos === 'ACTIVO'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vtipos === 'INACTIVO'){
                    $(td).find('span').addClass('badge badge-warning');
                }
            }},
            {'data': null,
                'orderable': false,
                'searchable': false,
                'createdCell': function(td, cellData, rowData, row, col)
                {
                     var id = rowData.id;
                     var botoneditar_vtipos = `<button class="btn btn-sm btn-warning fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#vtipos_modeditar" onclick="vtipos_editar(${id})" value=""></button>`;
                     var botoneliminar_vtipos = `<button onclick="mensajeborrar_vtipos(${id})" class="btn btn-sm btn-danger fa-solid fa-trash-can"></button>`;
                     $(td).addClass('text-center').html(botoneditar_vtipos+'<span style="margin-left: 5px;"></span>'+botoneliminar_vtipos);
                }
            }
        ],
        'dom': 'rt<"bottom"p>',
        'initComplete': function(){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vtipos');
            $('#pagination_tiposclientes').append(pagination);
        },
        'drawCallback': function(settings){
            var pagination = $('.pagination');
            pagination.attr('id', 'pagination_vtipos');
            $('#pagination_tiposclientes').html('');
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
        pagination.attr('id', 'pagination_vtipos');
        $('#pagination_tiposclientes').append(pagination);
    });
    //CONFIGURACIÓN DE DATATABLES
    
    //COMPROBACIÓN DE DATOS DE TIPOSCLIENTES
    $.ajax({
        url: 'ctipos_clientes/comprobacionvtipos',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(!data){
                $('#btnexcel_vtipos').prop('disabled', true);
                $('[name="tabla_vtipos_length"]').prop('disabled', true);
                $('#dropdowns_vtipos').addClass('disabled_dropdown_vtipos');
                $('[name="dt_buscar_vtipos"]').prop('disabled', true);
            }
            else{
                $('#btnexcel_vtipos').prop('disabled', false);
                $('[name="tabla_vtipos_length"]').prop('disabled', false);
                $('#dropdowns_vtipos').removeClass('disabled_dropdown_vtipos');
                $('[name="dt_buscar_vtipos"]').prop('disabled', false);
            }
        }
    });
    //COMPROBACIÓN DE DATOS DE TIPOSCLIENTES W
});

$(document).on('click', '#vtipos_registrar', function(e){
    e.preventDefault();

    var tipocliente = $('#tipocliente').val();

    if(tipocliente == "")
    {
        alert('Se requiere llenar algunos campos obligatorios');
    }
    else
    {
        $.ajax({
            url: 'ctipos_clientes/agregarvtipos',
            type: 'POST',
            dataType: 'JSON',
            data:{
                tipocliente:tipocliente
            },
            success: function(data){
                if(data.responce == 'success')
                {
                    $('#vtipos_agregartipocliente').modal('hide');
                    Swal.fire({
                        title: "Tipo de Cliente Agregado",
                        text: "Tipo de cliente agregado con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#vtipos_formregistrar')[0].reset();
                            window.location.href = "ctipos_clientes";
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
                    $('#vtipos_formregistrar')[0].reset();
                }
            }
        });
    }
});

$(document).on('click', '#vtipos_actualizar', function(e){
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
            var edittipocliente = $('#edittipocliente').val();

            if(edittipocliente == "")
            {
                alert('Se requiere llenar algunos campos obligatorios');
            }
            else
            {
                $.ajax({
                    url: 'ctipos_clientes/actualizarvtipos',
                    type: 'POST',
                    dataType: 'JSON',
                    data:{
                        editid:editid,
                        edittipocliente:edittipocliente
                    },
                    success: function(data){
                        if(data.responce == 'success')
                        {
                            $('#vtipos_modeditar').modal('hide');
                            Swal.fire({
                                title: "Tipo de Cliente Actualizado",
                                text: "Tipo de cliente actualizado con éxito",
                                icon: "success",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.href = "ctipos_clientes";
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

function vtipos_editar(id)
{
    $('#vtipos_formeditar')[0].reset();

    $.ajax({
        url: 'ctipos_clientes/editarvtipos/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            $('[name="editid"]').val(data.id);
            $('[name="edittipocliente"]').val(data.tipocliente);
            $('#vtipos_modeditar').modal();
        },
        error: function(xhr, status, error, code)
        {
            console.error('Error al obtener los datos del tipo cliente', error);
            console.xhr('XHR:', xhr);
            console.code('Code:', code);
            console.status('Status:', status);
        }
    });
    $('#vtipos_formeditar')[0].reset();
}

function mensajeborrar_vtipos(id)
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
        if(result.isConfirmed)
        {
            window.location.href = 'ctipos_clientes/eliminarvtipos/' + id;
        }
    });
}

document.addEventListener('click', function(event){
    const dropdowns = document.querySelectorAll('#dropdowns_vtipos');
    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select_vtipos');
        const caret = dropdown.querySelector('.caret_vtipos');
        const menu = dropdown.querySelector('.menu_vtipos');

        if(!dropdown.contains(event.target)){
            select.classList.remove('select_clicked_vtipos');
            caret.classList.remove('caret_rotate_vtipos');
            menu.classList.remove('menu_vtipos_open');
        }
    });
});

const dropdown_vtipos = document.querySelectorAll('#dropdowns_vtipos');

dropdown_vtipos.forEach(dropdown => {
    const select = dropdown.querySelector('.select_vtipos');
    const caret = dropdown.querySelector('.caret_vtipos');
    const menu = dropdown.querySelector('.menu_vtipos');
    const options = dropdown.querySelectorAll('.menu_vtipos li a');
    const selected = dropdown.querySelector('.selected_vtipos');

    select.addEventListener('click', () => {
        select.classList.toggle('select_clicked_vtipos');
        caret.classList.toggle('caret_rotate_vtipos');
        menu.classList.toggle('menu_vtipos_open');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            caret.classList.remove('caret_rotate_vtipos');
            menu.classList.remove('menu_vtipos_open');

            options.forEach(option => {
                select.classList.toggle('select_clicked_vtipos');
            });

            option.classList.add('active');
        });
    });
});