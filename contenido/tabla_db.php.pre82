<?php
session_start();
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
include('../funciones.bus.php');
ini_set('display_errors','1');
 

if($_REQUEST['tipo']=='personal_listado') {
	
	$busqueda 	= $_REQUEST['buscar'];
		$activo=$_REQUEST['activo'];
	//echo($_REQUEST['fc1_filtro']);
	
	
	
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
		//echo('hola');
		$vwhere[]= "  p.especialidad = ?";
		$valores[]=$_REQUEST["filtro_esp"];
  	
		}
	
	 if(($_REQUEST['fc1_filtro'] !="")&&($_REQUEST['fc2_filtro'] =="")){
	  			
	  			$vwhere[]=" to_date(especialidad_pabellon.fc_pab,'dd/mm/yyyy')=? ";
          $valores[]=$_REQUEST["fc1_filtro"];
      }	
   if(($_REQUEST['fc1_filtro'] !="")&&($_REQUEST['fc2_filtro'] !="")){
			   $vwhere[]=" (especialidad_pabellon.fc_pab between to_date(?,'dd/mm/yyyy') and to_date(?,'dd/mm/yyyy'))";
			   $valores[]=$_REQUEST["fc1_filtro"];
			   $valores[]=$_REQUEST["fc2_filtro"];
			}
	}
	
	
	//ECHO($_REQUEST['buscar']);
	$sql="SELECT p.rut, p.nombre||' '||p.appaterno,p.num_parte,especialidad.glosa_especialidad,
	to_char(p.fc_parte,'dd/mm/yyyy HH24:MI '),cie10.glosa_diag,intervencion.glosa_intervencion,
  especialidad_pabellon.PABELLON,to_date(especialidad_pabellon.FC_PAB,'dd/mm/yyyy'),paciente_pabellon.MIN,
  especialidad_pabellon.id_pab,especialidad_pabellon.id_pabellon,paciente_pabellon.hora_ini,paciente_pabellon.hora_fin,
  p.medico_tratante,p.anestesia
				FROM parte_quirurgico p
				inner join especialidad on p.especialidad = especialidad.id_especialidad 
			inner join cie10 on p.diagnostico=cie10.cod_diag
			inner join intervencion on p.intervencion=intervencion.codprest	
      inner join paciente_pabellon on p.num_parte=paciente_pabellon.num_parte
			inner join especialidad_pabellon on paciente_pabellon.ID_PAB=especialidad_pabellon.ID_PAB
      where  activo=2  and p.ESPECIALIDAD = especialidad_pabellon.ESPECIALIDAD 
      
    ";
	
	
	

		
	if(count($vwhere) >0){
	  $sql.= " and ". implode(" and " ,$vwhere);
       
        }
    $sql.= "group by p.rut, p.nombre||' '||p.appaterno,p.num_parte,especialidad.glosa_especialidad,
	to_char(p.fc_parte,'dd/mm/yyyy HH24:MI '),cie10.glosa_diag,intervencion.glosa_intervencion,
  especialidad_pabellon.PABELLON,especialidad_pabellon.FC_PAB,paciente_pabellon.MIN,especialidad_pabellon.id_pab
  ,especialidad_pabellon.id_pabellon,paciente_pabellon.hora_ini,paciente_pabellon.hora_fin,p.medico_tratante,p.anestesia
order by 11,12,13 asc";    
	
/*	$orden = $_REQUEST['orden'];
	if($busqueda!=""){
		$orderby = "ORDER BY ".$orden." desc";
	}else{
		$orderby = "order by 11,12,13 asc";
	
	}
	*/
	
	$personal = $db->Execute($sql,$valores);
	print_r($valores);

	
	
	//echo($sql);
	print("<center>
		<table style='width:100%;' id='tabla_usuarios' name='tabla_usuarios'>
		<thead>
			<tr class='theader' onclick='unsel_tr(\"tabla_usuarios\",\"tfila1\",\"tfila2\");cancelar();'>
				<td style='text-align: center;center;width:3%;'>
					<b>Pab.</b>
				</td>
				<td style='text-align: center;center;width:10%;'>
					<b>Hora</b>
				</td>
				<td style='text-align: center;center;width:3%;'>
					<b>Rut</b>
				</td>
				<td style='text-align: center;center;width:20%;'>
					<b>Paciente</b>
				</td>
				<td style='text-align: center;center;width:25%;'>
					<b>Diagn&oacute;stico</b>
				</td>
				<td style='text-align: center;center;width:25%;'>
					<b>Intervenci&oacute;n</b>
				</td>
				<td style='text-align: center;center;width:14%;'>
					<b>Especialdiad</b>
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
	$$minnnn = 0;
	while (!$personal->EOF) {
		if(($i%2)==0) {
				$clase='tfila1';
		} else {
				$clase='tfila2';
		}
		
		
	/*	$hora =split(":",$personal->fields[11]);
		$horas =$hora[0]*3600; 
		$min =$hora[1]*60;
		$horario = $horas + $min;
		$tiempo_operacion = ((($personal->fields[9]+ $horario)/60)/60 );
		$num = floor($tiempo_operacion);
		
		$dec = (($tiempo_operacion - $num)*60);
		*/
			
		$html="
			<tr id='tabla_usuarios_".$i."' class='$clase'
			onClick='seleccionar_paciente(\"".$personal->fields[2]."\",$i);'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:3%;'><u><b>".$personal->fields[7]."</b></u></td>
		<td style='text-align: center;width:10%;'>".$personal->fields[12]." - ".$personal->fields[13]."</td>
		<td style='text-align: center;width:3%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:20%;'>".$personal->fields[1]."</td>
		<td style='text-align: left;width:25%;'>".$personal->fields[5]."</td>
		<td style='text-align: left;width:25%;'>".$personal->fields[6]."</td>
		<td style='text-align: left;width:14%;'>".utf8_encode($personal->fields[3])."</td>
		
		</tr>
		</table>
		<table>
		<tr class='$clase'>
		<td>
		<b>Anestesista:</b> 
		</td>
		<td style='text-align: left;width:80%;'>".$personal->fields[15]."</td>
		
		</tr>
		<tr class='$clase'>
		<td>
		<b>Cirujanos:</b> 
		</td>
		<td style='text-align: left;width:80%;'>".$personal->fields[15]."</td>
		
		</tr>
		<tr class='$clase'>
		<td>
		<b>Observaciones:</b> 
		</td>
		<td style='text-align: left;width:80%;'>".$personal->fields[15]."</td>
		
		</tr>
		</table>
		<table>
		
		
		
	
		</tr>
		";
		print($html);
		$personal->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
	
}



if($_GET['tipo']=='cargar_filtro_especialidad') {
	
		$sql="SELECT parte_quirurgico.especialidad,especialidad.glosa_especialidad,
		count(parte_quirurgico.especialidad)  
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad=especialidad.id_especialidad
				where activo = 2
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



if($_GET['tipo']=='personal') {
	$busqueda = ($_GET['buscar']*1);
	$sql="SELECT pp.hora_ini, pp.hora_fin, pp.id_pab,to_char(parte_quirurgico.fc_parte,'dd-mm-yy')
	,parte_quirurgico.anestesia,pp.id_hora_pab,parte_quirurgico.especialidad    
	FROM paciente_pabellon pp	
	inner join parte_quirurgico on pp.num_parte = parte_quirurgico.num_parte 
	WHERE pp.num_parte=$busqueda";
	$personal = $db->Execute($sql);
	//print($personal);
	for($i=0;$i <= 6;$i++) {
		$datos[$i]=($personal->fields[$i]);
	}
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);		
}


if($_REQUEST['tipo']=='cargar_listado_pabellones') {
	
	//$sql="select id_pab,hora_inicio||' '|| hora_fin as hora from ESPECIALIDAD_PABELLON where ESPECIALIDAD = 0 and id_pabellon > ?";
	
	$valores = array();
	$sql="select  TO_CHAR(to_timestamp(hora_inicio,'HH24:MI')-TO_timestamp(hora_fin,'HH24:MI'), 'HH24:MI') AS TIEMPO,especialidad,id_pab,
						HORA_INICIO||' ' ||hora_fin as hora		
						from especialidad_pabellon
						where id_pabellon > ? and especialidad = ?  ";
		$valores[] = $_REQUEST['idpab'];
		$valores[] = $_REQUEST['espe'];
		$rs_2 = $db->Execute($sql,$valores);
		$xx = $rs_2->fields[2];
		$sql_1="select sum(min) from paciente_pabellon
			 where id_pab = '$xx' ";
		//$valores[] = $_REQUEST['idpab'];
		$rs_1 = $db->Execute($sql_1);
	
	
	print("<center>
		<table style='width:98%;' id='tabla_usuarios' name='tabla_usuarios'>
		<thead>
			<tr class='theader' >
				<td style='text-align: center;'>
					<b>Pabellon</b>
				</td>
				<td style='text-align: center;'>
					<b>Horario</b>
				</td>
				<td style='text-align: center;'>
					<b>Tiempo Disponible</b>
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
	while (!$rs_2->EOF) {
		if(($i%2)==0) {
				$clase='tfila1';
		} else {
		
				$clase='tfila2';		
		}
		
		
					$datos = $rs_2->fields[0];
					$especialidad2 = $rs_2->fields[1];
					$id_pab2 = $rs_2->fields[2];
					$hora_ini = $rs_2->fields[3];
					$min = split("0 0",$datos);
					$uno = $min[1];
					$dos = split(":00.",$uno);
					$tres = $dos[0];
					$hora = split(":",$tres);
			
					$hora_real = $hora[0] * 3600;
					$min_real = $hora[1] * 60;
					$tiempo_total_pabellon = $hora_real + $min_real;
					$tpo1 = $rs_1->fields[0];
					$disponible = (($tiempo_total_pabellon - $tpo1)/60);
				
		
		$html="
			<tr id='tabla_usuarios_".$i."' class='$clase'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios2\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios2\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:20%;'>".$rs_2->fields[2]."</td>
		<td style='text-align: center;width:46%;'>".$rs_2->fields[3]."</td>
		<td style='text-align: center;width:33%;'>".$disponible." min</td>
		
		</tr>
		";
		print($html);
		$rs_2->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
}

?>
