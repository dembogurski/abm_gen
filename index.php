<html>
    <head>
        <script src="js/jquery_2.1.0.js"></script>


        <script language="javascript">
            
             var db = null;
             var table =null;
             var host = null;
             var user =null;
             var pass =null;
            
            
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
                            }
                        }
                    });                  
                
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
                            }
                        }
                    }); 
            }
            
            function getAttributes(id){  
              // var type = $("#types_"+id+" option:selected").text();
              var type = $("#types_"+id ).val(); alert(type);
                
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
            
            $(function(){
               $(".seleccionados").click(function(){
                   var v = $(this).is(":checked");
                   if(v){
                       
                   }else{
                       
                   }
               });
            });
  
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
        <div >


            <input type="hidden" name="paso" value="1" />
            <table class="mformulario">
                <thead>
                    <tr>
                        <th colspan="2">Conectar a la base de datos</th>
                    </tr>
                </thead>
                <tr>
                    <th>Host:</th>
                    <td><input type="text" id="db_host" value="localhost"  />   <span id="msg"> </span></td>
                </tr>
                <tr>
                    <th>Usuario:</th>
                    <td><input type="text" id="db_user" value="root" /></td>
                </tr>
                <tr>
                    <th>Contrase�a:</th>
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