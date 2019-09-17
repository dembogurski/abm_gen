<?php

require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Asientos {

    private $table = 'asientos';
    private  $items = [array("column_name"=>"id_asiento","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Asiento=>","titulo_listado"=>"Id Asiento","type"=>"number","required"=>"false","inline"=>"false"),array("column_name"=>"fecha","nullable"=>"YES","data_type"=>"date","max_length"=>"","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Fecha=>","titulo_listado"=>"Fecha","type"=>"date","required"=>"false","inline"=>"false"),array("column_name"=>"usuario","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Usuario=>","titulo_listado"=>"Usuario","type"=>"text","required"=>"false","inline"=>"false"),array("column_name"=>"id_frac","nullable"=>"YES","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Frac=>","titulo_listado"=>"Id Frac","type"=>"number","required"=>"false","inline"=>"false"),array("column_name"=>"e_sap","nullable"=>"YES","data_type"=>"tinyint","max_length"=>"","numeric_pres"=>"3","dec"=>"","titulo_campo"=>"E Sap=>","titulo_listado"=>"E Sap","type"=>"","required"=>"false","inline"=>"false"),array("column_name"=>"descrip","nullable"=>"YES","data_type"=>"varchar","max_length"=>"254","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Descrip=>","titulo_listado"=>"Descrip","type"=>"text","required"=>"false","inline"=>"false"),array("column_name"=>"identif","nullable"=>"YES","data_type"=>"varchar","max_length"=>"200","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Identif=>","titulo_listado"=>"Identif","type"=>"text","required"=>"false","inline"=>"false")];
    private $limit = 20;
    

    function __construct() {
        $action = $_REQUEST['action'];
        if (function_exists($action)) {
            call_user_func($action);
        } else {
            $this->main();
        }
    }

    function main() {
        echo getcwd();
	$columns = "";
        foreach ($this->items as $array){
            $columns .= $array['column_name'].",";
        }
        
        $columns = substr($columns,0, -1);
        
        //echo $columns;
		
		
        $t = new Y_Template("Asientos.html");
        $t->Show("headers");
         
        $db = new My();     
         
               
        $rem = 'SELECT  '.$columns.' FROM '.$this->table.' LIMIT '.$this->limit.'';     
        
        //$rem = "SELECT cuenta FROM bcos_ctas ";
        
        //echo "Database ". $db->Database;
        $db->Query($rem);
 
        if ( $db->NumRows() > 0) {
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
        } else {
            $t->Show("no_result");
        } 
    }

}

function register() {
    
}

function update() {
    
}

new Asientos();
?>
