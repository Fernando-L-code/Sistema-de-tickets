function init(){
   
}

$(document).ready(function(){
    var ticket_id = getUrlParameter('ID');

    listardetalle(ticket_id);

    $('#tickd_descrip').summernote({
        height: 400,
        lang: "es-ES",
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        }
    });

    $('#tickd_descripusu').summernote({
        height: 400,
        lang: "es-ES"
    });  

    $('#tickd_descripusu').summernote('disable');

});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).on("click","#btnenviar", function(){
    var ticket_id = getUrlParameter('ID') ;
    var user_id = $('#user_idx').val();
    var ticket_description = $('#tickd_descrip').val();

    if ($('#tickd_descrip').summernote('isEmpty')){
        swal("Advertencia!", "Falta Descripción", "warning");
    }else{
        $.post("../../controller/ticket.php?options=insertDetail", { ticket_id:ticket_id,user_id:user_id,ticket_description:ticket_description}, function (data) {
            listardetalle(ticket_id);
            $('#tickd_descrip').summernote('reset');
            swal("Correcto!", "Registrado Correctamente", "success");
        }); 
    }
});

$(document).on("click","#btncerrarticket", function(){
    swal({
        title: "¡Advertencia!",
        text: "¿Esta seguro de Cerrar el Ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            var ticket_id = getUrlParameter('ID');
            var user_id = $('#user_idx').val();
            $.post("../../controller/ticket.php?options=update", { ticket_id : ticket_id,user_id : user_id }, function (data) {

            }); 

            listardetalle(ticket_id);

            swal({
                title: "",
                text: "Ticket Cerrado correctamente.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
});

function listardetalle(ticket_id){
    $.post("../../controller/ticket.php?options=listDetail", { ticket_id : ticket_id }, function (data) {
        $('#lbldetalle').html(data);
    }); 

    $.post("../../controller/ticket.php?options=show", { ticket_id : ticket_id }, function (data) {
        data = JSON.parse(data);
        $('#lblestado').html(data.ticket_status);
        $('#lblnomusuario').html(data.user_name);
        $('#lblfechcrea').html(data.date_create);
        
        $('#lblnomidticket').html("Detalle Ticket - "+data.ticket_id);

        $('#cat_nom').val(data.categori_name);
        $('#tick_titulo').val(data.ticket_title);
        $('#tickd_descripusu').summernote ('code',data.ticket_description);

        console.log( data.ticket_status_txt);
        if (data.ticket_status_txt == "Cerrado"){
            $('#pnldetalle').hide();
        }
    }); 
}

init();
