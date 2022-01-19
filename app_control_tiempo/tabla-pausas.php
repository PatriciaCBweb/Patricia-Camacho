<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Crear tabla pausas</title>
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
		$sql = "CREATE TABLE pausas (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			idempleado INT(10) NOT NULL,
			proyecto VARCHAR(30) NOT NULL,
			fecha DATE NOT NULL,
            pausa TIME NOT NULL,
            reanudar TIME NOT NULL
		)";
		
		

		if ($conn->query($sql) === TRUE) {
		  echo "Table pausas created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>