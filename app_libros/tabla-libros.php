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
		$dbname = "app_libros";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// CREAR TABLA
		// FILA, NOMBRE, TIPO DE DATO, NULO/NO NULO, AUTOINCREMENTO, KEY... 
		$sql = "CREATE TABLE libros (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			usuario VARCHAR(30) NOT NULL,
			libro VARCHAR(100) NOT NULL,
			n_autor VARCHAR(50) NOT NULL,
            ap_autor VARCHAR(50) NOT NULL,
            coleccion VARCHAR(50) NOT NULL
		)";
		
		if ($conn->query($sql) === TRUE) {
		  echo "Tabla libros creada con éxito";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>