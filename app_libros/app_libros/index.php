<?php
	//Conexion
    include_once "conexion.php";

	$usuario = NULL;

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Libros</title>
    
</head>

<body>
    <div class="container-i">
		<h1 class="index_title">Usuario</h1>
        <div class="index_container">
            <form method="post" action="book-list.php">
                <select name="usuario" id="usuario">
                    <option></option>
                    <?php
                        $sql = "SELECT * FROM usuarios";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<option value='".$row['user']."'>".$row['user']."</option>";
                            }
                        }
                    ?>
                </select>
                <button>Ir</button>
            </form>   
            <a href="new-user.php" class="index_button"><button>Nuevo usuario</button></a>
        </div>
        <br><br>
        <h1 class="index_title">Buscador</h1>
        <div class="index_container">
            <form method="post" action="search-index.php">    
                <div class="input_search_index"><input type="text" name="book" placeholder="Libro"></div>
                <div class="input_search_index"><input type="text" name="author" placeholder="Autor"></div>
                <button class="search_button">Buscar</button>
            </form>
        </div>
    </div>
</body>
</html>