<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Crear tabla</title>
</head>

<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "app_todolist";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// CREAR TABLA
		// FILA, NOMBRE, TIPO DE DATO, NULO/NO NULO, AUTOINCREMENTO, KEY... 
		$sql = "CREATE TABLE tareas (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			tarea VARCHAR(140) NOT NULL,
			estado VARCHAR(10) NOT NULL,
			creacion DATETIME NOT NULL,
            inicio DATETIME NOT NULL,
			fin DATETIME NOT NULL
		)";
		
		if ($conn->query($sql) === TRUE) {
		  echo "Tabla tareas creada con éxito";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>