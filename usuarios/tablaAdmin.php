<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "controlhoras";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "CREATE TABLE Admin (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		code VARCHAR(8) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password VARCHAR(50) NOT NULL, 
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		rol VARCHAR(10),
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	  echo "Table Admin created successfully";
	} else {
	  echo "Error creating table: " . $conn->error;
	}

	$conn->close();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tabla Admin</title>
</head>

<body>
</body>
</html>