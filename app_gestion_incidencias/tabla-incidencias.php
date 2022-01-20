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
		$dbname = "movilessa";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// CREAR TABLA
		// FILA, NOMBRE, TIPO DE DATO, NULO/NO NULO, AUTOINCREMENTO, KEY... 
		$sql = "CREATE TABLE INCIDENCIASVENTAS (
			NUMEROINCIDENCIA VARCHAR(6) PRIMARY KEY, 
			APARATO VARCHAR(20) NOT NULL,
			NOMBRE VARCHAR(50) NOT NULL,
			DIRECCION VARCHAR(50) NOT NULL,
            EMAIL VARCHAR(50) NOT NULL,
            DESCRIPCION TEXT NOT NULL,
			FECHA DATE
		)";
		
		if ($conn->query($sql) === TRUE) {
		  echo "Tabla INCIDENCIASVENTAS creada con éxito";
		} else {
		  echo "Error creating table: " . $conn->error;
		}

		$conn->close();
	?>
</body>
</html>