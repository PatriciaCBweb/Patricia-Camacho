<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar</title>
<link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="contenedor">
		<?php
		try{
			require_once("../Conexion_db.php");
			$sql="DELETE FROM INCIDENCIASVENTAS WHERE NUMEROINCIDENCIA=:n_inci";
			$preparada=$base->prepare($sql);
			$preparada->execute(array(":n_inci"=>$n_inci2));
			if($preparada->rowCount()==0){
				echo "<p>No se ha podido eliminar el producto</p>";
				echo "<p><a href='Formulario_Eliminar.html'><input type='button' value='Atrás'</a></p>";
			}
			else{
				echo "<p>Incidencia eliminada correctamente</p>";
				echo "<p><a href='Formulario_Eliminar.html'><input type='button' value='Eliminar'</a>&nbsp;";
				echo "<a href='../index.html'><input type='button' value='Inicio'</a></p>";
			}
			$preparada->closeCursor();
		}catch(Exception $e){
			die($e->getMessage());
		}
		?>
	</div>
</body>
</html>