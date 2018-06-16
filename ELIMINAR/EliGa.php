<?php
	
	require("../conexion.php");
	$id=$_REQUEST['codi'];
	
		
	$sql = "SELECT * FROM gasto INNER JOIN saldo ON saldo.id_sal=gasto.id_sal  WHERE id_gas=$id";
		$resu=$base->prepare($sql);
		$resu->execute(array());
    	while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
		    $saldo=$consulta['n_saldo'];
		    $precio=$consulta['precio'];
		    $id_Semana=$consulta['id_sem'];
		    $id_Usuario=$consulta['id_usu'];
		}
		
    $sql = "DELETE FROM gasto WHERE id_gas=$id";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		$c=$resu->rowCount();
		if($c>0){
			echo 'Exitoso';
		}else{
			echo 'No elimino';
		}
				
	$queda=$saldo+$precio;
	
	$sql3 ="UPDATE saldo SET n_saldo=:saldo WHERE id_sem=$id_Semana and id_usu=$id_Usuario";
	$resu3=$base->prepare($sql3);
	$resu3->execute(array(":saldo"=>$queda));


	
   $contador=$resu->rowCount();
	if($contador > 0){
		echo "<script>window.location='../index.php';</script>";
	}else{
		echo "false";
	} 
				
				
				
				

		
?>