<?php
session_start();
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
include('../funciones.bus.php');
ini_set('display_errors','1');
 

if($_REQUEST['tipo']=='personal_listado') {
	
	$busqueda 	= $_REQUEST['buscar'];
	//ECHO($_REQUEST['buscar']);
	$sql="SELECT rut, nombre||' '||appaterno,num_parte,glosa_especialidad,fono,fono2,
	to_char(fc_parte,'dd/mm/yyyy HH24:MI '),contactado,num_parte
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad 
			  where  (activo = 5 or especialidad = 1) $orderby ";
	$activo=$_REQUEST['activo'];
	//echo($activo);
	if($activo !=1){
	
	if ($busqueda!=""){
		if ($_REQUEST['orden']=="rut"){
		$vwhere[]= " (".$_REQUEST['orden'].") =? ";
		$valores[]=$_REQUEST["buscar"];
    	
		   }
		else{	
		$vwhere[] = " upper(".$_REQUEST['orden'].") like '%".strtoupper($busqueda)."%'";
		
  
		    }
	  }
	  
	  
	 if($_REQUEST['filtro_esp'] !=100){
		
		$vwhere[]= " parte_quirurgico.especialidad = ?";
		$valores[]=$_REQUEST["filtro_esp"];
  
		}
	 if(($_REQUEST['fc1_filtro'] !="")&&($_REQUEST['fc2_filtro'] =="")){
	  			$vwhere[]=" to_char(parte_quirurgico.fc_parte,'dd/mm/yyyy')=? ";
          $valores[]=$_REQUEST["fc1_filtro"];
      }	
   if(($_REQUEST['fc1_filtro'] !="")&&($_REQUEST['fc2_filtro'] !="")){
			   $vwhere[]=" (parte_quirurgico.fc_parte between to_date(?,'dd/mm/yyyy') and to_date(?,'dd/mm/yyyy'))";
			   $valores[]=$_REQUEST["fc1_filtro"];
			   $valores[]=$_REQUEST["fc2_filtro"];
			}	
	}	
	if(count($vwhere) >0){
	  $sql.= " and ". implode(" and " ,$vwhere);
        }
	
	$orden = $_REQUEST['orden'];
	if($busqueda!=""){
		$orderby = "ORDER BY ".$orden." desc";
	}else{
		$orderby = "ORDER BY 2 Asc";
	
	}
	
	
	$personal = $db->Execute($sql,$valores);
	//echo($sql);
	print("<center>
		<table style='width:100%;' id='tabla_usuarios' name='tabla_usuarios'>
		<thead>
			<tr class='theader' onclick='unsel_tr(\"tabla_usuarios\",\"tfila1\",\"tfila2\");cancelar();'>
				<td style='text-align: center;center;width:15%;'>
					<b>Fecha Parte</b>
				</td>
				<td style='text-align: center;center;width:10%;'>
					<b>Rut</b>
				</td>
				<td style='text-align: center;center;width:25%;'>
					<b>Nombre</b>
				</td>
				<td style='text-align: center;center;width:25%;'>
					<b>Especialidad</b>
				</td>
				<td style='text-align: center;center;width:10%;'>
					<b>Fonos</b>
				</td>
				<td style='text-align: center;center;width:5%;'>
					<b>Notas</b>
				</td>
				<td style='text-align: center;center;width:5%;'>
					<b>Contactado</b>
				</td>
			
			</tr>
			</thead>
    		<tr>
			 <tbody>
			
					<td colspan='13'>
						<div style='height:350px;overflow:auto;'>
	  					<table  id='tb_desglose' name='tb_desglose'>
			");
	$i=0;
	while (!$personal->EOF) {
		if(($i%2)==0) {
				$clase='tfila1';
		} else {
				$clase='tfila2';
		}
		
		if(($personal->fields[4])!=1){
			$fono = $personal->fields[4];
		}else{
			$fono = "";
			}
	
		if(($personal->fields[5]==1) ||($personal->fields[5]==0)){
			$fono2 = "";
		}else{
			$fono2 = $personal->fields[5];
			}
		if(($personal->fields[7])!= 1){
			$ubicado = "<img src='imagenes/mal.png' border='0px'>";
		}else{
			$ubicado = "<img src='imagenes/bien.png' border='0px'>";
			}
		
			$nota = "<img src='imagenes/reclamo.png' border='0px'>";
			
			
		$html="
			<tr id='tabla_usuarios_".$i."' class='$clase'
			onClick='seleccionar_paciente(\"".$personal->fields[2]."\",$i);'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:15%;'>".$personal->fields[6]."</td>
		<td style='text-align: center;width:10%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:25%;'>".utf8_encode($personal->fields[1])."</td>
		<td style='text-align: left;width:25%;'>".utf8_encode($personal->fields[3])."</td>
		<td style='text-align: left;width:10%;'>".$fono." - ".$fono2."</td>
		<td style='text-align: left;width:3%;' title='Agregar Notas' onClick='ver_nota(\"".$personal->fields[8]."\")'>".$nota."</td>
		<td style='text-align: left;width:3%;' title='Llamar al Paciente' onClick='marcado(\"".$personal->fields[8]."\")'>".$ubicado."</td>
		</tr>
		";
		print($html);
		$personal->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
	
}

if($_REQUEST['tipo']=='ubicado') {
	   	//$results = 1;
  	$valores = Array();
		$sql="update parte_quirurgico set contactado = 1 where num_parte=? and activo =0";
		$valores[0]=$_REQUEST['param'];
		$recordset = $db->Execute($sql,$valores);
  	if(!$recordset){
  		$results=1;
  	}
  	$json = new Services_JSON();
		$myjson = $json->encode($results);
		print($myjson);
  
  }

if($_GET['tipo']=='cargar_filtro_especialidad') {
	
		$sql="SELECT parte_quirurgico.especialidad,especialidad.glosa_especialidad,
		count(parte_quirurgico.especialidad)  
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad=especialidad.id_especialidad
				where activo = 0 and contactado is null
				GROUP BY parte_quirurgico.especialidad,especialidad.glosa_especialidad
				ORDER BY parte_quirurgico.especialidad DESC";
	$rs = $db->Execute($sql);
	
		
	//print($sql);
	
	echo("<select  name='filtro_esp' id='filtro_esp' style='width:140px;' onchange='cargar_listado2(this.value);' >");
	echo("<option value=100  >--Todos--</option>");
	
		while (!$rs->EOF) {
		
		echo "<option value='".$rs->fields[0]."'  >".htmlentities($rs->fields[1])."(".($rs->fields[2]).")</option>";
		$rs->movenext();
		}
	
	echo("</select>");
	
}

?>
