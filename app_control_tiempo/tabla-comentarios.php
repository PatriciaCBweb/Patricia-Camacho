<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Crear tabla comentarios</title>
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
		$sql = "CREATE TABLE comentarios (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			idempleado INT(10) NOT NULL,
			proyecto VARCHAR(30) NOT NULL,
			comentario VARCHAR(160),
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		
		

		if ($conn->query($sql) === TRUE) {
		  echo "Table comentarios created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>