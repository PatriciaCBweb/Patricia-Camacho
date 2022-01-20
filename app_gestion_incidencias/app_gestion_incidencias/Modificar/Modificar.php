<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modificación</title>
<link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="contenedor">
		<?php
		try{
			require_once("../Conexion_db.php");
			$sql="UPDATE INCIDENCIASVENTAS SET NUMEROINCIDENCIA=:n_inci,APARATO=:aparato,NOMBRE=:nombre,DIRECCION=:direccion,EMAIL=:email,DESCRIPCION=:descripcion,FECHA=:fecha WHERE NUMEROINCIDENCIA=:n_inci2";
			$preparada=$base->prepare($sql);
			$preparada->execute(array(":n_inci"=>$n_inci,":aparato"=>$aparato,":nombre"=>$nombre,":direccion"=>$direccion,":email"=>$email,":descripcion"=>$descripcion,":fecha"=>$fecha,":n_inci2"=>$n_inci2,));
			if($preparada->rowCount()==0){
				echo "<p>Error. No se ha podido modificar la incidencia</p>";
				echo "<p><a href='Formulario_Modificar_1.html'><input type='button' value='Atrás' /></a></p>";
			}
			else{
				echo "<p>Incidencia modificada correctamente</p>";
				echo "<p><a href='Formulario_Modificar_1.html'><input type='button' value='Modificar' /></a>&nbsp;";
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