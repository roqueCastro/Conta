<?php
session_start();
require('conexion.php');	
$usuario=$_SESSION['id'];
$_SESSION['semana']=1;
$ts=0;
$url=$_REQUEST['codi'];

try{
	$sql ="SELECT * FROM saldo WHERE id_usu=$usuario";
	$resu=$base->prepare($sql);
	$resu->execute(array());
	while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
		$ts=$consulta['id_sem'];
	}
		// PENDIENTE $suma=$saldo+$_POST['saldo'];
	
}catch(Exepiton $e){
	die('error'.$e->getMessage());
}
	
	
	if(isset($_POST['envio'])){
		try{
				
				$semana=0;
				$sal=0;
				$sql ="SELECT * FROM saldo WHERE id_usu=$usuario";
				$resu=$base->prepare($sql);
				$resu->execute(array());
				while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
					$semana=$consulta['id_sem'];
					$sal=$consulta['n_saldo'];
				}
		
				if($_REQUEST['codi']==1 || $ts==0){
					echo 'vacia';
					
					try{
					    if($sal<0){
					        $sal=0;
					    }
						$ts=$ts+1;
						$sql2 ="INSERT INTO saldo (n_saldo, id_sem, id_usu) VALUES (:saldo, :semana, :usuario)";
						$resu2=$base->prepare($sql2);
						$resu2->execute(array(":saldo"=>$sal, ":semana"=>$ts, ":usuario"=>$usuario));
						$c=$resu2->rowCount();
						if($c==0){
							echo "no se a podido ejecutar Errror...";
							echo "<br> saldo.. ".$_POST['saldo']." Semana...".$ts." uSUArio.......".$usuario;
						}else{
							echo "correcto";
							?>
								<script>window.location="index.php";</script>							
							<?php
						}
				
					}
					catch(Exeption $e){
						die("Error".$e->getMessage());
					}
					
					
				}else if($semana==$ts && $url==0){
					echo 'llena';
					
					try{
						$sql ="UPDATE saldo SET n_saldo=:saldo WHERE id_sem=$ts and id_usu=$usuario";
						$resu=$base->prepare($sql);
						$resu->execute(array(":saldo"=>$_POST['saldo']));
						
						?>
							<script>window.location="index.php";</script>
						<?php
					}
					catch(Exeption $e){
						die("Error".$e->getMessage());
					}
					
				}
				
			}
			catch(Exeption $e){
				die("Error".$e->getMessage());
			}
			
			
			if($url==2){
					echo 'llena';
					
					try{
					    $suma=$sal+$_POST['saldo'];
						$sql ="UPDATE saldo SET n_saldo=:saldo WHERE id_sem=$ts and id_usu=$usuario";
						$resu=$base->prepare($sql);
						$resu->execute(array(":saldo"=>$suma));
						
						?>
							<script>window.location="index.php";</script>
						<?php
					}
					catch(Exeption $e){
						die("Error".$e->getMessage());
					}
					
				}

	}	
?>
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
					
					
						 Saldo
					
				</li>
			</ol>
		</div><!--/.row-->
	<nav class="nav">
		<h1 class="panel-title center-block"> INGRESA SALDO</h1>
<form action="" method="post">
	<center>
		<input type="number" style="border-color: #64CB33" value="<?php echo $saldo; ?>" name="saldo">
		<input type="submit" value="Concinar" name="envio">
	</center>
	
</form>		
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
