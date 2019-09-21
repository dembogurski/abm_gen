<?php

include_once ( "Y_DB_MySQL.class.php" );

class GeneratorFunctions {

    function __construct() {
        if ($action = $_REQUEST['action']) {
            if (function_exists($action)) {
                call_user_func($action);
            } else {
                echo "Funcion $action no declarada...";
            }
        }
    }

}

function getIP() {
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
            return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
        } else {
            return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
        }
    }
}

function getDatabases() {

    $user = $_REQUEST['user'];
    $pass = $_REQUEST['pass'];

    $db = new My();
    $db->User = $user;
    $db->Password = $pass;
    $db->Database = "";
    try {
        $db->Query("show databases");

        echo '<select id="databases" onchange="getDBTables()">';
        echo "<option value='Seleccione'>Seleccione</option>";
        while ($db->NextRecord()) {
            $data = $db->Record['Database'];
            echo "<option value='$data'>$data</option>";
        }
        echo '</select>';
        echo "<span id='tables_sp'></span> <span>"
        . "<input type='button' id='hide_button' value='-' onclick='showHideDBForm()'></span>&nbsp;&nbsp;"
        . "<span><input type='button' value='Generar' id='generar' onclick='generarABM()' style='display:none'> "
                . "<input type='button' value='Ver ABM' id='verABM' onclick='verABM()' style='display:none'>"
                . "</span>";
    } catch (Exception $e) {
        echo "No se puede conectar, Usuario u Contrase&ntilde;a incorrectos...";
    }
}

function getTables() {

    $user = $_REQUEST['user'];
    $pass = $_REQUEST['pass'];
    $database_name = $_REQUEST['db'];

    $db = new My();
    $db->User = $user;
    $db->Password = $pass;

    $db->Query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA LIKE '$database_name' ");
    echo '<label>&nbsp;<b>Tabla:</b>&nbsp;</label>  <select id="tables" onchange="getColumns()">';
    echo "<option value='Seleccione'>Seleccione  la Tabla</option>";
    while ($db->NextRecord()) {
        $table = $db->Record['TABLE_NAME'];
        echo "<option value='$table'>$table</option>";
    }
    echo '</select>';
}

function getColumns() {

    require_once('Y_Template.class.php');
    $t = new Y_Template("GeneratorFunctions.html");
    $user = $_REQUEST['user'];
    $pass = $_REQUEST['pass'];
    $database_name = $_REQUEST['db'];
    $table_name = $_REQUEST['table'];

    $db = new My();
    $db->User = $user;
    $db->Password = $pass;

    $db->Query("SELECT  COLUMN_NAME, IS_NULLABLE, if(DATA_TYPE = 'tinyint', 'int', DATA_TYPE) as DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, COLUMN_KEY  FROM information_schema.COLUMNS c WHERE   TABLE_SCHEMA LIKE '$database_name' AND TABLE_NAME LIKE '$table_name'  ");


    $t->Show("cabecera");

    while ($db->NextRecord()) {
        $id = $db->Record['COLUMN_NAME'];
        $isn = $db->Record['IS_NULLABLE'];
        $dt = $db->Record['DATA_TYPE'];
        $cml = $db->Record['CHARACTER_MAXIMUM_LENGTH'];
        $np = $db->Record['NUMERIC_PRECISION'];
        $ck = $db->Record['COLUMN_KEY'];
        
        if($ck != ""){
            $ck = " $ck";
        }
        
        $t->Set('id', $id);
        $t->Set('isn', $isn);
        $t->Set('dt', $dt);
        $t->Set('cml', $cml);
        $t->Set('np', $np);
        $t->Set('ck', $ck);
        $t->Show("datos");
        // echo  "<tr> <td><input type='checkbox' name='seleccionados' value='id' /></td> <td>$cn</td>  <td>$isn</td> <td>$dt</td>  <td>$cml</td>  <td>$np</td>";
    }
    $t->Show("fin");
}

// Load Attributes from a JSON file
function getElementAttributes() {
    $type = $_REQUEST['type'];
    echo $type;
}

function generarABM() {
    $master = $_REQUEST['master'];
    $database = $master["database"];
    $table = $master["table"];
    $folder_name = $master["folder_name"];
    $default_lines = $master["default_lines"];
    $save_button_name = $master["save_button_name"];
    $items = $master['items'];
    $primary_key = $master['primary_key'];

    createProject($database);

    $work_path = "$database/$folder_name";

    @mkdir($work_path, 0755);

    /** Create List .php  file
     *  Create List  html template file
     *  Create Form .php file 
     *  Create Form  html template file
     */
    
    
    $table_headers = "";
    $table_data =    ""; 
    foreach ($items as $array => $arr) { 
         $column_name = $arr['column_name'];
         $titulo_listado = $arr['titulo_listado'];
         if($titulo_listado !== ''){ 
            $table_headers .="<th>$titulo_listado</th>"; 
            $table_data .="<td>-|$column_name|-</td> "; 
         } 
    }
    $table_headers .="<th></th>"; 
    $table_data .='<td class="itemc"><img class="edit" src="../img/edit.png" onclick=editUI("{'.$primary_key.'}") ></td> '; 
        
    $table_data = str_replace("-|", "{", $table_data);
    $table_data = str_replace("|-", "}", $table_data);
    //$table_data = str_replace("primary_key", $primary_key, $table_data);
    
     
    
    $ClassName = ucfirst($table);
       
    
    $class = file_get_contents("skeletons/ClassName.class.skel");
    $class = str_replace('ClassName', $ClassName , $class);
    
    $class = str_replace('table = null;',"table = '$table';" , $class); // Limit
    $class = str_replace('primary_key = null;',"primary_key = '$primary_key';" , $class); // Limit
       
    $lista = json_encode($items);
    $lista = str_replace(":", "=>", $lista);
    $lista = str_replace("{", "array(", $lista);
    $lista = str_replace("}", ")", $lista);
    $class = str_replace('$items = null;',' $items = '.$lista.";"  , $class);
    file_put_contents($work_path . "/$ClassName.class.php", $class);
    
    // Create Template File
    $tamplate = file_get_contents("skeletons/Template.html");
    $tamplate = str_replace("ClassName", "$ClassName" , $tamplate);     
    $tamplate = str_replace("table_headers", "$table_headers", $tamplate);
    $tamplate = str_replace("table_data", "$table_data", $tamplate);
    $tamplate = str_replace("table_name", "$table", $tamplate);
    
    $form_rows = createEditableForm($ClassName,$items);
    $tamplate = str_replace("form_rows", "$form_rows", $tamplate);
    
    file_put_contents($work_path . "/$ClassName.html", $tamplate); 
    
    // Create js File
    $js = file_get_contents("skeletons/ClassName.js");
    $js = str_replace('ClassName', $ClassName , $js);
    $js = str_replace("table_name", "$table", $js);
    $js = str_replace('"pageLength": 20','"pageLength": '.$default_lines.'', $js); 
    file_put_contents($work_path . "/$ClassName.js", $js); 
    
    // Create css File
    
    $css = file_get_contents("skeletons/ClassName.css");
    $css = str_replace("table_name", "$table", $css);
    file_put_contents($work_path . "/$ClassName.css", $css); 
    
    echo json_encode(array("ABM Generado en $table/$ClassName.class.php"));
    
}

function createEditableForm($ClassName,$items){
    $form_rows = "";
    foreach ($items as $array => $arr) { 
         $titulo_campo = $arr['titulo_campo'];
         $column_name = $arr['column_name'];
         $editable = $arr['editable'];
         //$editable = $arr['editable'];
         $type = $arr['type'];
         $max_length = $arr['max_length'];
         
         if($editable !== 'No'){ 
             $readonly = "";  
            if($editable == "readonly"){  
                $readonly = 'readonly="readonly"';
            } 
            
            if($max_length == ""){
                $max_length = $arr['numeric_pres'];
            }
            
            $size = "";            
            if($type ===  "text"  || $type === "number"){
                $size = 'size="'.$max_length.'"';      
            }
            $visual_type = $type;
            if($type === "number"){
               $visual_type = "text";
            }
            
            $id = 'id="form_'.$column_name.'"';
            
            $input = '<input class="form_'.$type.'" type="'.$visual_type.'" '.$id.'  '.$readonly.' '.$size.' value="{value_of_'.$column_name.'}" >'; 
            if($type === "textarea"){
                $input = '<textarea class="form_'.$type.'" '.$id.' cols="20" rows="3" '.$readonly.' ></textarea>';
            }                
                
            
            $form_rows .= '<tr> <td class="form_label">'.$titulo_campo.'</td> <td>'.$input.'</td>  </tr>'."\n";  
         } 
    }
    return $form_rows;   
}

function createProject($name) { //echo getcwd();
    try {
        @mkdir($name, 0755);
        @mkdir($name . '/logs', 0755);
        // Clonar Clase Config.class.php

        if (!file_exists($name . '/Config.class.php')) {
            $Config = file_get_contents("skeletons/Config.class.skel");
            //Set de database name
            $Config = str_replace('const DB_NAME        = "";', 'const DB_NAME        = "' . $name . '";', $Config);
            file_put_contents($name . '/Config.class.php', $Config);
        }
        // Copio los demas Archivos necesarios
        copyFile('Logger.class.php', "$name");
        //copyFile('skeletons/Y_DB_MySQL.class.php', "$name");
        copyFile('Y_Template.class.php', "$name");
        
        if (!copy('skeletons/Y_DB_MySQL.class.php', "$name/Y_DB_MySQL.class.php")) {
            echo "Error al copiar $name/Y_DB_MySQL.class.php...\n";
        }
        
    } catch (Exception $ex) {
        echo "Error al crear directorio: $ex " . __FILE__ . " line " . __LINE__;
    }
}

 

function copyFile($file, $project) {
    if (!file_exists("$project/$file")) {
        if (!copy($file, "$project/$file")) {
            echo "Error al copiar $project/$file...\n";
        }
    }
}

function deleteDir($dirPath) {
    array_map('unlink', glob("$dirPath/*.*"));
    rmdir($dirPath);
}

new GeneratorFunctions();
?>    

