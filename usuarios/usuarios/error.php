<?php
	session_start();

	if(!isset($_SESSION["time"])){
		$_SESSION["time"] = time();
		}
		elseif(time() - $_SESSION["time"] > 30){
			session_destroy();
			unset($_SESSION["contador"]);
			header("location: index.php");
			die();
		}
	$_SESSION["time"] = time();
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
<link href="css/signin.css" rel="stylesheet">
</head>

<body>
<main style="max-width:500px;" class="mx-auto">
	<h1 class="text-center">Error</h1>
	<h1 class="h4 mb-3 fw-normal text-center">Has superado el número máximo de intentos de inicio de sesión. Tienes que esperar (30") para volver a intentarlo.</h1>
	</main>
</body>
</html>