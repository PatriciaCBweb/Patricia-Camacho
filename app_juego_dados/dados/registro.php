<?php
	$nm = NULL;
	$ml = NULL;
	$psw = NULL;
	$hidden = NULL;
	$hidden2 = "hidden";
	$msg = NULL;

//Variables
	if(isset($_POST["nm"])){
		$nm = test_input($_POST["nm"]);
	}
	if(isset($_POST["ml"])){
		$ml = test_input($_POST["ml"]);
	}
	if(isset($_POST["psw"])){
		$psw = test_input($_POST["psw"]);
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){

//Filtros
		if(empty($nm) || empty($ml) || empty($psw)){
			$warning = "Formulario incompleto";
		}
		elseif(!filter_var($ml,FILTER_VALIDATE_EMAIL)){
			$warning = "Email no válido";
		}

//Conexión
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dados";
		
		$conn = new mysqli($servername,$username,$password,$dbname);
		
//Comprobar conexión
		if($conn->connect_error){
			die("Error en la conexión: ".$conn->connect_error);
		}

// Filtro usuario repetido
		if(!empty($nm) && !empty($ml) && !empty($psw)){
			$pswCod = convert_uuencode($psw);
			
			$sql = "SELECT USUARIO FROM usuarios";
			$result = mysqli_query($conn,$sql);
			
				while($row = $result->fetch_assoc()){
				if(strcasecmp($row['USUARIO'],$nm)==0){
					$msg = "Nombre de usuario no disponible";
				}
				else{
					$sql2 = "INSERT INTO usuarios (USUARIO, EMAIL, CONTRASENA,CREDITOS) VALUES ('$nm','$ml','$pswCod','10')";
					$result2 = mysqli_query($conn,$sql2);
					if($result2 == false){
						$msg = "Error en el registro";
					}
					else{
						$hidden = "hidden";
						$hidden2 = NULL;
						$msg = "<p class='button'>Registro realizado con éxito</p>";
					}
				}
			}
			
		$conn->close();
		}
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
		input{
			max-width: 195px;
			width: 100%;
			height: 15px;
			padding: 7px;
		}
		.button{
			text-align: center;
		}
		.a{
			text-align: center;
		}
		a{
			text-decoration: none;
			color: black;
		}
	</style>
</head>

<body>
	<form method="post" action="registro.php">
		<p ><label for="nm">Nombre</label></p><input type="text" id="nm" name="nm"/>
		<p><label for="ml">Email</label></p><input type="text" id="ml" name="ml"/>
		<p><label for="psw">Contraseña</p></label><input type="password" id="psw" name="psw"/>
		<p class="button"><button type="submit" <?php echo $hidden ?>>Registrarse</button></p>
		<?php echo $msg?>
	</form>
	<p class="a" <?php echo $hidden2 ?>><button><a href="iniciar.php">Iniciar sesión</a></button></p>
	<p class="a"><button><a href="index.php">Inicio</a></button></p>
</body>
</html>
