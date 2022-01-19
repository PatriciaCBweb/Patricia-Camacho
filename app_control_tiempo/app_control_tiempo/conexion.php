<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fichar";
	date_default_timezone_set('europe/gibraltar');

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
?>