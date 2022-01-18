<?php
	//Sesión
	session_start();

    //Conexion
    include_once "conexion.php";

	//Variables
	$usuario = NULL;

	if(isset($_REQUEST['usu'])){
		$usuario = $_REQUEST['usu'];
	}

	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } 

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>Nuevo usuario</title>
</head>

<body>
    <div class="container-i">
        <div class="index_container">
            <form method="post" action="new-user.php"> 
                <div class="input_search_index">
                    <label for="usuario" class="label">Nombre</label><input type="text" name="usu">
                    <button class="search_button">Registrar</button>
                </div>
            </form>
            <a href="index.php"><button class="search_button">Volver a Inicio</button></a>
        </div>
    </div>
</body>
</html>

<?php

	if($_SERVER["REQUEST_METHOD"] =="POST"){
		if(!empty($usuario)){
			$usuario = test_input($_REQUEST["usu"]);
			
			$sql = "INSERT INTO usuarios(user)
                    VALUES ('$usuario')";
			
            if ($conn->query($sql) === TRUE) {
                echo "Usuario guardado.<br>";
				$_SESSION['usuario'] = $usuario;
                echo "<a href='book-list.php'><button>Ir a la lista</button></a> ";
                echo "<a href='index.php'><button>Inicio</button></a>";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
        }
        else{
            echo "Rellene el nombre de usuario";
        }
	}	
?>