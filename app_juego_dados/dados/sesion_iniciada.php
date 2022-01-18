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
	</style>
</head>

<body>
	<?php
		
//Bienvenida
		if(isset($_SESSION["nm"])){
			$welcome = "Bienvenido/a, ".$_SESSION["nm"];
		}
		else{
			$welcome = "Bienvenido/a invitado/a";
		}
	
//Créditos
		if(isset($_SESSION["nm"])){
			$nm = $_SESSION["nm"];

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dados";

			$conn = new mysqli($servername,$username,$password,$dbname);

			if($conn->connect_error){
				die("Error en la conexión: ".$conn->connect_error);
			}

			$sql = "SELECT * FROM usuarios WHERE USUARIO='$nm'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_assoc($result);
			$credito = $row['CREDITOS'];
		}
		else{
			$credito = 10;
		}

	?>
	<div>
		<h1><?php echo $welcome ?></h1>
	<h2>¿Quieres jugar?</h2>
		<form method="post" action="dados2.php">
			<h2>Crédito actual: <?php echo $credito ?></h2>
			<input type="text" name="credit" value="<?php echo $credito ?>" hidden/>
			<button type="submit" name="send1">Lanzar dados</button>
		</form>
	</div>
</body>
</html>