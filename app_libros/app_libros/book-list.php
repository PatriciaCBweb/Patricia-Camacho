<?php
	//Sesion
	session_start();

    //Conexion
    include_once "conexion.php";

    //Variables
    $usuario = NULL;
    $book = $author = NULL;
    $contador = NULL;


    if(isset($_REQUEST['usuario']) && !empty($_REQUEST['usuario'])){
        $usuario = $_REQUEST['usuario'];
		$_SESSION['usuario'] = $_REQUEST['usuario'];
        $usuario = $_SESSION['usuario'];
    }
    
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
	}

    if(isset($_REQUEST['book'])){
        $book = $_REQUEST['book'];
    }

    if(isset($_REQUEST['author'])){
        $author = $_REQUEST['author'];
    }

    $sql2 = "SELECT count(*) contador FROM libros WHERE usuario='$usuario'";
    $result2 = $conn->query($sql2);
    $row = mysqli_fetch_assoc($result2);
    $contador = $row['contador'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>Libros</title>
</head>
<body>
    <div class="container-s">
        <header> 
            <div class="bl_header">
                <div id="left"> 
                    <h1 class="bl_title">Usuario </h1>
                    <h2 class="bl_user"><?php echo $usuario; ?></h2>
                    <p class="contador">Tienes <input type="text" value="<?php echo $contador; ?>" readonly> libros guardados</p>
                    <a href="end-session.php"><button class="search_button">Volver a Inicio</button></a>
                </div>  

                <div id="center">
                <h1 class="bl_title">Nuevo libro </h1>
                    <a href="new-book.php"><button id="new"><span>&#128462;</span>&#128930;</button></a>
                </div>

                <div id="right">
                    <form method="post" action="book-list.php">
                    <p class="bl_title">Buscador</p>
                        <div class="input_search_index"><input type="text" name="book" placeholder="Libro" ></div>
                        <div class="input_search_index"><input type="text" name="author" placeholder="Autor"></div>
                        <button class="search_button">Buscar</button>
                </form>
                </div>
            </div>

            <div id="abc">
                <a href="book-list.php?letra=a"><button>A</button></a>
                <a href="book-list.php?letra=b"><button>B</button></a>
                <a href="book-list.php?letra=c"><button>C</button></a>
                <a href="book-list.php?letra=d"><button>D</button></a>
                <a href="book-list.php?letra=e"><button>E</button></a>
                <a href="book-list.php?letra=f"><button>F</button></a>
                <a href="book-list.php?letra=g"><button>G</button></a>
                <a href="book-list.php?letra=h"><button>H</button></a>
                <a href="book-list.php?letra=i"><button>I</button></a>
                <a href="book-list.php?letra=j"><button>J</button></a>
                <a href="book-list.php?letra=k"><button>K</button></a>
                <a href="book-list.php?letra=l"><button>L</button></a>
                <a href="book-list.php?letra=m"><button>M</button></a>
                <a href="book-list.php?letra=n"><button>N</button></a>
                <a href="book-list.php?letra=ñ"><button>Ñ</button></a>
                <a href="book-list.php?letra=o"><button>O</button></a>
                <a href="book-list.php?letra=p"><button>P</button></a>
                <a href="book-list.php?letra=q"><button>Q</button></a>
                <a href="book-list.php?letra=r"><button>R</button></a>
                <a href="book-list.php?letra=s"><button>S</button></a>
                <a href="book-list.php?letra=t"><button>T</button></a>
                <a href="book-list.php?letra=u"><button>U</button></a>
                <a href="book-list.php?letra=v"><button>V</button></a>
                <a href="book-list.php?letra=w"><button>W</button></a>
                <a href="book-list.php?letra=x"><button>X</button></a>
                <a href="book-list.php?letra=y"><button>Y</button></a>
                <a href="book-list.php?letra=z"><button>Z</button></a>
            </div>
            <br>
        </header>
        <main>      
            
            <?php

// BUSCAR POR INICIAL
                if(isset($_GET['letra'])){
                    echo "<a href='book-list.php' class='button_center'><button>Ver todos</button></a><br><br>";

                $letra = $_GET['letra'];

                $sql = "SELECT * FROM libros WHERE usuario='$usuario' AND ap_autor LIKE '$letra%' ORDER BY ap_autor,coleccion ASC";
                    $result = $conn->query($sql);
                    $registros=0;
                    if($result->num_rows > 0){
                        echo "<table border=1>";
                            echo "<tr>";
                                echo "<th></th>";
                                echo "<th>Libro</th>";
                                echo "<th>Colección</th>";
                                echo "<th colspan=2>Autor</th>";              
                            echo "</tr>";          
                                while($row = $result->fetch_assoc()){
                                    $registros++;
                                    if($registros%2==1){
                                        echo "<tr class='impar'>";
                                        echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 

                                        echo "<td class='title'>".$row['libro']."</td>";
                                        echo "<td class='title'>".$row['coleccion']."</td>";
                                        echo "<td class='autor'>".$row['n_autor']."</td>";
                                        echo "<td class='autor'>".$row['ap_autor']."</td>";
                                        echo "</tr>";
                                    }else{
                                        echo "<tr class='par'>";
                                        echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>";                                        
                                        echo "<td class='title'>".$row['libro']."</td>";
                                        echo "<td class='title'>".$row['coleccion']."</td>";
                                        echo "<td class='autor'>".$row['n_autor']."</td>";
                                        echo "<td class='autor'>".$row['ap_autor']."</td>";
                                        echo "</tr>"; 
                                    }
                                }
                    }//$result->num_rows > 0
                    else {
                    echo "0 results";
                    echo "<script> window.location='book-list.php'; </script>";
                    }
                    echo "</table>";
                    echo "<br><a href='book-list.php' class='button_center'><button>Ver todos</button></a>";

                } //get_letra
                else{
// VER TODOS LOS LIBROS
                    if(empty($book) && empty($author)){
                        $sql = "SELECT * FROM libros WHERE usuario='$usuario' ORDER BY ap_autor,coleccion ASC";
                        $result = $conn->query($sql);
                        $registros=0;
                        if($result->num_rows > 0){
                            echo "<table border=1>";
                                echo "<tr>";
                                    echo "<th></th>";
                                    echo "<th>Libro</th>";
                                    echo "<th>Colección</th>";
                                    echo "<th colspan='2'>Autor</th>";              
                                echo "</tr>";          
                                    while($row = $result->fetch_assoc()){
                                        $registros++;
                                        if($registros%2==1){
                                            echo "<tr class='impar'>";
                                            echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 
                                            echo "<td class='title'>".$row['libro']."</td>";
                                            echo "<td class='title'>".$row['coleccion']."</td>";
                                            echo "<td class='autor'>".$row['n_autor']."</td>";
                                            echo "<td class='autor'>".$row['ap_autor']."</td>";
                                            echo "</tr>";
                                        }else{
                                            echo "<tr class='par'>";
                                            echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 
                                            echo "<td class='title'>".$row['libro']."</td>";
                                            echo "<td class='title'>".$row['coleccion']."</td>";
                                            echo "<td class='autor'>".$row['n_autor']."</td>";
                                            echo "<td class='autor'>".$row['ap_autor']."</td>";
                                            echo "</tr>";
                                        }
                                    }
                        }//$result->num_rows > 0
                        else {
                        echo "0 results";
                        }
                        echo "</table>";
                    } //empty book & empty author

                else{      
// VER LIBRO/AUTOR POR BUSCADOR     
                    if(isset($book) || isset($author)){

                        echo "<a href='book-list.php' class='button_center'><button>Ver todos</button></a><br><br>";

                        if(isset($book) && empty($author)){
                            $sql = "SELECT * FROM libros WHERE usuario='$usuario' AND libro LIKE '%$book%' ORDER BY ap_autor,coleccion ASC";
                            $result  = $conn->query($sql);
                            $registros=0;
                            if($result->num_rows > 0){
                                echo "<table border=1>";
                                    echo "<tr>";
                                    echo "<th></th>";
                                        echo "<th>Libro</th>";
                                        echo "<th>Colección</th>";
                                        echo "<th colspan=2>Autor</th>";              
                                    echo "</tr>";          
                                        while($row = $result->fetch_assoc()){
                                            $registros++;
                                            if($registros%2==1){
                                                echo "<tr class='impar'>";
                                                echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 
                                                echo "<td class='title'>".$row['libro']."</td>";
                                                echo "<td class='title'>".$row['coleccion']."</td>";
                                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                                echo "</tr>";
                                            }else{
                                                echo "<tr class='par'>";
                                                echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 
                                                echo "<td class='title'>".$row['libro']."</td>";
                                                echo "<td class='title'>".$row['coleccion']."</td>";
                                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                                echo "</tr>"; 
                                            }
                                        }
                            }//$result->num_rows > 0
                            else {
                            echo "0 results";
                            echo "<script> window.location='book-list.php'; </script>";
                            }
                        }
                        if(isset($author) && empty($book)){
                        $sql = "SELECT * FROM libros WHERE usuario='$usuario' AND n_autor LIKE '%$author%' OR usuario='$usuario' AND ap_autor LIKE '%$author%' ORDER BY ap_autor,coleccion ASC";
                        $result = $conn->query($sql);
                        $registros=0;
                            if($result->num_rows > 0){
                                echo "<table border=1>";
                                    echo "<tr>";
                                        echo "<th></th>";
                                        echo "<th>Libro</th>";
                                        echo "<th>Colección</th>";
                                        echo "<th colspan=2>Autor</th>";              
                                    echo "</tr>";          
                                        while($row = $result->fetch_assoc()){
                                            $registros++;
                                            if($registros%2==1){
                                                echo "<tr class='impar'>";
                                                echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 
                                                echo "<td class='title'>".$row['libro']."</td>";
                                                echo "<td class='title'>".$row['coleccion']."</td>";
                                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                                echo "</tr>";
                                            }else{
                                                echo "<tr class='par'>";
                                                echo "<td class='iconos'> <a href='delete.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='x'>&#128937;</a> <a href='modify.php?libro=".$row['libro']."&coleccion=".$row['coleccion']."&n_autor=".$row['n_autor']."&ap_autor=".$row['ap_autor']."' class='y'>&#128393;</a></td>"; 
                                                echo "<td class='title'>".$row['libro']."</td>";
                                                echo "<td class='title'>".$row['coleccion']."</td>";
                                                echo "<td class='autor'>".$row['n_autor']."</td>";
                                                echo "<td class='autor'>".$row['ap_autor']."</td>";
                                                echo "</tr>"; 
                                            }
                                        }
                            }//$result->num_rows > 0
                            else {
                            echo "0 results";
                            echo "<script> window.location='book-list.php'; </script>";
                            }
                        echo "</table>";
                        echo "<br><a href='book-list.php' class='button_center'><button>Ver todos</button></a>";
                        }
                    } //isset book or author

                } //else isset get_letra
            }
            $conn->close();
            ?>
        </main>
    </div>
</body>
</html>