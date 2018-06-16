	<?php
	session_start();	
	require("../conexion.php");
	if(! isset($_SESSION['id'])){
		?>
			<script>window.location="../login.php";</script>
		<?php
	}
    $usuario=$_SESSION['id'];
	$saldo=0; // Guarda el saldo de la semana traido por el methodod POST
	$n=0; // Guarda el numero de la semana traido por el methodod POST
	$tPrecio=0; // sumatoria de todos los precios
	$suma=0; // Es la resta del precio con el total de precio de los articulos
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>APP Desayunos</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	<link href="../css/estilo.css" rel="stylesheet">
	<link href="../css/tabla.css" rel="stylesheet">
	
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
				<li class="panel-footer"><a class="panel-heading" href="../index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li id="li" class="panel-heading" >
					
					<!-- SE MIRA SI HAY PEDIDOS -->
					
					
					<a href="../nuevaSemana.php">	 Nueva Semana </a>
					
				</li>
			</ol>
		</div><!--/.row-->
	<nav class="nav">
		
		

	<center> <form action="" method="post">
		<select class="input-lg" name="nSemana" required>
			<option value="0">Seleccione Semana</option>
			<?php	
				try{
					
					$sql ="SELECT * FROM saldo WHERE id_usu=$usuario";
					$resu=$base->prepare($sql);
					$resu->execute(array());
					while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
						echo'<option value="'.$consulta['id_sem'].'">'.'Semana'.' '.$consulta['id_sem'].'</option>';
					}
			
				}
				catch(Exeption $e){
					die("Error".$e->getMessage());
				}
			?>			
		</select>
		<input type="submit" name="envio" value="Consultar" class="input-lg">
		</form>
	</center>
	<?php 
		if(isset($_POST['envio'])){
			$n=$_POST['nSemana'];
			if($n==0){
				?>
				<script>alert('Seleccione Una Semana');</script>
				<?php
			}else if ($n>0){
				?>
				<br>
				<br>
				<center> <p style="color: darkblue; font-size: 19px">SEMANA <?php echo $n; ?></p> </center>
				<br>
	
				<table align="center" bordercolor="#D1A521" class="table-condensed">
					<tr>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Fecha</th>
					</tr>
					
						<?php
						try{
				
							$sql ="SELECT * FROM gasto INNER JOIN saldo ON saldo.id_sal=gasto.id_sal WHERE saldo.id_sem=$n and gasto.id_usu=$usuario ORDER BY id_gas DESC";
							$resu=$base->prepare($sql);
							$resu->execute(array());
							while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
								$saldo=$consulta['n_saldo'];
								$precio=$consulta['precio'];
								?>
								<tr>
								
								<td> <?php echo $consulta['nombre']?> </td>
								<td> <?php echo $consulta['precio']?> </td>
								<td> <?php echo $consulta['fecha']?> </td>
								</tr>
								<?php
								
								$tPrecio=$tPrecio+$precio;
							}
								$suma=$saldo-$tPrecio;
						}
						catch(Exeption $e){
							die("Error".$e->getMessage());
						}
						?>
					<tr>
						<th>SALDO</th>
						<td colspan="4"> <p style="font-size: 45px"> $<?php echo $saldo; ?> </p> </td>
					</tr>
					<tr>
						<th>TOTAL QUE GASTO</th>
						<td colspan="4"> <p style="font-size: 35"> $<?php echo $tPrecio; ?> </p> </td>
					</tr>
					<tr>
						<th>DINERO QUE QUEDO</th>
						<td colspan="4"> <p style="font-size: 35"> $<?php echo $suma; ?> </p> </td>
					</tr>
				</table>
				<?php
			}
		}

	?>
	
		
	</nav>


		
		
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>

		
</body>
</html>	
	
	
	
	

</html>
