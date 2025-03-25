<?php

require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Clientes {

    private $table = 'clientes';
    private  $items = [array("column_name"=>"cod_cli","nullable"=>"NO","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cod Cli=>","titulo_listado"=>"Cod Cli","type"=>"text","required"=>"required","inline"=>"false","editable"=>"readonly","insert"=>"Yes","default"=>"","pk"=>"PRI","extra"=>""),array("column_name"=>"tipo_doc","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Tipo Doc=>","titulo_listado"=>"Tipo Doc","type"=>"text","required"=>"required","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"ci_ruc","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Ci Ruc=>","titulo_listado"=>"Ci Ruc","type"=>"text","required"=>"required","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"nombre","nullable"=>"YES","data_type"=>"varchar","max_length"=>"60","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Nombre=>","titulo_listado"=>"Nombre","type"=>"textarea","required"=>"required","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"cat","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Cat=>","titulo_listado"=>"Cat","type"=>"number","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"suc","nullable"=>"NO","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Suc=>","titulo_listado"=>"Suc","type"=>"db_select","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"sucursales=>suc,nombre","pk"=>"MUL","extra"=>""),array("column_name"=>"tel","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Tel=>","titulo_listado"=>"Tel","type"=>"text","required"=>"required","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"email","nullable"=>"YES","data_type"=>"varchar","max_length"=>"40","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Email=>","titulo_listado"=>"Email","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"fecha_nac","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Nac=>","titulo_listado"=>"Fecha Nac","type"=>"date","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"pais","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Pais=>","titulo_listado"=>"Pais","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"estado","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Estado=>","titulo_listado"=>"Estado","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"ciudad","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Ciudad=>","titulo_listado"=>"Ciudad","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"dir","nullable"=>"YES","data_type"=>"varchar","max_length"=>"60","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Dir=>","titulo_listado"=>"","type"=>"textarea","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"ocupacion","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Ocupacion=>","titulo_listado"=>"Ocupacion","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"situacion","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Situacion=>","titulo_listado"=>"Situacion","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"tipo","nullable"=>"YES","data_type"=>"varchar","max_length"=>"16","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Tipo=>","titulo_listado"=>"Tipo","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"usuario","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Usuario=>","titulo_listado"=>"Usuario","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"fecha_reg","nullable"=>"YES","data_type"=>"varchar","max_length"=>"20","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Reg=>","titulo_listado"=>"Fecha Reg","type"=>"text","required"=>"","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"","extra"=>""),array("column_name"=>"fecha_ins","nullable"=>"YES","data_type"=>"varchar","max_length"=>"20","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Ins=>","titulo_listado"=>"Fecha Ins","type"=>"text","required"=>"","inline"=>"false","editable"=>"readonly","insert"=>"Auto","default"=>"","pk"=>"","extra"=>"")];    
    private $primary_key = 'cod_cli';
    private $limit = 100;

    function __construct() {
        $action = $_REQUEST['action'];
        if (isset($action)) {
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
               $columns .= $array['column_name'].",";
            }
        }
        
        $columns = substr($columns,0, -1);
          
		
        $t = new Y_Template("Clientes.html");
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
            $t->Show("no_result");
        }
    }
    
    function addUI(){
        $tmp_con = new My();
        $t = new Y_Template("Clientes.html");
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
		  
        $t = new Y_Template("Clientes.html");
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


new Clientes();
?>
