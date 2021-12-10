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
				,ingreso.fc_pabellon,especialidad.glosa_especialidad
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
			
		$html="
		
		<tr class='$clase' draggable='true' ondragstart='drag(event)'  id='\"".$detalle->fields[7]."\"'  
			onMouseOver='this.className=\"mouse_over3\"'
			onMouseOut='this.className=\"$clase\"' 
			onClick='seleccionar_usuario(\"".$detalle->fields[7]."\");'> 
			<td style='text-align: center;width:2%;'>".$detalle->fields[8]."</td>
			<td style='text-align: center;width:2%;'>".$dias."</td>
			<td style='text-align: center;width:3%;'>".$detalle->fields[1]."</td>
			<td style='text-align: center;width:8%;'>".htmlentities($detalle->fields[2])."</td>
			<td style='text-align: center;width:8%;'>".htmlentities($detalle->fields[12])."</td>
			<td style='text-align: center;width:2%;'>".$tiempo."</td>
			
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
	$sql="select estado from pabellon where id_pab = '".$_GET['fc']."'
 		";
		$rs = $db->Execute($sql);
		$resul = $rs->fields[0];
	
	
	
	print("
		<div style='overflow:auto;width:100%;' >
			<table  style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:33%;'>
					<b>PABELLON   ".$fc_pabellon."</b>
				</td>
					<td style='text-align: center;width:10%;' >
					<b>Estado</b>
					</td>
					<td>
						<select id='estado' name='estado'   style='width:90px;' class='combo' onchange='cambiar_estado(this.value);'>
							<option value='1' selected >Disponible</option>
							<option value='2'>Bloqueado</option>
						</select>	
					</td>		
			</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:150px;overflow:auto;' >
			<table  style='width:98%;' align='center'   id='tb_desglose' name='tb_desglose' >");
	$i=0;
			
	$html.= "<div id='filtrox' name='filtrox'   style='display:none;'>";
							$html.= "<table style='width:98%;' >
														<tr>
															<td>
																<b>Especialidad</b>
															</td>
															<td>
															<input type='hidden' id='fc' value=".$fc_pabellon." >
																	<select name='especialidad'  style='width:140px' id='especialidad'  >
												
																		<option value=-1>-----------------</option>
																		<option value='0'>Traumatologia</option>
																		<option value='3'>Otorrino</option>
																		<option value='8'>Mama</option>
																		<option value='4'>Cirugia</option>
																		<option value='7'>Cirugia Plastica</option>
																		<option value='6'>Neurocirugia</option>
																		<option value='1'>Oftalmologia</option>
																		<option value='2'>Urologia</option>
																		<option value='5'>vascular</option>
																		<option value='9'>Policlinico de anestesia</option> 
																		<option value='10'>Cirugia cardiovascular </option>
																		<option value='20'>gastroenterologia</option>
																		<option value='16'>cirugia maxilofacial</option>
																		<option value='15'>cirugia infantil </option>
																		<option value='21'>ginecologia/obstetricia</option>
																		<option value='24'>traumatologia infantil</option>
																		<option value='30'>odontopediatria y odontologia c/anestesia gral.</option>
																		<option value='31'>endoscopia urologica</option>
																		<option value='32'>scanner con anestesia general</option>
																		<option value='33'>hemodinamia con anestesia general </option>
																		<option value='34'>cirugia mayor ambulatoria</option>
																		<option value='35'>resonancia magnètica con anestesia general</option>

																				
																		</select>		";
																			
																		
										
														
											$html.= "				</td>
															<td style='width:10%;'>
															<b>Turno</b>
															</td>
															<td>
															<select id='turnos' name='turnos' style='width:50px;display:block;' onchange='cambiar()'; class='combo'>
																<option value='0'>AM</option>
																<option value='1'>PM</option>
															</select>
															</td>
															
															<td>
															<b>Horas</b>
															</td>
															
															<td id='horaam' style='display:block;'>
															<select id='hora1' name='hora1' style='width:70px;display:block;' onclick='cambiar()'; class='combo'>
															<option value='08:00'>08:00</option>
															<option value='08:30'>08:30</option>
															<option value='09:00'>09:00</option>
															<option value='09:30'>09:30</option>
															<option value='10:00'>10:00</option>
															<option value='10:30'>10:30</option>
															<option value='11:00'>11:00</option>
															<option value='11:30'>11:30</option>
															<option value='12:00'>12:00</option>
															<option value='12:30'>12:30</option>
															<option value='13:00'>13:00</option>
															<option value='13:30'>13:30</option>
														
														</select>
														</td>
														<td id='horaam1' style='display:block;'>
														<select id='hora2' name='hora2' style='width:70px;display:block;' onclick='cambiar()'; class='combo'>
															<option value='08:30'>08:30</option>
															<option value='09:00'>09:00</option>
															<option value='09:30'>09:30</option>
															<option value='10:00'>10:00</option>
															<option value='10:30'>10:30</option>
															<option value='11:00'>11:00</option>
															<option value='11:30'>11:30</option>
															<option value='12:00'>12:00</option>
															<option value='12:30'>12:30</option>
															<option value='13:00'>13:00</option>
															<option value='13:30'>13:30</option>
														
														</select>
															</td>
															
															<td id='horapm' style='display:none;'>
														<select id='hora3' name='hora3' style='width:70px;' class='combo'>
															<option value='14:00' selected>14:00</option>
															<option value='14:30'>14:30</option>
															<option value='15:00'>15:00</option>
															<option value='15:30'>15:30</option>
															<option value='16:00'>16:00</option>
															<option value='16:30'>16:30</option>
															<option value='17:00'>17:00</option>
														
														</select>
														</td>
														<td id='horapm1' style='display:none;'>
														<select id='hora4' name='hora4' style='width:70px;' class='combo'>
															<option value='14:30'>14:30</option>
															<option value='15:00'>15:00</option>
															<option value='15:30'>15:30</option>
															<option value='16:00'>16:00</option>
															<option value='16:30'>16:30</option>
															<option value='17:00'>17:00</option>
														
														</select>
														
														</td>
													
													
													<tr>		
													
															<td td style='text-align:center;'>
																<input type='button' name='contacto' id='contacto' value='Guardar' onclick='guardar_contacto();'  >
															</td>
													</tr>		
												</table>
											";
							$html.= "</div>";
							
							print($html);
		

print("</table></div>");
}


if($_GET['tipo']=='guardar_pab'){
	
	
	$especialidad = $_GET['especialidad'];
	$hora1 = $_GET['hora1'];
	$hora2 = $_GET['hora2'];
	$pabellon = $_GET['pabellon'];
	$id_pab =$_GET['id_pab'];
	$fc_pab =$_GET['fc_pab'];
	$estado =$_GET['estado'];
	
	$turnos =$_GET['turnos'];
	
		//print('puede agendar');
			$sql_2="insert into ESPECIALIDAD_PABELLON (HORA_INICIO,HORA_FIN,ESPECIALIDAD,PABELLON,FC_PAB,ID_PAB,TURNO)values
						('$hora1','$hora2','$especialidad','$pabellon','$fc_pab','$id_pab','$turnos') ";
				$rs_2=$db->Execute($sql_2);
		//		print($sql_2);

				$sql="select estado from PABELLON where ID_PAB ='$id_pab'";
				$rs=$db->Execute($sql);
				IF($rs->EOF){

						$sql_2="insert into PABELLON (ID_PAB,ESTADO)values
						('$id_pab',$estado) ";
						$rs_2=$db->Execute($sql_2);
				}else{
					$sql="update  pabellon set estado = $estado where id_pab = '$id_pab' ";
					$rs = $db->Execute($sql);
					
					}
	
	}
	
if($_GET['tipo']=='guardar_pab_estado'){
	
	
	$estado =$_GET['estado'];
	$id_pab = $_GET['id_pab'];
	
	
	$sql="select estado from PABELLON where ID_PAB ='$id_pab'";
				$rs=$db->Execute($sql);
				IF($rs->EOF){
						$sql_2="insert into PABELLON (ID_PAB,ESTADO)values
						('$id_pab',$estado) ";
						$rs_2=$db->Execute($sql_2);
			
			
				}else{
					$sql="update  pabellon set estado = $estado where id_pab = '$id_pab' ";
					$rs = $db->Execute($sql);
				}
					
	
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
			<table class='theader' style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
					<td style='text-align: center;width:30%;'>
					<b>Horario</b>
				</td>
				<td style='text-align: center;width:50%;'>
					<b>Especialidad</b>
				</td>
					<td style='text-align: center;width:20%;'>
					<b>Acci&oacute;n</b>
				</td>
			
				</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:200px;overflow:auto;' >
			<table  style='width:98%;' align='center'   id='tb_desglose' name='tb_desglose' >");
	$i=0;
	while (!$detalle->EOF) {
		
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
			onMouseOver='h_i(this);this.className=\"mouse_over3\"'
			onMouseOut='this.className=\"$clase\"'>
			<td style='text-align: center;width:2%;'>".$detalle->fields[0]."</td>
			<td style='text-align: center;width:3%;'>".$detalle->fields[1]."</td>
			<td style='text-align: center;width:8%;'>".htmlentities($detalle->fields[2])."</td>
			<td style='text-align: center;width:2%;'  title='Eliminar' onClick='borrar_item(".$detalle->fields[3].")'><a><b>BORRAR</b></a></td>
			
		</tr>
		";
		print($html);
		$detalle->movenext();
		$i++;
}
print("</table></div>");
}	



if($_GET['tipo']=='verifica_class'){
	
	$data = $_GET['resultado'];
	
		 $sql="select id_pab from pabellon where id_pab = '$data'
 			group by id_pab";
		$rs = $db->Execute($sql);
		
		$resul = $rs->fields[0];
		
 print($resul);

}
if($_GET['tipo']=='borrar_item') {
	$valores= array();
	$sql="delete from especialidad_pabellon where id_pabellon = ?";
	$valores[0]	=$_REQUEST['iditem'];
	$rs = $db->Execute($sql,$valores);
	
	
}


?>