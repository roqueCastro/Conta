<?php
session_start();
require('../conexion.php');	
$usuario=$_SESSION['id'];
$_SESSION['semana']=1;
$ts=0;
$url=$_REQUEST['codi'];
$sal=0;


try{
	$sql ="SELECT * FROM saldo WHERE id_usu=$usuario";
	$resu=$base->prepare($sql);
	$resu->execute(array());
	while($consulta=$resu->fetch(PDO::FETCH_ASSOC)){
		$ts=$consulta['id_sem'];
		$sal=$consulta['n_saldo'];
	}

	
}catch(Exepiton $e){
	die('error'.$e->getMessage());
}



    if($sal<=0){
        $sal=0;
    }
	$ts=$ts+1;
	$sql2 ="INSERT INTO saldo (n_saldo, id_sem, id_usu) VALUES (:saldo, :semana, :usuario)";
	$resu2=$base->prepare($sql2);
	$resu2->execute(array(":saldo"=>$sal, ":semana"=>$ts, ":usuario"=>$usuario));
	$c=$resu2->rowCount();
	if($c==0){
		echo "no se a podido ejecutar Errror...";
		echo "<br> saldo.. ".$_POST['saldo']." Semana...".$ts." uSUArio.......".$usuario;
	}else{
		echo "correcto";
		?>
			<script>window.location="../index.php";</script>							
		<?php
	}

?>