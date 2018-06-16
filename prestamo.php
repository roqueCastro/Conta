<?php
	session_start();	

	require("conexion.php"); //Conexion a la base de datos

    $_SESSION['dineroF']=0;
    $usuario=$_SESSION['id']; // Id del usuario
	$_SESSION['dineroT_P']=0; //Variable donde hacemos la suma de toda la deuda

	// Comprobamos si hay un usuario ingresado o iniciando session sino lo manda al login
	if(! isset($_SESSION['id'])){
		?>
			<script>window.location="login.php?codi=0";</script>
		<?php
	}
// ---------------------------------------------------------------------------------------

// Consulta de las tablas gasto, saldo y usuarios..
	$sql ="SELECT * FROM prestamo WHERE id_usu=$usuario ORDER BY id_pre DESC";
	$resu=$base->prepare($sql);
	$resu->execute(array());
	while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){


		$preci_P=$consulta['precio_pre']; // Variable precio del articulo
		$_SESSION['dineroT_P']=$_SESSION['dineroT_P']+$preci_P; // suma de todos los articulos
	}

	//$queda=$saldo-$_SESSION['dineroT']; //Saldo restado el dinero de todos los articulos
	//----------------------------------------------------------------------------------------------------------------

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
	<script src="LIBRERIAS/jquery-3.2.1.min.js"></script>
	
	<title> Gastos </title>
	<script src="LIBRERIAS/jquery-3.2.1.min.js"></script>
	<script>
		function FormularioFia(){
			
			var total_prestamo = $("#T_Presta_Fi").val();
			var nombre_fi = $("#Fiador").val();
		    var idUsuario = $("#id_usu").val();
		    var debe = $("#debe").val();
		
			
			if(total_prestamo.length == 0) {
				$("#resultado").html("Inserte el valor del prestamo");	
				$("#T_Presta_Fi").focus();
			   }else if(nombre_fi.length == 0) {
				   $("#resultado").html("Inserte nombre de la persona que presta");	
				   $("#Fiador").focus();
			   }else if(total_prestamo < debe) {
					$("#resultado").html("El total de prestamo debe ser mayor a lo que debes " + "$" + debe );	
				    $("#T_Presta_Fi").focus();
			   }else{
				   $("#resultado").html(" ");	
				   	$.ajax({
					data: {"total_prestamo":total_prestamo, "nombre_fi": nombre_fi, "idUsuario" : idUsuario },
					url: 'INSERT/registro_fia.php',
					type: 'post',
					beforeSend: function(){
						$("#resultado").html("Procesando.....");
					},
					success: function(response){
						if(response=="true"){
							$("#T_Presta_Fi").val('');	
							$("#Fiador").val('');	
							$("#resultado").html('Exitoso');
							window.location="index.php"
						}else{
							$("#resultado").html(response);	
						}
						
					}
					
				});
		
			   }
		}
	</script>

</head>

<body>
		<div class="navbar-fixed-top">
			<ol class="breadcrumb">
				<li class="panel-footer"><a class="panel-heading" href="nuevaSemana.php">
					<em class="fa fa-file-o"></em>
				</a></li>
				<li id="li" class="panel-heading" >
					
					<!-- SE MIRA EL PRECIO DE LA DEUDA -->
					
						 PRESTAMOS  <span>  debes  $<?php echo $_SESSION['dineroT_P']; ?></span>
				</li>
			</ol>
		</div><!--/.row-->
	
	
		<div class="panel-body">
			
		<div>
			<form action="../FORMULARIO RESPONSIVO/formRegistro1.php" method="post">
			<h2>Persona que le debes</h2>


			<!--<textarea name="mensaje" placeholder="Escriba aqui su mensaje"></textarea>---->
			<input type="hidden" value="<?php echo $usuario; ?>" id="id_usu"  required>
			<input type="hidden" value="<?php echo $_SESSION['dineroT_P'] ?>" id="debe"  required>
			<div id="resultado"></div>
			<input type="number" id="T_Presta_Fi"  placeholder="Total de prestamo" required>
			<input type="text" id="Fiador"  placeholder="Nombre la persona que te empresto" required>
			<input type="button" onClick="FormularioFia()" value="Registrar" id="boton">	
			</form>
		</div>
		</div>
	
	<br>
	<br>
	
		
<!-- TABLA GUARDA LA LISTA -->
	<div class="container-fluid">
	<div class="">
		<div class="">
			<span class="panel-title center-block" style="font-size: 17px; text-align: center">PRESTAMOS</span>
			<br>
			<table class="table-responsive">
					<tr>
						<th>
							Nombre 
						</th>
						<th>
							Precio
						</th>
						<th>
							$ pagar
						</th>
					</tr>				
					
					<?php
		
						try{
							$n=0;
							$sql ="SELECT * FROM fiador WHERE id_usu=$usuario and precio_T_Fi>0 ORDER BY id_fia DESC";
							$resu=$base->prepare($sql);
							$resu->execute(array());
							while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
								$nom = $consulta['nombre_fia'];
								$id = $consulta['id_fia'];
								$precio_d = $consulta['precio_T_Fi'];
								$_SESSION['dineroF']=$_SESSION['dineroF']+$precio_d;
								?>
									<tr>
										<td> <p style="font-size: 14"> <?php echo $nom  ?> </p> </td>
										<td> <p style="font-size: 14px"> $<?php echo $precio_d ?> </p> </td>
										<td> <a href="pagar_prestamo.php?codi=<?php echo $id ?>"> <img src="img/debes.png" height="40px"> </a> </td>
									</tr>
								<?php
							}
						}
						catch(Exeption $e){
							die("Error".$e->getMessage());
						} 
		
				?>
				<tr>
					<th colspan="2">Total que debes</th>
					<td colspan="2"> <?php echo $_SESSION['dineroF']; ?> </td>
				</tr>
			</table>
		</div>
	</div>
</div>
		
		




		
		
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
