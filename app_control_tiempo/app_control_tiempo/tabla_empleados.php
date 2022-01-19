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
//SESIONES
  if(isset($_SESSION["nombre"])) {
    
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
  }
//VARIABLES
    $idempleado ="";
    if(isset($_REQUEST["idempleado"])){
        $idempleado=$_POST['idempleado'];
    }
    $nombre ="";
    if(isset($_REQUEST["nombre"])){
          $nombre=$_POST['nombre'];
    }
    $apellido ="";
    if(isset($_REQUEST["apellido"])){
          $apellido=$_POST['apellido'];
    }
    $email ="";
    if(isset($_REQUEST["email"])){
          $email=$_POST['email'];
    }
    $telf ="";
    if(isset($_REQUEST["telefono"])){
          $telf=$_POST['telefono'];
    }
    $rol ="";
    if(isset($_REQUEST["rol"])){
          $rol=$_POST['rol'];
    }
  
?>
<!doctype html>
  <html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.84.0">
      <title>TABLA DE EMPLEADOS</title>

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
              <a class="nav-link" href="informetiempo.php">
                <span data-feather="layers"></span>
                Reportes
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="tabla_empleados.php">
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
          <h1 class="h2">Hola <?php echo $nombre; ?> Admin</h1> <!--Incluir $empleado-->
        </div>    
  <div class="container">
    <div class="table-responsive">
      <h2>EMPLEADOS</h2>
<?php
            $sql = "SELECT * FROM empleados";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table table-striped table-sm'>";
                echo "<tr>";
                        echo"<th> ID EMPLEADO </th>";
                        echo"<th> NOMBRE </th>";
                        echo"<th> APELLIDO </th>";
                        echo"<th> EMAIL </th>";
                        echo"<th> TELEFONO </th>";
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo"<td>" .$row["idempleado"]. "</td>";
                        echo"<td>" .$row["nombre"]. "</td>";
                        echo"<td>" .$row["apellido"]. "</td>";
                        echo"<td>" .$row["email"]. "</td>";
                        echo"<td>" .$row["telefono"]. "</td>";   
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
?>
      <form action="tabla_empleados.php" method="POST">
      <p>
        ID Empleado <input type="text" name="idempleado" value="<?php echo $idempleado?>">
    </p>
      <button type="submit" class="btn btn-sm btn-outline-secondary" name="editar">EDITAR</button>
      <?php
      if(isset($_REQUEST['editar'])){
//BUSQUEDA POR ID EMPLEADO
    $sql = "SELECT * FROM empleados WHERE idempleado LIKE '$idempleado'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo"<br>";
        echo "<table class='table table-striped table-sm'>";
        echo "<tr>";
                echo "<th> ID Empleado </th>";
                echo"<th> Nombre </th>";
                echo"<th> Apellido </th>";
                echo "<th> Email </th>";
                echo"<th> Telefono </th>";
                echo"<th> Rol </th>";
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
                echo"<td>".$row['idempleado']."</td>";
                echo"<td><input type='text' name='nombre' value=".$row['nombre']."></td>";
                echo"<td><input type='text' name='apellido' value=".$row['apellido']."></td>";
                echo"<td><input type='text' name='email' value=".$row['email']."></td>";
                echo"<td><input type='text' name='telf' value=".$row['telefono']."></td>"; 
                echo"<td><input type='text' name='rol' value=".$row['rol']."></td>";
            echo "</tr>";
            $idempleado = $row['idempleado'];
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $email = $row['email'];
            $telf = $row['telefono'];
            $rol = $row['rol'];
        }
    } else {
        echo "No se encuentra el ID Empleado";
    }
      }//request editar
?>
      <hr>
    <button type="submit" class="btn btn-sm btn-outline-secondary" name="modificar">EDITAR DATOS</button>
      </form>
<?php
//VARIABLES NUEVAS
//RECOGER VARIABLES NUEVAS CON UN REQUEST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_REQUEST['nombre'])){
        $name = $_REQUEST['nombre'];  
    }
    if(isset($_REQUEST['apellido'])){
      $lastname = $_REQUEST['apellido'];  
  }
  if(isset($_REQUEST['email'])){
    $correo = $_REQUEST['email'];  
  }
  if(isset($_REQUEST['telf'])){
    $numtelf = $_REQUEST['telf'];  
  }
  if(isset($_REQUEST['rol'])){
    $puestorol = $_REQUEST['rol'];  
  }
}
//MODIFICAR TABLA
if(isset($_REQUEST['modificar'])){
    echo"<br>";
    //MODIFICAR NOMBRE
    $sql2 = "UPDATE empleados SET nombre='$name' WHERE idempleado='$idempleado'";
    if ($conn->query($sql2) === TRUE) {
        echo "Has actualizado el nombre del ". $idempleado. " por ".$name;
        echo"<br>";
    } 
    else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    //MODIFICAR APELLIDO
        $sql3 = "UPDATE empleados SET apellido='$lastname' WHERE idempleado='$idempleado'";
        if ($conn->query($sql3) === TRUE) {
            echo "Has actualizado el nombre del ". $idempleado. " por ".$lastname;
            echo"<br>";
        } 
        else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
    //MODIFICAR EMAIL
      $sql4 = "UPDATE empleados SET email='$correo' WHERE idempleado='$idempleado'";
      if ($conn->query($sql4) === TRUE) {
          echo "Has actualizado el nombre del ". $idempleado. " por ".$correo;
          echo"<br>";
      }else {
         echo "Error: " . $sql4 . "<br>" . $conn->error;
      }
      //MODIFICAR TELEFONO
      $sql5 = "UPDATE empleados SET telefono='$numtelf' WHERE idempleado='$idempleado'";
      if ($conn->query($sql5) === TRUE) {
        echo "Has actualizado el nombre del ". $idempleado. " por ".$numtelf;
        echo"<br>";
      }else {
         echo "Error: " . $sql5 . "<br>" . $conn->error;
      }
      //MODIFICAR ROL
        $sql6 = "UPDATE empleados SET rol='$puestorol' WHERE idempleado='$idempleado'";
        if ($conn->query($sql6) === TRUE) {
          echo "Has actualizado el nombre del ". $idempleado. " por ".$puestorol;
          echo"<br>";
        }else {
          echo "Error: " . $sql6 . "<br>" . $conn->error;
        }
}//request modificar
?>
      
    </div>
  </div>
  </main>
      <script src="js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../3.Login_user/3.Sing_in-Sesion/dashboard.js"></script>
    </body>
<?php
  }//entrada a lo bruto filtro
?>
</html>
