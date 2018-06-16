<?php

session_start();
require('../conexion.php');
$t=trim($_POST['total_prestamo']);
$n=trim($_POST['nombre_fi']);
$usu=trim($_POST['idUsuario']);

$sql ="SELECT * FROM saldo WHERE id_usu=$usu";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
			$saldo=$consulta['n_saldo'];
			$semana=$consulta['id_sem'];
		}
$sql ="SELECT * FROM prestamo WHERE id_usu=$usu";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
			$prestamo=$consulta['precio_pre'];
		}

$sql ="INSERT INTO fiador (nombre_fia,precio_T_Fi,id_usu) VALUES (:nomF,:preF,:id_u)";
		$resu=$base->prepare($sql);
		$resu->execute(array(":nomF"=>$n, ":preF"=>$t,":id_u"=>$usu));


$sql4 ="UPDATE prestamo SET precio_pre=:saldo WHERE id_usu=$usu";
	$resu4=$base->prepare($sql4);
	$resu4->execute(array(":saldo"=>0));


$P_U=$t-$prestamo;


if($P_U > 0){
	if($sql) {
	$suma=$saldo+$P_U;
	$sql3 ="UPDATE saldo SET n_saldo=:saldo WHERE id_sem=$semana and id_usu=$usu";
	$resu3=$base->prepare($sql3);
	$resu3->execute(array(":saldo"=>$suma));
	$contador=$resu3->rowCount(); 
	if($contador > 0){
				echo "true";
			}else{
				echo "Ocurrio un error";
			} 
	}

}
?>