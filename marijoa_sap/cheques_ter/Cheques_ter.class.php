<?php

require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Cheques_ter {

    private $table = 'cheques_ter';
    private  $items = [array("column_name"=>"id_cheque","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Cheque=>","titulo_listado"=>"Id Cheque","type"=>"number","required"=>"false","inline"=>"false","editable"=>"readonly","insert"=>"Auto","default"=>"","pk"=>"PRI"),array("column_name"=>"nro_cheque","nullable"=>"NO","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Nro Cheque=>","titulo_listado"=>"Nro Cheque","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"PRI"),array("column_name"=>"id_banco","nullable"=>"NO","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Id Banco=>","titulo_listado"=>"Id Banco","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"PRI"),array("column_name"=>"f_nro","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"F Nro=>","titulo_listado"=>"F Nro","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"MUL"),array("column_name"=>"trans_num","nullable"=>"NO","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Trans Num=>","titulo_listado"=>"Trans Num","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"PRI"),array("column_name"=>"id_concepto","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Concepto=>","titulo_listado"=>"Id Concepto","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"MUL"),array("column_name"=>"cuenta","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cuenta=>","titulo_listado"=>"Cuenta","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"fecha_ins","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Ins=>","titulo_listado"=>"Fecha Ins","type"=>"date","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"fecha_emis","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Emis=>","titulo_listado"=>"Fecha Emis","type"=>"date","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"fecha_pago","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha Pago=>","titulo_listado"=>"Fecha Pago","type"=>"date","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"benef","nullable"=>"YES","data_type"=>"varchar","max_length"=>"80","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Benef=>","titulo_listado"=>"Benef","type"=>"textarea","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"suc","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Suc=>","titulo_listado"=>"Suc","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"valor","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Valor=>","titulo_listado"=>"Valor","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"m_cod","nullable"=>"NO","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"M Cod=>","titulo_listado"=>"M Cod","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"MUL"),array("column_name"=>"cotiz","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"8","dec"=>"2","titulo_campo"=>"Cotiz=>","titulo_listado"=>"Cotiz","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"valor_ref","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Valor Ref=>","titulo_listado"=>"Valor Ref","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"motivo_anul","nullable"=>"YES","data_type"=>"varchar","max_length"=>"200","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Motivo Anul=>","titulo_listado"=>"Motivo Anul","type"=>"textarea","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"estado","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Estado=>","titulo_listado"=>"Estado","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"fecha","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha=>","titulo_listado"=>"Fecha","type"=>"date","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"hora","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Hora=>","titulo_listado"=>"Hora","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"tipo","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Tipo=>","titulo_listado"=>"Tipo","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"recibido_admin","nullable"=>"YES","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Recibido Admin=>","titulo_listado"=>"Recibido Admin","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"recibido_ger","nullable"=>"YES","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Recibido Ger=>","titulo_listado"=>"Recibido Ger","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"entrega","nullable"=>"YES","data_type"=>"varchar","max_length"=>"4","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Entrega=>","titulo_listado"=>"Entrega","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>""),array("column_name"=>"e_sap","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"3","dec"=>"0","titulo_campo"=>"E Sap=>","titulo_listado"=>"E Sap","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"","pk"=>"")];    
    private $primary_key = 'id_cheque';
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
          
		
        $t = new Y_Template("Cheques_ter.html");
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
    
    /**
     * Register a new row
     */
    function register() {
    
    }

    /**
     * Edit current line
     */
    function editUI(){
        $pk = $_REQUEST['pk'];
      
        $this->primary_key;
        
        $columns = "";
         
        
        foreach ($this->items as $array => $arr) {           
           $columns .= $arr['column_name'].",";          
        }        
        $columns = substr($columns,0, -1);
        
        $db = new My(); 
        $tmp_con = new My();
		  
        $t = new Y_Template("Cheques_ter.html");
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
                        for($i = 0; $i < sizeof($col_array); $i++){
                          if($i == 0){
                             $key = $tmp_con->Record[ $col_array[$i] ];
                          }else{ //echo "$i ".$col_array[$i]."<br>"; 
                              $values .= $tmp_con->Record[ $col_array[$i] ]." ";
                          } 
                        }
                        $values = trim($values);
                        $db_options.='<option value="'.$key.'">'.$values.'</option>'."\n";
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
        
        //$tmp_con->Close();
        //$db->Close();
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
           echo json_encode(array("mensaje"=>"Error"));
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


new Cheques_ter();
?>
