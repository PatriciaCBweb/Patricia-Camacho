<?php

	//Sesión
	session_start();

    //Conexion
    include_once "conexion.php";

    //Variables
    $lib = $n_aut = $ap_aut = $col = $usuario = NULL;

    if(isset($_REQUEST['lib'])){
        $lib = $_REQUEST['lib'];
    }

    if(isset($_REQUEST['n_aut'])){
        $n_aut = $_REQUEST['n_aut'];
    }

    if(isset($_REQUEST['ap_aut'])){
        $ap_aut = $_REQUEST['ap_aut'];
    }

    if(isset($_REQUEST['col'])){
        $col = $_REQUEST['col'];
    }

	if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $lib = test_input($_REQUEST['lib']);
        $n_aut = test_input($_REQUEST['n_aut']);
        $ap_aut = test_input($_REQUEST['ap_aut']);
        $col = test_input($_REQUEST['col']);
    }

	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>Nueva entrada</title>
</head>
<body>
    <div class="container-i">
        <div class="index_container newbook">
            <form method="post" action="new-book.php">
                <div class="input_search_index"><label for="libro" class="label">Libro: </label><input type="text" name="lib" placeholder="Libro"></div>
                <div class="input_search_index"><label for="coleccion" class="label">Colección: </label><input type="text" name="col" placeholder="Colección"></div>
                <div class="input_search_index"><label for="autor" class="label">Autor: </label><input type="text" name="n_aut" placeholder="Nombre"><input type="text" name="ap_aut" placeholder="Apellidos"></div>
                <button class="search_button">Guardar</button>
            </form>
            <a href="book-list.php" class="index_button"><button>Volver</button></a>
        </div>
    
</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] =="POST"){
		if(!empty($lib)){
			$lib = test_input($_REQUEST["lib"]);
		}
		if(!empty($n_aut)){
			$n_aut = test_input($_REQUEST["n_aut"]);
		}
        if(!empty($ap_aut)){
			$ap_aut = test_input($_REQUEST["ap_aut"]);
		}
		if(!empty($col)){
			$col = test_input($_REQUEST["col"]);
		}
	
        if(!empty($lib) || !empty($aut)){

                echo "<br>";
                echo "<div class='index_container newbook'>";
                $sql2 = "INSERT INTO libros(usuario,libro,n_autor,ap_autor,coleccion)
                        VALUES ('$usuario','$lib','$n_aut','$ap_aut','$col')";
                if ($conn->query($sql2) === TRUE) {
                    echo "<p class='parrafo'>Entrada guardada con éxito.</p>";
                    echo "<a href='book-list.php' class='index_button'><button>Volver a la lista</button></a> ";
                } else {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                }
            
        }
        else{
            echo "Faltan datos libro $lib autor $n_aut $ap_aut coleccion $col usuario $usuario";
        }
        echo "</div>";
    }
    $conn->close();

?>
</div>