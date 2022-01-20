<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listado de incidencias</title>
	<style type="text/css">
		body{
			font-size: 0.8em;
			margin-top: 20px;
			background-color: #D3DFEE;
		}
		table{
			border: 1px solid #4F81BD;
			border-collapse: collapse;
			margin: auto;
			margin-left: 0.2px;
			width: 1200px;
		}
		th{
			border: 1px solid #4F81BD;
			background-color: #4F81BD;
			padding: 3px 10px;
			color: #fff;
		}
		td{
			border: 1px solid #4F81BD;
			text-align: center;
			padding: 3px 10px;
		}
		table, th, td{
			font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
		}
		.par{
			background-color: #D3DFEE;
		}
		.impar{
			background-color: #fff;
		}
		a{
			margin-left: 0.2px;
		}
	</style>
</head>

<body>
	<?php
		try{
			require_once("../Conexion_db.php");
			$sql="SELECT * FROM INCIDENCIASVENTAS";
			$preparada=$base->prepare($sql);
			$preparada->execute();
			$registros=0;
			echo "<table>";
			while($fila=$preparada->fetch(PDO::FETCH_ASSOC)){
				$registros++;
				if($registros==1){
					echo "<tr>";
					foreach($fila as $clave=>$valor){
						echo "<th>".$clave."</th>";
					}
					echo "</tr>";
				}
			echo "<tr>";
			foreach($fila as $clave=>$valor){
				if($registros%2==1){
					echo "<td class='impar'>".$valor."</td>";
					
				}
				else{
					echo "<td class='par'>".$valor."</td>";
				}
					
			}
			echo "</tr>";
			}
			echo "</table>";
			$preparada->closeCursor();
			echo "<br/><a href='../index.html'><input type='button' value='Inicio' /></a>";
		}catch(Exception $e){
			die($e->getMessage());
		}
	?>
</body>
</html>
