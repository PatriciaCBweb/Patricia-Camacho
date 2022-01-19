<?php
	session_start();
if(empty($_SESSION['nombre'])){
		header("location:index_login.php");
}
if(!empty($_SESSION['nombre'])){
//filtro entrada a lo bruto
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fichar";
	date_default_timezone_set('europe/gibraltar');
//Conexión
	$conn = new mysqli($servername,$username,$password,$dbname);
			
//Comprobar conexión
	if($conn->connect_error){
		die("Error en la conexión: ".$conn->connect_error);
	}
//INICIO SESION

	if(isset($_SESSION["nombre"])) {
		
		$nombre = $_SESSION["nombre"];
		$rol = $_SESSION["rol"];
		
	}
//PREFIL EMPLEADO
if($rol == "empleado"){
	?>
	<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.84.0">
		<title>PROYECTO</title>

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
					<span data-feather="file"></span>
					Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="perfil.php">
					<span data-feather="file"></span>
					Perfil
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="fichar.php">
					<span data-feather="file"></span>
					Fichar
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="proyecto.php">
					<span data-feather="home"></span>
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
					<a class="nav-link" href="informetiempo.php">
					<span data-feather="file"></span>
					Reportes
					</a>
				</li>
				</ul>   
			</div>
			</nav>
		</div>
		</div>
		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Bienvenido <?php echo $nombre; ?></h1> <!--Incluir $empleado-->
		
			</div>
		<div class="container">
				<div class="table-responsive">
				<?php
	//Consulta en inicio_fin_sesion
		$sql="SELECT DISTINCT idempleado,proyecto FROM inicio_fin_sesion  ORDER BY proyecto";
		$result = $conn->query($sql);

		if($result->num_rows>0){
			echo "<table class='table table-striped table-sm'>";
					echo "<tr>";
						echo "<th>Proyecto</td>";
						echo "<th>Fecha inicio</td>";
						echo "<th>Fecha fin</td>";
						echo "<th>Estado</td>";

					echo "</tr>";
			
	//CONSULTA PROYECTOS
			while($row = $result->fetch_assoc()){
			
				$proy = $row["proyecto"];
				$sql2 = "SELECT * FROM proyectos WHERE proyecto='$proy'";
				$result2 = $conn->query($sql2);
				
				if ($result2->num_rows > 0) {
					while($row = $result2->fetch_assoc()) {
						echo "<tr>";
							echo "<td>".$row['proyecto']."</td>";
							echo "<td>".$row['inicio']."</td>";
							echo "<td>".$row['fin']."</td>";
							echo "<td>".$row['estado']."</td>";
						echo "</tr>";

					} //while result2
				
				}//if result2	
				
			}//while result
			echo "</table>";
		}//if result 
		else{
			echo "LA CAGASTES";
		}

	?>

				</div>
			</div>
	</main>
		
			<p>
			<a href="comentario.php"><button>Comentario</button></a>
			</p>
			<script src="js/bootstrap.bundle.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
		</body>
		</html>
		<?php
				$conn->close();
}//empleado
if($rol == "admin"){
	?>
	<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.84.0">
		<title>PROYECTO</title>

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
					<span data-feather="file"></span>
					Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="perfil.php">
					<span data-feather="file"></span>
					Perfil
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="fichar.php">
					<span data-feather="file"></span>
					Fichar
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="proyecto.php">
					<span data-feather="home"></span>
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
					<a class="nav-link" href="informetiempo.php">
					<span data-feather="file"></span>
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
		</div>
		</div>
		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Bienvenido <?php echo $nombre; ?></h1> <!--Incluir $empleado-->
		
			</div>
		<div class="container">
				<div class="table-responsive">
				<?php
	//Consulta en inicio_fin_sesion
		echo "<h2> Proyectos </h2>";
			
	//CONSULTA PROYECTOS

				$sql2 = "SELECT * FROM proyectos";
				$result2 = $conn->query($sql2);
				
				if ($result2->num_rows > 0) {
					echo "<table class='table table-striped table-sm'>";
					echo "<tr>";
						echo "<th>Proyecto</td>";
						echo "<th>Fecha inicio</td>";
						echo "<th>Fecha fin</td>";
						echo "<th>Estado</td>";

					echo "</tr>";
					while($row = $result2->fetch_assoc()) {
						echo "<tr>";
							echo "<td>".$row['proyecto']."</td>";
							echo "<td>".$row['inicio']."</td>";
							echo "<td>".$row['fin']."</td>";
							echo "<td>".$row['estado']."</td>";
						echo "</tr>";

					} //while result2
					echo "</table>";
				
				}//if result2	
				else{
					echo "No hay proyectos que mostrar";
				}

	?>
	<?php
//FORMULARIO NUEVO PROYECTO

	//VARIBLES
	$proyecto = $errorproyect ="";
	//VALIDAR VARIBLES
	if(isset($_REQUEST["proyecto"])){
	$proyecto=$_POST['proyecto'];
	}
	//TEST INPUT
	function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
	//FILTROS DE VALIDACION
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//Proyecto
		if(empty($_POST["proyecto"])){
			$errorproyect = "CAMPO REQUERIDO";
		}else{
			if (!preg_match("/^[0-9]*$/",$proyecto)) {
				$errorproyect = "Solo numeros";
				$proyecto ="";
			}else{
				$proyecto = test_input($_POST["proyecto"]);
			}
		}
	}//if server
	//INTRODUCIR REGISTRO EN LA BASE DE DATOS
	//guarda dos veces el proyecto
		if(!empty($proyecto)){
			$date = date("Y-m-d h:i:sa");
			$nomproy= "proyecto_".$proyecto;
				
				$sql2 = "INSERT INTO proyectos (proyecto, inicio, fin, estado)
				VALUES ('$nomproy', '$date', '', 'En_progreso')";
			
				if ($conn->query($sql2) === TRUE) {
				echo "Nombre del proyecto guardado";
				$proyecto= "";
				} else {
				echo "Error: " . $sql2 . "<br>" . $conn->error;
				}
		}
	?>
	<div class="col-md-7 col-lg-8">
        <h4 class="mb-3">NUEVO PROYECTO</h4>
        <form class="needs-validation" method ="POST" action="proyecto.php">
          <div class="row g-3">
            <div class="col-12">
              <label for="username" class="form-label">Nombre del proyecto</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="proyecto" placeholder="Nombre del proyecto" name="proyecto" value="<?php echo $proyecto?>" required>
              </div>
              <p class="error"><?php echo $errorproyect?></p>
            </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit" name="save">GUARDAR</button>
        </form>
      </div>
    </div>
  </div>
		</div>
	</div>
	</main>
		
			<p>
			<a href="comentario.php"><button>Comentario</button></a>
			</p>
			<script src="js/bootstrap.bundle.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
		</body>
		</html>
		<?php
				$conn->close();
}//admin
?>
<?php
  }//entrada a lo bruto
?>
