<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
    <title>Guardado</title>
</head>
<body>
    <div id="contenedor">
		<?php
		try{
			require_once("../Conexion_db.php");
			$sql="INSERT INTO incidenciasventas (NUMEROINCIDENCIA,APARATO,NOMBRE,DIRECCION,EMAIL,DESCRIPCION,FECHA) VALUES (:n_inci,:aparato,:nombre,:direccion,:email,:descripcion,:fecha)";
			$preparada=$base->prepare($sql);
			$preparada->execute(array(":n_inci"=>$n_inci,":aparato"=>$aparato,":nombre"=>$nombre,":direccion"=>$direccion,":email"=>$email,":descripcion"=>$descripcion,":fecha"=>$fecha));
			if($preparada->rowCount()==0){
				echo "<p>Error. No se ha podido crear la incidencia</p>";
				echo "<p><a href='nueva-incidencia.html'><input type='button' value='Atrás' /></a></p>";
			}
			else{
				echo "<p>Incidencia creada correctamente</p>";
				echo "<p><a href='nueva-incidencia.html'><input type='button' value='Nueva' /></a>&nbsp;";
				echo "<a href='../index.html'><input type='button' value='Inicio' /></a></p>";
			}
			$preparada->closeCursor();
			}catch(Exception $e){
				die($e->getMessage());
		}
		?>
	</div>
</body>
</html>