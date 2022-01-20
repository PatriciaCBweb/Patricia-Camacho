<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<?php
		$base=new PDO("mysql:host=localhost;dbname=movilessa","root","");
		$base->exec("SET CHARSET utf8");
		extract($_GET);
	?>
</body>
</html>