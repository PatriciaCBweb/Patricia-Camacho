<?php
	session_start();

	$correo = NULL;
	$contrasena = NULL;
	$warning = NULL;
	$color = NULL;
	$contador =0;

	if(isset($_SESSION["contador"])){
		$contador = $_SESSION["contador"];
	}
	if(isset($_SESSION["contador"]) && $_SESSION["contador"]>2){
		header("location: error.php");
	}
	else{
		$_SESSION["contador"] = 0;
	}
//Temporizador para resetear contador
	if(!isset($_SESSION["time"])){
		$_SESSION["time"] = time();
		}
		elseif(time() - $_SESSION["time"] > 900){
			session_destroy();
			unset($_SESSION["contador"]);
			header("location: index.php");
			die();
		}
	$_SESSION["time"] = time();

	if(isset($_REQUEST['correo'])){
		$correo = test_input($_REQUEST['correo']);
	}

	if(isset($_REQUEST['contrasena'])){
		$contrasena = test_input($_REQUEST['contrasena']);
	}
	
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
			
//Filtros email y contraseña
			if(empty($correo) || empty($contrasena)){
				$warning = "Rellena email y contraseña";
				$color="danger";
			}

			elseif(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				$warning = "Email no válido";
				$color="danger";
			}

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "controlhoras";

//Conexión a la BS
			$conn = new mysqli($servername,$username,$password,$dbname);
		
//Comprobación conexión		
			if($conn->connect_error){
				die("Error en la conexión: ".$conn->connect_error);
			}		
		
//Consulta
			if(!empty($correo) && !empty($contrasena)){
				$sql = "SELECT * FROM admin WHERE email='$correo'";
				$result = $conn->query($sql);
				$row = mysqli_fetch_assoc($result);	
				
				if(strcasecmp($correo,$row['email'])==0){
					if(strcasecmp($correo,$row['email'])==0 && $contrasena == $row['password']){
						if($row['rol'] === "user"){
							header("location: album/album.php");
							$_SESSION["contador"] = 0;
							$_SESSION['usuario'] = $row['firstname']." ".$row['lastname'];
						}
						else{
							header("location: dashboard/dashboard.php");
							$_SESSION["contador"] = 0;
							$_SESSION['usuario'] = $row['firstname']." ".$row['lastname'];
						}	
						if(isset($_REQUEST["remember"]) && $_REQUEST["remember"] == "rememberMe"){
							setcookie("login",$email,time()+3600,"/");
						
						}
					}
					else{
						$warning = "Contraseña incorrecta";
						$color="danger";
						$contador++;
						$_SESSION["contador"] = $contador;
					}

				}
				else{
					$warning = "Usuario no registrado.";
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
  <form method="post" action="index.php" class="mb-2">
    <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo" value = "<?php echo $correo ?>">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control mb-0" id="floatingPassword" placeholder="Contraseña" name="contrasena">
      <label for="floatingPassword">Contraseña</label>
    </div>
	  
    <div class="checkbox mb-1 mt-2">
      <label>
        <input type="checkbox" value="rememberMe" name="remember" > Recordar
      </label>
    </div>
    <p class="text-secondary m-0">Contador: <?php echo $contador ?>/3</p>
	<p class="mt-1 text-<?php echo $color ?>"><?php echo $warning ?></p>
    <button class="w-100 btn btn-lg btn-secondary" type="submit" name="start" value="start">Iniciar sesión</button>
  </form>
  <a href="insertAdmin.php"><button class="w-100 btn btn-lg btn-secondary">Registrar datos</button></a>
  <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
</main>


    
  </body>
</html>




