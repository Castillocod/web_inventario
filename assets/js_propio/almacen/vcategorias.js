$(document).ready(function() {
    var tabla_vcat = $('#tabla_vcat').DataTable({
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
                $(td).addClass('');
            }},
            {'data': 'categoria', 'orderable': false, 'createdCell': function(td, cellData, rowData, row, col){
                $(td).addClass('');
            }},
            {'data': 'estado_vcat', 'orderable': false, 'createdCell': function(td, cellData, rowData, row, col){
                var estado_vcat = cellData.trim();
                $(td).html('<span id="celda_estado_vcat" style="font-weight: bold; font-size: 11px;">'+cellData+'</span>');

                if(estado_vcat === 'Activo'){
                    $(td).find('span').addClass('badge badge-success');
                } else if(estado_vcat === 'Inactivo'){
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
                    $(td).html(botoneditar_vcat +'<span style="margin-left: 5px;"></span>'+botoneliminar_vcat);
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

    new $.fn.dataTable.Buttons(tabla_vcat, {
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success',
                action: function(e, dt, node, config){
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
                }
            }
        ]
    });

    $('#dt-search-0').on('keyup', function(){
        tabla_vcat.search(this.value).draw();
    });

    $('#dt-length-0').on('change', function(){
        tabla_vcat.page.len(this.value).draw();
        // var filas_vcat = parseInt(this.value);
        // var totalRows = tabla_vcat.data().length;

        // if(totalRows > filas_vcat){
        //     tabla_vcat.page.len(filas_vcat).draw();
        // }
    });

    $('#btn-excel').on('click', function(){
        tabla_vcat.button('.buttons-excel').trigger();
    });

    tabla_vcat.on('draw', function(){
        var pagination = $('.pagination');
        pagination.attr('id', 'pagination_vcat');
        $('#pagination_categorias').append(pagination);
    });

    $('#estado_lblcat').text('Inactivo');
    $('#estado_vcat').val('Inactivo');
    $('#switchestadocat').addClass('switch_inactivo');

    $('#switchestadocat').change(function() {
        if($(this).prop('checked')){
            $('#estado_lblcat').text('Activo');
            $('#estado_vcat').val('Activo');
        }
        else{
            $('#estado_lblcat').text('Inactivo');
            $('#estado_vcat').val('Inactivo');
        }
    });

    $('#edit_switchestadocat').change(function() {
        if($(this).prop('checked')){
            $('#edit_estado_lblcat').text('Activo');
            $('#edit_estado_vcat').val('Activo');
        }
        else{
            $('#edit_estado_lblcat').text('Inactivo');
            $('#edit_estado_vcat').val('Inactivo');
        }
    });
});

$(document).on('click', '#vcat_registrar', function(e){
    e.preventDefault();

    var categoria = $('#categoria').val();
    var estado_vcat = $('#estado_vcat').val();

    if(categoria == ""){
        alert('Se requiere llenar algunos campos');
    }
    else{
        $.ajax({
            url: 'ccategorias/agregarcategorias',
            type: 'POST',
            dataType: 'JSON',
            data:{
                categoria:categoria,
                estado_vcat:estado_vcat
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

    var editid = $('#editid').val();
    var editcategoria = $('#editcategoria').val();
    var edit_estado_vcat = $('#edit_estado_vcat').val();

    if(editcategoria == ""){
        alert('Se requiere llenar algunos campos');
    }
    else{
        $.ajax({
            url: 'ccategorias/actualizarcategorias',
            type: 'POST',
            dataType: 'JSON',
            data: {
                editid:editid,
                editcategoria:editcategoria,
                edit_estado_vcat:edit_estado_vcat
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

            if(data.estado_vcat == 'Activo'){
                $('#edit_estado_lblcat').text('Activo');
                $('#edit_estado_vcat').val('Activo');
                $('#edit_switchestadocat').removeClass('switch-inactivo').addClass('switch-activo').prop('checked', true);
            }
            else{
                $('#edit_estado_lblcat').text('Inactivo');
                $('#edit_estado_vcat').val('Inactivo');
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

var dropdown_vcat = document.querySelectorAll('#dropdown_vcategorias');

document.addEventListener('click', function(event){
    dropdown_vcat.forEach(dropdown => {
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

dropdown_vcat.forEach(dropdown => {
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