<?php
	include('conexion/conexion.php');
	
	session_destroy();
	print('<script>window.open("index.html", "_self");</script>'); 
?>
