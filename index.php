<?php
	session_start();	

	require("conexion.php"); //Conexion a la base de datos

	// Comprobamos si hay un usuario ingresado o iniciando session sino lo manda al login
	if(! isset($_SESSION['id'])){
		?>
			<script>window.location="login.php?codi=0";</script>
		<?php
	}
// ---------------------------------------------------------------------------------------

	$_SESSION['dineroT']=0; //Inicializamos la variable dineroT  Para meter ahi todo el saldo de los gastos
	$_SESSION['prestamoT']=0; //Inicializamos la variable para sumar prestamos
	$_SESSION['idSemana']=0; //Inicializamos toda las semanas en session
    
	$usuario=$_SESSION['id'];
	try{
		// Consultamos todos los saldos que sean del mismo usuario..		
		$sql ="SELECT * FROM saldo WHERE id_usu=$usuario";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
			$idSa=$consulta['id_sem'];
			$saldo=$consulta['n_saldo'];
			$idS=$consulta['id_sal'];
		}
		//---------------------------------------------------------.
		// Aqui se mira si ya hay semanas Ingresadas..
		if($idSa==0){
			?>
				<script>window.location="INSERT/saldo.php";</script>
			<?php
		}
		
		// -------------------------------------------

		// Consulta de las tablas gasto, saldo y usuarios..
		$sql ="SELECT * FROM gasto INNER JOIN saldo ON saldo.id_sal=gasto.id_sal WHERE saldo.id_sem=$idSa and saldo.id_usu=$usuario ORDER BY id_gas DESC";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){


			$preci=$consulta['precio']; // Variable precio del articulo
			$_SESSION['dineroT']=$_SESSION['dineroT']+$preci; // suma de todos los articulos
		}

		$queda=$saldo-$_SESSION['dineroT']; //Saldo restado el dinero de todos los articulos
		//----------------------------------------------------------------------------------------------------------------
		
		
		// Consulta de prestamos
		$sql ="SELECT * FROM prestamo INNER JOIN usuario ON usuario.id_usu=prestamo.id_usu WHERE prestamo.id_usu=$usuario";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){


			$precioDeuda=$consulta['precio_pre']; // Variable precio del articulo prestado
			$_SESSION['prestamoT']=$_SESSION['prestamoT']+$precioDeuda; // suma de todos los articulos prestados
		}
		
		if($_SESSION['prestamoT']>0){
			echo '<script>window.location="prestamo.php";</script>';
		}
		//$queda=$saldo-$_SESSION['dineroT']; //Saldo restado el dinero de todos los articulos		
		//--------------------------------------------------------------------------------------------------

	}
	catch(Exeption $e){
		die("Error".$e->getMessage());
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
	<script src="LIBRERIAS/jquery-3.2.1.min.js"></script>
	<script>
		function Formulario(){
			var nombre = $("#nombre").val();
			var precio = $("#usuario").val();
			var idSaldo = $("#idS").val();
		    var idUsuario = $("#idUsu").val();
			var idSemana = $("#idSem").val();
			var Saldo = $("#Saldo").val();

			if(nombre.length ==	0 || precio.length ==0 || idSaldo.length ==0){
				$("#resultado").text("Datos Vacios");	
			}else{
				$.ajax({
					data: {"nombre":nombre, "precio": precio, "idSaldo" : idSaldo, "idSemana" : idSemana, "idUsuario" : idUsuario,"Saldo" : Saldo},
					url: 'INSERT/insert_gastos.php',
					type: 'post',
					beforeSend: function(){
						$("#resultado").html('<img src="img/cargando.gif" height="40">');
						$("#resultadoV").html("Procesando, espere por favor.. ");
					},
					success: function(response){
						if(response=="true"){
							$("#resultado").html("");
							$("#resultadoV").html("Registro Exitoso");
							window.location="index.php";
						}else{
							$("#resultadoV").html("");
							$("#resultado").html("Datos Erroneos No esta registrando...");
						}
						

					}
					
				});
			}

		}
	</script>
	<title> Gastos </title>

</head>

<body>
		<div class="navbar-fixed-top">
			<ol class="breadcrumb">
				<li class="panel-footer"><a class="panel-heading" href="nuevaSemana.php">
					<em class="fa fa-file-o"></em>
				</a></li>
				<li id="li" class="panel-heading" >
					
					<!-- SE MIRA SI HAY PEDIDOS -->
					
					
						 Semana <?php echo $idSa; ?>
					
				</li>
			</ol>
		</div><!--/.row-->
		
		<div class="panel-body">
			<div class="col-lg-12">
				<ol class="breadcrumb">
				<li class="panel-heading"><a class="panel-group" href="saldo.php?codi=2">
					Cosingnar 
					<p class="text-center" style="color: green"> <?php echo $saldo; ?> </p>
				</a></li>
				<li id="li" class="panel-heading">
					<a class="panel-group" href="saldo.php?codi=0">
						 Actualizar
					</a>
						<p class="text-center" style="color: red"> <?php echo $saldo; ?> </p>
				</li>
			</ol>
			</div>
			
			<div>
				<form action="../FORMULARIO RESPONSIVO/formRegistro1.php" method="post">
<h2>REGISTRE GASTO</h2>


<!--<textarea name="mensaje" placeholder="Escriba aqui su mensaje"></textarea>---->
<input type="hidden"  id="idS" value="<?php echo $idS; ?>" required />
<div id="resultado" align="center"></div>
<input type="hidden"  id="idSem" value="<?php echo $idSa; ?>" required />
<input type="hidden"  id="Saldo" value="<?php echo $saldo; ?>" required />
<input type="hidden"  id="idUsu" value="<?php echo $usuario; ?>" required />
<input type="text" id="nombre"  placeholder="Nombre Producto" required>
<input type="number" id="usuario"  placeholder="Precio" required>
<input type="button" onClick="Formulario()" value="Registrar" id="boton">	
</form>
</div>
		</div>
<!-- TABLA GUARDA LA LISTA -->
	<div class="container-fluid">
	<div class="">
		<div class="">
			<table class="table-responsive">
					<tr>
						<th>
							# Lista
						</th>
						<th>
							Nombre
						</th>
						<th>
							Precio
						</th>
						<th>
							Fecha
						</th>
						
					</tr>				
					
					<?php
		
						try{
							$n=0;
							$sql ="SELECT * FROM gasto INNER JOIN saldo ON saldo.id_sal=gasto.id_sal  WHERE saldo.id_sem=$idSa and saldo.id_usu=$usuario ORDER BY id_gas DESC";
							$resu=$base->prepare($sql);
							$resu->execute(array());
							while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
								$hora = $consulta['fecha'];
								$id = $consulta['id_gas'];


								?>
									<tr>
										<td> <?php echo $n=$n+1; ?> </td>
										<td> <p style="font-size: 14"> <?php echo $consulta['nombre'] ?> </p> </td>
										<td> <p style="font-size: 14px"> $ <?php echo $consulta['precio'] ?> </p> </td>
										<td> <p style="font-size: 14px"> <?php echo $consulta['fecha']; ?> </p> </td>
										<td> <a href="ELIMINAR/EliminarGasto.php?codi=<?php echo $id; ?>"> <img src="img/eli.jpg" height="40px"> </a> </td>
									</tr>
								<?php


							}
						$_SESSION['idSemana']=$idSa;
						}
						catch(Exeption $e){
							die("Error".$e->getMessage());
						}
		
				?>
				<tr>
					<th colspan="2">TOTAL</th>
					<td colspan="2"> <?php echo $_SESSION['dineroT']; ?> </td>
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

		
	
	<div class="panel-default">
			<ol class="breadcrumb">
				<li class="btn-warning"><a class="panel-heading" href="salir.php">
					salir
					<em class="fa fa-close"></em>
				</a></li>
				
			</ol>
		</div><!--/.row-->
</body>
</html>
