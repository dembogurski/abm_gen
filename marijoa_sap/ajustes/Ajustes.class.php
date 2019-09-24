<?php

require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Ajustes {

    private $table = 'ajustes';
    private  $items = [array("column_name"=>"id_ajuste","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Ajuste=>","titulo_listado"=>"Id Ajuste","type"=>"number","required"=>"false","inline"=>"false","editable"=>"readonly","insert"=>"Auto"),array("column_name"=>"usuario","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Usuario=>","titulo_listado"=>"Usuario","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"f_nro","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"F Nro=>","titulo_listado"=>"F Nro","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"codigo","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Codigo=>","titulo_listado"=>"Codigo","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"lote","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Lote=>","titulo_listado"=>"Lote","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"tipo","nullable"=>"YES","data_type"=>"varchar","max_length"=>"60","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Tipo=>","titulo_listado"=>"Tipo","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"signo","nullable"=>"YES","data_type"=>"varchar","max_length"=>"2","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Signo=>","titulo_listado"=>"Signo","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"inicial","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"0","titulo_campo"=>"Inicial=>","titulo_listado"=>"Inicial","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"ajuste","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Ajuste=>","titulo_listado"=>"Ajuste","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"final","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"0","titulo_campo"=>"Final=>","titulo_listado"=>"Final","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"p_costo","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"P Costo=>","titulo_listado"=>"P Costo","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"motivo","nullable"=>"YES","data_type"=>"varchar","max_length"=>"100","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Motivo=>","titulo_listado"=>"Motivo","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"fecha","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha=>","titulo_listado"=>"Fecha","type"=>"date","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"hora","nullable"=>"YES","data_type"=>"varchar","max_length"=>"12","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Hora=>","titulo_listado"=>"Hora","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"um","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Um=>","titulo_listado"=>"Um","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"estado","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Estado=>","titulo_listado"=>"Estado","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"verificado_por","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Verificado Por=>","titulo_listado"=>"Verificado Por","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"verif_hora","nullable"=>"YES","data_type"=>"datetime","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Verif Hora=>","titulo_listado"=>"Verif Hora","type"=>"datetime-local","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"valor_ajuste","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Valor Ajuste=>","titulo_listado"=>"Valor Ajuste","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"suc","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Suc=>","titulo_listado"=>"Suc","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"e_sap","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"3","dec"=>"0","titulo_campo"=>"E Sap=>","titulo_listado"=>"E Sap","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes")];    
    private $primary_key = 'id_ajuste';
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
          
		
        $t = new Y_Template("Ajustes.html");
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
		
        $t = new Y_Template("Ajustes.html");
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
             if($editable !== 'No'){
                $value = $db->Record[$column_name]; 
                
                // echo "$column_name : $value<br>";
                
                if($type == "number"){
                    $t->Set("value_of_".$column_name,number_format($value, $dec, ',', '.'));
                }else{
                    $t->Set("value_of_".$column_name,$value);
                }                
                
             }
           }
        }         
        $t->Show("edit_form_data");
        $t->Show("edit_form_foot");  
        
    }


    function update() {

    }

}


new Ajustes();
?>
