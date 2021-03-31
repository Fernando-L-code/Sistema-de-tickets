
function init(){
   
    $("#ticket_form").on("submit",function(e){
        guardaryeditar(e);	
    });
    
}

$(document).ready(function() {
    $('#ticket_description').summernote({
        height: 150,
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

    $.post("../../controller/categoria.php?options=combo",function(data, status){
        console.log(data);
        $('#categori_id').html(data);
    });

});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    if ($('#ticket_description').summernote('isEmpty') || $('#ticket_title').val()==''){
        swal("Advertencia!", "Campos Vacios", "warning");
    }else{
        $.ajax({
            url: "../../controller/ticket.php?options=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){  
                // console.log(datos);
                $('#ticket_title').val('');
                $('#ticket_description').summernote('reset');
                swal("Correcto!", "Registrado Correctamente", "success");
            }  
        }); 

    }
}

init();