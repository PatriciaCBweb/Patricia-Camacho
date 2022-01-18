<?php
	session_start();

	$ml = NULL;
	$psw = NULL;
	$pswCod = NULL;
	$warning = NULL;

	if(isset($_REQUEST['ml'])){
		$ml = test_input($_REQUEST['ml']);
	}

	if(isset($_REQUEST['psw'])){
		$psw = test_input($_REQUEST['psw']);
		$pswCod = convert_uuencode($psw);
	}
	
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
//Filtros email y contraseña
		if(empty($ml) || empty($psw)){
			$warning = "Rellena email y password";
		}

		elseif(!filter_var($ml,FILTER_VALIDATE_EMAIL)){
			$warning = "Email no válido";
		}
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dados";

//Conexión a la BS
		$conn = new mysqli($servername,$username,$password,$dbname);
		
//Comprobación conexión		
		if($conn->connect_error){
			die("Error en la conexión: ".$conn->connect_error);
		}
//Consulta
		if(!empty($ml) && !empty($psw)){
			$sql = "SELECT * FROM usuarios WHERE EMAIL='$ml'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_assoc($result);

			if(strcasecmp($ml,$row['EMAIL'])==0){
				if(strcasecmp($ml,$row['EMAIL'])==0 && strcmp($pswCod,$row['CONTRASENA'])==0){
					header("location: sesion_iniciada.php");
					$_SESSION["nm"] = $row["USUARIO"];
					if($_REQUEST["remember"] == "rememberMe"){
						setcookie("login",$ml,time(),"/");
					}
				}

				else{
					$warning = "Contraseña incorrecta";
				}
			}
			else{
				$warning = "Usuario no registrado.";
			}
		}
	
		$conn->close();
	}		
		
		
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<style type="text/css">
		form{
			max-width: 200px;
			margin: 35px auto 15px auto;
		}
		p{
			margin-bottom: 5px;
		}
		.text{
			max-width: 195px;
			width: 100%;
			height: 15px;
			padding: 7px;
		}
		.button{
			text-align: center;
		}
		#a{
			text-align: center;
		}
		a{
			text-decoration: none;
			color: black;
		}
	</style>
</head>

<body>
	<form method="post" action="iniciar.php">
		<p><label for="ml">Email</label></p><input type="text" id="ml" name="ml" class="text"/>
		<p><label for="psw">Contraseña</p></label><input type="password" id="psw" name="psw" class="text"/>
		<p class="button"><input type="checkbox" value="rememberMe" name="remember"> Recuérdame</p>
		<p class="button"><button type="submit">Iniciar sesión</button></p>
	</form>
	<p id="a"><button><a href="index.php">Inicio</a></button></p>
</body>
</html>