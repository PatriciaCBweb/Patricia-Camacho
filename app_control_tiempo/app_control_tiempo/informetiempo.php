<?php
session_start();

if(empty($_SESSION['nombre'])){
    header("location:index_login.php");
}
if(!empty($_SESSION['nombre'])){

//CONEXION BD
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fichar";

//Conexión
    $conn = new mysqli($servername,$username,$password,$dbname);
            
//Comprobar conexión
    if($conn->connect_error){
        die("Error en la conexión: ".$conn->connect_error);
    }

//FORMATO FECHA
    date_default_timezone_set('europe/gibraltar');

//VARIABLES
	$option = NULL;
	$proy = NULL;
	$proyecto=NULL;
	$dia=NULL;
	$idempleado = NULL;
	$fecha1 = NULL; 
	$fecha2 = NULL;
	$input_varios = NULL;
	$date_hidden = NULL;
	$boton_varios = NULL;
	$error_proyecto = NULL;

//INICIO DE SESION
  if(isset($_SESSION["nombre"])) {    
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
  }

  if(isset($_SESSION["idempleado"])){
    $idempleado = $_SESSION["idempleado"];
  }
 if(isset($_SESSION["proyecto"])){
    $proyecto = $_SESSION["proyecto"];
  }

//variable dia
	if(isset($_POST["date"])){
		$dia = $_POST["date"];
	}

	if(isset($_POST["fecha1"])){
		$fecha1 = $_POST["fecha1"];
	
	}
	if(isset($_POST["fecha2"])){
	$fecha2 = $_POST["fecha2"];	
	}

//EMPLEADO
if($rol == "empleado"){
?>
<!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.84.0">
      <title>INICIO</title>

      <link rel="canonical" href="css/dashboard.css">
      <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

      <style>
      
      .btn-outline-secondary:hover {
        background-color: #080744;
        }
      .bg-dark {
        background-color: #080744 !important;
      }
      
      
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>

      
      <!-- Custom styles for this template -->
      <link href="css/dashboard.css" rel="stylesheet">
    </head>
    <body>
      
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img class="mb-2" src= "brand/white-logo_WTai.svg" alt="Worktime" width="190" height=""></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
    
      <a class="nav-link px-3" href="logout.php"> 
        <button type="button" class="btn btn-sm btn-outline-secondary" name ="cerrar">CERRAR SESION</button>
      </a>
    
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfil.php">
                <span data-feather="shopping-cart"></span>
                Perfil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="fichar.php">
                <span data-feather="users"></span>
                Fichar
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="proyecto.php">
                <span data-feather="bar-chart-2"></span>
                Proyectos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comentario.php">
                <span data-feather="file"></span>
                Comentarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link  active"  aria-current="page" href="informetiempo.php">
                <span data-feather="layers"></span>
                Reportes
              </a>
            </li>
          </ul> 
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Hola <?php echo $nombre; ?></h1> <!--Incluir $empleado-->
          
        </div>
		  
	<?php   
		echo "acabas de pisar REPORTES</br></br>";	
	?>

      <div class="container">
        <div class="table-responsive=''">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
			<?php 
	
//Consulta en inicio_fin_sesion
				$sql3="SELECT DISTINCT proyecto FROM inicio_fin_sesion WHERE idempleado='$idempleado' ORDER BY proyecto ";
				$result3 = $conn->query($sql3);

				if($result3->num_rows>0){
			
//CONSULTA PROYECTOS
					$option = "<select name='proyecto'  class='form-select'>";
						$option .= "<option hidden></option>";

					while($row = $result3->fetch_assoc()){

						$proyecto = $row["proyecto"];
						$option .= "<option>$proyecto</option>";

					}//while result

					$option .= "</select>";

				}//if result 

			else{
				echo "Error";
			}

//SELECCIONAR EL PROYECTO
			if($_SERVER["REQUEST_METHOD"] == "POST"){

			  //ELEGIR PROYECTO		
				if(empty($proyecto) || $proyecto == "vacio"){
				  $error_proyecto = "CAMPO REQUERIDO";
				 }else{
					 $proyecto = $_POST['proyecto'];
				 }
			}
			  
            ?>
			  <h2 class="mb-3"> REGISTROS DEL DÍA </h2>
<form method="post" action="informetiempo.php">
			  <h4 class="mb-3">Selecciona el proyecto en el que estás trabajando.</h4>
			   <!-- $option = select de proyecto --> 
			   <div class="form-inline mb-2">
				   <div class ="row">
				   		<div class="col-sm-5">
						   <label for="date" class="sr-only">Proyecto:</label>
							<?php echo $option;
					  		echo $error_proyecto;?> 	
						</div>
						<div class="col-sm-5">
							<label for="date" class="sr-only">Fecha:</label>
							<input  type="date" name="date" id="date" class="form-control" value="<?php echo $dia ?>">
						</div>
					</div>
					<h4 class="mt-4 mb-3">Busqueda de varias fechas</h4>
					<div class="row">
						<div class="col-sm-5">
							<label for="fecha1" class="sr-only">Fecha 1 </label>
							<input type='date' name='fecha1' id='fecha1' class='form-control' value="<?php echo $fecha1 ?>">
						</div>
						<div class="col-sm-5">
							<label for="fecha2" class="sr-only">Fecha 2 </label>
							<input type='date' name='fecha2' id='date2' class='form-control' value="<?php echo $fecha2 ?>">
						</div> 
				</div>
		</div>
					<button type="submit" name="guardar" value="guardar" class="btn btn-sm btn-outline-secondary me-2">Ver registro</button>
</form>

			  <a href="<?php $_SERVER['PHP_SELF']; ?>"><button class="btn btn-sm btn-outline-secondary me-2">Nueva búsqueda</button></a>	  
			  <?php
			   
			    echo "<h5 class='mt-4 mb-3'>PROYECTO SELECCIONADO: $proyecto</h5>";
			  
//CONSULTA  PARA UN DIA
				if($_SERVER["REQUEST_METHOD"] == "POST"){

					if(!empty($dia) && empty($fecha1) && empty($fecha2)){
						$sql = "SELECT proyecto,dia,entrada,salida FROM inicio_fin_sesion WHERE idempleado='$idempleado' AND dia='$dia' AND proyecto='$proyecto' ORDER BY entrada";

						$result = $conn->query($sql);

//MOSTRAR DATOS DEL DIA
							if ($result->num_rows > 0) {
								// output data of each row
								echo "<h5 class='mt-2 mb-4'>DÍA SELECCIONADO: $dia</h5>";
								echo "<h5>Tiempo de conexión</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> ENTRADA </th>";
										echo"<th> SALIDA </th>";
										echo"<th> CONECTADO</th>";

									echo "</tr>";

									$horas=0;
									$min =0;

								while($row = $result->fetch_assoc()) {
									$date1 =date_create($row['entrada']);
									$date2 = date_create($row['salida']);

									$diff = date_diff($date1, $date2);
									$diff->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['entrada']. "</td>";
										echo"<td>" .$row['salida']. "</td>";
										echo"<td>" . $diff->format('%h horas %i minutos'). "</td>";
									echo "</tr>";

								//Suma de tiempos
									$horas = (int)$diff->format('%h')+ $horas;
									$min = $diff->format('%i')+ $min;

								}//while $result
								echo "</table>";
									$min_final = 0;
									$horas_final = 0;
									$min_final = $min/60;
									//echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final = $horas + floor($min_final);
									$min_final = $min - (floor ($min_final)*60);

								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total conectado</th>";
									echo "<td>".$horas_final." horas y ".$min_final." minutos</td>";
									echo "</tr>";
								echo "</table>";
								//echo "Total: ".$horas_final." horas y ".$min_final." minutos";

							} else {
								echo "No hay registros que mostrar";
							}
						}


//CONSULTA DOS DIAS
					if(!empty($fecha1) && !empty($fecha2) && empty($dia)){
						$sql2 = "SELECT proyecto,dia,entrada,salida FROM inicio_fin_sesion WHERE idempleado='$idempleado' AND dia>='$fecha1' AND dia<='$fecha2' AND proyecto='$proyecto' ORDER BY dia";

						$result2 = $conn->query($sql2);

								if ($result2->num_rows > 0) {
								// output data of each row
								echo "<h5 class='mt-2 mb-4'>DÍAS SELECCIONADOS: del $fecha1 a $fecha2</h5>";
								echo "<h5>Tiempo de conexión</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> DIA </th>";
										echo"<th> ENTRADA </th>";
										echo"<th> SALIDA </th>";
										echo"<th> CONECTADO</th>";

									echo "</tr>";

									$horas2=0;
									$min2 =0;

								while($row = $result2->fetch_assoc()) {
									$date1 =date_create($row['entrada']);
									$date2 = date_create($row['salida']);
									$diff2 = date_diff($date1, $date2);

									$diff2->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['dia']. "</td>";
										echo"<td>" .$row['entrada']. "</td>";
										echo"<td>" .$row['salida']. "</td>";
										echo"<td>" . $diff2->format('%h horas %i minutos'). "</td>";
									echo "</tr>";

					//Suma de tiempos
									$horas2 = (int)$diff2->format('%h')+ $horas2;
									$min2 = $diff2->format('%i')+ $min2;

								}//while $result2
								echo "</table>";
									$min_final2 = 0;
									$horas_final2 = 0;
									$min_final2 = ($min2)/60;
									// echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final2 = ($horas2) + floor($min_final2);
									$min_final2 = ($min2) - floor($min_final2)*60;

								
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total conectado</th>";
									echo "<td>".$horas_final2." horas y ".$min_final2." minutos</td>";
									echo "</tr>";
								echo "</table>";
								//echo "Total: ".$horas_final2." horas y ".$min_final2." minutos";

							}else{
							echo "No hay registros que mostrar";
						}
					}

					//pasas hay que cambiar a partir de aqui todos los datos

					//CONSULTA  PARA UN DIA PAUSA

					if(!empty($dia) && empty($fecha1) && empty($fecha2)){
						$sql3 = "SELECT * FROM pausas WHERE idempleado='$idempleado' AND fecha='$dia' AND proyecto='$proyecto' ORDER BY reanudar";

						$result3 = $conn->query($sql3);

					//MOSTRAR DATOS DEL DIA
							if ($result3->num_rows > 0) {
								// output data of each row

								echo "<h5 class='mt-4'>Tiempo de pausa</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> PAUSA </th>";
										echo"<th> REANUDAR </th>";
										echo"<th> DESCONECTADO</th>";

									echo "</tr>";

									$horas3=0;
									$min3 =0;

								while($row = $result3->fetch_assoc()) {
									$date1 =date_create($row['pausa']);
									$date2 = date_create($row['reanudar']);

									$diff3 = date_diff($date1, $date2);
									$diff3->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['pausa']. "</td>";
										echo"<td>" .$row['reanudar']. "</td>";
										echo"<td>" . $diff3->format('%h horas %i minutos'). "</td>";
									echo "</tr>";

								//Suma de tiempos
									$horas3 = (int)$diff3->format('%h')+ $horas3;
									$min3 = $diff3->format('%i')+ $min3;

								}//while $result
								echo "</table>";
									$min_final3 = 0;
									$horas_final3 = 0;
									$min_final3= ($min3)/60;
									//echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final3 = ($horas3) + floor($min_final3);
									$min_final3 = $min3 - (floor ($min_final3)*60);

								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total en pausa</th>";
									echo "<td>".$horas_final3." horas y ".$min_final3." minutos</td>";
									echo "</tr>";
								echo "</table>";
								
								//echo "Total: ".$horas_final3." horas y ".$min_final3." minutos";

							} else {
								echo "No hay registros que mostrar";
							}
						}//if


					//CONSULTA DOS DIAS PAUSA
					if(!empty($fecha1) && !empty($fecha2) && empty($dia)){
						$sql4 = "SELECT * FROM pausas WHERE idempleado='$idempleado' AND fecha>='$fecha1' AND fecha<='$fecha2' AND proyecto='$proyecto' ORDER BY fecha";

						$result4 = $conn->query($sql4);

								if ($result4->num_rows > 0) {
								// output data of each row

								echo "<h5>Tiempo de pausa</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> DIA </th>";
										echo"<th> PAUSA </th>";
										echo"<th> REANUDAR </th>";
										echo"<th> DESCONECTADO</th>";

									echo "</tr>";

									$horas4=0;
									$min4 =0;


								while($row = $result4->fetch_assoc()) {
									$date1 =date_create($row['pausa']);
									$date2 = date_create($row['reanudar']);
									$diff4 = date_diff($date1, $date2);
									$diff4->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['fecha']. "</td>";
										echo"<td>" .$row['pausa']. "</td>";
										echo"<td>" .$row['reanudar']. "</td>";
										echo"<td>" . $diff4->format('%h horas %i minutos'). "</td>";
									echo "</tr>";


					//Suma de tiempos
									$horas4= (int)$diff4->format('%h')+ $horas4;
									$min4 = $diff4->format('%i')+ $min4;

								}//while $result2
								echo "</table>";
									$min_final4= 0;
									$horas_final4 = 0;
									$min_final4 = ($min4)/60;
									// echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final4= ($horas4)+ floor($min_final4);
									$min_final4= ($min4) - floor($min_final4)*60;

								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total en pausa</th>";
									echo "<td>".$horas_final4." horas y ".$min_final4." minutos</td>";
									echo "</tr>";
								echo "</table>";
									
								//echo "Total: ".$horas_final4." horas y ".$min_final4." minutos";


							}else{
							echo "No hay registros que mostrar";
						}//else
					}
					
					echo "<br>";

//resta inicio fin menos pausas
					$total_horas = $total_horas2 = $total_min = $total_min2 = NULL;

					echo "<table class='table table-striped table-sm'>";
					if(!empty($dia) && empty($fecha1) && empty($fecha2)){
			
						if(isset($horas_final) && isset($horas_final3) && isset($min_final) && isset($min_final3)){
						$total_horas = ($horas_final)-($horas_final3);
						$total_min = ($min_final)-($min_final3);
							
						echo "<tr>";
						echo "<th>Total</th>";
						echo "<td>".($total_horas). " horas y ".($total_min)." minutos</td>";
						echo "</tr>";
						}	
						
						//echo "Total del todo: ".($total_horas). "horas y ".($total_min)." minutos";
					}if(empty($dia) && !empty($fecha1) && !empty($fecha2)){
						
						if(isset($horas_final2) && isset($horas_final4) && isset($min_final2) && isset($min_final4)){
						$total_horas2 = ($horas_final2)-($horas_final4);
						$total_min2 = ($min_final2)-($min_final4);
						
						echo "<tr>";
						echo "<th>Total</th>";
						echo "<td>".($total_horas2). " horas y ".($total_min2)." minutos</td>";
						echo "</tr>";
						}
						
						//echo "Total del todo: ".($total_horas2). "horas y ".($total_min2)." minutos";
					}
//CALCULAR EL SALARIO DEL EMPLEADO hora
					$sql5 = "SELECT * FROM salario WHERE idempleado='$idempleado' AND proyecto='$proyecto'";
					$result5 = $conn->query($sql5);
					if ($result5->num_rows > 0) {
						while($row5 = $result5->fetch_assoc()){
							echo "<tr>";
							echo "<th>Salario por hora</th>";
							echo "<td>".$row5['salario']."</td>";
							echo "</tr>";
							//echo "Salario por hora: ".$row5['salario'];
							echo "<tr>";
							echo "<th>Salario total</th>";
						//salario empleado total
							if(!empty($dia) && empty($fecha1) && empty($fecha2)){
							
								
								echo "<td>".round($row5['salario'] * ($total_horas + (($total_min)/60)),2)." €</td>";
								
								// echo "Salario total: ";
								 //echo round($row5['salario'] * ($total_horas + (($total_min)/60)),2)." €";
							}
							if(empty($dia) && !empty($fecha1) && !empty($fecha2)){
							
							
								echo "<td>".round($row5['salario'] * ($total_horas2 + (($total_min2)/60)),2)." €</td>";
								
								//echo "Salario total: ";
								 //echo round($row5['salario'] * ($total_horas2 + (($total_min2)/60)),2)." €";
							}
							echo "</tr>";
							echo "</table>";
						}
					}
				}


?>
			  
			  
          </tr>
          </thead>

        </table>
      </div>
      </div>
      </main>

      <script src="js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
    </body>
    </html>
		
<?php
	$conn->close();
}//empleado
//ADMINISTRADOR
if($rol == "admin"){?>
	<!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.84.0">
      <title>INICIO</title>

      <link rel="canonical" href="css/dashboard.css">
      <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

      <style>
      
      .btn-outline-secondary:hover {
        background-color: #080744;
        }
      .bg-dark {
        background-color: #080744 !important;
      }
      
      
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>

      
      <!-- Custom styles for this template -->
      <link href="css/dashboard.css" rel="stylesheet">
    </head>
    <body>
      
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img class="mb-2" src= "brand/white-logo_WTai.svg" alt="Worktime" width="190" height=""></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
    
      <a class="nav-link px-3" href="logout.php"> 
        <button type="button" class="btn btn-sm btn-outline-secondary" name ="cerrar">CERRAR SESION</button>
      </a>
    
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfil.php">
                <span data-feather="shopping-cart"></span>
                Perfil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="fichar.php">
                <span data-feather="users"></span>
                Fichar
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="proyecto.php">
                <span data-feather="bar-chart-2"></span>
                Proyectos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comentario.php">
                <span data-feather="file"></span>
                Comentarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link  active"  aria-current="page" href="informetiempo.php">
                <span data-feather="layers"></span>
                Reportes
              </a>
            </li>
			<li class="nav-item">
			<a class="nav-link" href="tabla_empleados.php">
			  <span data-feather="file"></span>
			  Tabla de Empleados
			</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="reg_admin.php">
			  <span data-feather="file"></span>
			  Registro de Empleados
			</a>
		  </li>
          </ul> 
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Hola <?php echo $nombre; ?></h1> <!--Incluir $empleado-->
          
        </div>
		  
	<?php   
		echo "acabas de pisar REPORTES</br></br>";	
	?>

      <div class="container">
        <div class="table-responsive=''">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
			<?php 
	
//Consulta en inicio_fin_sesion
				$sql3="SELECT DISTINCT proyecto FROM inicio_fin_sesion WHERE idempleado='$idempleado' ORDER BY proyecto ";
				$result3 = $conn->query($sql3);

				if($result3->num_rows>0){
			
//CONSULTA PROYECTOS
					$option = "<select name='proyecto'  class='form-select'>";
						$option .= "<option hidden></option>";

					while($row = $result3->fetch_assoc()){

						$proyecto = $row["proyecto"];
						$option .= "<option>$proyecto</option>";

					}//while result

					$option .= "</select>";

				}//if result 

			else{
				echo "Si no te sale el deplegable deberias elegir proyecto y fichar primero";
			}

//SELECCIONAR EL PROYECTO
			if($_SERVER["REQUEST_METHOD"] == "POST"){

			  //ELEGIR PROYECTO		
				if(empty($proyecto) || $proyecto == "vacio"){
				  $error_proyecto = "CAMPO REQUERIDO";
				 }else{
					 $proyecto = $_POST['proyecto'];
				 }
			}
			  
            ?>
			  <h2 class="mb-3"> REGISTROS DEL DÍA </h2>
<form method="post" action="informetiempo.php">
			  <h4 class="mb-3">Selecciona el proyecto en el que estás trabajando.</h4>
			   <!-- $option = select de proyecto --> 
			   <div class="form-inline mb-2">
				   <div class ="row">
				   		<div class="col-sm-5">
						   <label for="date" class="sr-only">Proyecto:</label>
							<?php echo $option;
					  		echo $error_proyecto;?> 	
						</div>
						<div class="col-sm-5">
							<label for="date" class="sr-only">Fecha:</label>
							<input  type="date" name="date" id="date" class="form-control" value="<?php echo $dia ?>">
						</div>
					</div>
					<h4 class="mt-4 mb-3">Busqueda de varias fechas</h4>
					<div class="row">
						<div class="col-sm-5">
							<label for="fecha1" class="sr-only">Fecha 1 </label>
							<input type='date' name='fecha1' id='fecha1' class='form-control' value="<?php echo $fecha1 ?>">
						</div>
						<div class="col-sm-5">
							<label for="fecha2" class="sr-only">Fecha 2 </label>
							<input type='date' name='fecha2' id='date2' class='form-control' value="<?php echo $fecha2 ?>">
						</div> 
				</div>
		</div>
					<button type="submit" name="guardar" value="guardar" class="btn btn-sm btn-outline-secondary me-2">Ver registro</button>
</form>

			  <a href="<?php $_SERVER['PHP_SELF']; ?>"><button class="btn btn-sm btn-outline-secondary me-2">Nueva búsqueda</button></a>	  
			  <?php
			   
			    echo "<h5 class='mt-4 mb-3'>PROYECTO SELECCIONADO: $proyecto</h5>";
			  
//CONSULTA  PARA UN DIA
				if($_SERVER["REQUEST_METHOD"] == "POST"){

					if(!empty($dia) && empty($fecha1) && empty($fecha2)){
						$sql = "SELECT proyecto,dia,entrada,salida FROM inicio_fin_sesion WHERE idempleado='$idempleado' AND dia='$dia' AND proyecto='$proyecto' ORDER BY entrada";

						$result = $conn->query($sql);

//MOSTRAR DATOS DEL DIA
							if ($result->num_rows > 0) {
								// output data of each row
								echo "<h5 class='mt-2 mb-4'>DÍA SELECCIONADO: $dia</h5>";
								echo "<h5>Tiempo de conexión</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> ENTRADA </th>";
										echo"<th> SALIDA </th>";
										echo"<th> CONECTADO</th>";

									echo "</tr>";

									$horas=0;
									$min =0;

								while($row = $result->fetch_assoc()) {
									$date1 =date_create($row['entrada']);
									$date2 = date_create($row['salida']);

									$diff = date_diff($date1, $date2);
									$diff->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['entrada']. "</td>";
										echo"<td>" .$row['salida']. "</td>";
										echo"<td>" . $diff->format('%h horas %i minutos'). "</td>";
									echo "</tr>";

								//Suma de tiempos
									$horas = (int)$diff->format('%h')+ $horas;
									$min = $diff->format('%i')+ $min;

								}//while $result
								echo "</table>";
									$min_final = 0;
									$horas_final = 0;
									$min_final = $min/60;
									//echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final = $horas + floor($min_final);
									$min_final = $min - (floor ($min_final)*60);

								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total conectado</th>";
									echo "<td>".$horas_final." horas y ".$min_final." minutos</td>";
									echo "</tr>";
								echo "</table>";
								//echo "Total: ".$horas_final." horas y ".$min_final." minutos";

							} else {
								echo "No hay registros que mostrar";
							}
						}


//CONSULTA DOS DIAS
					if(!empty($fecha1) && !empty($fecha2) && empty($dia)){
						$sql2 = "SELECT proyecto,dia,entrada,salida FROM inicio_fin_sesion WHERE idempleado='$idempleado' AND dia>='$fecha1' AND dia<='$fecha2' AND proyecto='$proyecto' ORDER BY dia";

						$result2 = $conn->query($sql2);

								if ($result2->num_rows > 0) {
								// output data of each row
								echo "<h5 class='mt-2 mb-4'>DÍAS SELECCIONADOS: del $fecha1 a $fecha2</h5>";
								echo "<h5>Tiempo de conexión</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> DIA </th>";
										echo"<th> ENTRADA </th>";
										echo"<th> SALIDA </th>";
										echo"<th> CONECTADO</th>";

									echo "</tr>";

									$horas2=0;
									$min2 =0;

								while($row = $result2->fetch_assoc()) {
									$date1 =date_create($row['entrada']);
									$date2 = date_create($row['salida']);
									$diff2 = date_diff($date1, $date2);

									$diff2->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['dia']. "</td>";
										echo"<td>" .$row['entrada']. "</td>";
										echo"<td>" .$row['salida']. "</td>";
										echo"<td>" . $diff2->format('%h horas %i minutos'). "</td>";
									echo "</tr>";

					//Suma de tiempos
									$horas2 = (int)$diff2->format('%h')+ $horas2;
									$min2 = $diff2->format('%i')+ $min2;

								}//while $result2
								echo "</table>";
									$min_final2 = 0;
									$horas_final2 = 0;
									$min_final2 = ($min2)/60;
									// echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final2 = ($horas2) + floor($min_final2);
									$min_final2 = ($min2) - floor($min_final2)*60;

								
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total conectado</th>";
									echo "<td>".$horas_final2." horas y ".$min_final2." minutos</td>";
									echo "</tr>";
								echo "</table>";
								//echo "Total: ".$horas_final2." horas y ".$min_final2." minutos";

							}else{
							echo "No hay registros que mostrar";
						}
					}

					//pasas hay que cambiar a partir de aqui todos los datos

					//CONSULTA  PARA UN DIA PAUSA

					if(!empty($dia) && empty($fecha1) && empty($fecha2)){
						$sql3 = "SELECT * FROM pausas WHERE idempleado='$idempleado' AND fecha='$dia' AND proyecto='$proyecto' ORDER BY reanudar";

						$result3 = $conn->query($sql3);

					//MOSTRAR DATOS DEL DIA
							if ($result3->num_rows > 0) {
								// output data of each row

								echo "<h5 class='mt-4'>Tiempo de pausa</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> PAUSA </th>";
										echo"<th> REANUDAR </th>";
										echo"<th> DESCONECTADO</th>";

									echo "</tr>";

									$horas3=0;
									$min3 =0;

								while($row = $result3->fetch_assoc()) {
									$date1 =date_create($row['pausa']);
									$date2 = date_create($row['reanudar']);

									$diff3 = date_diff($date1, $date2);
									$diff3->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['pausa']. "</td>";
										echo"<td>" .$row['reanudar']. "</td>";
										echo"<td>" . $diff3->format('%h horas %i minutos'). "</td>";
									echo "</tr>";

								//Suma de tiempos
									$horas3 = (int)$diff3->format('%h')+ $horas3;
									$min3 = $diff3->format('%i')+ $min3;

								}//while $result
								echo "</table>";
									$min_final3 = 0;
									$horas_final3 = 0;
									$min_final3= ($min3)/60;
									//echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final3 = ($horas3) + floor($min_final3);
									$min_final3 = $min3 - (floor ($min_final3)*60);

								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total en pausa</th>";
									echo "<td>".$horas_final3." horas y ".$min_final3." minutos</td>";
									echo "</tr>";
								echo "</table>";
								
								//echo "Total: ".$horas_final3." horas y ".$min_final3." minutos";

							} else {
								echo "No hay registros que mostrar";
							}
						}//if


					//CONSULTA DOS DIAS PAUSA
					if(!empty($fecha1) && !empty($fecha2) && empty($dia)){
						$sql4 = "SELECT * FROM pausas WHERE idempleado='$idempleado' AND fecha>='$fecha1' AND fecha<='$fecha2' AND proyecto='$proyecto' ORDER BY fecha";

						$result4 = $conn->query($sql4);

								if ($result4->num_rows > 0) {
								// output data of each row

								echo "<h5>Tiempo de pausa</h5>";
								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
										echo"<th> DIA </th>";
										echo"<th> PAUSA </th>";
										echo"<th> REANUDAR </th>";
										echo"<th> DESCONECTADO</th>";

									echo "</tr>";

									$horas4=0;
									$min4 =0;


								while($row = $result4->fetch_assoc()) {
									$date1 =date_create($row['pausa']);
									$date2 = date_create($row['reanudar']);
									$diff4 = date_diff($date1, $date2);
									$diff4->format('%h horas %i minutos');
									echo "<tr>";
										echo"<td>" .$row['fecha']. "</td>";
										echo"<td>" .$row['pausa']. "</td>";
										echo"<td>" .$row['reanudar']. "</td>";
										echo"<td>" . $diff4->format('%h horas %i minutos'). "</td>";
									echo "</tr>";


					//Suma de tiempos
									$horas4= (int)$diff4->format('%h')+ $horas4;
									$min4 = $diff4->format('%i')+ $min4;

								}//while $result2
								echo "</table>";
									$min_final4= 0;
									$horas_final4 = 0;
									$min_final4 = ($min4)/60;
									// echo $min_final."<br/>";
									//variant_int toma la parte entera de un float
									$horas_final4= ($horas4)+ floor($min_final4);
									$min_final4= ($min4) - floor($min_final4)*60;

								echo "<table class='table table-striped table-sm'>";
									echo "<tr>";
									echo "<th>Total en pausa</th>";
									echo "<td>".$horas_final4." horas y ".$min_final4." minutos</td>";
									echo "</tr>";
								echo "</table>";
									
								//echo "Total: ".$horas_final4." horas y ".$min_final4." minutos";


							}else{
							echo "No hay registros que mostrar";
						}//else
					}
					
					echo "<br>";

//resta inicio fin menos pausas
					$total_horas = $total_horas2 = $total_min = $total_min2 = NULL;

					echo "<table class='table table-striped table-sm'>";
					if(!empty($dia) && empty($fecha1) && empty($fecha2)){
			
						if(isset($horas_final) && isset($horas_final3) && isset($min_final) && isset($min_final3)){
						$total_horas = ($horas_final)-($horas_final3);
						$total_min = ($min_final)-($min_final3);
							
						echo "<tr>";
						echo "<th>Total</th>";
						echo "<td>".($total_horas). " horas y ".($total_min)." minutos</td>";
						echo "</tr>";
						}	
						
						//echo "Total del todo: ".($total_horas). "horas y ".($total_min)." minutos";
					}if(empty($dia) && !empty($fecha1) && !empty($fecha2)){
						
						if(isset($horas_final2) && isset($horas_final4) && isset($min_final2) && isset($min_final4)){
						$total_horas2 = ($horas_final2)-($horas_final4);
						$total_min2 = ($min_final2)-($min_final4);
						
						echo "<tr>";
						echo "<th>Total</th>";
						echo "<td>".($total_horas2). " horas y ".($total_min2)." minutos</td>";
						echo "</tr>";
						}
						
						//echo "Total del todo: ".($total_horas2). "horas y ".($total_min2)." minutos";
					}
//CALCULAR EL SALARIO DEL EMPLEADO hora
					$sql5 = "SELECT * FROM salario WHERE idempleado='$idempleado' AND proyecto='$proyecto'";
					$result5 = $conn->query($sql5);
					if ($result5->num_rows > 0) {
						while($row5 = $result5->fetch_assoc()){
							echo "<tr>";
							echo "<th>Salario por hora</th>";
							echo "<td>".$row5['salario']."</td>";
							echo "</tr>";
							//echo "Salario por hora: ".$row5['salario'];
							echo "<tr>";
							echo "<th>Salario total</th>";
						//salario empleado total
							if(!empty($dia) && empty($fecha1) && empty($fecha2)){
							
								
								echo "<td>".round($row5['salario'] * ($total_horas + (($total_min)/60)),2)." €</td>";
								
								// echo "Salario total: ";
								 //echo round($row5['salario'] * ($total_horas + (($total_min)/60)),2)." €";
							}
							if(empty($dia) && !empty($fecha1) && !empty($fecha2)){
							
							
								echo "<td>".round($row5['salario'] * ($total_horas2 + (($total_min2)/60)),2)." €</td>";
								
								//echo "Salario total: ";
								 //echo round($row5['salario'] * ($total_horas2 + (($total_min2)/60)),2)." €";
							}
							echo "</tr>";
							echo "</table>";
						}
					}
				}


?>
			  
			  
          </tr>
          </thead>

        </table>
      </div>
      </div>
      </main>

      <script src="js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
    </body>
    </html>
		
<?php
	$conn->close();
}//admin
}//entrada a lo bruto
?>