<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// CONECTAR
	$conn = new mysqli($servername, $username, $password);

	// COMPROBAR CONEXIÓN
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// CREAR BASE DE DATOS
	$sql = "CREATE DATABASE controlHoras";  // NUEVA BASE DE DATOS => myDB
	if ($conn->query($sql) === TRUE) {
	  echo "Base de datos creada con éxito";
	} else {
	  echo "Error al crear base de datos: " . $conn->error;
	}

	$conn->close();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
</body>
</html>