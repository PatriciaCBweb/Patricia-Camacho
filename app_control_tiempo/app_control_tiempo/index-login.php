<?php
session_start();

// define variables y asigna valor 
$user = '';
$errorUser = '';
$errorCodigo = '';
$idempleado='';


// validamos el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // 1. Validar input usuario
  if ($_POST['email'] == '') {
    $errorUser = "Escribe tu email";
  } else {
    $user = $_POST["email"];
  }

	//Validar ID de empleado
	
	// Aqui verificaremos el Código Empleado
	if ( !empty($_POST["idEmpleado"]) ) {
		$idempleado=$_POST["idEmpleado"];
		} else {

			$errorCodigo = "Introduce tu código";
		}
	
	//


  // 3. Validamos si existe usuario
   if (($user != '')) {
  // if ( ($_POST['email'] != "") && ($_POST['password'] != "") ) {

    // Entonces ya podemos conectar con el servidor
    include("conexion.php");
    

    $sql = "SELECT *
          	FROM empleados 
            WHERE email='$user' AND idempleado='$idempleado'
            ";
	  
	   
    $result = $conn->query($sql);

    // si hay conexión, resultado devuelve 0 o 1 si coincide
    if ($result->num_rows > 0) {
		
      $row=$result->fetch_assoc();

      $_SESSION["idempleado"]= $row['idempleado'];
      $_SESSION["rol"]= $row['rol'];
      $_SESSION["nombre"]= $row['nombre'];

        header('location:dashboard.php');
        // header ('location:dashboard.php?email=' . $_POST["email"] );

    } else {
      $errorPass = 'El usuario no existe';
    }
    $conn->close();
  } // FIN validación &&
} // FIN validación ||


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.83.1">
  <title>WORKTIME</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <style>
	  
	  a {
		  color: #0095A3;
	  	}
	 .btn-info {
		  background-color: #080744;
		 color: #fff;
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
  <link href="./css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

		  <main class="form-signin">
			<form action="index-login.php" method="post">
			  <a href="index.php"><img class="mb-4 mt-2" src="brand/logo_WT.svg" alt="Worktime" title="" width="250px" height=""></a>
			  <h1 class="h3 mb-5 fw-normal">Por favor, identifícate</h1>

			  <div class="form-floating">
				<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $user ?>">
				<label for="floatingInput">Email </label>
				<span class="text-danger"><?php echo $errorUser ?></span>
			  </div>
				
			<div class="form-floating">
				<input type="text" name="idEmpleado" class="form-control" id="floatingPassword" placeholder="Introduce tu Id de empleado " value="<?php echo $idempleado ?>">
				<label for="floatingPassword">ID Empleado</label>
				<span class="text-danger"><?php echo $errorCodigo ?></span>
		  </div>
			  
			  <button class="w-100 btn btn-lg btn-info" type="submit" name="action" value="signin">Entrar</button>
			</form>
			  

    <!-- Recupera la contraseña en otro documento   -->
    <!-- <form action="olvidado.php" method="post">
      <button class="btn btn-link" type="submit" name="action" value="forget">He olvidado la contraseña</button>
    </form> -->
    <!-- enlace para ir a página olvidado.php -->


    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>

  </main>
</body>

</html>