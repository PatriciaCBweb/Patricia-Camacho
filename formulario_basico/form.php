
<!DOCTYPE html>
<html lang="es-Es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style type="text/css">
        span{color: red;}
    </style>
</head>

<body>
    <?php

    // DEFINIR VARIABLE y VALIDAR

    $nombre = "";
    $apellido = "";
    $email = "";
    $genero = "";
    $pais = "";
    $politica = "";
    

    $nombreErr = $apellidoErr = $emailErr = $generoErr = $paisErr = $politicaErr = "";

    if(isset($_REQUEST['nombre'])){
        $nombre = $_REQUEST['nombre'];
    }
    
    if(isset($_REQUEST['apellido'])){
        $apellido = $_REQUEST['apellido'];
    }

    if(isset($_REQUEST['email'])){
        $email = $_REQUEST['email'];
    }

    if(isset($_REQUEST['genero'])){
        $genero = $_REQUEST['genero'];
    }
    if(isset($_REQUEST['pais'])){
        $pais = $_REQUEST['pais'];
    }
    if(isset($_REQUEST['politica'])){
        $politica = $_REQUEST['politica'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_REQUEST["nombre"])){
            $nombreErr =  "* Campo obligatorio";
        }
        else{
            $nombre = test_input($_REQUEST['nombre']);
        }
        if (empty($_REQUEST["apellido"])){
            $apellidoErr =  "* Campo obligatorio";
        }
        else{
            $apellido = test_input($_REQUEST['apellido']);
        }
        if (empty($_REQUEST["email"])){
            $emailErr =  "* Campo obligatorio";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr =  "* Email no válido";
        }
        else{
            $email = test_input($_REQUEST["email"]);
        }

        if(empty($_REQUEST["genero"])){
            $generoErr = "* Campo obligatorio";
        }
        else{
            $genero = test_input($_REQUEST["genero"]);
        }
        if(empty($_REQUEST["pais"])){
            $paisErr = "* Campo obligatorio";    
        }
        else{
            $pais = test_input($_REQUEST["pais"]);
        }
        if (empty($_REQUEST["politica"])){
            $politicaErr =  "* Campo obligatorio";
        }
        else{
            $politica = test_input($_REQUEST["politica"]);
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   

    if(empty($nombre) || empty($apellido) || empty($email) || empty($politica)){
        echo "Rellena el formulario";
    }

    if(!empty($nombre) && !empty($apellido) && !empty($politica)){
        echo "Hoy es: ".date("l d-m-Y")."<br/>";
        echo "Hola, ";
        echo "$nombre $apellido<br/>";
        echo "Email: $email<br/>";
        echo "Género: $genero<br/>";
        echo "País: $pais";
    }

    
    ?>
    <hr>
    <form action="form.php" method="post" >
        <fieldset style="padding-top: 20px; margin-top: 30px;">
        <legend>Formulario</legend>
        <label>Nombre: </label>
                <input type="text" name="nombre" value="<?php echo $nombre ?>"> <span class="error"><?php echo $nombreErr; ?> </span>
        <br><br>
        <label>Apellidos: </label>
                <input type="text" name="apellido" value="<?php echo $apellido; ?>"> <span class="error"><?php echo $apellidoErr; ?> </span>
        <br><br>
        <label>Email: </label>
                <input type="text" name="email" value="<?php echo $email; ?>"> <span class="error"><?php echo $emailErr; ?> </span>
        <br><br>
        <label>Género: </label> 
                <input type="radio" name="genero" value="Femenino" <?php if($genero=="Femenino"){echo "checked";} ?>>Femenino
                <input type="radio" name="genero" value="Masculino" <?php if($genero=="Masculino"){echo "checked";} ?>>Masculino
                <input type="radio" name="genero" value="Otro" <?php if($genero=="Otro"){echo "checked";} ?>>Otro  <span class="error"><?php echo $generoErr; ?> </span>
        <br><br>
        <label>País: </label>
                <select name="pais" value="pais">
                    <option hidden></option>
                    <option value="españa" <?php if($pais=="españa"){echo "selected";} ?>>España</option>
                    <option value="portugal" <?php if($pais=="portugal"){echo "selected";} ?>>Portugal</option>
                    <option value="francia" <?php if($pais=="francia"){echo "selected";} ?>>Francia</option>
                    <option value="otro" <?php if($pais=="otro"){echo "selected";} ?>>Otro</option>
                </select> <span class="error"><?php echo $paisErr; ?> </span>

        <br><br>
        <input type="checkbox" name="politica" value="aceptar" <?php if($politica =="aceptar"){echo "checked";} ?>>He leído la <a href="#">Política de privacidad</a>  <span class="error"><?php echo $politicaErr; ?> </span>
        <br><br>
        <button type="submit" name="action"  value="calcular">Enviar</button>
        </fieldset>
        <p><a href="form.php">Volver a iniciar</a></p>
    </form> 

</body>
</html>