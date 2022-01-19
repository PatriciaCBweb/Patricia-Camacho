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
//SESIONES
  if(isset($_SESSION["nombre"])) {
    
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
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
      <title>REGISTRO EMPLEADOS</title>

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
                <a class="nav-link" href="tabla_empleados.php">
                  <span data-feather="file"></span>
                  Tabla de Empleados
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="reg_admin.php">
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
<?php
//VARIBLES
  $idempleado = $nombre = $apellido = $email = $telf = $rol ="";
  $errorid = $errornom = $errorape = $erroremail = $errortelf = $errorRol ="";
//VALIDAR VARIBLES
  if(isset($_REQUEST["idempleado"])){
    $idempleado=$_POST['idempleado'];
  }
  if(isset($_REQUEST["nombre"])){
    $nombre=$_POST['nombre'];
  }
  if(isset($_REQUEST["apellido"])){
    $apellido=$_POST['apellido'];
  }
  if(isset($_REQUEST["email"])){
    $email=$_POST['email'];
  }
  if(isset($_REQUEST["telf"])){
    $telf=$_POST['telf'];
  }
  if(isset($_REQUEST["rol"])){
    $rol=$_POST['rol'];
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

  //ID empleado
  if(empty($_POST["idempleado"])){
      $errorid = "CAMPO REQUERIDO";
    }else{
        if(!preg_match("/^[0-9]*$/", $idempleado)){
          $errorid ="ID Empleado incorrecto (Solo numeros)";
          $idempleado="";
        }else{
          $idempleado = test_input($_REQUEST["idempleado"]);
        }
    }
  //Nombre
  if (empty($_POST["nombre"])) {
      $errornom = "CAMPO REQUERIDO";
    } else {
  // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' áéíóúAÉÍÓÚÑñ]*$/",$nombre)) {
        $errornom = "Solo letras o espacios en blanco";
        $nombre ="";
      }else{
        $nombre = test_input($_POST["nombre"]);
      }
    }
  //Apellido
  if (empty($_POST["apellido"])) {
      $errorape = "CAMPO REQUERIDO";
  } else {
      $apellido = test_input($_POST["apellido"]);
  // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' áéíóúAÉÍÓÚÑñ]*$/",$apellido)) {
        $errorape = "Solo letras o espacios en blanco";
        $apellido ="";
      }
  }
  //Email
  if (empty($_REQUEST["email"])) {
      $emailErr = "CAMPO REQUERIDO";
  } else {
  // comprueba el email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "EMAIL NO VALIDO";
          $email =""; 
      }else{
          $email = test_input($_REQUEST["email"]);
      }
  }
  //Telefono
  if(empty($_POST["telf"])){
      $errortelf = "CAMPO REQUERIDO";
    }else{
        $telf= test_input($_POST['telf']);
        if(!preg_match("/^[0-9]*$/", $telf)){
          $errortelf ="Telefono incorrecto (Solo numeros)";
          $telf="";
        }
    }//if empty idempleado

  //ROL
  if(empty($_POST["rol"]) || $rol == "vacio"){
      $errorRol ="Campo Requerido";
    }else{
      $rol = test_input($_POST["rol"]);
    }
  }//if server
//INTRODUCIR REGISTRO EN LA BASE DE DATOS
  if(!empty($idempleado) && !empty($nombre) && !empty($apellido) && !empty($email) && !empty($telf) && !empty($rol)){
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql ="SELECT * FROM empleados WHERE idempleado LIKE '$idempleado'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Este ID Empleado ya existe";
        $idempleado = $nombre= $apellido = $email=$telf= $rol= "";
    }else{
      $sql2 = "INSERT INTO empleados (idempleado, nombre, apellido, email, telefono, rol)
        VALUES ('$idempleado', '$nombre', '$apellido', '$email', '$telf', '$rol')";
    
      if ($conn->query($sql2) === TRUE) {
        echo "Empleado registrado correctamente";
        $idempleado = $nombre= $apellido = $email=$telf= $rol= "";
        } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
      }
    }
    $conn->close();
  }
?>
  <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">FORMULARIO</h4>
        <form class="needs-validation" method ="POST" action="reg_admin.php">
          <div class="row g-3">
            <div class="col-12">
              <label for="username" class="form-label">ID Empleado</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="idempleado" placeholder="ID Empleado" name="idempleado" value="<?php echo $idempleado?>" required>
              </div>
              <p class="error"><?php echo $errorid?></p>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Nombre</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo $nombre?>" required>
              </div>
              <p class="error"><?php echo $errornom?></p>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Apellido</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo $apellido?>" required>
              </div>
              <p class="error"><?php echo $errorape?></p>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Email</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $email?>" required>
              </div>
              <p class="error"><?php echo $erroremail?></p>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Telefono</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="telf" placeholder="000 000 000" name="telf" value="<?php echo $telf?>" required>
              </div>
              <p class="error"><?php echo $errortelf?></p>
            </div>

            <div class="col-md-5">
              <label for="rol" class="form-label">Rol Empleado</label>
              <select class="form-select" id="rol" value="rol" name ="rol" required>
                <option value="">Elige un rol...</option>
                <option value="empleado" <?php if (isset($rol) && $rol=="empleado");?>>Empleado</option>
                <option value="admin" <?php if (isset($rol) && $rol=="admin");?>>Admin</option>
              </select>
              <p class="error"><?php echo $errorRol?></p>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
        </form>
      </div>
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
