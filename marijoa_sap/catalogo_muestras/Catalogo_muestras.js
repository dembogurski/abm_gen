var openForm = false;

$(document).ready(function() {
    $('#catalogo_muestras').DataTable( {
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
        url: "Catalogo_muestras.class.php",
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


function updateData(){
    alert("Updating data");
}

function closeForm(){
    $(".form").html("");
    $(".form").fadeOut();
    openForm = false;
}