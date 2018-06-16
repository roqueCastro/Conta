<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>APP Desayunos</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/estilo.css" rel="stylesheet">
	<link href="css/tabla.css" rel="stylesheet">
	
	<style>
		body{
			overflow-x: hidden;
		}
	</style>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<title> nueva semana </title>

</head>

<body>
		<div class="navbar-fixed-top">
			<ol class="breadcrumb">
				<li class="panel-footer"><a class="panel-heading" href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li id="li" class="panel-heading" >
					
					<!-- SE MIRA SI HAY PEDIDOS -->
					
					
						 Nueva Semana
					
				</li>
			</ol>
		</div><!--/.row-->
	<nav class="nav">
		<center>
Seguro que Quieres una Nueva Semana
<br>
	<a href="INSERT/saldo.php?codi=<?php echo "1";?>"> <img src="img/bien.png" height="100px" ></a>
	<a href="index.php"> <img src="img/mal.png" height="100px" ></a>
	<br>
	<br>
	<br>
	<a style="text-decoration: none" href="CONSULTAS/ConsultarGastos.php"> <p style="color:green; font-size: 23px"> CONSULTA  DE GASTOS POR SEMANAS</p> </a>
    <br>
    <br>
    <br>
    <br>
	<a style="text-decoration: none" href="prestamo.php"> <p style="color:green; font-size: 23px"> CONSULTAR PRESTAMOS</p> </a>
</center>		
	</nav>


		
		
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

		
</body>
</html>