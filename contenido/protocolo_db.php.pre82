<?php
session_start();
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');

if($_GET['tipo']=='control_tramitacion') {
	
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
					$orden			 = $_GET['orden'];
					$filtro 		 = $_GET['filtro'];
			
		
					if(trim($filtro_cond)>="0") {
					$filtro_cond=" AND (condicion.cod_cond =$filtro_cond)";
					} else {
					$filtro_cond="AND (condicion.cod_cond > '-1')";
					}
					
						if(trim($fc1_filtro)!="") {
						$fc1_filtro=" AND (TO_CHAR(parte_quirurgico.fc_parte,'dd-mm-yy') = '$fc1_filtro')";
						
								
						}
						
							
										$filtro_esp = $_GET['filtro_esp'];
										if(trim($filtro_esp)>="0") {
										$filtro_esp=" AND (parte_quirurgico.especialidad =$filtro_esp)";
										} else {
										$filtro_esp="";
										}
											
											
											
											if ($filtro!=""){
											if ($_GET['orden']=="rut"){
											$filtro_persona = " and (".$_GET['orden'].") = '".($filtro)."'";
												
											}
											else{	
											$filtro_persona = " and upper(".$_GET['orden'].") like '%".strtoupper($filtro)."%'";
											}
										}
										
										
										
			}
	$buscar ="
						$fc1_filtro
						$filtro_cond
						$filtro_esp
						$filtro_persona
						";
	
	$sql="select obs,TO_CHAR(fc_parte,'dd-mm-yy'),nombre||' '||appaterno||' '||apmaterno as nombre,rut,
				medico_tratante,glosa_diag,tpo_cirugia,parte_quirurgico.num_parte,condicion.glosa_cond,
				trunc(CURRENT_TIMESTAMP) - trunc(fc_parte)as diferencia_dias,trunc(CURRENT_TIMESTAMP) - trunc(ingreso.fc_pabellon)as pab_dias
				,ingreso.fc_pabellon,ingreso.total_check,dv_rut,glosa_intervencion
				from parte_quirurgico
				inner join cie10 on parte_quirurgico.diagnostico=cie10.cod_diag
				inner join ingreso on parte_quirurgico.num_parte=ingreso.num_parte
				inner join intervencion on parte_quirurgico.INTERVENCION||parte_quirurgico.DIG_INTERV = intervencion.CODPREST||intervencion.CORROPER
			  inner join condicion on ingreso.CONDICION=condicion.COD_COND
			 	inner join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad
				 inner join PACIENTE_PABELLON on PARTE_QUIRURGICO.NUM_PARTE = PACIENTE_PABELLON.NUM_PARTE
				where activo=2 and (PACIENTE_PABELLON.ID_PAB is not null)$buscar
				";
	$detalle = $db->Execute($sql);
	//echo($sql);
	print("
		<div style='overflow:auto;width:100%;' >
			<table class='theader' style='width:98%;' align='center'  id='tabla_af' name='tabla_af'>
		<thead >
			<tr >
				<td style='text-align: center;width:5%;'>
					<b>Nro</b>
				</td>
				<td style='text-align: center;width:10%;'>
					<b>Rut</b>
				</td>
					<td style='text-align: center;width:25%;'>
					<b>Nombre</b>
				</td>
				<td style='text-align: center;width:40%;'>
					<b>Operaci&oacute;n</b>
				</td>
				<td style='text-align: center;width:10%;'>
					<b>tipo Cirug&iacute;a</b>
				</td>
				<td style='text-align: center;width:10%;'>
					<b>Estado</b>
				</td>
			
				</tr>
			</thead>
			</table>
		</div>
		<div style='width:100%;height:350px;overflow:auto;'>
			<table  style='width:98%;' align='center'  id='tb_desglose' name='tb_desglose'>");
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
					
	$total = $detalle->fields[12];	
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
		<tr class='$clase' 
			onMouseOver='this.className=\"mouse_over3\"'
			onMouseOut='this.className=\"$clase\"' 
			onClick='seleccionar_usuario(\"".$detalle->fields[7]."\");' >
			<td style='text-align: center;width:5%;'>".$detalle->fields[7]."</td>
			<td style='text-align: center;width:10%;'>".$detalle->fields[3]."</td>
			<td style='text-align: center;width:25%;'>".htmlentities($detalle->fields[2])."</td>
			<td style='text-align: center;width:40%;'>".htmlentities($detalle->fields[14])."</td>
			<td style='text-align: center;width:10%;'>'cirugia menor'</td>
			<td style='text-align: center;width:10%;'>'Edicion'</td>
			
			
		</tr>
		";
		print($html);
		$detalle->movenext();
		$i++;
}
print("</table></div>");
}


if($_GET['tipo']=='personal') {
	$busqueda = ($_GET['buscar']*1);
	$sql="SELECT rut, nombre,appaterno,apmaterno,edad,fono,TO_CHAR(fc_parte,'dd-mm-yy'),parte_quirurgico.especialidad,medico_tratante, 
	parte_quirurgico.num_parte,obs,grupo_base,sis_salud,categoria,TO_CHAR(fc_digitacion,'dd-mm-yy'),TO_CHAR(fc_pabellon,'dd-mm-yy'),condicion 
	,glosa_intervencion,glosa_diag,paciente_pabellon.id_pab
	,ESPECIALIDAD_PABELLON.pabellon,ESPECIALIDAD_PABELLON.FC_PAB,ESPECIALIDAD_PABELLON.HORA_FIN
  ,ESPECIALIDAD_PABELLON.HORA_INICIO
	FROM parte_quirurgico	
	inner join ingreso on parte_quirurgico.NUM_PARTE = ingreso.NUM_PARTE
	inner join cie10 on parte_quirurgico.diagnostico=cie10.cod_diag
	inner join intervencion on parte_quirurgico.INTERVENCION||parte_quirurgico.DIG_INTERV = intervencion.CODPREST||intervencion.CORROPER
	inner join PACIENTE_PABELLON on PARTE_QUIRURGICO.NUM_PARTE = PACIENTE_PABELLON.NUM_PARTE
	inner join ESPECIALIDAD_PABELLON on PACIENTE_PABELLON.id_hora_pab  = ESPECIALIDAD_PABELLON.ID_PABELLON
	
	WHERE parte_quirurgico.num_parte=$busqueda";
	$personal = $db->Execute($sql);
	//print($personal);
	for($i=0;$i <= 23;$i++) {
		$datos[$i]=($personal->fields[$i]);
	}
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);		
}




if($_GET['tipo']=='lista_notas') {
	$idmensaje = $_GET['idmensaje'];
	$sql="SELECT glosa,TO_CHAR(fecha,'dd-mm-yy HH:MM'),usuario FROM nota_parte where parte = ".$idmensaje." order by id_nota asc ";
	$rsnota = $db->Execute($sql);
	$html ="<table style='width:99%;'>";
	$html.="<tr><td style='width:10%;'><b>Nro.</b></td>
					<td style='width:70%;'><b>Observaci&oacute;n</b></td>
					<td style='width:10%;'><b>Fecha/Hora</b></td>
					<td style='width:10%;'><b>Usuario</b></td>
					</tr></table><div style='overflow:auto;height:65%;'><table style='width:99%;'>";
	$i=1;
	while (!$rsnota->EOF) {
		if(($i%2)==0) {
				$clase='mouse_over2';
		} else {
				$clase='mouse_over';
		}
		$html.="<tr class='$clase' >";
		$html.="<td style='width:10%;text-align:left;'>".$i.")</td>";
		$html.="<td style='width:70%;text-align:left;'>".htmlentities($rsnota->fields[0])."</td>";
		$html.="<td style='width:10%;text-align:left;'>".$rsnota->fields[1]."</td>";
		$html.="<td style='width:10%;text-align:left;'>".$rsnota->fields[2]."</td>";
		$html.="</tr>";
		$rsnota->movenext();
		$i++;
	}
	$html.="</table></div>";
	print($html);
}

if($_GET['tipo']=='guardar_detalle'){
	
	$usuario  =$_SESSION ['rut'];
	$cond 		= $_GET['cond'];
	$parte 		= $_GET['parte'];
	$fc_pab 	= $_GET['fc_pab'];
	
	if($cond==0){
		$cond_glosa = 'LISTA ESPERA';
		}
	if($cond==1){
		$cond_glosa = 'PROGRAMADO';
		}
	if($cond==2){
		$cond_glosa = 'SUSPENDIDO';
		}
	if($cond==3){
		$cond_glosa = 'OPERADO';
		}
					
		$sql_2="select id_ingreso from ingreso where num_parte = $parte and condicion = $cond ";
		$rs_2=$db->Execute($sql_2);
		$datos = $rs->fields[0];
		//print($datos);
		
		if(!$rs_2->EOF){
		
				$sql="update ingreso set condicion = $cond,fc_pabellon = '$fc_pab' where num_parte = $parte";
				$rs = $db->Execute($sql);
				
				//	print('1');
			}else{
				$sql="update ingreso set condicion = $cond,fc_pabellon = '$fc_pab' where num_parte = $parte";
				$rs = $db->Execute($sql);
			//	print('2');
				$sql="insert into nota_parte (glosa,parte,fecha,usuario)
						values ('Cambio de Estado Paciente a ".$cond_glosa."',$parte,current_timestamp,'$usuario')";
				$rs=$db->Execute($sql);
			
				}
	
	}
	
	if($_GET['tipo']=='cargar_filtro_condicion') {
	$inicio = $_GET['inicio'];
		$sql="SELECT condicion.COD_COND,condicion.glosa_cond  
				FROM ingreso
				inner join condicion on ingreso.condicion=condicion.cod_cond
				GROUP BY condicion.COD_COND,condicion.glosa_cond 
				ORDER BY condicion.COD_COND DESC";
	$rs = $db->Execute($sql);
	
		
	//print($sql);
	
	echo("<select  name='filtro_cond' id='filtro_cond' style='width:80px;' onchange='listado_ingresos_filtros();' >");
	echo("<option value=-1  >--Todos--</option>");
	
		while (!$rs->EOF) {
		
		echo "<option value='".$rs->fields[0]."' selected >".htmlentities($rs->fields[1])."</option>";
		$rs->movenext();
		}
	
	echo("</select>");
}

if($_GET['tipo']=='cargar_filtro_especialidad') {
	
		$sql="SELECT parte_quirurgico.especialidad,especialidad.glosa_especialidad,count(parte_quirurgico.especialidad)  
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad=especialidad.id_especialidad
				inner join ingreso on parte_quirurgico.num_parte = ingreso.num_parte
				where activo = 2 and ingreso.fc_pabellon is not null
				GROUP BY parte_quirurgico.especialidad,especialidad.glosa_especialidad
				ORDER BY parte_quirurgico.especialidad DESC";
	$rs = $db->Execute($sql);
	
		
	//print($sql);
	
	echo("<select  name='filtro_esp' id='filtro_esp' style='width:140px;' onchange='listado_ingresos_filtros();' >");
	echo("<option value=-1 selected >--Todos--</option>");
	
		while (!$rs->EOF) {
		
		echo "<option value='".$rs->fields[0]."'  >".htmlentities($rs->fields[1])."(".($rs->fields[2]).")</option>";
		$rs->movenext();
		}
	
	echo("</select>");
	
}

if($_GET['tipo']=='cargar_pato') {
	$buscar = $_GET['buscar'];
	//echo($buscar);
		$sql="select glosa_patologia,id_patologia from patologias where codigo_patologia =$buscar";
		$rs = $db->Execute($sql);
	
	//print($sql);
	echo("<select  name='filtro_base' id='filtro_base' style='width:100px;' onchange='listado_ingresos_filtros();' >");
	echo("<option value=-1  >-------------</option>");
	while (!$rs->EOF) {
		echo "<option value='".$rs->fields[1]."'   >".htmlentities($rs->fields[0])."</option>";
		$rs->movenext();
	}
	echo("</select>");
}	

if($_GET['tipo']=='ver_checks') {

	$rut = $_GET['rut'];
	$parte = $_GET['parte'];
	$usuario 			 =$_SESSION ['rut'];
		

	$sql=" select p.latex ,p.preanestesia,p.rayos,p.upc,p.sangre,p.insumos_especifico,p.obsinstrumental,
 	p.obsinsumos
	from parte_quirurgico p
	where p.num_parte = $parte
	";
	$personal = $db->Execute($sql);
	
		$permisos = Array();
		$sql2 ="select id_cargo from cargo_usuario where usuario = '$usuario'";
		$rs2 = $db->Execute($sql2);
	//	print($sql2);
		$i=0;
		
				while (!$rs2->EOF) {
					$permisos[$i]=$rs2->fields[0];
					$i++;
					$rs2->movenext();
				//	print('hola');
					
			}
			
			
		$chequeos = Array();
		$sql3 ="select num_req from requerimientos where num_parte = $parte ";
		$rs3 = $db->Execute($sql3);
	//	print($sql2);
		$a=0;
		
				while (!$rs3->EOF) {
					$chequeos[$a]=$rs3->fields[0];
					$a++;
					$rs3->movenext();
				//	print('hola');
					
			}
			
	//	 $permisos;
	//	print($permisos);
	



$html ="<table  class='theader' width='98%' heigth='60%'  >
				<tr>
				<td style='text-align:center;width:'25%;'>
					<b>Requiere Aprobaci&oacute;n</b>
				</td>
				<td style='text-align:center;width:'25%;'>
					<b>Servicio que Aprueba</b>
				</td>
				<td style='text-align:center;width:'25%;'>
					<b>Usuario</b>
				</td>
				<td style='text-align:center;width:'25%;'>
					<b>Fecha</b>
				</td>
				</table>
				</tr>
				
				<tr>
				
				<table id='lin' class='theader' width='100%' heigth='90%'>
				";
$i=1;
$sum=0;
while (!$personal->EOF) {
	

		

		

if($personal->fields[0]==1){
	$sum++;
			if(in_array(1,$chequeos)){
				
			$ver = 'imagenes/bien.png';
		$class='mouse_over2';
		}else{
			$ver = 'imagenes/mal.png';
			$class='mouse_over2';
			$user = ".:";
			$fc 	= ".:";
	
			}
	
	
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =1 ";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
					$html.="<tr class='$class' ><td style='width:2%;text-align:center;'>
									<hr><img src=$ver></hr></td>
									<td style='width:25%;text-align:left;'><hr>Latex</hr></td>
									<td style='width:15%;text-align:left;'><hr>Centro Quirurgico</hr></td>
									<td style='width:25%;text-align:left;'><hr>Supervisor: $user</hr></td>
									<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
									</tr>";

	}
	
if($personal->fields[2]==1){
	$sum++;
		if(in_array(2,$chequeos)){
			
		$ver = 'imagenes/bien.png';
		$class='mouse_over2';
		}else{
			$ver = 'imagenes/mal.png';
			$class='mouse_over2';
			$user = ".:";
			$fc 	= ".:";
	
			}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =2 ";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
					$html.="<tr    class='$class' ><td style='width:2%;text-align:center;'>
								<hr><img src=$ver></hr></td>
								<td style='width:25%;text-align:left;'><hr>Rayos</hr></td>
								<td style='width:15%;text-align:left;'><hr>Centro Quirurgico</hr></td>
								<td style='width:25%;text-align:left;'><hr>Supervisor: $user</hr></td>
								<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
								</tr>";

	}		
if($personal->fields[6]!=null){
	$sum++;
	
	if(in_array(3,$chequeos)){
			
		$ver = 'imagenes/bien.png';
		$class='mouse_over2';
		}else{
			$ver = 'imagenes/mal.png';
			$class='mouse_over2';
			$user = ".:";
			$fc 	= ".:";
	
			}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =3";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
					
					$html.="<tr class='$class'><td style='width:2%;text-align:center;'>
					<hr><img src=$ver></hr></td>
					<td style='width:25%;text-align:left;'><hr>Instrumental:".htmlentities($personal->fields[6])."</hr></td>
					<td style='width:15%;text-align:left;'><hr>Centro Quirurgico</hr></td>
					<td style='width:25%;text-align:left;'><hr>Supervisor: $user</hr></td>
					<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
			
					</tr>";

		
}	

if($personal->fields[1]==1){
$sum++;				
					if(in_array(4,$chequeos)){
						
					$ver = 'imagenes/bien.png';
					$class='mouse_over2';
					}else{
						$ver = 'imagenes/mal.png';
						$class='mouse_over2';
						$user = ".:";
						$fc 	= ".:";
				
						}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =4";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
					
					
						$html.="<tr class='$class'><td style='width:2%;text-align:center;'>
									<hr><img src=$ver></hr></td>
								<td style='width:25%;text-align:left;'><hr>Preanestesia</hr></td>
								<td style='width:15%;text-align:left;'><hr>Poli Anestesia</hr></td>
								<td style='width:25%;text-align:left;'><hr>M&eacute;dico Anestesista: $user</hr></td>
								<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
			
								</tr>";
	}
						

if($personal->fields[3]==1){		
$sum++;	
					if(in_array(5,$chequeos)){
						
						$ver = 'imagenes/bien.png';
					$class='mouse_over2';
					}else{
						$ver = 'imagenes/mal.png';
						$class='mouse_over2';
						$user = ".:";
						$fc 	= ".:";
				
						}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =5";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
					
				$html.="<tr class='$class'><td style='width:2%;text-align:center;'>
								<hr><img src=$ver></hr></td>
							<td style='width:25%;text-align:left;'><hr>CAMA UPC</hr></td>
							<td style='width:15%;text-align:left;'><hr>UPC</hr></td>
							<td style='width:25%;text-align:left;'><hr>M&eacute;dico Jefe UPC: $user</hr></td>
							<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
			
							</tr>";
	
			
}


if($personal->fields[4]==1){
$sum++;	
			if(in_array(6,$chequeos)){
			
			$ver = 'imagenes/bien.png';
					$class='mouse_over2';
					}else{
						$ver = 'imagenes/mal.png';
						$class='mouse_over2';
						$user = ".:";
						$fc 	= ".:";
				
						}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =6";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
				
			$html.="<tr class='$class'><td style='width:2%;text-align:center;'>
									<hr><img src=$ver></hr></td>
							<td style='width:25%;text-align:left;'><hr>Donates Sangre</hr></td>
							<td style='width:15%;text-align:left;'><hr>Banco Sangre</hr></td>
							<td style='width:25%;text-align:left;'><hr>Tecn&oacute;logo Jefe: $user</hr></td>
							<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
			
							</tr>";
		
			
}	

if($personal->fields[5]==1){
$sum++;
			if(in_array(7,$chequeos)){
			
					$ver = 'imagenes/bien.png';
					$class='mouse_over2';
					}else{
						$ver = 'imagenes/mal.png';
						$class='mouse_over2';
						$user = ".:";
						$fc 	= ".:";
				
						}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =7";
					$rsa = $db->Execute($sql);
					if(!$rsa->EOF){
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					}
			$html.="<tr class='$class'><td style='width:2%;text-align:center;'>
								<hr><img src=$ver></hr></td>
							<td style='width:25%;text-align:left;'><hr>Insumos Especificos:".htmlentities($personal->fields[7])." </hr></td>
							<td style='width:15%;text-align:left;'><hr>Insumos Clinicos</hr></td>
							<td style='width:25%;text-align:left;'><hr><b>Enfermera Insumos: $user<b></hr></td>
							<td style='width:25%;text-align:left;'><hr>$fc</hr></td>
			
							</tr>";
		
}
		
		
		
		
		
		
	
//echo($sum);	
$personal->movenext();
$i++;
}
$html.="</tr></table>";
print($html);
}



?>