<?php
session_start();
require('../conexion.php');	
$total_fia=$_POST['total_fia'];
$idUsuario=$_POST['idUsuario'];
$debe=$_POST['debe'];
$sal=$_POST['sal'];
$fiador=$_POST['fiador'];

$restaF=$debe-$total_fia;
$restaS=$sal-$total_fia;

$sql ="SELECT * FROM saldo WHERE id_usu=$idUsuario";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
			$semana=$consulta['id_sem'];
		}

$sql3 ="UPDATE fiador SET precio_T_Fi=:saldo WHERE id_fia=$fiador and id_usu=$idUsuario";
	$resu3=$base->prepare($sql3);
	$resu3->execute(array(":saldo"=>$restaF));
if($sql3){
	$sql3 ="UPDATE saldo SET n_saldo=:saldo WHERE id_sem=$semana and id_usu=$idUsuario";
	$resu3=$base->prepare($sql3);
	$resu3->execute(array(":saldo"=>$restaS));
	$c=$resu3->rowCount();
	if($c>0){
		echo 'true';
	}else{
		echo 'Comunicate con admin..';
	}
}

?>