<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dados</title>
	<style type="text/css">
		div{
			width: 500px;
			text-align: center;
			margin: auto;
		}
		button a{
			color: black; 
			text-decoration: none;
		}
		#a{
			text-align: center;
		}
	</style>
</head>

<body>
	<div>
	<h1>¿Quieres volver a jugar?</h1>
		<form method="post" action="dados2.php">
			
				<?php
			// QUEDA MIN 1 TIRADA
					if(($_SESSION["credit"]+$_SESSION["premio"]) > 0){
						echo "<h2>Crédito actual: ".($_SESSION["credit"]+=$_SESSION["premio"])."</h2>";
						echo "<input type='text' name='credit' value='".$_SESSION['credit']."' hidden/>";
						echo "<button type='submit' name='send1'>Volver a jugar</button>";
					}
			// CERO CRÉDITOS
					else{
						echo "<h2>Crédito actual: insuficiente</h2>";
						echo "<button type='button' ><a href='index.php'>Volver a iniciar</a></button>";
					}
				?>
		</form>
		<br/>
		<form method="post" action="volver.php">
			<button type="submit" name="exit" value="exit">Salir</button>
		</form>
	</div>
</body>
</html>

<?php
//Guarda los créditos en la bbdd
	if(isset($_SESSION["nm"])){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dados";

		// CONECTAR
		$conn = new mysqli($servername, $username, $password, $dbname);

		// ACTUALIZAR / MODIFICAR DATOS DE TABLA
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$credito = $_SESSION['credit'];
		$user = $_SESSION['nm'];

		$sql = "UPDATE usuarios SET CREDITOS='$credito' WHERE USUARIO='$user'";

			if ($conn->query($sql) === TRUE) {
			  "Record updated successfully";
			} else {
			  echo "Error updating record: " . $conn->error;
			}
			$conn->close();
	}

//Cerrar sesión y salir
	if(isset($_REQUEST["exit"]) && $_REQUEST["exit"] == "exit"){
		if(isset($_SESSION["nm"])){
			unset($_SESSION["nm"]);
		}
		header("location: index.php");
	}
?>

