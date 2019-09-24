<?php

require_once("../Y_Template.class.php");
require_once("../Y_DB_MySQL.class.php");

/**
 * Description of Audit
 *
 * @author Doglas
 */
class Asientos_det {

    private $table = 'asientos_det';
    private  $items = [array("column_name"=>"id_asiento","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Asiento=>","titulo_listado"=>"Id Asiento","type"=>"number","required"=>"false","inline"=>"false","editable"=>"readonly","insert"=>"Auto","default"=>""),array("column_name"=>"id_det","nullable"=>"NO","data_type"=>"int","max_length"=>"","numeric_pres"=>"10","dec"=>"0","titulo_campo"=>"Id Det=>","titulo_listado"=>"Id Det","type"=>"select","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"clave=>valor,clave2=>valor2"),array("column_name"=>"cuenta","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Cuenta=>","titulo_listado"=>"Cuenta","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>""),array("column_name"=>"nombre_cuenta","nullable"=>"YES","data_type"=>"varchar","max_length"=>"30","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Nombre Cuenta=>","titulo_listado"=>"Nombre Cuenta","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>""),array("column_name"=>"debe","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Debe=>","titulo_listado"=>"Debe","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>""),array("column_name"=>"haber","nullable"=>"YES","data_type"=>"decimal","max_length"=>"","numeric_pres"=>"16","dec"=>"2","titulo_campo"=>"Haber=>","titulo_listado"=>"Haber","type"=>"number","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>""),array("column_name"=>"suc","nullable"=>"YES","data_type"=>"varchar","max_length"=>"10","numeric_pres"=>"","dec"=>"","titulo_campo"=>"Suc=>","titulo_listado"=>"Suc","type"=>"text","required"=>"false","inline"=>"false","editable"=>"Yes","insert"=>"Yes","default"=>"")];    
    private $primary_key = 'id_asiento';
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
          
		
        $t = new Y_Template("Asientos_det.html");
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
		
        $t = new Y_Template("Asientos_det.html");
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


new Asientos_det();
?>
