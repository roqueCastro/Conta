<?php

try{

	
	
	$base= new PDO('mysql:host=localhost; dbname=id4332085_contable','root','');
	$base->exec('SET CHARACTER SET utf8');	

}
catch(Exection $e){
	die('error'.$e->getMessage());
	echo '<script>window.alert("error en la bd");</script>';
}

?>