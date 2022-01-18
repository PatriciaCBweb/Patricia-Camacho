<?php

$id_modify = NULL;
$newtask = NULL;

if(isset($_REQUEST["id_modify"])){
    $id_modify = $_REQUEST["id_modify"];
}

if(isset($_REQUEST["newtask"])){
    $newtask = $_REQUEST["newtask"];
}

if(isset($id_modify) && !empty($newtask)){

    include_once "conexion.php";
    $sql = "UPDATE tareas SET tarea='$newtask' WHERE id='$id_modify'";
    if ($conn->query($sql) === TRUE) {
        echo "Tarea modificada";
        header("location: index.php?option=1");
        die();
    } else {
    echo "Error updating record: " . $conn->error;
    }

}











/*
//Variables

$modif = NULL;
$tarea = NULL;
$tarea2 = NULL;

if(isset($_REQUEST['modif'])){
    $modif = $_REQUEST['modif'];
}

if(isset($_REQUEST['tarea'])){
    $tarea = $_REQUEST['tarea'];
}

if(isset($_REQUEST['tarea2'])){
    $tarea2 = $_REQUEST['tarea2'];
}

//Formulario modificar
if(isset($modif)){
    //  header ("location: modificar.php");
    echo "Has pulsado modificar";
    echo $tarea;
    echo "<form method='post' action='modificar.php'>";
        echo "<input type='text' name='tarea_modificada'>";
        echo "<button name='boton_modificada'>Modificar</button>";
    echo "</form>";

    //Variables formulario modificar
    $tarea_modificada = NULL;

    if(isset($_REQUEST['tarea_modificada'])){
        $tarea_modificada = $_REQUEST['tarea_modificada'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($tarea_modificada)){
            //Conexion
            include_once 'conexion.php';

            $sql = "UPDATE tareas SET tarea='$tarea_modificada' WHERE id='$tarea2'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                echo "<a href='lista_tareas.php'>Volver a tareas</a>";

            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }


}
*/

?>