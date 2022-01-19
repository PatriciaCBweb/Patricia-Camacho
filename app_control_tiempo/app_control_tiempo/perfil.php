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
    //echo "Conexión ok";

//echo"<br>";
//FORMATO FECHA
    date_default_timezone_set('europe/gibraltar');
    //echo date("d-m-Y");

//VARIABLES
    $fecha = date("Y-m-d");
    $entry = $exit = "";
//INICIO DE SESION

    if(isset($_SESSION["nombre"])) {
        
        $nombre = $_SESSION["nombre"];
        $rol = $_SESSION["rol"];
        $idempleado = $_SESSION['idempleado'];

    }
//PERFIL EMPLEADO
if($rol == "empleado"){
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.84.0">
      <title>PERFIL</title>

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
              <a class="nav-link active" aria-current="page" href="perfil.php">
                <span data-feather="home"></span>
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
              <a class="nav-link" href="proyecto.php">
                <span data-feather="file"></span>
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
  //MOSTRAR LOS DATOS DEL EMPOLEADO
      echo"<h1> Datos del empleado </h1>";
          $sql = "SELECT * FROM empleados WHERE idempleado LIKE '$idempleado'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              echo "<table class='table table-striped table-sm'>";
              echo "<tr>";
                      echo "<th> ID Empleado </th>";
                      echo"<th> Nombre </th>";
                      echo"<th> Apellido </th>";
              echo "</tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                      echo"<td>" .$row["idempleado"]. "</td>";
                      echo"<td>" .$row["nombre"]. "</td>";
                      echo"<td>" .$row["apellido"]. "</td>";
                  echo "</tr>";
              }
              echo "</table>";
          } else {
              echo "Empleado no encontrado";
          }
  //MOSTRAR LOS TIEMPOS DEL DIA
      echo"<br>";
      echo"<br>";
      echo "<h2> Registros del día </h2>";
      $sql2 = "SELECT * FROM inicio_fin_sesion WHERE idempleado LIKE '$idempleado' AND dia LIKE '$fecha' ";
      $result = $conn->query($sql2);
      
          if ($result->num_rows > 0) {
              // output data of each row
              echo "<table class='table table-striped table-sm'";
                  echo "<tr>";
                      echo"<th> PROYECTO </th>";
                      echo"<th> FECHA </th>";
                      echo"<th> ENTRADA </th>";
                      echo"<th> SALIDA </th>";
                      echo"<th> TOTAL DEL DIA </th>";
                  echo "</tr>";
              while($row = $result->fetch_assoc()) {
              //resumen del dia
                  $date1 =date_create($row['entrada']);
                  $date2 = date_create($row['salida']);
                  $diff = date_diff($date1, $date2);
                  $diff->format('%h horas');

                  echo "<tr>";
                      echo"<td>" .$row['proyecto']. "</td>";
                      echo"<td>" .$row['dia']. "</td>";
                      echo"<td>" .$row['entrada']. "</td>";
                      echo"<td>" .$row['salida']. "</td>";
                      echo"<td>" . $diff->format('%h h %i min'). "</td>";
                  echo "</tr>";
              }
              echo "</table>";
          } else {
              echo "No hay registros que mostrar";
          }
  //MOSTRAS LAS PAUSAS
      echo"<br>";
      echo"<br>";
      echo "<h2> Pausas </h2>";
      $sql3 = "SELECT * FROM pausas WHERE idempleado LIKE '$idempleado' AND fecha LIKE '$fecha' ";
      $result = $conn->query($sql3);
      
          if ($result->num_rows > 0) {
              // output data of each row
              echo "<table class='table table-striped table-sm'>";
                  echo "<tr>";
                      echo"<th> PROYECTO </th>";
                      echo"<th> FECHA </th>";
                      echo"<th> PAUSA </th>";
                      echo"<th> REANUDAR </th>";
                      echo"<th> TOTAL PAUSA</th>";
                  echo "</tr>";
              while($row = $result->fetch_assoc()) {
                  //resumen del dia
                  $date1 =date_create($row['pausa']);
                  $date2 = date_create($row['reanudar']);
                  $diff = date_diff($date1, $date2);
                  $diff->format('%h h %i min');
                  echo "<tr>";
                      echo"<td>" .$row['proyecto']. "</td>";
                      echo"<td>" .$row['fecha']. "</td>";
                      echo"<td>" .$row['pausa']. "</td>";
                      echo"<td>" .$row['reanudar']. "</td>";
                      echo"<td>" . $diff->format('%h h %i min'). "</td>";
                  echo "</tr>";
              }
              echo "</table>";
          } else {
              echo "No hay registros que mostrar";
          }
  ?>
      </div>
      </div>
  </main>

      <p>
          <a href="informetiempo.php">INFORMES DE TIEMPO</a>
      </p>
      <script src="js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
  </body>
    <?php
            $conn->close();
    }//else
}//empleado
if($rol =="admin"){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title>PERFIL ADMIN</title>

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
                <a class="nav-link active" aria-current="page" href="perfil.php">
                  <span data-feather="home"></span>
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
                <a class="nav-link" href="proyecto.php">
                  <span data-feather="file"></span>
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
    //MOSTRAR LOS DATOS DEL EMPOLEADO
        echo"<h1> Datos del empleado </h1>";
            $sql = "SELECT * FROM empleados WHERE idempleado LIKE '$idempleado'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table table-striped table-sm'>";
                echo "<tr>";
                        echo "<th> ID Empleado </th>";
                        echo"<th> Nombre </th>";
                        echo"<th> Apellido </th>";
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo"<td>" .$row["idempleado"]. "</td>";
                        echo"<td>" .$row["nombre"]. "</td>";
                        echo"<td>" .$row["apellido"]. "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Empleado no encontrado";
            }
    //MOSTRAR LOS TIEMPOS DEL DIA
        echo"<br>";
        echo"<br>";
        echo "<h2> Registros del día </h2>";
        $sql2 = "SELECT * FROM inicio_fin_sesion WHERE idempleado LIKE '$idempleado' AND dia LIKE '$fecha' ";
        $result = $conn->query($sql2);
        
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table table-striped table-sm'";
                    echo "<tr>";
                        echo"<th> PROYECTO </th>";
                        echo"<th> FECHA </th>";
                        echo"<th> ENTRADA </th>";
                        echo"<th> SALIDA </th>";
                        echo"<th> TOTAL DEL DIA </th>";
                    echo "</tr>";
                while($row = $result->fetch_assoc()) {
                //resumen del dia
                    $date1 =date_create($row['entrada']);
                    $date2 = date_create($row['salida']);
                    $diff = date_diff($date1, $date2);
                    $diff->format('%h horas');

                    echo "<tr>";
                        echo"<td>" .$row['proyecto']. "</td>";
                        echo"<td>" .$row['dia']. "</td>";
                        echo"<td>" .$row['entrada']. "</td>";
                        echo"<td>" .$row['salida']. "</td>";
                        echo"<td>" . $diff->format('%h h %i min'). "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No hay registros que mostrar";
            }
    //MOSTRAS LAS PAUSAS
        echo"<br>";
        echo"<br>";
        echo "<h2> Pausas </h2>";
        $sql3 = "SELECT * FROM pausas WHERE idempleado LIKE '$idempleado' AND fecha LIKE '$fecha' ";
        $result = $conn->query($sql3);
        
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table table-striped table-sm'>";
                    echo "<tr>";
                        echo"<th> PROYECTO </th>";
                        echo"<th> FECHA </th>";
                        echo"<th> PAUSA </th>";
                        echo"<th> REANUDAR </th>";
                        echo"<th> TOTAL PAUSA</th>";
                    echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    //resumen del dia
                    $date1 =date_create($row['pausa']);
                    $date2 = date_create($row['reanudar']);
                    $diff = date_diff($date1, $date2);
                    $diff->format('%h h %i min');
                    echo "<tr>";
                        echo"<td>" .$row['proyecto']. "</td>";
                        echo"<td>" .$row['fecha']. "</td>";
                        echo"<td>" .$row['pausa']. "</td>";
                        echo"<td>" .$row['reanudar']. "</td>";
                        echo"<td>" . $diff->format('%h h %i min'). "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No hay registros que mostrar";
            }
    ?>
        </div>
        </div>
    </main>

        <p>
            <a href="informetiempo.php">INFORMES DE TIEMPO</a>
        </p>
        <script src="js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
    </body>
      <?php
              $conn->close();
  }//admin
?>
</html>