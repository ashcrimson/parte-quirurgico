<?php
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
session_start();
//ini_set("display_errors","1");
if($_POST['tipo']=='personas') {
	$idmensaje = $_POST['idmensaje'];
	$registro 	=  $_SESSION ['centro']['usuario'];
	$usu  	 	= split("@sanidadnaval",$registro);
	$usuario_log        = $usu[0];

	$rut = $usuario_log;
	
	
	$sql="select 
				usuario.rut, 
				glgrado || ' ' || nombres ||' ' || appaterno || ' ' || apmaterno as nombre,
				tpgrado.tpgrado, tpcargo.glcargo, tpcargo.tpcargo
				from tpdepartamento 
				inner join departamentos on tpdepartamento.cddepartamento = departamentos.cddepartamento 
				inner join tpdivision on tpdepartamento.cddepartamento = tpdivision.cddepartamento 
				inner join tpcargo on tpdivision.tpdivision = tpcargo.tpdivision 
				inner join usuariocargo on tpcargo.tpcargo = usuariocargo.tpcargo 
				inner join usuario on usuariocargo.rut = usuario.rut 
				inner join tpgrado on usuario.tpgrado = tpgrado.tpgrado 
				where activo = 1 and fctermino > now() 
				and departamentos.cddepartamento in 
					(select cddepartamento from distribucion where idmensaje = $idmensaje)
				group by tpgrado.tpgrado, usuario.rut, glgrado || ' ' || nombres ||' ' || appaterno || ' ' || apmaterno, tpcargo.glcargo,tpcargo.tpcargo
				order by usuario.tpgrado, appaterno ";
	//print($sql);
	$personal = $db->Execute($sql);
	print("
		<table style='width:100%;' >
		<tr style='font-size: 12px;'>");
	$i=1;
	$html  = "";
	while (!$personal->EOF) {
		if($i==4) {
				$clase='table';
				$html.="</tr><tr style='font-size: 12px;'>";
				$i=1;
		}
		$html.="
		<td style='width=7%;'><input style='visibility:visible' type='checkbox' id='".$personal->fields("rut")."_".$personal->fields("tpcargo")."' name='".$personal->fields("rut")."_".$personal->fields("tpcargo")."' ></td>
		<td style='width=40%;font-size=10px;'>".$personal->fields("nombre")."(".$personal->fields("glcargo").")</td>";
		$personal->movenext();
		$i++;
	}
	print($html);
	print("</table></tr>");

}

if($_POST['tipo']=='guardar_nota'){

	$registro 	=  $_SESSION ['centro']['usuario'];
	$usu  	 	= split("@sanidadnaval",$registro);
	$usuario_log        = $usu[0];

	


	$idmensaje 		= $_POST['idmensaje'];
	$texto				= iconv("UTF-8", "ISO-8859-1", $_POST['texto']);
	$texto				= str_replace("×","=",$texto);
	$texto				= str_replace("Ý","´",$texto);
	$texto				= str_replace("ã","?",$texto);
	$texto				= str_replace("æ","%",$texto); 
	$texto				= str_replace("Þ","&",$texto);
	//print($texto);
	//print($texto);
	$rut = $usuario_log;
	//$usuario = $_SESSION['nombre'];
	$tpaviso = $_POST['tpaviso'];
	
	if($tpaviso =='1'){
		$rs = $db->Execute("SET NAMES 'LATIN1'");
		$sql = "insert into nota_parte (glosa,parte,fecha,usuario)
						values ('$texto',$idmensaje,current_timestamp,'$rut')";
		$rs= $db->Execute($sql);
	}

}


?>
