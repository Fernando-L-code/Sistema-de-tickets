function init(){
   
}
$(document).ready(function(){
    var user_id = $('#user_idx').val();
    $.post("../../controller/usuario.php?options=total", 
    { user_id:user_id}, function (data) {
        data = JSON.parse(data);
        $('#lbltotal').html(data.TOTAL);

        console.log(data.TOTAL);
    }); 

    $.post("../../controller/usuario.php?options=totalOpen", 
    { user_id:user_id}, function (data) {
        data = JSON.parse(data);
        $('#lbltotalabierto').html(data.TOTAL);

        console.log(data.TOTAL);
    }); 

    $.post("../../controller/usuario.php?options=totalClose", 
    { user_id:user_id}, function (data) {
        data = JSON.parse(data);
        $('#lbltotalcerrado').html(data.TOTAL);

        console.log(data.TOTAL);
    }); 

});

init();
