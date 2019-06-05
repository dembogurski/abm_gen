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
                        data: "action=get_databases&user="+user+"&pass="+pass+"",
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
                        data: "action=get_tables&db="+db+"&user="+user+"&pass="+pass+"",
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){
                            $("#msg").html("<img src='images/activity.gif' width='30' height='11' >");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){ 
                                $("#tables_sp"  ).html(objeto.responseText );  
                                $("#msg"  ).html("");  $("#barra"  ).html("");  
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
                        data: "action=get_columns&db="+db+"&table="+table+"&user="+user+"&pass="+pass+"",
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
                        data: "action=get_element_attributes&type="+type,
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
                       $("#titulo_campo_"+column_name).val(column_name_rem);
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
            }  
             
            function selectType(){
                
            }
            function generarABM(){
                
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
        <div id='columns' style="padding-left: 10px;padding-top: 10px" ></div>
        
    </body>
</html>