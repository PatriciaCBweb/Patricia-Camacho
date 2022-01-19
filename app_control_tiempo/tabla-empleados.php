<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Crear tabla empleados</title>
</head>

<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "fichar";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// CREAR TABLA
		// FILA, NOMBRE, TIPO DE DATO, NULO/NO NULO, AUTOINCREMENTO, KEY... 
		$sql = "CREATE TABLE empleados (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			idempleado INT(10) NOT NULL,
			nombre VARCHAR(30) NOT NULL,
			apellido VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            telefono INT(9) NOT NULL,
			rol VARCHAR(20) NOT NULL
		)";
		
		

		if ($conn->query($sql) === TRUE) {
		  echo "Table empleados created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>