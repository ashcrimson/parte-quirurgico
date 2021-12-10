<?php
session_start();
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
include('../funciones.bus.php');
 

if($_REQUEST['tipo']=='personal_listado') {
	$busqueda = $_REQUEST['buscar'];
	$where="";
	if ($busqueda!=""){
		if ($_REQUEST['orden']=="rut"){
		$where = " and (".$_REQUEST['orden'].") = '".($busqueda)."'";
			
		}
		else{	
		$where = " and upper(".$_REQUEST['orden'].") like '%".strtoupper($busqueda)."%'";
		}
	}
	$orden = $_REQUEST['orden'];
	$orderby = "ORDER BY ".$orden." asc";
	$sql="SELECT rut, nombre||' '||appaterno,num_parte,glosa_especialidad 
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad 
			   where (activo=5 or especialidad = 1) $where  $orderby ";
	$personal = $db->Execute($sql);
	//print($sql);
	print("<center>
		<table style='width:98%;' id='tabla_usuarios' name='tabla_usuarios'>
		<thead>
			<tr class='theader' onclick='unsel_tr(\"tabla_usuarios\",\"tfila1\",\"tfila2\");cancelar();'>
				<td style='text-align: center;'>
					<b>Rut</b>
				</td>
				<td style='text-align: center;'>
					<b>Nombre</b>
				</td>
				<td style='text-align: center;'>
					<b>Parte</b>
				</td>
			</tr>
			</thead>
    		<tr>
			 <tbody>
			
					<td colspan='13'>
						<div style='height:200px;overflow:auto;'>
	  					<table  id='tb_desglose' name='tb_desglose'>
			");
	$i=0;
	while (!$personal->EOF) {
		if(($i%2)==0) {
				$clase='tfila1';
		} else {
				$clase='tfila2';
		}
		
		$html="
			<tr id='tabla_usuarios_".$i."' class='$clase'
			onClick='seleccionar_paciente(\"".$personal->fields[2]."\",$i);'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:15%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:80%;'>".utf8_encode($personal->fields[1])."</td>
		<td style='text-align: left;width:15%;'>".htmlentities($personal->fields[3])."</td>
	
		</tr>
		";
		print($html);
		$personal->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
	
}

if($_REQUEST['tipo']=='paciente') {
	
	$valores = array();
	$sql="SELECT rut, nombre,appaterno,apmaterno,edad,fono,TO_CHAR(fc_parte,'dd-mm-yy'),especialidad,medico_tratante, 
	num_parte,obs,dv_rut FROM parte_quirurgico	WHERE num_parte=?";
	$valores[0]=$_REQUEST['buscar'];
	$personal = $db->Execute($sql,$valores);
	
	for($i=0;$i <= 11;$i++) {
		$datos[$i]=($personal->fields[$i]);
	}
	
	if($personal->fields[5]==1){
		$sql="select contacto from contacto_paciente where rut = ".$datos[0]." and orden = 1";
		$rs = $db->Execute($sql);
		if($rs->fields[0]!=null){
			
			$datos[5]=$rs->fields[0];
		}else{
			
			$datos[5]='';
			}
	}
		
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);	
}

if($_REQUEST['tipo']=='cargar_pato') {
	
	$valores=array();
	$sql="select glosa_patologia,id_patologia from patologias where codigo_patologia=?";
	$valores[0]=$_REQUEST['buscar'];
	$rs = $db->Execute($sql,$valores);
	
	echo("<select  name='patolo' id='patolo' style='width:100px;' class='combo' >");
	echo("<option value=-1>-------------</option>");
	while (!$rs->EOF) {
		echo "<option value='".$rs->fields[1]."'>".htmlentities($rs->fields[0])."</option>";
		$rs->movenext();
	}
	echo("</select>");
}

if($_REQUEST['tipo']=='cargar_medi') {
	
	$valores = array();
	$sql="select id_medicamento,glosa_medicamento from medicamentos where num_parte=?";
	$valores[0]=$_REQUEST['buscar'];
	$rs = $db->Execute($sql,$valores);
	
	echo " <select id='referidos' name='referidos'  size='5' multiple style='width:299px;' >";
	while (!$rs->EOF) {
		echo "<option value=".$rs->fields[0]." onclick='rem_ref(".$rs->fields[0].");' >".$rs->fields[1]."</option>";
		$rs->movenext();
	}
	echo "</select>";
}

if($_REQUEST['tipo']=='medicamento') {
	$valores = array();
	$sql="insert into medicamentos values(null,?,?)";
	$valores[0]=$_REQUEST['buscar'];
	$valores[1]=$_REQUEST['nombre'];
	
	$rs = $db->Execute($sql,$valores);
	if(!$rs){
		$results =0;
		//print_r($valores);
		// print($db->ErrorMsg());
		}
	$json = new Services_JSON();
	$myjson = $json->encode($results);
	print($myjson);
}

if($_REQUEST['tipo']=='borrar_medicamento') {
	$valores = array();
	$sql="delete  from medicamentos where id_medicamento = ?";
	$valores[0]= $_REQUEST['buscar']; 
	$recordset = $db->Execute($sql,$valores);
	
	if(!$recordset){
		
		$results=0;
	}else{
		$results=1;
		}
	
	$json = new Services_JSON();
	$myjson = $json->encode($results);
	print($myjson);
	
}

if($_REQUEST['tipo']=='guardar_ingreso') {
	
	$hora				= date("H:i");
	$registro 	=  $_SESSION ['centro']['usuario'];
	$usu  	 	= split("@sanidadnaval",$registro);
	$medico_tratante	= $usu[0];

	
	
		$sql="select max(id_ingreso) from ingreso";
		$rs = $db->Execute($sql);
		$numero 	= $rs->fields[0];
		$num_max  = $numero + 1; 
	//(id_inreso,parte,fc1, fc2,categoria,salud,base,condicion,totalusuario)
  
	$valores=array();

	 $sql="insert into ingreso values (?,?,TO_TIMESTAMP(?, 'DD-MM-RRHH24:MI:SSXFF'),TO_TIMESTAMP(?, 'DD-MM-RRHH24:MI:SSXFF'),?,?,?,?,?,?)";
	$valores[0]=$num_max;                                                                                                              
	$valores[1]=$_REQUEST['parte'];
	$valores[2]=$_REQUEST['fc_dig']."".$hora;
	$valores[3]=$_REQUEST['fc_pab'];
	$valores[4]=$_REQUEST['salud'];
	$valores[5]=$_REQUEST['categ'];
	$valores[8]=$_REQUEST['patolo'];
	$valores[6]='0';
	$valores[7]='0';
	$valores[9]=$medico_tratante;
	
	$recordset = $db->Execute($sql,$valores);
  if(!$recordset){
  
  $results= 0;
  print_r($valores);
  // print($sql);
   print($db->ErrorMsg());
  }
  else{
   	//$results = 1;
  	$valores = Array();
		$sql="update parte_quirurgico set activo = 1 where num_parte=?";
		$valores[0]=$_REQUEST['parte'];
		$recordset = $db->Execute($sql,$valores);
  	if(!$recordset){
  		$results=1;
  	}
  
  
  }
  
  $json = new Services_JSON();
	$myjson = $json->encode($results);
	print($myjson);
  

}

if($_REQUEST['tipo']=='cargar_listado_contactos') {
	$valores = array();
	$sql="SELECT tp_contacto, contacto,id_contacto 	FROM contacto_paciente	where rut = ?";
	$valores[0] = $_REQUEST['buscar'];
	$personal = $db->Execute($sql,$valores);
	
	print("<center>
		<table style='width:98%;' id='tabla_usuarios2' name='tabla_usuarios2'>
	  		<tr>
			 <tbody>
					<td colspan='13'>
						<div style='height:150px;overflow:auto;'>
	  					<table  id='tb_desglose' name='tb_desglose'>
			");
	$i=0;
	while (!$personal->EOF) {
		if(($i%2)==0) {
				$clase='tfila1';
		} else {
				$clase='tfila2';
		}
		
		$html="
			<tr id='tabla_usuarios_".$i."' class='$clase'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios2\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios2\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:45%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:50%;'>".$personal->fields[1]."</td>
		<td style='text-align: id='elimina_contacto' value='' title='ELIMINAR'  onclick='borrar_contacto(".$personal->fields[2].");'  'left;width:5%;'>E</td>
	
		</tr>
		";
		print($html);
		$personal->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
	
}

if($_REQUEST['tipo']=='guardar_telefonos') {
	
	
	$valores=array();
	$sql="select count(id_contacto) from contacto_paciente where rut=? and contacto =?";
	$valores[0]= $_REQUEST['rut'];
	$valores[1]= $_REQUEST['fono_contacto'];
	
	$rs = $db->Execute($sql,$valores);
	$dato = $rs->fields[0];
	
	
	if($dato==0){
		$valores = array();
		$sql="select max(orden) from contacto_paciente where rut= ?";
		$valores[0]= $_REQUEST['rut'];
		$rs = $db->Execute($sql,$valores);
		if(!$rs){
			print(0);
			}else{
			$numero 	= $rs->fields[0];
			$num_max  = $numero + 1; 
		
			$valores = array();
			$sql="insert into contacto_paciente	values(?,?,?,null,?)";
			$valores[0]= $_REQUEST['rut'];
			$valores[1]= $_REQUEST['tp_contacto'];
			$valores[2]= $_REQUEST['fono_contacto'];
			$valores[3]= $num_max;
			$rs = $db->Execute($sql,$valores);
			if(!$rs){
				print(0);
			}else{
				print(2);
				}
			
			}
	}if($dato==1){
		print(1);
		}
}

if($_REQUEST['tipo']=='borrar_contacto') {
	
	 $valores = array();
  
		$sql="delete from contacto_paciente where id_contacto =?";
	  $valores[]=$_REQUEST['buscar'];
	  $recordset = $db->Execute($sql,$valores);
	  if(!$recordset){
	  	
	  	$results=0;
	  }else{
	  	$results=1;
	  	}
  $json = new Services_JSON();
	$myjson = $json->encode($results);
	print($myjson);
	
	
	
	
}

if($_REQUEST['tipo']=='busca_telefonos') {
	
	$valores = array();
  
	$sql="select min(orden) from contacto_paciente where rut = ? ";
	$valores[0]	=$_REQUEST['rut'];
	
		$recordset = $db->Execute($sql,$valores);
		$orden = $recordset->fields[0];
		
		if(!$recordset){
			$results=0;
		}else{
		
		$valores = array();
	  $sql="select contacto from contacto_paciente where rut = ? and orden = ? ";
		$valores[0]	=$_REQUEST['rut'];
		$valores[1]	=$orden;
		$recordset = $db->Execute($sql,$valores);
		if(!$recordset){
						$results = '';
						
			}else{
						$results = $recordset->fields[0];
						}
		}
	
	$json = new Services_JSON();
	$myjson = $json->encode($results);
	print($myjson);
	
		
	//print($dato);
	
	
}


?>
