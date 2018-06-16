<?php
require('../conexion.php');
$nom=$_POST['nombre'];
$pre=$_POST['precio'];
$idS=$_POST['idSaldo'];
$idSem=$_POST['idSemana'];
$usuario=$_POST['idUsuario'];
$saldo=$_POST['Saldo'];
$fecha=date('Y-m-d H:i:s');



$sql ="INSERT INTO gasto (nombre,precio, fecha, id_sal, id_usu)  VALUES (:n, :p, :fe, :saldo, :usu)";
	$resu=$base->prepare($sql);
	$resu->execute(array(":n"=>$nom, ":p"=>$pre, ":fe"=>$fecha, ":saldo"=>$idS, ":usu"=>$usuario));
	
	

$queda=$saldo-$pre;
	
	
	
		
if($queda < 0) {
    
    $precio_pres=($queda*$queda)-($queda*$queda+$queda);
    
	// Consulta si as ingresado a prestamos ..
		$sql ="SELECT * FROM prestamo WHERE id_usu=$usuario";
		$resu=$base->prepare($sql);
		$resu->execute(array());
		while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){


			$precio_pre=$consulta['precio_pre']; // Variable precio del articulo
			
			if($precio_pre == 0){
				$sql ="UPDATE prestamo SET precio_pre=:pr WHERE id_usu=$usuario";
				$resu=$base->prepare($sql);
				$resu->execute(array(":pr"=>$precio_pres));	
			}else{
				$suma=$precio_pre+$precio_pres;
				$sql3 ="UPDATE prestamo SET precio_pre=:saldo WHERE id_usu=$usuario";
				$resu3=$base->prepare($sql3);
				$resu3->execute(array(":saldo"=>$suma));	
			}
    
		}
    
    
    $queda=0;
}
		
	
  	$sql3 ="UPDATE saldo SET n_saldo=:saldo WHERE id_sem=$idSem and id_usu=$usuario";
	$resu3=$base->prepare($sql3);
	$resu3->execute(array(":saldo"=>$queda));
	
        	
            	
       $contador=$resu->rowCount();
		if($contador > 0){
			echo "true";
		}else{
			echo "false";
		}

           
?>