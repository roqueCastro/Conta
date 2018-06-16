<!DOCTYPE HTML>
<!--
	Urban by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>App Desayunos</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<!-- ESTE ESTILO ED DE LA VENTANA MODEL-->
	<link rel="stylesheet" href="css/esti.css" >
	
	<!---  -->
	<script>
	
		function validar(){
			
			var nombre =$("#nom").val();
			var telefono =$("#tel").val();
			var correo =$("#cor").val();
			var clave = $("#con").val();
			
			
			
			if(nombre.length==0){
				$("#resultadoV").html("");
				$("#resultado").html("Digite El Nombre");
				$("#nom").focus();
			}else if(telefono.length==0){
				$("#resultadoV").html("");
				$("#resultado").html("Digite El Numero Telefonico");
				$("#tel").focus();
			}else if(correo.length==0){
				$("#resultadoV").html("");
				$("#resultado").html("Digite El Correo");
				$("#cor").focus();
			}else if(clave.length==0){
				$("#resultadoV").html("");
				$("#resultado").html("Digite la Contraseña");
				$("#con").focus();
			}else{
				
				$.ajax({
					data: {"nombre":nombre, "telefono": telefono, "clave" : clave, "correo" : correo},
					url: 'INSERT/registro1.php',
					type: 'post',
					beforeSend: function(){
						$("#resultado").html("");
						$("#resultadoV").html("Procesando, espere por favor.. ");
					},
					success: function(response){
						if(response=="true"){
							$("#resultado").html("");
							$("#resultadoV").html("Registro Exitoso");
							window.location="login.php";
						}else{
							$("#resultadoV").html("");
							$("#resultado").html("Datos Erroneos No esta registrando...");
						}
						

					}
					
				});
				
			}
				
		}
		
	  </script>
	  
	</head>
	<?php
	session_start();
	require('conexion.php');
	
	?>
	
<body>
	<!-- Header -->
	<header id="header" class="alt">
 		<div class="logo"><a href="login.php?codi=0">R<span>Contable</span></a></div>
				
	</header>

	<!-- Nav -->
			

	<!-- Banner -->
	
	
	
	<section id="banner">
		<div class="inner">
		<header id="">
			<h1 id="bi">Registro </h1>
			<p>Llene <br/>aqui El Formulario</p>
						
		</header>
		<header id="header2">
			<h1 id="bi"> </h1>
			<p></p>
		</header>
		<!--<a href="#main" class="button big scrolly">Iniciar</a> -->
					
					
		<form action="" method="post">
	    
		<div class="modal-wrapper" id="popup">
			<div class="popup-contenedor">
					   
				<form role="form" >
				  
					<div class="form-group">					 
						<label id="tex" for="exampleInputEmail1">
							Nombre Y Apellidos
						</label>
						<input class="form-control" id="nom" type="text" name="nom">
					</div>
					
					<div class="form-group">					 
						<label id="tex" for="exampleInputEmail1">
							Telefono
						</label>
						<input class="form-control" id="tel" type="number" name="tel">
					</div>
					
					<div class="form-group">					 
						<label id="tex" for="exampleInputEmail1">
							Correo Electronico
						</label>
						<input class="form-control" id="cor" type="email" name="cor">
					</div>
					
					<div class="form-group">					 
						<label id="tex" for="exampleInputPassword1">
							Contraseña
						</label>
						<input class="form-control" id="con" name="con" type="password">
					</div>
					<div class="alert-info">	<a id="tex" href="#" class=>.</a></div>
						   
						   
				</form>
				<div class="modal-footer">
					<div id="alerta" class="alert-danger">
							
					</div>						
					<div id="resultado" style="color: white; font-size: 15px; background-color: red;" > </div>
							   
					<div id="resultadoV" style="color: white; font-size: 15px; background-color: darkgreen;" > </div> 
    			 	<input id="ini" type="button" value="iniciar" onClick="validar()" name="btninicio" />
     
     
      
  			    </div>
			</div>
					
	</div>
	</section>
			
			

				</form>
		<!-- Main -->
			
		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-snapchat"><span class="label">Snapchat</span></a></li>
					</ul>
					<p>&copy; 
						Diseñador :DUVAN ANDRES BARRERA
						<br>Programador: ROQUE CASTRO GARZÓN
							</a></p>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>