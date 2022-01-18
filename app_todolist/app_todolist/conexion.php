<?php
    // Variables de conexion
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "app_todolist";

    // Conectar
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprobar conexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>