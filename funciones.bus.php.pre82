<?php
function retorna_datos_referencial($run){
  require_once('nusoap/lib/nusoap.php');
  $client = new soapclient('http://172.25.16.18/bus/webservice/ws.php?wsdl');
  $result = $client->call('buscarDetallePersona', array('run' =>$run));
  return $result;
}
function retorna_autenticacion($usuario,$clave){
  require_once('nusoap/lib/nusoap.php');
  $client = new soapclient('http://172.25.16.18/bus/webservice/ws.php?wsdl');
  $result = $client->call('autentifica_ldap', array('id' =>$usuario,'clave'=>$clave));
  return $result;
}


function verifica_sesion($redir = true) {
  if (!isset($_SESSION["centro"]) || count($_SESSION["centro"]) < 1) {
    ini_set("session.cookie_domain", ".hospitalnaval.cl");
    session_start();
  }
  if (!isset($_SESSION["centro"]['cod_u']) && $redir) {
    header('Location: index.php');
    exit(0);
  }
  
  if (!isset($_SESSION["portal"]['email'])) {
    header('Location: http://registrosclinicos.hospitalnaval.cl');
  	exit(0);
  }
  
}
?>