<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../estilo_Formulario_Inicial.css" rel="stylesheet" type="text/css">
    <title>Confirmar datos</title>
</head>
<body>
    <?php
		extract($_GET);
	?>
    <div id="contenedor">
        <h2>Nueva incidencia</h2>
        <form action="save-incidencia.php" method="get">
            <table>
                <tr>
                    <td>Nº de Incidencia</td>
                    <td><input type="text" class="caja" name="n_inci" id='n_inci' maxlength='6' value="<?php echo $n_inci; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Aparato</td>
                    <td><input type="text" class="caja" name="aparato" id='aparato' maxlength='20' value="<?php echo $aparato; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" class="caja" name="nombre" id='nombre' maxlength='50' value="<?php echo $nombre; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td><input type="text" class="caja" name="direccion" id='direccion' maxlength='50' value="<?php echo $direccion; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" class="caja" name="email" id='email' maxlength='50' value="<?php echo $email; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td><input type="text" class="caja" name="descripcion" id='descripcion' value="<?php echo $descripcion; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td><input type="date" class="caja date" name="fecha" id='fecha' value="<?php echo $fecha; ?>" readonly></td>
                </tr>
                <tr>
                    <td class="botones" colspan="2"><p><a href="nueva-incidencia.html"><input type="button" value="Atrás"></a>&nbsp; <input type="submit" value="Confirmar"></p></td>     
                </tr>
            </table>
        </form>
    </div>
</body>
</html>