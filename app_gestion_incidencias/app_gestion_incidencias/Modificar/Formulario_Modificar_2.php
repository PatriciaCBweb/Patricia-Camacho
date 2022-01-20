<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modificar Incidencia</title>
<link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="contenedor">
		<h2>Modificar incidencia</h2>
		<?php
		try{
			require_once("../Conexion_db.php");
			$sql="SELECT * FROM INCIDENCIASVENTAS WHERE NUMEROINCIDENCIA=:n_inci";
			$preparada=$base->prepare($sql);
			$preparada->execute(array(":n_inci"=>$n_inci));
			while($fila=$preparada->fetch(PDO::FETCH_ASSOC)){
				echo "<form method='get' action='Formulario_Confirmar_Modificar.php'>";
				echo "<table>";
				echo "<tr>";
				echo "<td>Nº Incidencia</td>";
				echo "<td><input type='text' class='caja' name='n_inci' id='n_inci' maxlength='6' value='".$fila["NUMEROINCIDENCIA"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Aparato</td>";
				echo "<td><input type='text' class='caja' name='aparato' id='aparato' maxlength='20' value='".$fila["APARATO"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Nombre</td>";
				echo "<td><input type='text' class='caja' name='nombre' id='nombre' maxlength='50' value='".$fila["NOMBRE"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Dirección</td>";
				echo "<td><input type='text' class='caja' name='direccion' id='direccion' maxlength='50' value='".$fila["DIRECCION"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Email</td>";
				echo "<td><input type='text' class='caja' name='email' id='email' maxlength='50' value='".$fila["EMAIL"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Descripción</td>";
				echo "<td><input type='text' class='caja' name='descripcion' id='descripcion' value='".$fila["DESCRIPCION"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Fecha</td>";
				echo "<td><input type='date' class='caja date' name='fecha' id='fecha' value='".$fila["FECHA"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td><input type='hidden' name='n_inci2' id='n_inci2' maxlength='6' value='".$fila["NUMEROINCIDENCIA"]."' /></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class='botones' colspan='2'><p><a href='Formulario_Modificar_1.html'><input type='button' value='Atrás' /></a>&nbsp; <input type='submit' value='Modificar' /></p></td>";
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