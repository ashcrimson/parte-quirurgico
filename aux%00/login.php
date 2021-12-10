<?php
	session_start();
	$_SESSION['rut'] = $_POST['user'];
	include('conexion/conexion.php');
	include('funciones.bus.php');
	
	if(isset($_POST['user'])) {
		
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		if ($_POST['user']==''){
			print('<script>window.open("index.html", "_self");</script>'); 
			exit;
		}
			
		if ($_POST['pass']==''){
			print('<script>window.open("index.html", "_self");</script>'); 
			exit;
		}
		/*
		$sql ="Select nombre,pass,usuario from usuario where pass ='$pass'
					";
		$rs = $db->Execute($sql);
		
		$_SESSION['nombre']=$rs->fields[2];
		$passw = $rs->fields[1];
		*/
                $result=array();
                $result=retorna_autenticacion($user,$pass);
		//print($passw);
		
				
				if ($result["resp"] ==1) {
				  $_SESSION['nombre']=$result["nombre"];
					print('<script> 
					window.open("index.php", "_self");
					</script>');
				} else {
					print('<script> 
					alert("Datos de ingreso al sistema incorrectos."); 
					window.open("index.html", "_self");
					</script>');
				}
			 
	
}	
?>
