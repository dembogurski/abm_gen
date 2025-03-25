<?php
/*
  ---------------------------------------------------------
  | Orden_pago.class.skel    Skeleton for main clases        |
  |---------------------------------------------------------|
  | @author   Doglas A. Dembogurski <dembogurski@gmail.com> |
  | @date     february, 18 of 2018                          |
  |---------------------------------------------------------|
 
  | Instance Methods:                                       |
  | -----------------                                       |
  | mail()     Show firs 20 data rows from database         |
  |                                                         |
  | addUI()    Show User interface to add new record        |
  |                                                         |
  | editUI()   Show a edit form to modify data              |
  |                                                         |
  |                                                         |
  | updateData() method to call from editUI                 |
  |                                                         | 
  |                                                         |
  | addData()    method called from addUI                   |
  |                                                         |    
  ---------------------------------------------------------

  

  CHANGELOG

  2019 Abr 19 - added above comments
   

 */
require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Orden_pago {

    private $table = 'orden_pago';
    private  $items = [array("column_name"=>"id_orden","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Orden=>","titulo_listado"=>"Id","type"=>"number","required"=>"required","inline"=>"false","editable"=>"readonly","insert"=>"Yes","default"=>"","pk"=>"PRI","extra"=>"auto_increment"),
 array("column_name"=>"usuario","nullable"=>"NO","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Usuario=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"cod_prov","nullable"=>"NO","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cod Prov=>","titulo_listado"=>"","type"=>"db_select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"proveedores=>cod_prov,nombre","pk"=>"","extra"=>""),
 array("column_name"=>"beneficiario","nullable"=>"YES","data_type"=>"varchar","max_length"=>"140","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Beneficiario=>","titulo_listado"=>"Beneficiario","type"=>"textarea","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"nro_doc","nullable"=>"YES","data_type"=>"varchar","max_length"=>"16","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Nro Doc=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"fecha","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha=>","titulo_listado"=>"","type"=>"date","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"tipo_orden","nullable"=>"YES","data_type"=>"varchar","max_length"=>"16","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Tipo Orden=>","titulo_listado"=>"Tipo Orden","type"=>"select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"Cheque=>Cheque,Transferencia=>Transferencia","pk"=>"","extra"=>""),
 array("column_name"=>"monto_total","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Monto Total=>","titulo_listado"=>"Monto Total","type"=>"number","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"moneda","nullable"=>"NO","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Moneda=>","titulo_listado"=>"Moneda","type"=>"text","required"=>"","inline"=>"false","editable"=>"No","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"obs","nullable"=>"YES","data_type"=>"varchar","max_length"=>"120","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Obs=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"id_banco_origen","nullable"=>"YES","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Id Banco_origen=>","titulo_listado"=>"","type"=>"db_select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"bancos=>id_banco,nombre","pk"=>"","extra"=>""),
 array("column_name"=>"cuenta_origen","nullable"=>"NO","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cuenta Origen=>","titulo_listado"=>"","type"=>"db_select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"nro_cheque","nullable"=>"YES","data_type"=>"varchar","max_length"=>"20","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Nro Cheque=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"id_banco_destino","nullable"=>"YES","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Id Banco_destino=>","titulo_listado"=>"","type"=>"db_select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"bancos=>id_banco,nombre","pk"=>"","extra"=>""),
 array("column_name"=>"cuenta_destino","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cuenta Destino=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"cbu","nullable"=>"YES","data_type"=>"varchar","max_length"=>"50","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cbu=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"nro_comprobante","nullable"=>"YES","data_type"=>"varchar","max_length"=>"100","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Nro Comprobante=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"url_comprobante","nullable"=>"YES","data_type"=>"varchar","max_length"=>"256","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Url Comprobante=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"estado","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Estado=>","titulo_listado"=>"Estado","type"=>"select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"Pendiente=>Pendiente,Aprobada=>Aprobada,Pagada=>Pagada","pk"=>"","extra"=>""),
 array("column_name"=>"aprobado_por","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Aprobado Por=>","titulo_listado"=>"","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"No","default"=>"","pk"=>"","extra"=>""),
 array("column_name"=>"fecha_aprobacion","nullable"=>"YES","data_type"=>"datetime","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Aprobacion=>","titulo_listado"=>"","type"=>"datetime-local","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"No","default"=>"","pk"=>"","extra"=>"")];    
    private $primary_key = 'id_orden';
    private $limit = 100;

    function __construct() {
        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
            $this->{$action}();
        } else {
            $this->main();
        }
    }

    function main() {
        
	    $columns = "";
        foreach ($this->items as $array){ 
            $titulo_listado = $array['titulo_listado'];
            
            if($titulo_listado !== ''){ 
                $data_type =  $array['data_type'];
                if($data_type == "date"){
                    $colname = $array['column_name'];
                    $columns .= "DATE_FORMAT($colname,'%d-%m-%Y') as $colname,";
                }else{
                    $columns .= $array['column_name'].",";   
                }                
            }
        }
        
        $columns = substr($columns,0, -1);
          
		
        $t = new Y_Template("Orden_pago.html");
        $t->Show("headers");
	$t->Show("insert_edit_form");// Empty div to load here  formulary for edit or new register 	  
        $db = new My();     
        $Qry = "SELECT  $columns FROM  $this->table LIMIT $this->limit"; 
        $db->Query($Qry);

        if ($db->NumRows() > 0) {
            $t->Show("data_header");
            while ($db->NextRecord()) {
                
               foreach ($this->items as $array){
                  $column_name = $array['column_name'];
                  $dec = $array['dec'];
                  
                  $value = $db->Record[$column_name];
                  
                  if($dec > 0 ){
                      $t->Set($column_name, number_format($value, $dec, ',', '.'));
                  }else{
                     $t->Set($column_name, $value);             
                  }
               }                

               $t->Show("data_line");
            }
            $t->Show("data_foot");
		 
            
	    $t->Show("script");
        } else {
			$t->Show("headers");
			$t->Show("data_header");
			$t->Show("data_foot");
			$t->Show("script");
            $t->Show("no_result");
        }
    }
    
    function addUI(){
        $tmp_con = new My();
        $t = new Y_Template("Orden_pago.html");
        $t->Show("add_form_cab");
         
           foreach ($this->items as $array => $arr) {           
             $column_name = $arr['column_name'];
             $insert = $arr['insert'];
             $type = $arr['type'];
             $dec = $arr['dec'];
             
             
             //echo "$column_name $insert<br>";
             
             if($insert === 'Yes'){
                  
                if($type == "db_select"){
                    $db_options = "\n";
                    $default = $arr['default'];
                    list($tablename,$columns) = explode("=>",$default);        
                    $query = "SELECT $columns FROM $tablename"; 
                    $tmp_con->Query($query);
                    $col_array = explode(",",$columns);
                    while($tmp_con->NextRecord()){ 
                        $key = "";
                        $values = "";
                        for($i = 0; $i < sizeof($col_array); $i++){
                          if($i == 0){
                             $key = $tmp_con->Record[ $col_array[$i] ];
                          }else{ 
                              $values .= $tmp_con->Record[ $col_array[$i] ]." ";
                          } 
                        }
                        $values = trim($values);
                        $db_options.='<option value="'.$key.'">'.$values.'</option>'."\n";
                    }                        
                    $t->Set("value_of_".$column_name,$db_options);
                }                
                
             }
           }
               
        $t->Show("add_form_data");
        $t->Show("add_form_foot");         
    }
    

    /**
     * Edit current line
     */
    function editUI(){
        $pk = $_REQUEST['pk'];
        
        $columns = "";
          
        foreach ($this->items as $array => $arr) {           
           $columns .= $arr['column_name'].",";          
        }        
        $columns = substr($columns,0, -1);
        
        $db = new My(); 
        $tmp_con = new My();
		  
        $t = new Y_Template("Orden_pago.html");
        //$t->Show("headers");        
        $Qry = "SELECT $columns FROM $this->table WHERE  $this->primary_key = '$pk'";
        $db->Query($Qry);
       
        $t->Show("edit_form_cab");
        while ($db->NextRecord()) { 
           foreach ($this->items as $array => $arr) {           
             $column_name = $arr['column_name'];
             $editable = $arr['editable'];
             $type = $arr['type'];
             $dec = $arr['dec'];
             //$sub_pk = $arr['pk'];
             
             if($editable !== 'No'){
                $value = $db->Record[$column_name]; 
                 
                if($type == "db_select"){
                    $db_options = "\n";
                    $default = $arr['default'];
                    list($tablename,$columns) = explode("=>",$default);        
                    $query = "SELECT $columns FROM $tablename"; 
                    $tmp_con->Query($query);
                    $col_array = explode(",",$columns);
                    while($tmp_con->NextRecord()){ 
                        $key = "";
                        $values = "";
                        $selected = "";
                        for($i = 0; $i < sizeof($col_array); $i++){
                          if($i == 0){
                             $key = $tmp_con->Record[ $col_array[$i] ];
                             if($key == $value){
                                  $selected = 'selected="selected"';
                             }
                                 
                          }else{  
                              $values .= $tmp_con->Record[ $col_array[$i] ]." ";
                          } 
                        }
                        $values = trim($values);
                        $db_options.='<option value="'.$key.'"  '.$selected.'  >'.$values.'</option>'."\n";
                    }                        
                    $t->Set("value_of_".$column_name,$db_options);
                }else if($type == "select"){
                    $value = $db->Record[$column_name];  
                    $def_options= $arr['default'];   
                    $items = explode(",",$def_options);
                    $options = "";
                   
                    foreach($items as $item){
                       list($val,$opt) = explode("=>",$item);
                       $selected = "";
                       if($val == $value){    
                           $selected = 'selected="selected"';
                       }
                       $options .= '<option value="'.$val.'" '.$selected.' >'.$opt.'</option>';
                    }
                    $t->Set("value_of_".$column_name,$options);
                    
                }else{
                   if($dec > 0){
                       $t->Set("value_of_".$column_name,number_format($value, $dec, ',', '.'));
                   }else{
                       $t->Set("value_of_".$column_name,$value);
                   }                        
                }
                                
                
             }
           }
        }         
        $t->Show("edit_form_data");
        $t->Show("edit_form_foot");  
 
    }


    function updateData() {
       $master = $_REQUEST['master'];        
       $table = $this->table;        
       
       $primary_keys = $master['primary_keys'];
       $update_data = $master['update_data'];
       
       $update = "";
        
       foreach ($update_data as $key => $value) {
           foreach ($this->items as $arr) {
              if($arr["column_name"] == $key){
                 if($this->isCharOrNumber( $arr["data_type"]) == "number" ){
                     if($value != ''){
                        $update .=" $key = $value,";       
                     }
                 }else{
                    $update .=" $key = '$value',";      
                 }
              }    
           }            
       }
       $update = substr($update, 0,-1);
       
       $where = " ";
       foreach ($primary_keys as $key => $value) {
           $where .=" $key = '$value' AND";       
       }
       $where = substr($where, 0,-4);
       
       $Qry = "UPDATE $table SET $update WHERE $where;";
       
       //echo $Qry;
       
       $my = new My();
       $my->Query($Qry);
       if($my->AffectedRows() > 0){
           echo json_encode(array("mensaje"=>"Ok"));
       }else{
           echo json_encode(array("mensaje"=>"Error","query"=>$Qry));
       }           
       $my->Close();      
       
    }
    
    function addData(){
       $master = $_REQUEST['master'];        
       $table = $this->table;        
       
       $data = $master['data'];
       $colnames = "";
       $insert_vlues = "";
        
       foreach ($data as $key => $value) {
           foreach ($this->items as $arr) {
              if($arr["column_name"] == $key){
                 $colnames .="$key,";   
                 if($this->isCharOrNumber( $arr["data_type"]) == "number" ){
                     if($value != ''){    
                        $insert_vlues .="$value,";  
                     }else{
                        $insert_vlues .="null,";
                     }
                 }else{
                   $insert_vlues .="'$value',";  
                 }
              }    
           }            
       }
       $colnames = substr($colnames, 0,-1);
       $insert_vlues = substr($insert_vlues, 0,-1);
        
       
       $Qry = "INSERT INTO $table ($colnames) VALUES($insert_vlues);";
       
       //echo $Qry;
       
       $my = new My();
       $my->Query($Qry);
       if($my->AffectedRows() > 0){
           echo json_encode(array("mensaje"=>"Ok"));
       }           
       $my->Close();         
    }
    
    function isCharOrNumber($data_type){
        $numerics = array("int","decimal","double","float","smallint","tinyint","bigint");
        if (in_array($data_type, $numerics)) {
            return "number";
        }else{
            return "char";
        }        
    }

}


new Orden_pago();
?>
