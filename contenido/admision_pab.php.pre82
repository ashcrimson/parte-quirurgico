<?php

require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');

if($_GET['tipo']=='pabellon') {
	
	$inicio 		= $_GET['inicio'];
	//$fc1_filtro = iconv("UTF-8", "ISO-8859-1",$_GET['fc1_filtro']);
	//$fc2_filtro = iconv("UTF-8", "ISO-8859-1",$_GET['fc2_filtro']);
									
	if($inicio==1){
		$filtro_cond = "AND (condicion.cod_cond =0)";
	//	$filtro_esp  = "AND (parte_quirurgico.especialidad >=0)";
	//	$filtro_base  = "AND (ingreso.grupo_base >=0)";
										
		}
	
	else{
					$filtro_cond = $_GET['filtro_cond'];
					$fc1_filtro  = $_GET['fc1_filtro'];
					$fc2_filtro  = $_GET['fc2_filtro'];
					$orden			 = $_GET['orden'];
					$filtro 		 = $_GET['filtro'];
					$tpcirugia 	 = $_GET['tpcirugia'];
					$priori			 = $_GET['priori'];
					$salud			 = $_GET['salud'];
		
					if(trim($filtro_cond)>="0") {
					$filtro_cond=" AND (condicion.cod_cond =$filtro_cond)";
					} else {
					$filtro_cond="AND (condicion.cod_cond > '-1')";
					}
							
					/*	if(trim($fc1_filtro)!="" && trim($fc2_filtro)=="" ) {
						$fc1_filtro=" AND TO_CHAR(parte_quirurgico.fc_parte,'dd-mm-yy') >= TO_DATE('$fc1_filtro')";
						$fc2_filtro ="";
								
						}*/ 
						
							 if(trim($fc2_filtro)!="" && trim($fc1_filtro)!="" ) {
							$fc2_filtro=" AND (TO_CHAR(parte_quirurgico.fc_parte,'dd-mm-yy') between TO_DATE('$fc1_filtro') and TO_DATE('$fc2_filtro'))
														 ";
					//		$fc1_filtro ="";
								
							}
							
										$filtro_esp = $_GET['filtro_esp'];
										if(trim($filtro_esp)>="0") {
										$filtro_esp=" AND (parte_quirurgico.especialidad =$filtro_esp)";
										} else {
										$filtro_esp="";
										}
											
											
											$filtro_base = $_GET['filtro_base'];
											if(trim($filtro_base)>="0") {
											$filtro_base=" AND (ingreso.grupo_base =$filtro_base)";
											} else {
											$filtro_base="";
											}
											
											if ($filtro!=""){
											if ($_GET['orden']=="rut"){
											$filtro_persona = " and (".$_GET['orden'].") = '".($filtro)."'";
												
											}
											else{	
											$filtro_persona = " and upper(".$_GET['orden'].") like '%".strtoupper($filtro)."%'";
											}
										}
										
										
										if(trim($tpcirugia)>="0") {
											$filtro_cirugia=" AND (tp_cirugia =$tpcirugia)";
											} else {
											$filtro_cirugia="";
											}
											if(trim($priori)>="0") {
											$filtro_priori=" AND (prioridad =$priori)";
											} else {
											$filtro_priori="";
											}
											if(trim($salud)>="0") {
											$filtro_salud=" AND (ingreso.sis_salud =$salud)";
											} else {
											$filtro_salud="";
											}
					
			}
	$buscar ="$fc2_filtro
						$filtro_cond
						$filtro_esp
						$filtro_base
						$filtro_persona
						$filtro_cirugia
						$filtro_priori
						$filtro_salud
						";
	
	$sql="select obs,TO_CHAR(fc_parte,'dd-mm-yy'),nombre||' '||appaterno||' '||apmaterno as nombre,rut,
				medico_tratante,glosa_diag,tpo_cirugia,parte_quirurgico.num_parte,condicion.glosa_cond,
				trunc(CURRENT_TIMESTAMP) - trunc(fc_parte)as diferencia_dias,trunc(CURRENT_TIMESTAMP) - trunc(ingreso.fc_pabellon)as pab_dias
				,ingreso.fc_pabellon,especialidad.glosa_especialidad,ingreso.total_check
				from parte_quirurgico
				left join cie10 on parte_quirurgico.diagnostico=cie10.cod_diag
				left join ingreso on parte_quirurgico.num_parte=ingreso.num_parte
			  left join condicion on ingreso.CONDICION=condicion.COD_COND
			 	left join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad
			 	
				where activo=1 $buscar 
				";
	$detalle = $db->Execute($sql);
	
	//echo($sql);
	print("
		<div style='overflow:auto;width:100%;' >
			<table class='theader' style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:2%;'>
					<b>Cond.</b>
				</td>
				<td style='text-align: center;width:3%;'>
					<b>D&iacute;as Espera</b>
				</td>
				<td style='text-align: center;width:5%;'>
					<b>Fc Insc.</b>
				</td>
				<td style='text-align: center;width:8%;'>
					<b>Nombre</b>
				</td>
				<td style='text-align: center;width:5%;'>
					<b>Especialidad</b>
				</td>
				<td style='text-align: center;width:5%;'>
					<b>TPO QCO.</b>
				</td>
				<td style='text-align: center;width:5%;'>
					<b>CHEQUEOS PO</b>
				</td>
				
				</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:200px;overflow:auto;' >
			<table  style='width:98%;' align='center'   id='tb_desglose' name='tb_desglose' >");
	$i=0;
	while (!$detalle->EOF) {
		if(($i%2)==0) {
				$clase='mouse_over2';
		} else {
				$clase='mouse_over';
		}
		$tpo=$detalle->fields[6];
		if($tpo==0){
			$tiempo='30 mins';
			}
			if($tpo==1){
			$tiempo='60 mins';
			}if($tpo==2){
			$tiempo='90 mins';
			}if($tpo==3){
			$tiempo='120 mins';
			}if($tpo==4){
			$tiempo='150 mins';
			}if($tpo==5){
			$tiempo='180 mins';
			}
			if($tpo==6){
			$tiempo='210 mins';
			}
			if($tpo==7){
			$tiempo='240 mins';
			}
			if($tpo==8){
			$tiempo='270 mins';
			}
			if($tpo==9){
			$tiempo='300 mins';
			}
			
			
			
			if($detalle->fields[11]!=null){
				
				$dias= ($detalle->fields[9]-$detalle->fields[10]);
				}
				else{
					$dias=$detalle->fields[9];
					}
			
			
	$total = $detalle->fields[13];	
	$num_p = $detalle->fields[7];
		if($total!=0){
		$sqlz="select count(num_req) from requerimientos where  num_parte =$num_p ";			
		$rsz = $db->Execute($sqlz);
		
	$listos	= $rsz->fields[0];
	$porc = round(($listos * 100) / $total)."%";
	if($porc ==100){
		$color = "color='#00FF00'";
	}
			if(($porc >=50) && ($porc < 100 ) ){
					$color = "color='#FFEB00'";
			}			
					if($porc < 50){
							$color = "color='#FF2B00'";
					}
	
	}else{
		$listos ="";
		$porc ="S/R";
		$color= "color='#FFFFFF'";
		$total="";	
	}	
			
			
		$html="
		
		<tr class='$clase'   id='\"".$detalle->fields[7]."\"'  
			onMouseOver='this.className=\"mouse_over3\"'
			onMouseOut='this.className=\"$clase\"' 
			onClick='guardar_agenda(\"".$detalle->fields[7]."\");'>
			<td td style='text-align: center;width:2%;'> 
			<td style='text-align: center;width:2%;'>".$detalle->fields[8]."</td>
			<td style='text-align: center;width:2%;'>".$dias."</td>
			<td style='text-align: center;width:3%;'>".$detalle->fields[1]."</td>
			<td style='text-align: center;width:8%;'>".htmlentities($detalle->fields[2])."</td>
			<td style='text-align: center;width:8%;'>".htmlentities($detalle->fields[12])."</td>
			<td style='text-align: center;width:2%;'>".$tiempo."</td>
			<td style='text-align: center;width:5%;text-shadow: -1px -1px 1px #000, 1px -1px 1px #000, -1px 1px 1px #000, 1px 1px 1px #000;'  title='AVANCE' id='xxxx' onmouseover='ver_check(".$detalle->fields[7].");'  ><font $color><b>".$porc."</b></font></td>
		
			
		</tr>
		";
		print($html);
		$detalle->movenext();
		$i++;
}
print("</table></div>");
}

if($_GET['tipo']=='pabellon_asignado') {
	
	$fc_pabellon = $_GET['fc'];
	$pab = split(":",$fc_pabellon);
	$pab1 = $pab[1];
//	echo ($pab1);
	//echo($sql);
	
	print("
		<div style='overflow:auto;width:100%;' >
			<table  style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:2%;'>
					<b>PABELLON ".$fc_pabellon."</b>
				</td>
							
			</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:10px;overflow:auto;' >
			<table  style='width:98%;' align='center'   id='tb_desglose' name='tb_desglose' >");
		

}

if($_GET['tipo']=='detalle_pabellon') {
	
	$inicio = $_GET['inicio'];
	$sql="select hora_inicio ,hora_fin,especialidad.glosa_especialidad,id_pabellon,especialidad
				from especialidad_pabellon
				left join especialidad on especialidad_pabellon.especialidad = especialidad.id_especialidad
				where id_pab = '$inicio'
				order by hora_inicio asc
				
				";
	$detalle = $db->Execute($sql);
	
	//echo($detalle);
	print("
		<div style='overflow:auto;width:100%;' >
			
				<table  style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:2%;'>
					<b>PABELLON ".$inicio."</b>
				</td>
							
			</tr>
			</thead>
			</table>
			<table class='theader' style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:2%;'>
					<b>Horario</b>
				</td>
				<td style='text-align: center;width:3%;'>
					<b>Especialidad</b>
				</td>
				<td style='text-align: center;width:3%;'>
					<b>Pacientes Agendados</b>
				</td>
				
				</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:200px;overflow:auto;' >
			<table  style='width:98%;' align='center'   id='tb_desglose' name='tb_desglose' >");
	$i=0;
	while (!$detalle->EOF) {
		
		$sqlx="select count(num_parte)
				from paciente_pabellon
				where id_hora_pab = ".$detalle->fields[3]."
				
				";
	$rsx = $db->Execute($sqlx);
	$datox = $rsx->fields[0]; 
	//print($datox);
	
		
		
		if($detalle->fields[4]==0) {
				$clase='mouse_over_traumatologia';
		}
		if($detalle->fields[4]==5) {
		
				$clase='mouse_over_vascular';
		}
		if($detalle->fields[4]==1) {
		
				$clase='mouse_over_ofta';
		}
		if($detalle->fields[4]==3) {
		
				$clase='mouse_over_otorrino';
		}
			if($detalle->fields[4]==8) {
		
				$clase='mouse_over_mama';
		}
		
		$html="
		
		<tr class='$clase'   id='\"".$detalle->fields[3]."\"'  
			onMouseOver='this.className=\"mouse_over\"'
			onMouseOut='this.className=\"$clase\"' onClick='abrir_pab(\"".$detalle->fields[3]."\");' >
			<td style='text-align: center;width:2%;'>".$detalle->fields[0]."</td>
			<td style='text-align: center;width:3%;'>".$detalle->fields[1]."</td>
			<td style='text-align: center;width:8%;'>".htmlentities($detalle->fields[2])."</td>
			<td style='text-align: center;width:3%;'>".$datox."</td>
			
		</tr>
		";
		print($html);
		$detalle->movenext();
		$i++;
}
print("</table></div>");
}	


if($_GET['tipo']=='pabellon2') {
	
	$inicio 		= $_GET['inicio'];
	
	
	
	
	
	$sql="select p.obs,TO_CHAR(p.fc_parte,'dd-mm-yy'),p.nombre||' '||p.appaterno||' '||p.apmaterno as nombre,p.rut,
				p.medico_tratante,glosa_diag,tpo_cirugia,p.num_parte,condicion.glosa_cond,
				trunc(CURRENT_TIMESTAMP) - trunc(p.fc_parte)as diferencia_dias,trunc(CURRENT_TIMESTAMP) - trunc(ingreso.fc_pabellon)as pab_dias
				,ingreso.fc_pabellon,especialidad.glosa_especialidad,especialidad_pabellon.id_pab,p.edad,p.fono,p.tpo_cirugia
				from parte_quirurgico p
				left join cie10 on p.diagnostico=cie10.cod_diag
				left join ingreso on p.num_parte=ingreso.num_parte
			  left join condicion on ingreso.CONDICION=condicion.COD_COND
			 	left join especialidad on p.especialidad = especialidad.id_especialidad
				inner join paciente_pabellon on p.num_parte = paciente_pabellon.num_parte
				inner join especialidad_pabellon on paciente_pabellon.id_hora_pab = especialidad_pabellon.ID_PABELLON
				where activo=2 and  paciente_pabellon.id_hora_pab = $inicio
				";
	$detalle = $db->Execute($sql);
	
	//echo($sql);
	print("
		<div style='overflow:auto;width:100%;' >
			<table class='theader' style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:2%;'>
					<b>Pabellon ".$detalle->fields[13]."</b>
				</td>
				
				
				</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:400px;overflow:auto;' >
			<table  style='width:98%;' align='center'   id='tb_desglose' name='tb_desglose' >
			<td colspan=2 > </td>");
	$i=0;
	while (!$detalle->EOF) {
		if(($i%2)==0) {
				$clase='mouse_over2';
		} else {
				$clase='mouse_over2';
		}
		$closon ='mouse_over_verde';
		$closin = 'mouse_over_fondo';
		$tpo=$detalle->fields[16];
		if($tpo==0){
			$tiempo='30 mins';
			}
			if($tpo==1){
			$tiempo='60 mins';
			}if($tpo==2){
			$tiempo='90 mins';
			}if($tpo==3){
			$tiempo='120 mins';
			}if($tpo==4){
			$tiempo='150 mins';
			}if($tpo==5){
			$tiempo='180 mins';
			}
			if($tpo==6){
			$tiempo='210 mins';
			}
			if($tpo==7){
			$tiempo='240 mins';
			}
			if($tpo==8){
			$tiempo='270 mins';
			}
			if($tpo==9){
			$tiempo='300 mins';
			}
		
		
			
		$html="
		
		<tr class='$clase'   id='\"".$detalle->fields[7]."\"'  
			onMouseOver='this.className=\"mouse_over2\"'
			onMouseOut='this.className=\"$clase\"' 
			onClick='guardar_agenda(\"".$detalle->fields[7]."\");'>
			<td style='text-align: center;width:2%;'>Especialidad</td>
			<td style='text-align: center;width:2%;' >".htmlentities($detalle->fields[12])."</td>
			</tr><tr>
			<td class='$closin' style='text-align: center;width:3%;'>Paciente:</td>
			<td class='$closon' style='text-align: center;width:8%;'>".htmlentities($detalle->fields[2])."</td>
			</tr><tr>
			<td class='$closin' style='text-align: center;width:8%;'>Rut</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$detalle->fields[3]."</td>
			</tr><tr>
			<td class='$closin' style='text-align: center;width:8%;'>Edad</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$detalle->fields[14]."</td>
			</tr><tr>
			<td class='$closin' style='text-align: center;width:8%;'>Fono</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$detalle->fields[15]."</td>
			</tr><tr>
			<td class='$closin' style='text-align: center;width:8%;'>Medico Tratante</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$detalle->fields[4]."</td>
			</tr><tr>
			<td  class='$closin' style='text-align: center;width:8%;'>Tpo.Quirurgico</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$tiempo."</td>
			</tr><tr>
			<td class='$closin' style='text-align: center;width:8%;'>Diagnostico</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$detalle->fields[5]."</td>
			</tr><tr>
			<td  class='$closin' style='text-align: center;width:8%;'>Fecha Parte</td>
			<td class='$closon' style='text-align: center;width:2%;'>".$detalle->fields[1]."</td>
			</tr><tr>
			<td  class='$closin' style='text-align: center;width:8%;'>Borrar Paciente</td>
			<td class='$closon' style='text-align: center;width:2%;'><input type='image' onclick='borrar_lista(\"".$detalle->fields[7]."\",\"".$detalle->fields[13]."\");' src='imagenes/user_delete.png'></td>
			
		</tr>
		";
		print($html);
		$detalle->movenext();
		$i++;
}
print("</table></div>");
}

if($_GET['tipo']=='guardar_paciente_agenda'){
	
	$parte 			 = $_GET['parte'];
	$hora_agenda =$_GET['hora_agenda'];
	//print($hora_agenda);
	
	$sql="select tpo_cirugia,especialidad from parte_quirurgico where num_parte = $parte";
	$rs = $db->Execute($sql);
	$tpo = $rs->fields[0];
	$especialidad = $rs->fields[1];
	//print($tpo);
	if($tpo==0){
			$tiempo='30';
			}
			if($tpo==1){
			$tiempo=60;
			}if($tpo==2){
			$tiempo=90;
			}if($tpo==3){
			$tiempo=120;
			}if($tpo==4){
			$tiempo=150;
			}if($tpo==5){
			$tiempo=180;
			}
			if($tpo==6){
			$tiempo=210;
			}
			if($tpo==7){
			$tiempo=240;
			}
			if($tpo==8){
			$tiempo=270;
			}
			if($tpo==9){
			$tiempo=300;
			}
	$total_tpo = $tiempo * 60;
	//print($total_tpo);
	
	
		$sql_2="select  TO_CHAR(to_timestamp(hora_inicio,'HH24:MI')-TO_timestamp(hora_fin,'HH24:MI'), 'HH24:MI') AS TIEMPO,especialidad,id_pab,
						HORA_INICIO		
						from especialidad_pabellon
						where id_pabellon = $hora_agenda  ";
		$rs_2=$db->Execute($sql_2);
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
	//	print($tiempo_total_pabellon);
	
	$sql="select sum(min) from paciente_pabellon
			 where id_hora_pab = $hora_agenda ";
	$rs = $db->Execute($sql);
	$tpo1 = $rs->fields[0];
	//print($tpo1);
		// print($total_tpo_guardado);
		 
		$totales = 	$tiempo_total_pabellon - $tpo1;
	//	print($totales);
		
if($total_tpo > $totales){
	
	print('0');
	}
else{
	if($especialidad == $especialidad2){

	$sql_h="select max(hora_fin) from paciente_pabellon where id_hora_pab = $hora_agenda";
	$rs_hora = $db->Execute($sql_h);
	$hora_ultima = $rs_hora->fields[0];		
	if($hora_ultima==""){	
		
		$hora =split(":",$hora_ini);
		$horas =$hora[0]*3600; 
		$min =$hora[1]*60;
		$horario = $horas + $min;
		$tiempo_operacion = ((($total_tpo+ $horario)/60)/60 );
		$num = floor($tiempo_operacion);
		$dec = (($tiempo_operacion - $num)*60);
		$hora_fin = $num.":".$dec; 
	}else{
		$hora =split(":",$hora_ultima);
		$horas =$hora[0]*3600; 
		$min =$hora[1]*60;
		$horario = $horas + $min;
		$tiempo_operacion = ((($total_tpo+ $horario)/60)/60 );
		$num = floor($tiempo_operacion);
		$dec = (($tiempo_operacion - $num));
		if($dec == 0.5){
		$dec = ($dec*60);
	}else{
		$dec="00";
		}
		$hora_fin = $num.":".$dec;
		$hora_ini = $hora_ultima; 
	}
	
	
		$sql="select max(orden) from paciente_pabellon where id_hora_pab = $hora_agenda";
		$rs = $db->Execute($sql);
		$numero 	= $rs->fields[0];
		$num_max  = $numero + 1; 
		
		//print($hora_ini);	
		//print($hora_fin);	
		$sql_2="insert into paciente_pabellon (num_parte,id_hora_pab,min,id_pab,hora_ini,hora_fin,orden)values($parte,$hora_agenda,$total_tpo,'$id_pab2','$hora_ini','$hora_fin',$num_max)";
		$rs_2=$db->Execute($sql_2);
		//$datos = $rs->fields[0];
		
			$sql="update parte_quirurgico  set activo = 2 where num_parte =$parte";
			$rs = $db->Execute($sql);
	
			$sql="update pabellon  set estado = 3 where id_pab ='$id_pab2'";
			$rs = $db->Execute($sql);
			

		print('1');
	}else{
		print('2');
		}
	
}
}


if($_GET['tipo']=='borrar_paciente_agenda'){
	
	
	$borrar = $_GET['borrar'];
	
	$id_pab = $_GET['id_pab'];
	
	$sql="delete from paciente_pabellon where num_parte =$borrar";
	$rs= $db->Execute($sql);
	//print($sql);
		$sql2="update parte_quirurgico  set activo = 1 where num_parte =$borrar";
		$rs2 = $db->Execute($sql2);
	
	$sql="select count(id_pab) from paciente_pabellon where id_pab ='$id_pab'";
	$rs= $db->Execute($sql);
	$resul = $rs->fields[0];
	if($resul==0){
			$sql2="update pabellon  set estado = 1 where id_pab ='$id_pab'";
			$rs2 = $db->Execute($sql2);
		}
	
	}





?>