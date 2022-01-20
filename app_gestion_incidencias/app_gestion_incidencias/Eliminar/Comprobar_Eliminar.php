<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Comprobar Eliminar</title>
<link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="contenedor">
	<h2>Confirmar eliminación de incidencia</h2>
	<?php
		try{
			require_once("../Conexion_db.php");
			$sql="SELECT * FROM INCIDENCIASVENTAS WHERE NUMEROINCIDENCIA=:n_inci";
			$preparada=$base->prepare($sql);
			$preparada->execute(array(":n_inci"=>$n_inci));
			while($fila=$preparada->fetch(PDO::FETCH_ASSOC)){
				echo "<form method='get' action='Eliminar.php'>";
				echo "<table>";
				echo "<tr>";
				echo "<td>Nº Incidencia</td>";
				echo "<td><input type='text' class='caja' name='n_inci' id='n_inci' maxlength='6' value='".$fila["NUMEROINCIDENCIA"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Aparato</td>";
				echo "<td><input type='text' class='caja' name='aparato' id='aparato' maxlength='20' value='".$fila["APARATO"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Nombre</td>";
				echo "<td><input type='text' class='caja' name='nombre' id='nombre' maxlength='50' value='".$fila["NOMBRE"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Dirección</td>";
				echo "<td><input type='text' class='caja' name='direccion' id='direccion' maxlength='50' value='".$fila["DIRECCION"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Email</td>";
				echo "<td><input type='text' class='caja' name='email' id='email' maxlength='50' value='".$fila["EMAIL"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Descripción</td>";
				echo "<td><input type='text' class='caja' name='descripcion' id='descripcion' value='".$fila["DESCRIPCION"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Fecha</td>";
				echo "<td><input type='date' class='caja' name='fecha' id='fecha' value='".$fila["FECHA"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td><input type='hidden' name='n_inci2' id='n_inci2' maxlength='6' value='".$fila["NUMEROINCIDENCIA"]."' readonly /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan='2' class='botones'><p><a href='Formulario_Eliminar.html'><input type='button' value='Atrás' /></a> <input type='submit' value='Eliminar' /></p></td>";
				echo "</tr>";
				echo "</table>";
				echo"</form>";
			}
			
			$preparada->closeCursor();
		}catch(Exception $e){
			die($e->getMessage());
		}
	?>
	</div>
</body>
</html>