<?php

session_start();
require('../conexion.php');
$n=trim($_POST['nombre']);
$t=trim($_POST['telefono']);
$cl=trim($_POST['clave']);
$co=trim($_POST['correo']);

		$sql ="INSERT INTO usuario (nombres_usu,telefono,correo_usu,pass_usu) VALUES (:nom,:tel,:cor,:con)";
		$resu=$base->prepare($sql);
		$resu->execute(array(":nom"=>$n, ":tel"=>$t,":cor"=>$co,":con"=>$cl));
		$contador=$resu->rowCount();
			if($contador > 0){
				echo "true";

			}else{
				echo "false";
			} 


?>