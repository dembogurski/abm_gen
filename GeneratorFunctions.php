<?php

class GeneratorFunctions {

    function __construct() {
        $action = $_REQUEST['action'];
        switch ($action) {
            case '': $this->home();
                break;
            case 'home': $this->home();
                break;
            case 'get_databases': $this->getDatabases();
                break;
            case 'get_tables': $this->getTables();
                break;
            case 'get_columns': $this->getColumns();
                break;
            case 'get_element_attributes': $this->getElementAttributes();
                break;
             
            default : $this->home();
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
        include_once ( "Y_DB.class.php" );
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];

        $db = new Y_DB();
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
        include_once ( "Y_DB.class.php" );
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];
        $database_name = $_REQUEST['db'];

        $db = new Y_DB();
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
        include_once ( "Y_DB.class.php" );
        require_once('Y_Template.class.php');
        $t = new Y_Template("GeneratorFunctions.html");
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];
        $database_name = $_REQUEST['db'];
        $table_name = $_REQUEST['table'];

        $db = new Y_DB();
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
    function getElementAttributes(){
        $type = $db->Record['type'];        
        echo  $type;
    }

}

new GeneratorFunctions();
?>    

