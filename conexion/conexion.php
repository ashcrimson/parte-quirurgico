<?php
	$driver='oci8po';
       $server = '172.25.23.84:1521/orcl';
	//$server = '172.25.16.24:1521/lawen.hnv.sanidadnaval.cl';
	$user = 'parte';
	$password = 'parte';
	include('adodb/adodb.inc.php');
	//$db = ADONewConnection($driver);
	$db=NewADOConnection($driver);
	$db->debug = FALSE;
	$db->PConnect($server, $user, $password);
	
?>

