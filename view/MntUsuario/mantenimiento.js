var tabla;

function init() {
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}


function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?options=saveEdit",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#usuario_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#user_data').DataTable().ajax.reload();

            swal({
                title: "",
                text: "Completado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

$(document).ready(function () {
    tabla = $('#user_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax": {
            url: '../../controller/usuario.php?options=list',
            type: "post",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);


            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();

});

function editar(user_id) {
    $('#mdltitulo').html('Editar Registro');
    $.post("../../controller/usuario.php?options=show", {user_id: user_id}, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#user_id').val(data.user_id);
        $('#user_name').val(data.user_name);
        $('#user_email').val(data.user_email);
        $('#user_password').val(data.user_password);
        $('#user_rol').val(data.user_rol).trigger('change');
    });
    $('#modalmantenimiento').modal('show');
}

function eliminar(user_id) {
    swal({
            title: "¡Advertencia!",
            text: "¿Esta seguro de eliminar al usuario?",
            type: "error",
            showCancelButton: true,
            confirmButtonClass: "btn-error",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false
        },
        function (isConfirm) {
            if (isConfirm) {
                // var ticket_id = getUrlParameter('ID');
                // // var user_id = $('#user_idx').val();
                $.post("../../controller/usuario.php?options=delete", {
                    user_id: user_id
                }, function (data) {});

                $('#user_data').DataTable().ajax.reload();


                swal({
                    title: "",
                    text: "Usuario eliminado.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
        });
}

// function editar(usu_id){
//     $('#mdltitulo').html('Editar Registro');

//     // $.post("../../controller/usuario.php?op=mostrar", {usu_id : usu_id}, function (data) {
//     //     data = JSON.parse(data);
//     //     $('#usu_id').val(data.usu_id);
//     //     $('#usu_nom').val(data.usu_nom);
//     //     $('#usu_ape').val(data.usu_ape);
//     //     $('#usu_correo').val(data.usu_correo);
//     //     $('#usu_pass').val(data.usu_pass);
//     //     $('#rol_id').val(data.rol_id).trigger('change');
//     // }); 

//     $('#modalmantenimiento').modal('show');
// }


$(document).on("click", "#btnAdd", function () {
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
})
// console.log("e");
init();