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
		$dbname = "dados";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// CREAR TABLA
		// FILA, NOMBRE, TIPO DE DATO, NULO/NO NULO, AUTOINCREMENTO, KEY... 
		$sql = "CREATE TABLE usuarios (
			ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			USUARIO VARCHAR(140) NOT NULL,
			EMAIL VARCHAR(30) NOT NULL,
			CONTRASENA VARCHAR(30) NOT NULL,
            CREDITOS INT(6) NOT NULL,
			DATE_REG TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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