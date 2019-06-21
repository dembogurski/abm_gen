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
        . "<span><input type='button' value='Generar' id='generar' onclick='generarABM()' style='display:none'></span>";
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

    $db->Query("SELECT  COLUMN_NAME, IS_NULLABLE, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION  FROM information_schema.COLUMNS c WHERE   TABLE_SCHEMA LIKE '$database_name' AND TABLE_NAME LIKE '$table_name'  ");


    $t->Show("cabecera");

    while ($db->NextRecord()) {
        $id = $db->Record['COLUMN_NAME'];
        $isn = $db->Record['IS_NULLABLE'];
        $dt = $db->Record['DATA_TYPE'];
        $cml = $db->Record['CHARACTER_MAXIMUM_LENGTH'];
        $np = $db->Record['NUMERIC_PRECISION'];

        $t->Set('id', $id);
        $t->Set('isn', $isn);
        $t->Set('dt', $dt);
        $t->Set('cml', $cml);
        $t->Set('np', $np);
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
    $max_lines = $master["max_lines"];
    $save_button_name = $master["save_button_name"];
    $items = $master['items'];

    createProject($database);
    
    $work_path = "$database/$folder_name";
    
    @mkdir($work_path, 0755);
    
    /** Create List .php  file
     *  Create List  html template file
     *  Create Form .php file 
     *  Create Form  html template file
     */
    
    
    
    /*
      echo " database: $database  table: $table  max_lines : $max_lines   save_button_name: $save_button_name<br><br>";
      echo "<br>";
      foreach ($items as $key => $value) {
      foreach ($value as $k  => $v  ) {
      echo "$k   -->  $v <br>";
      }
      echo "<br>";
      } */
}

function createProject($name) {
    try {
        @mkdir($name, 0755);
        @mkdir($name.'/logs', 0755);
        // Clonar Clase Config.class.php
        
        if(!file_exists($name.'/Config.class.php')){
            $Config = file_get_contents("skeletons/Config.class.skel");
            //Set de database name
            $Config = str_replace('const DB_NAME        = "";', 'const DB_NAME        = "' . $name . '";', $Config);
            file_put_contents($name.'/Config.class.php', $Config);
        }
        // Copio los demas Archivos necesarios
        copyFile('Logger.class.php', "$name");
        copyFile('Y_DB_MySQL.class.php', "$name");
        copyFile('Y_Template.class.php', "$name");
    } catch (Exception $ex) {
        echo "Error al crear directorio: $ex ".__FILE__." line ".__LINE__;
    }
}

function copyFile($file, $project) {
    if(!file_exists("$project/$file")){
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

