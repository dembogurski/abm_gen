<html>
    <head>
        <script src="js/jquery_2.1.0.js"></script>


        <script language="javascript">
            
            var db = null;
            var table =null;
            var host = null;
            var user =null;
            var pass =null;
            var slideform = false;
            var db_data_types = {"int":"number","double":"number","varchar":"text","date":"date"};
             
            function connect(){
                var host = $("#db_host").val();
                var user = $("#db_user").val();
                var pass = $("#db_pass").val();
                
                $.ajax({
                        type: "POST",
                        url: "http://"+host+"/abm_gen/GeneratorFunctions.php",
                        data: "action=getDatabases&user="+user+"&pass="+pass+"",
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){
                            $("#msg").html("<img src='images/activity.gif' width='30' height='11' >");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){ 
                                   $("#db"  ).html(objeto.responseText );  
                                   $("#msg"  ).html("");  $("#barra"  ).html("");  
                                   $(".connect_form").slideUp();
                                   $("#hide_button").val("+"); 
                                   slideform = true;
                            }
                        }
                    });                  
                
            }
            function showHideDBForm(){
                if(slideform){
                    $(".connect_form").slideDown();
                    slideform = false;
                    $("#hide_button").val("-");
                }else{
                    $(".connect_form").slideUp();
                    $("#hide_button").val("+");
                    slideform = true;
                }
               
            }
            function getDBTables(){
                  db = $("#databases").val();
                  host = $("#db_host").val();
                  user = $("#db_user").val();
                  pass = $("#db_pass").val();
                
                $.ajax({
                        type: "POST",
                        url: "http://"+host+"/abm_gen/GeneratorFunctions.php",
                        data: "action=getTables&db="+db+"&user="+user+"&pass="+pass+"",
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){
                            $("#msg").html("<img src='images/activity.gif' width='30' height='11' >");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){ 
                                $("#tables_sp"  ).html(objeto.responseText );  
                                $("#msg"  ).html("");  $("#barra"  ).html(""); 
                                $("#tables").change(function(){
                                   $("#folder_name").val($(this).val());
                                });
                            }
                        }
                    }); 
            }
            function getColumns(){
                var db = $("#databases").val();
                var table = $("#tables").val();
                var host = $("#db_host").val();
                var user = $("#db_user").val();
                var pass = $("#db_pass").val();
                
                $.ajax({
                        type: "POST",
                        url: "http://"+host+"/abm_gen/GeneratorFunctions.php",
                        data: "action=getColumns&db="+db+"&table="+table+"&user="+user+"&pass="+pass+"",
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){
                            $("#msg").html("<img src='images/activity.gif' width='30' height='11' >");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){ 
                                   $("#columns"  ).html(objeto.responseText );  
                                   $("#msg"  ).html("");  $("#barra"  ).html("");  
                                   init();
                            }
                        }
                    }); 
            }
            
            function getAttributes(id){  
              // var type = $("#types_"+id+" option:selected").text();
              var type = $("#types_"+id ).val();  
                
                $.ajax({
                        type: "POST",
                        url: "http://"+host+"/abm_gen/GeneratorFunctions.php",
                        data: "action=getElementAttributes&type="+type,
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){
                            $("#msg").html("<img src='images/activity.gif' width='30' height='11' >");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){ 
                                   //Levantar Popup o Ventana
                                  alert(objeto.responseText);
                                   //$("#xxx"  ).html(objeto.responseText );  
                                   $("#msg"  ).html("");   
                            }
                        }
                    }); 
            }
            function incluir(){
                 $(".seleccionados").each(function(){
                     $(this).trigger("click");                     
                 });
            }
            String.prototype.ucwords = function() {
              str = this.toLowerCase();
               return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
                  function(s){
                    return s.toUpperCase();
                  });
            };
            
            
            function init(){
                $(".seleccionados").click(function(){
                   var checked = $(this).is(":checked");
                   var column_name = $(this).parent().parent().find(".column_name").html(); 
                    
                   if(checked){                                                
                       var column_name_rem = column_name.replace("_"," ").ucwords();                       
                       $("#titulo_campo_"+column_name).val(column_name_rem+":");
                       $("#titulo_listado_"+column_name).val(column_name_rem);
                       var data_type = $(this).parent().parent().find(".data_type").html(); 
                       console.log(data_type);
                       var type = db_data_types[data_type];
                       console.log(type);
                       $("#types_"+column_name).val(type); 
                   }else{
                       $("#titulo_campo_"+column_name).val("");
                       $("#titulo_listado_"+column_name).val("");
                       $("#types_"+column_name).val(""); 
                   }
               }); 
               $("#generar").fadeIn();
               $(".form_header").slideDown();
            }  
             
            function selectType(){
                
            }
            function generarABM(){
                var database = $("#databases").val();
                var table = $("#tables").val();
                var max_lines = $("#max_lines").val();
                var save_button_name = $("#save_button_name").val();
                var folder_name = $("#folder_name").val();
                
                var items = new Array();

                $(".seleccionados").each(function(){
                  var checked = $(this).is(":checked");
                  if(checked){
                    var column_name = $(this).parent().parent().find(".column_name").html(); 
                    var nullable  = $(this).parent().parent().find(".nullable" ).html(); 
                    var data_type  = $(this).parent().parent().find(".data_type").html(); 
                    var max_length  = $(this).parent().parent().find(".max_length").html(); 
                    var numeric_pres  = $(this).parent().parent().find(".numeric_pres").html(); 
                    var titulo_campo  = $(this).parent().parent().find(".titulo_campo").val(); 
                    var titulo_listado  = $(this).parent().parent().find(".titulo_listado").val(); 
                    var type  = $(this).parent().parent().find(".type").val(); 
                    var required  = $(this).parent().find(".required").is(":checked"); 
                    var inline  = $(this).parent().find(".inline").is(":checked"); 

                    var obj = {
                        column_name:column_name,
                        nullable:nullable,
                        data_type:data_type,
                        max_length:max_length,
                        numeric_pres:numeric_pres,
                        titulo_campo:titulo_campo,
                        titulo_listado:titulo_listado,
                        type:type,
                        required:required,
                        inline:inline
                    };
                    items.push(obj);
                    console.log(obj); 
                  } 
                });
                var master ={
                    database:database,
                    table:table,
                    folder_name:folder_name,
                    max_lines:max_lines,
                    save_button_name:save_button_name,
                    items:items
                };
                
                console.warn("----------------Master Data-----------------");
                console.log(master);
                //master = JSON.stringify(master);
                $.ajax({
                       type: "POST",
                       url: "http://"+host+"/abm_gen/GeneratorFunctions.php",
                       data: {"action": "generarABM",master:master},
                       async: true,
                       dataType: "json",
                       beforeSend: function () {
                           $("#msg").html("<img src='images/activity.gif' width='30' height='11' >");
                       },
                       success: function (data) {    
                           $("#msg").html("Ok: "+data); 
                       }
                   });               
                }            
        </script>    
        <style>
            th{
                text-align: left;
            }
            .mlistado{
                border:1px #E5E5E5 solid;
                border-collapse:collapse;
            }
        </style>

    </head>

    <body>
        <div> 
            <input type="hidden" name="paso" value="1" />
            <table class="mformulario">
                <thead class="connect_form">
                    <tr>
                        <th colspan="2">Conectar a la base de datos</th>
                    </tr>
                </thead>
                <tr class="connect_form">
                    <th>Host:</th>
                    <td><input type="text" id="db_host" value="localhost"  />   <span id="msg"> </span></td>
                </tr>
                <tr class="connect_form">
                    <th>Usuario:</th>
                    <td><input type="text" id="db_user" value="root" /></td>
                </tr>
                <tr class="connect_form">
                    <th>Contraseña:</th>
                    <td><input type="text" id="db_pass" /></td>
                </tr>
                <tr>
                    <th>Base de Datos</th>
                    <td id="db"></td>
                </tr> 
                <tr>
                    <td colspan="2" align="right" id="barra"><input type="button" onclick="connect()" value="Conectar >" />   </td>
                </tr>
            </table> 

        </div>
        <div class="form_header" style="display:none"> 
            <label>Carpeta:</label> <input type="text" value=""  id="folder_name" size="16" > 
            <label>Max Lineas:</label> <input type="number" value="20" step="1" id="max_lines" style="width: 50px"> 
            <label>Nombre Boton Aceptar:</label> <input type="text" value="Registrar" id="save_button_name" style="text-align:center" size="10">
        </div>
        <div id='columns' style="padding-left: 10px;padding-top: 10px" ></div>
        
    </body>
</html>