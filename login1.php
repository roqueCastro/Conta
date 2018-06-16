<?php

session_start();
require('conexion.php');
$clave=trim($_POST['clave']);
$cor=trim($_POST['correo']);

	$sql ="SELECT * from usuario WHERE correo_usu=:nom AND pass_usu=:pass";
		$resu=$base->prepare($sql);
		$resu->execute(array(":nom"=>$cor, ":pass"=>$clave));
		$contador=$resu->rowCount();
			if($contador > 0){

				$con=$resu->fetch(PDO::FETCH_ASSOC);
				 $_SESSION['id']= $con['id_usu'];
					echo "true";



			}else{
				echo "false";
			} 

?>