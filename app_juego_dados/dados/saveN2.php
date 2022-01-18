<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tu número</title>
	<style>
		#win{text-align: center;}
	</style>

<?php
	
?>
	
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	
	<?php
		echo "<h1>Tu tirada</h1>";
	
		echo "<h2 id='credito'>";
	
	
	// 0 CRÉDITOS
			if($_SESSION["credit"]<=0){
				$_REQUEST["saveN_dado1"]=1;
				$_REQUEST["saveN_dado2"]=2;
				$_REQUEST["saveN_dado3"]=3;
				$_REQUEST["saveN_dado4"]=4;
				$_REQUEST["saveN_dado5"]=5;
				echo "Crédito actual: ".$_SESSION["credit"];
			}
	// QUEDAN CRÉDITOS	
			else{
		// NO HEMOS VUELTO A TIRAR
				if(isset($_REQUEST["saveN_dado1"]) && isset($_REQUEST["saveN_dado2"]) && isset($_REQUEST["saveN_dado3"]) && isset($_REQUEST["saveN_dado4"]) && isset($_REQUEST["saveN_dado5"])){
					echo "Crédito actual: ".$_SESSION["credit"];
				}
		// NUEVA TIRADA
				else{
					echo "Crédito actual: ".$_SESSION["credit"]-= 1;
				}
			}

		echo "</h2>";
	
		echo "<div class='container'>";
		
			echo "<div id='dadosC'>";
	
				for($d=1;$d<=5;$d++){

				// NUEVA TIRADA DE DADOS
					echo "<div id='dado$d' class='dado'>";
						if(!isset($_REQUEST["saveN_dado$d"])){
							$newNumber1 = rand(1,6);
							echo "<h2>Nuevo lanzamiento de dado</h2>";
							echo "<img src='img/dados/$newNumber1.jpg' alt='dado $newNumber1'/>";
							echo "<p class='position'>Posición $d: $newNumber1</p>";
							$tirada[$d] = $newNumber1;
						}
				// DADOS GUARDADOS
						else{
							$myNumber1 = $_REQUEST["numero_dado$d"];
							echo "<h2>Dado guardado</h2>";
							echo "<img src='img/dados/$myNumber1.jpg' alt='dado $myNumber1'/>";
							echo "<p class='position'>Posición $d: $myNumber1</p>";
							$tirada[$d] = $myNumber1;
						}
					echo "</div>";
				}
	
	// ARRAY CON LOS RESULTADOS DE LOS DADOS -->  $tirada
		
			echo "<br/>";
	
			echo "</div>";

		echo "</div>";
	
	
	// PREMIOS
		$str_tirada = implode($tirada)."<br/>"; // STRING DE RESULTADO DE DADOS

		$pareja = 1; //PAREJA (2)
		$doblePareja = 2; //DOBLE PAREJA (2+2)
		$trio = 3; //TRIO (3)
		$full = 5; //FUL (3+2)
		$poker = 10; //POKER (4)
		$repoker = 15; //REPOKER (5)

		for ($i=1;$i<=6;$i++){	// 6 CARAS DEL DADO
			$repeticiones[$i] = substr_count($str_tirada,$i);  // ARRAY REPETICIONES DE CADA NÚMERO	
		}
	
		$str_repeticiones = implode($repeticiones); // STRING REPETICIONES DE CADA NÚMERO
	
	// BUSCAMOS PREMIOS. UN Nº PUEDE REPETIRSE 2, 3, 4 Y 5 VECES
		$dos = substr_count($str_repeticiones,2,0,6);  //  2 IGUALES ?
		$tres = substr_count($str_repeticiones,3,0,6);//  3 IGUALES ?
		$cuatro = substr_count($str_repeticiones,4,0,6);//  4 IGUALES ?
	 	$cinco = substr_count($str_repeticiones,5,0,6);//  5 IGUALES ?

	// PUNTOS SEGÚN REPETICIONES
		if($dos == 1 && $tres != 1){
			$premio1 = $pareja;
		}
		else{
			$premio1 = 0;
		}

		if($dos == 2){
			$premio2 = $doblePareja;
		}
		else{
			$premio2 = 0;
		}
		if($tres == 1 && $dos != 1){
			$premio3 = $trio;
		}
		else{
			$premio3 = 0;
		}
		if($dos == 1 && $tres == 1){
			$premio4 = $full;
		}
		else{
			$premio4 = 0;
		}
		if($cuatro == 1){
			$premio5 = $poker;
		}
		else{
			$premio5 = 0;
		}
		if($cinco == 1){
			$premio6 = $repoker;
		}
		else{
			$premio6 = 0;
		}

		$premioFinal = $premio1 + $premio2 + $premio3 + $premio4 + $premio5 + $premio6; // TOTAL

	// TOTAL GANADO
		echo "<h2 id='win'>Has ganado: ".$premioFinal." crédito(s)</h2>";
	
		$_SESSION["premio"] = $premioFinal; // OTRA SESIÓN CON EL PREMIO. DESPUÉS SUMAMOS A LA ANTERIOR
	
	// FINALIZAR PARTIDA
		echo "<p id='send'><button name='send'><a id='volver' href='volver.php'>Finalizar partida</a></button></p>";
				
	?>
	
	<br/><br/>
	<table border="1">
		<tr>
			<th colspan="2">Tabla de premios</th>
		</tr>
		<tr>
			<td>Pareja</td>
			<td>1 punto</td>
		</tr>
		<tr>
			<td>Doble Pareja</td>
			<td>2 puntos</td>
		</tr>
		<tr>
			<td>Trío</td>
			<td>3 puntos</td>
		</tr>
		<tr>
			<td>Full</td>
			<td>5 puntos</td>
		</tr>
		<tr>
			<td>Poker</td>
			<td>10 puntos</td>
		</tr>
		<tr>
			<td>Repoker</td>
			<td>15 puntos</td>
		</tr>
	</table>

</body>
</html>