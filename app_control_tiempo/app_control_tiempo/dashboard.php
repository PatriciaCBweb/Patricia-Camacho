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
	$idempleado = NULL;
  $option = NULL;
	$proyecto = NULL;


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
  
  if(isset($_REQUEST["select"])){
    $proyecto = $_REQUEST["select"];
    $_SESSION["proyecto"]=$proyecto;
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
              <a class="nav-link active" aria-current="page" href="dashboard.php">
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
              <a class="nav-link" href="informetiempo.php">
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

      <div class="container">
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr><?php 
  //Consulta en inicio_fin_sesion
              $sql="SELECT DISTINCT idempleado,proyecto FROM inicio_fin_sesion ORDER BY proyecto";
              $result = $conn->query($sql);
              if($result->num_rows>0){
                 
  //SELECCIONAR PROYECTOS
              echo '<h2>SELECCIONA EL PROYECTO</h2><br/><br/>	
              <form method="post" action="dashboard.php">
                <select class="form-select" aria-label="Default select example" name="select">
                  <option>Proyectos</option>';
                  while($row = $result->fetch_assoc()){
                    
                    $proyecto = $row["proyecto"];
                    
                    echo "<option>$proyecto</option>";
                    
                    
                  }//while result
                  echo '</select><br/><br/>
                  <button type="submit" class="btn btn-sm btn-outline-secondary">ELEGIR PROYECTO</button>
              </form>';
                if(isset($_REQUEST['select']) && $_REQUEST['select'] != "Proyectos"){
                  echo"<p> Has elegido el proyecto: ".$_REQUEST['select']."</p>";
                  echo"<a href='fichar.php'>
                        <button type='submit' class='btn btn-sm btn-outline-secondary'>IR A FICHAR</button>
                      </a>";
                }
              }//if result 
              else{
                echo "Error";
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
if($rol == "admin"){
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
              <a class="nav-link active" aria-current="page" href="dashboard.php">
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
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Hola <?php echo $nombre; ?></h1> <!--Incluir $empleado-->
          
        </div>
  
      <div class="container">
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr><?php

              
  //Consulta en inicio_fin_sesion
              $sql="SELECT DISTINCT idempleado,proyecto FROM inicio_fin_sesion ORDER BY proyecto";
              $result = $conn->query($sql);
              if($result->num_rows>0){
                
            //SELECCIONAR PROYECTOS
              echo '<h2>SELECCIONA EL PROYECTO</h2><br/><br/>	
              <form method="post" action="dashboard.php">
                <select class="form-select" aria-label="Default select example" name="select">
                  <option>Proyectos</option>';
                  while($row = $result->fetch_assoc()){
                    
                    $proyecto = $row["proyecto"];
                    
                    echo "<option>$proyecto</option>";
                    
                    
                  }//while result
                  echo '</select><br/><br/>
                  <button type="submit" class="btn btn-sm btn-outline-secondary">ELEGIR PROYECTO</button>
              </form>';
                if(isset($_REQUEST['select']) && $_REQUEST['select'] != "Proyectos"){
                  echo"<p> Has elegido el proyecto: ".$_REQUEST['select']."</p>";
                  echo"<a href='fichar.php'>
                        <button type='submit' class='btn btn-sm btn-outline-secondary'>IR A FICHAR</button>
                      </a>";
                }
              }//if result 
              else{
                echo "Error";
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
?>
<?php
}//entrada a lo bruto
?>
