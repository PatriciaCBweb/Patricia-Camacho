<?php
	session_start();

//FORMATO FECHA
    date_default_timezone_set('europe/gibraltar');	

//Si no se dió a finalizar, seguimos teniendo las sesiones de fecha y hora de entrada
	if(isset($_SESSION["f_fecha"]) && isset($_SESSION["h_entrada"])){
		
//Conexión a la base de datos solo si no se dió a finalizar		   
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "fichar";

//Conexión
		$conn = new mysqli($servername,$username,$password,$dbname);

//Comprobar conexión
		if($conn->connect_error){
			die("Error en la conexión: ".$conn->connect_error);
		}
		
//Variables
		$salir = date("G:i:s");
		$fecha_entrada = $_SESSION["f_fecha"];
		$hora_entrada = $_SESSION["h_entrada"];
		$idempleado = $_SESSION["idempleado"];
		
		$sql = "UPDATE inicio_fin_sesion SET salida='$salir' WHERE idempleado='$idempleado' AND entrada='$hora_entrada' AND dia='$fecha_entrada'";
		
		if($conn->query($sql) === TRUE){
			session_destroy();
			header("location: index_login.php");
		}
		else{
			echo "Error: ".$sql."</br>".$conn->error;
		}
	}
	else{
		session_destroy();
		header("location: index_login.php");
	}
	





//que modifique la columna de salida si cierras session sin haberle dado al boton de salir
?>
