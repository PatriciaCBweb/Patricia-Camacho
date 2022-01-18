<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php
    //Conexion
    include_once "conexion.php";

    //Variables
    $book = $author = NULL;

    if(isset($_REQUEST['book'])){
        $book = $_REQUEST['book'];
    }

    if(isset($_REQUEST['author'])){
        $author = $_REQUEST['author'];
    }

    if(empty($_REQUEST['book']) && empty($_REQUEST['author'])){
        echo "<script> window.location='index.php'; </script>";
    }

    echo "<div class='container-s'>";

    echo "<a href='index.php' class='button_center'><button>Volver</button></a>";
    if($_SERVER["REQUEST_METHOD"] =="POST"){
        if(isset($book) && empty($author)){

            $sql = "SELECT * FROM libros WHERE libro LIKE '%$book%' ORDER BY ap_autor ASC";
            $result = $conn->query($sql);
            $registros=0;
            if($result->num_rows > 0){
                echo "<table border=1>";
                    echo "<tr>";
                        echo "<th>Libro</th>";
                        echo "<th>Colección</th>";
                        echo "<th colspan=2>Nombre</th>";
                        echo "<th>Usuario</th>";              
                    echo "</tr>";          
                        while($row = $result->fetch_assoc()){
                            $registros++;
                            if($registros%2==1){
                                echo "<tr class='impar'>";
                                echo "<td class='title'>".$row['libro']."</td>";
                                echo "<td class='title'>".$row['coleccion']."</td>";
                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                echo "<td class='autor'>".$row['usuario']."</td>";
                                echo "</tr>";
                            }else{
                                echo "<tr class='par'>";
                                echo "<td class='title'>".$row['libro']."</td>";
                                echo "<td class='title'>".$row['coleccion']."</td>";
                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                echo "<td class='autor'>".$row['usuario']."</td>";
                                echo "</tr>";
                            }
                        }
            }//$result->num_rows > 0
            else {
			echo "0 results";
		    }
        }   

        if(empty($book) && isset($author)){

            $sql = "SELECT * FROM libros WHERE n_autor LIKE '%$author%' OR ap_autor LIKE '%$author%' ORDER BY ap_autor ASC";
            $result = $conn->query($sql);
            $registros=0;
            if($result->num_rows > 0){
                echo "<table border=1>";
                    echo "<tr>";
                        echo "<th>Libro</th>";
                        echo "<th>Colección</th>";
                        echo "<th colspan=2>Nombre</th>";
                        echo "<th>Usuario</th>";              
                    echo "</tr>";          
                        while($row = $result->fetch_assoc()){
                            $registros++;
                            if($registros%2==1){
                                echo "<tr class='impar'>";
                                echo "<td class='title'>".$row['libro']."</td>";
                                echo "<td class='title'>".$row['coleccion']."</td>";
                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                echo "<td class='autor'>".$row['usuario']."</td>";
                                echo "</tr>";
                            }else{
                                echo "<tr class='par'>";
                                echo "<td class='title'>".$row['libro']."</td>";
                                echo "<td class='title'>".$row['coleccion']."</td>";
                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                echo "<td class='autor'>".$row['usuario']."</td>";
                                echo "</tr>";
                            }
                        }
            }//$result->num_rows > 0
            else {
			echo "0 results";
		    }
        }   

        echo "</table>";
    }

    echo "<a href='index.php' class='button_center'><button>Volver</button></a>";

    echo "</div>";

?>
    
</body>
</html>