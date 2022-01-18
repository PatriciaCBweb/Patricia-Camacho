<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucle aleatorio Checkbox</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h1><a href="dados2.php">Lanza los dados</a></h1>
	<h2 id="credito">Crédito actual: 
		<?php echo $_SESSION["credit"] = ($_REQUEST["credit"]-1) ?>
	</h2>
    <div class="container">
        <form method="post" action="saveN2.php" id="form_index">
			<div id="dadosC">
				<?php 
					
				// SOLO PODEMOS HACER 1 TIRADA
					if($_SESSION["credit"] == 0){
						$msgError = "Sin créditos. Check para continuar";
					}
					else{
						$msgError = "";
					}
				// TIRADA 1
					for($d=1;$d<=5;$d++){
						echo "<div class='dado'>";
							echo "<h2>Dado ".$d."</h2>";
							$random = rand(1,6); 
							echo "<img src='img/dados/$random.jpg' alt='dado $random'/>";
							echo "<input type='text' name='numero_dado$d' value='$random' hidden/>";
							echo "<p><input type='checkbox' id='$d' name='saveN_dado$d' value='aceptar' /> Guardar tirada</p><p>$msgError</p>";
							
						echo "</div>";
					}
			?>
				
			</div>
			
			<?php
						
				echo "<p id='send'><button type='submit' name='send' onkeyup='send()' >Enviar</button></p>";
					
			?>
				
				
			

        </form> 
    </div>
	
</body>
</html>
