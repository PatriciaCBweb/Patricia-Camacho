<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Crear tabla inicio fin de sesión</title>
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
		$sql = "CREATE TABLE inicio_fin_sesion (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			idempleado INT(10) NOT NULL,
			proyecto VARCHAR(30) NOT NULL,
			dia DATE NOT NULL,
            entrada TIME NOT NULL,
            salida TIME NOT NULL,
			comentario VARCHAR(160) NOT NULL
		)";
		
		

		if ($conn->query($sql) === TRUE) {
		  echo "Table inicio_fin_sesion created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>