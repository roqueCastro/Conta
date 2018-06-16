<?php
	session_start();	

	require("conexion.php"); //Conexion a la base de datos

    $usuario=$_SESSION['id']; // Id del usuario
    $id=$_REQUEST['codi'];
	
//   echo '<script>alert("'.$id.'");</script>';
	// Comprobamos si hay un usuario ingresado o iniciando session sino lo manda al login
	if(! isset($_SESSION['id'])){
		?>
			<script>window.location="login.php?codi=0";</script>
		<?php
	}
// ---------------------------------------------------------------------------------------

// Consulta de las tablas fiador
	$sql ="SELECT * FROM fiador WHERE id_fia=$id and id_usu=$usuario";
	$resu=$base->prepare($sql);
	$resu->execute(array());
	while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
		$nombre=$consulta['nombre_fia'];
		$precio_fia=$consulta['precio_T_Fi'];
	}
// Consulta de las tablas gasto
	$sql ="SELECT * FROM saldo WHERE id_usu=$usuario";
	$resu=$base->prepare($sql);
	$resu->execute(array());
	while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
		$saldo=$consulta['n_saldo'];
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
			
			var total_fia = $("#T_Presta_Fi").val();
		    var idUsuario = $("#id_usu").val();
		    var debe = $("#debe").val();
		    var sal = $("#sal").val();
		    var fiador = $("#fia").val();
	
			 if(sal < total_fia){
					$("#resultado").html("No te alcanza el saldo" );	
				    $("#T_Presta_Fi").focus();
		   	  }else if(total_fia.length == 0) {
				$("#resultado").html("Inserte el valor a pagar");	
				$("#T_Presta_Fi").focus();
			   }else if(total_fia > debe) {
					$("#resultado").html("No debes tanto" );	
				    $("#T_Presta_Fi").focus();
			   }else{
				   $("#resultado").html(" ");	
				   	$.ajax({
					data: {"total_fia":total_fia, "idUsuario": idUsuario, "debe" : debe, "sal": sal, "fiador": fiador },
					url: 'INSERT/fiador_pagando.php',
					type: 'post',
					beforeSend: function(){
						$("#resultado").html("Procesando.....");
					},
					success: function(response){
						if(response=='true'){
							$("#resultado").html("Proceso  Exitoso.");
							window.location='prestamo.php';
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
					
			          <span style="font-size: 17px"> Le debes    $<?php echo $precio_fia; ?> a <?php echo $nombre ?> </span>
				</li>
			</ol>
		</div><!--/.row-->
	
	
		<div class="panel-body">
			
		<div>
			<form  method="post">
			<h2>$<?php echo $precio_fia ?> Le debes a <?php echo $nombre ?></h2>


			<!--<textarea name="mensaje" placeholder="Escriba aqui su mensaje"></textarea>---->
			<input type="hidden" value="<?php echo $usuario; ?>" id="id_usu"  required>
			<input type="hidden" value="<?php echo $precio_fia ?>" id="debe"  required>
			<input type="hidden" value="<?php echo $saldo ?>" id="sal"  required>
			<input type="hidden" value="<?php echo $_REQUEST['codi']; ?>" id="fia"  required>
			<div id="resultado"></div>
			<input type="number" id="T_Presta_Fi"  placeholder="Total de prestamo" required>
			<input type="button" onClick="FormularioFia()" value="PAGAR" id="boton">	
			</form>
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
