<?php

require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Articulos_x_temp {

    private $table = 'articulos_x_temp';
    private  $items = [array("column_name"=>"suc","nullable"=>"NO","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Suc=>","titulo_listado"=>"Suc","type"=>"text","required"=>"false","inline"=>"false","editable"=>"readonly","insert"=>"Auto"),array("column_name"=>"estante","nullable"=>"NO","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Estante=>","titulo_listado"=>"Estante","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"temporada","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Temporada=>","titulo_listado"=>"Temporada","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"codigo","nullable"=>"NO","data_type"=>"varchar","max_length"=>"16","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Codigo=>","titulo_listado"=>"Codigo","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"fila","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Fila=>","titulo_listado"=>"Fila","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"col","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Col=>","titulo_listado"=>"Col","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"um","nullable"=>"NO","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Um=>","titulo_listado"=>"Um","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"capacidad","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Capacidad=>","titulo_listado"=>"Capacidad","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"piezas","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Piezas=>","titulo_listado"=>"Piezas","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"usuario","nullable"=>"YES","data_type"=>"varchar","max_length"=>"20","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Usuario=>","titulo_listado"=>"Usuario","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes"),array("column_name"=>"fecha","nullable"=>"YES","data_type"=>"datetime","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha=>","titulo_listado"=>"Fecha","type"=>"datetime-local","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes")];    
    private $primary_key = 'suc';
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
          
		
        $t = new Y_Template("Articulos_x_temp.html");
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
		
        $t = new Y_Template("Articulos_x_temp.html");
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


new Articulos_x_temp();
?>
