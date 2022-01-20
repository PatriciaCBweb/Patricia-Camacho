<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Confirmar Modificación</title>
<link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="contenedor">
		<h2>Confirmar modificación</h2>
		<?php
		extract($_GET);
		?>
		<form method="get" action="Modificar.php">
			<table>
				<tr>
					<td>Nº Incidencia</td>
					<td><input type="text" class='caja' name="n_inci" id="n_inci" maxlength="6" value="<?php echo $n_inci; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Aparato</td>
					<td><input type="text" class='caja' name="aparato" id="aparato" maxlength="20" value="<?php echo $aparato; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Nombre</td>
					<td><input type="text" class='caja' name="nombre" id="nombre" maxlength="50" value="<?php echo $nombre; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Dirección</td>
					<td><input type="text" class='caja' name="direccion" id="direccion" maxlength="50" value="<?php echo $direccion; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" class='caja' name="email" id="email" maxlength="50" value="<?php echo $email; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Descripción</td>
					<td><input type="text" class='caja' name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Fecha</td>
					<td><input type="date" class='caja' name="fecha" id="fecha" value="<?php echo $fecha; ?>" readonly /></td>
				</tr>
				<tr>
					<td><input type="hidden" name="n_inci2" id="n_inci2" maxlength="6" value="<?php echo $n_inci; ?>" readonly /></td>
				<tr>
					<td class="botones" colspan="2"><p><a href="Formulario_Modificar_1.html"><input type="button" value="Atrás" /></a> &nbsp;<input type="submit" value="Modificar" /></p></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>