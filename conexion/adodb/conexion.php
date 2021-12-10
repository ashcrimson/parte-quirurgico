<?php
	$driver="mysql";
	$server = 'localhost';
	//$server = '192.168.0.191';
	$database = 'fesancos';
	$user = 'root';
	$password = '';
	include('adodb4/adodb.inc.php');
	$db = ADONewConnection($driver);    # create a connection 
	$db->debug = true;
	$db->Connect($server, $user, $password, $database);
?>

