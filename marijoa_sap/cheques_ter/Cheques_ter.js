var openForm = false;

$(document).ready(function() {
    $('#cheques_ter').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ filas por pagina",
            "zeroRecords": "Ningun resultado - lo siento",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Ningun registro disponible",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search":"Buscar",
			"paginate": {
             "previous": "Anterior",
             "next": "Siguiente"
            }
        },
        responsive: true,
		"lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
		"pageLength": 20
    } );
    
     
    
    window.addEventListener('resize', function(event){
        if(openForm){
           centerForm();
        }
    });   
     
} );

function getNick(){
    return "tmp_user";
}

function editUI(pk){
    $.ajax({
        type: "POST",
        url: "Cheques_ter.class.php",
        data: {action: "editUI" , pk: pk,  usuario: getNick()},
        async: true,
        dataType: "html",
        beforeSend: function () {
            $(".form").html("");
             $("#msg").html("<img src='img/loading_fast.gif' width='16px' height='16px' >"); 
        },
        complete: function (objeto, exito) {
            if (exito == "success") {                          
                var form = objeto.responseText;                  
                centerForm(); 
                $(".form").html(form);
                $("#msg").html(""); 
                //$(".PRI").prop("readonly",true);
            }else{
                $("#msg").html("Ocurrio un error en la comunicacion con el Servidor...");
            }
        },
        error: function () {
           $("#msg").html("Ocurrio un error en la comunicacion con el Servidor...");
        }
    });   
}




function centerForm(){
   var w = $(window).width();
   var h = $(window).height();
   $(".form").width(w);
   $(".form").height(h);   
   $(".form").fadeIn();
   openForm = true;
}


function updateData(form){
  var update_data = {};
  var primary_keys = {};
  var table = form.substring(5,60);  
  $("#"+form+" [id^='form_']").each(function(){
       
     var pk = $(this).hasClass("PRI");
     var column_name = $(this).attr("id").substring(5,60);
     var val = $(this).val();
     
     if(pk){
         primary_keys[column_name]=val;
     }else{
         update_data[column_name]=val;
     }  
  });   
  var master ={                  
        primary_keys:primary_keys,
        update_data:update_data
  };
  $.ajax({
        type: "POST",
        url: "Cheques_ter.class.php",
        data: {action: "updateData" , master: master,  usuario: getNick()},        
        async: true,
        dataType: "json",
        beforeSend: function () {
            $("#"+form+" input[id="+table+"_update_button]").prop("disabled",true);
            $("#msg_cheques_ter").html("Actualizando... <img src='../img/loading_fast.gif'  >");
        },
        success: function (data) {                
            if(data.mensaje == "Ok"){ 
                $("#msg_cheques_ter").html(data.mensaje);
                $("#"+form+" input[id="+table+"_close_button]").fadeIn();
            }else{
                $("#"+form+" input[id="+table+"_update_button]").prop("disabled",false);
                $("#msg_cheques_ter").html(data.mensaje+" intente nuevamente si el problema persiste contacte con el Administrador del sistema.");
            }           
        }
    });  
}

function closeForm(){
    $(".form").html("");
    $(".form").fadeOut();
    openForm = false;
}