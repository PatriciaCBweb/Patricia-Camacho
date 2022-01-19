<?php
	$correo = NULL;
	$nombre = NULL;
	$apellido = NULL;
	$contrasena = NULL;
	$rol = NULL;
	$aleatorio = substr(sha1(mt_rand()),17,8);
	$warning = NULL;
	$color = NULL;
	$disabled = NULL;

	if(isset($_REQUEST["correo"])){
		$correo = test_input($_REQUEST["correo"]);
	}
	if(isset($_REQUEST["nombre"])){
		$nombre = test_input($_REQUEST["nombre"]);
	}
	if(isset($_REQUEST["apellido"])){
		$apellido = test_input($_REQUEST["apellido"]);
	}
	if(isset($_REQUEST["contrasena"])){
		$contrasena = test_input($_REQUEST["contrasena"]);
	}
	if(isset($_REQUEST["rol"])){
		$rol = test_input($_REQUEST["rol"]);
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(empty($correo) || empty($nombre) || empty($apellido) || empty($contrasena) || empty($rol)){
			$warning = "Formulario incompleto";
			$color= "danger";
		}
		elseif(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
			$warning = "Email no válido";
			$color= "danger";
		}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "controlhoras";

	// CONECTAR
	$conn = new mysqli($servername, $username, $password, $dbname);

	// COMPROBAR CONEXIÓN
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	if(!empty($correo) && !empty($nombre) && !empty($apellido) && !empty($contrasena) && !empty($rol)){
	
		$sql = "INSERT INTO admin (code, email, password, firstname, lastname, rol)
				VALUES ('$aleatorio', '$correo', '$contrasena', '$nombre', '$apellido', '$rol')";

		if ($conn->query($sql) === TRUE) {
		  $warning =  "Registro realizado con éxito";
		  $color = "success"; 
		  $disabled = "disabled";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();	
}
	
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
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
	  .radio{
		border: 1px solid #ced4da;
		padding: 12px 16px;
		background-color: white;
		text-align: left;
	  }
    </style>

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post" action="insertAdmin.php">
    <h1 class="h3 mb-3 fw-normal">Registro</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo">
      <label for="floatingInput">Email</label>
    </div>
	<div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" name="nombre">
      <label for="floatingInput">Nombre</label>
    </div>
	<div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Apellido" name="apellido">
      <label for="floatingInput">Apellido</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control mb-0" id="floatingPassword" placeholder="Contraseña" name="contrasena">
      <label for="floatingPassword">Contraseña</label>
    </div>
	<div class="radio">
	  <label for="floatingPassword">Rol &nbsp;&nbsp;&nbsp;</label>
      <input type="radio"  id="floatingCheckbox" value="user" name="rol"> Usuario &nbsp;
	  <input type="radio"  id="floatingCheckbox" value="admin" name="rol"> Administrador   
    </div>

	<p class="mt-1 text-<?php echo $color ?>"><?php echo $warning ?></p>	

    <button class="w-100 btn btn-lg btn-secondary" type="submit" <?php echo $disabled ?>>Registrar datos</button>
  </form>

  <a href='index.php'><button class='w-100 btn btn-lg btn-secondary mt-2'>Volver</button></a>

  <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
</main>


    
  </body>
</html>




