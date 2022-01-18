<?php 

    //header ("location: index.php?option=1");

    //Conexion
    include_once "conexion.php";

    //Variables
    $option = NULL;
    $input_search = NULL;
    $color = NULL;
    
    if(isset($_REQUEST['input_search'])){
        $input_search = $_REQUEST['input_search'];
    }

    if(isset($_REQUEST['option'])){
        $option = $_REQUEST['option'];
    }


 ?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>todolist</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

</head>
<body class='d-flex flex-column'>

    <header class="sticky-top">
        <div class="navbar navbar-expand-lg navbar-dark px-5 bg bg-gradient fs-4 pb-2">
            <div class="container-fluid pe-2">
                <a class="navbar-brand" href="index.php?option=1">Todolist</a>
				<form method="post" action="index.php?option=1">
				  <div class="input-group">
					<input type="text" name="input_search"  class="form-control new_task border-primary" placeholder="Buscar tarea"  aria-label="Recipient">
					<button name="search" class="btn btn-outline-secondary btn-light" id="button-addon2"><i class='bi bi-search'></i></button>
				  </div>
			  </form>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark px-5 pt-0 pb-1 bg2 fs-4 d-flex">
            <div class="container-fluid px-0">
                <div class="px-2 navbar-brand">
                    <a href="index.php?option=1" class="me-2"><i class="bi bi-list-ul text-center icono2 px-2"></i></a>
                    <a href="index.php?option=2"><i class="bi bi-trash text-center icono px-2"></i> </a>
                </div>
                <form method="post" action="index.php?option=1 ms-auto">   
                    <div class="input-group pe-2">
                        <input type="text" name="input_task"  class="form-control new_task border-primary" placeholder="Nueva tarea"  aria-label="Recipient">
                        <button name="new" class="btn btn-outline-secondary btn-light py-0 px-2"" id="button-addon2"><i class='bi bi-plus plus'></i></button>
                    </div>
                </form>
            </div>
        </nav>
        
    </header>

    <main class='bg_main'>

        <div class="row ms-2 me-1 main justify-content-center pt-2">
            <div class="col-sm-11 col-xs-12 mt-auto row">
                <?php 
                    if(!isset($option) || $_GET["option"] == 1){

                        if(!empty($input_search) && $option ==1){ //input buscador vacio

// VISUALIZAR TAREAS BUSCADAS VISUALIZAR TAREAS BUSCADAS VISUALIZAR TAREAS BUSCADAS VISUALIZAR TAREAS BUSCADAS VISUALIZAR TAREAS BUSCADAS

                            //Sentencia select buscador
                            $sql = "SELECT * FROM tareas WHERE tarea LIKE '%$input_search%' AND estado!='Eliminada'";
                            $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    //Colores tareas
                                    if($row["estado"] == "Activa"){
                                        $color = "success";
                                        }
                                        elseif($row["estado"] == "Finalizada"){
                                        $color = "danger";	
                                        }
                                        else{
                                            $color = "secondary";
                                        }

                                    echo "<div class='col-xs-12 col-sm-6 col-lg-3'>";
                                        echo "<div class='card border-3 border-$color bg-light p-3 my-2 me-1 row'>";
                    
                                        if(isset($_GET["modify"]) && $_GET['modify']==$row['id'] && $_GET['task']==$row['tarea']){
                                                
                                            $id_modify = $_GET['modify'];
                                            $task = $_GET['task'];
                                            
                                            echo "<form method='post' action='modificar.php' class='ps-0'>
                                                <div class='input-group new_task mb-3'>
                                                    <input type='text' class ='form-control form-control-sm' value='$task' name='newtask'>
                                                    <input type='text' value='$id_modify' name='id_modify' hidden>
                                                    <button name='mod_final' class='btn btn-outline-secondary'><i class='bi bi-pencil'></i></button>
                                                </div>
                                            </form>";
                                        }			
                                    
                                        else{
                                            echo $row["tarea"] ."<br><br>";
                                        }
                                
                                        echo "<div class='d-flex flex-column flex-wrap'>";
                                            if($row["inicio"]!= 0){
                                                echo "<p class='mb-0 text-center'>".$row["inicio"]."</p>";
                                            }
                                            if($row["fin"]!= 0){
                                                echo "<p class='mb-0 text-center'>".$row["fin"]."</p>";
                                            }
                                            echo "<div class='d-flex justify-content-center flex-wrap'>";
                                                echo "<a href='index.php?start=".$row["id"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-play'></i></button></a>
                                                <a href='index.php?modify=".$row["id"]."&task=".$row["tarea"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-pencil'></i></button></a> 
                                                <a href='index.php?end=".$row["id"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-stop'></i></button></a> 
                                                <a href='index.php?delete=".$row["id"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-trash'></i></button></a>" ."<br>";
                                            echo "</div>"; 
                                        echo "</div>";  //div class='card...'
                                        echo "</div>"; //div class='col-xs-12 col-sm-6 col-lg-3'
                                    echo "</div>"; //div class='col-xs-12 col-sm-6 col-lg-3'>
                                }
                            }
                        } // if(!empty($input_search) && $option ==1)

                        else{

// VISUALIZAR TAREAS VISUALIZAR TAREAS VISUALIZAR TAREAS VISUALIZAR TAREAS VISUALIZAR TAREAS VISUALIZAR TAREAS VISUALIZAR TAREAS

                            //Sentencia select general
                            $sql = "SELECT * FROM tareas WHERE estado!='Eliminada'";
                            $result = $conn->query($sql);
                    
                            $color = NULL; //Variable para cambiar color
                            $id_modify = $task = NULL; //Variables para opción modificar
                    
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    //Colores tareas
                                    if($row["estado"] == "Activa"){
                                        $color = "success";
                                    }
                                    elseif($row["estado"] == "Finalizada"){
                                        $color = "danger";	
                                    }
                                    else{
                                        $color = "secondary";
                                    }

                                    echo "<div class='col-xs-12 col-sm-6 col-lg-3'>";
                                        echo "<div class='card border-3 border-$color p-3 my-2 me-1 row'>";
                    
                                        if(isset($_GET["modify"]) && $_GET['modify']==$row['id'] && $_GET['task']==$row['tarea']){
                                                
                                            $id_modify = $_GET['modify'];
                                            $task = $_GET['task'];
                                            
                                            echo "<form method='post' action='modificar.php' class='ps-0'>
                                                <div class='input-group new_task mb-3'>
                                                    <input type='text' class ='form-control form-control-sm' value='$task' name='newtask'>
                                                    <input type='text' value='$id_modify' name='id_modify' hidden>
                                                    <button name='mod_final' class='btn btn-outline-secondary'><i class='bi bi-pencil'></i></button>
                                                </div>
                                            </form>";
                                        }			
                                    
                                        else{
                                            echo $row["tarea"] ."<br><br>";
                                        }
                                
                                        echo "<div class='d-flex flex-column flex-wrap'>";
                                            if($row["inicio"]!= 0){
                                                echo "<p class='mb-0 text-center'>".$row["inicio"]."</p>";
                                            }
                                            if($row["fin"]!= 0){
                                                echo "<p class='mb-0 text-center'>".$row["fin"]."</p>";
                                            }
                                            echo "<div class='d-flex justify-content-center flex-wrap'>";
                                                echo "<a href='index.php?start=".$row["id"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-play'></i></button></a>
                                                <a href='index.php?modify=".$row["id"]."&task=".$row["tarea"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-pencil'></i></button></a> 
                                                <a href='index.php?end=".$row["id"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-stop'></i></button></a> 
                                                <a href='index.php?delete=".$row["id"]."&option=1"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-trash'></i></button></a>" ."<br>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                            }
                        } //else
                        
                    } //if(!isset($option) || $_GET["option"] == 1)

                    else{ //if(isset($_GET['option']) && $option == 2)

// VISUALIZAR ELIMINADAS VISUALIZAR ELIMINADAS VISUALIZAR ELIMINADAS VISUALIZAR ELIMINADAS VISUALIZAR ELIMINADAS                       
                        $sql = "SELECT id, tarea, estado FROM tareas WHERE estado='Eliminada'";
                        $result = $conn->query($sql);
                        
                        $color = NULL;
                        if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {
                                
                                //Colores tareas
                                    if($row["estado"] === "Activa"){
                                    $color = "success";
                                    }
                                    elseif($row["estado"] === "Finalizada"){
                                    $color = "danger";	
                                    }
                                    else{
                                        $color = "secondary";
                                    }

                                echo "<div class='col-xs-12 col-sm-6 col-lg-3'>";
                                    echo "<div class='card border-3 border-$color bg-light p-3 my-2 me-1 row'>";
                                        echo $row["tarea"] ."<br><br>";
                                        echo "<div class='d-flex justify-content-center flex-wrap'>";
                                            echo "<a href='index.php?recover=".$row["id"]."&option=2"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-reply'></i></button></a>
                                            <a href='index.php?deleteT=".$row["id"]."&option=2"."'><button class='btn btn-outline-secondary btn-sm m-1'><i class='bi bi-trash'></i></button></a>" ."<br>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        } 
                    }
                ?>
                
            </div>
        </div>
    </main>
    
</body>
</html>

<?php
    //variables tareas
    $tarea_name = NULL;

    if(isset($_REQUEST["input_task"])){
        $tarea_name = $_REQUEST["input_task"];
    }

//Variables día y hora
     $dia = date("y-m-d");
     $hora = date("G:i:s");
     $reg_date = date("y-m-d")." ".date("G:i:s");

//FORMATO FECHA
     date_default_timezone_set('Europe/Madrid');

// NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA NUEVA TAREA
    if(!empty($tarea_name) && isset($_REQUEST["new"])){   

        //Comprobar que la tarea no exista e insertar
        $sql = "SELECT tarea FROM tareas";
        
        $result = $conn->query($sql);

        $row = mysqli_fetch_assoc($result);
       
            // Insertar datos en la tabla

            if ($result->num_rows >= 0) {
                if($tarea_name != $row["tarea"]){

                    $sql = "INSERT INTO tareas (tarea,estado,creacion) VALUES ('$tarea_name','Inactiva','$reg_date')";

                    if ($conn->query($sql) === TRUE) {
                        $msg = "Tarea guardada con éxito<br><br>";
                        echo "<script> window.location='index.php?option=1'; </script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
    }

// INICIAR TAREA INICIAR TAREA INICIAR TAREA INICIAR TAREA INICIAR TAREA INICIAR TAREA INICIAR TAREA INICIAR TAREA INICIAR TAREA
	$id_start = NULL;
	if(isset($_REQUEST["start"])){

		$id_start = $_REQUEST["start"];
		$sql2 = "UPDATE tareas SET estado='Activa',inicio='$reg_date',fin='0' WHERE id='$id_start'";
		if ($conn->query($sql2) === TRUE) {
			//echo "Tarea iniciada";
			echo "<script> window.location='index.php?option=1'; </script>";
			die();
		} else {
		echo "Error updating record: " . $conn->error;
		}
	}

// MODIFICAR TAREA MODIFICAR TAREA MODIFICAR TAREA MODIFICAR TAREA MODIFICAR TAREA MODIFICAR TAREA MODIFICAR TAREA MODIFICAR TAREA
	$id_modify = NULL;
	$task = NULL;
	if(isset($_REQUEST["modify"]) ){

		$id_modify = $_REQUEST["modify"];
		$task = $_REQUEST["task"];
}

// FINALIZAR TAREA FINALIZAR TAREA FINALIZAR TAREA FINALIZAR TAREA FINALIZAR TAREA FINALIZAR TAREA FINALIZAR TAREA FINALIZAR TAREA
	$id_end = NULL;
	if(isset($_REQUEST["end"])){

		$id_end = $_REQUEST["end"];
		$sql3 = "UPDATE tareas SET estado='Finalizada',fin='$reg_date' WHERE id='$id_end'";
		if ($conn->query($sql3) === TRUE) {
			//echo "Tarea Finalizada";
			echo "<script> window.location='index.php?option=1'; </script>";
			die();
		} else {
		echo "Error updating record: " . $conn->error;
		}

	}

//ELIMINAR TAREA ELIMINAR TAREA ELIMINAR TAREA  ELIMINAR TAREA ELIMINAR TAREA ELIMINAR TAREA  ELIMINAR TAREA ELIMINAR TAREA
	$id_delete = NULL;
	if(isset($_REQUEST["delete"])){

		$id_delete = $_REQUEST["delete"];
		$sql4 = "UPDATE tareas SET estado='Eliminada',inicio='0',fin='0' WHERE id='$id_delete'";
		if ($conn->query($sql4) === TRUE) {
			//echo "Tarea Eliminada";
			echo "<script> window.location='index.php?option=1'; </script>";
			die();
		} else {
		echo "Error updating record: " . $conn->error;
		}
	}

// RECUPERAR TAREA RECUPERAR TAREA RECUPERAR TAREA RECUPERAR TAREA RECUPERAR TAREA RECUPERAR TAREA RECUPERAR TAREA RECUPERAR TAREA
	$id_recover = NULL;
	if(isset($_REQUEST["recover"])){

		$id_recover = $_REQUEST["recover"];
		$sql2 = "UPDATE tareas SET estado='Inactiva' WHERE id='$id_recover'";
		if ($conn->query($sql2) === TRUE) {
			echo "<script> window.location='index.php?option=2'; </script>";
			die();
		} else {
		echo "Error updating record: " . $conn->error;
		}
	}

// ELIMINAR DEFINITIVO ELIMINAR DEFINITIVO ELIMINAR DEFINITIVO ELIMINAR DEFINITIVO ELIMINAR DEFINITIVO ELIMINAR DEFINITIVO ELIMINAR DEFINITIVO
    //Variables
    $deleteT = NULL;

    if(isset($_REQUEST['deleteT'])){
        $deleteT = $_REQUEST['deleteT'];
    }

    if(isset($deleteT)){

        // ELIMINAR DATOS DE TABLA

        $sql = "DELETE FROM tareas WHERE id='$deleteT'";

        if ($conn->query($sql) === TRUE) {
            echo "Tarea eliminada";
            echo "<script> window.location='index.php?option=2'; </script>";
        } else {
        echo "Error updating record: " . $conn->error;
        }  

    }
    else{
        echo "";
    }

?>