<?php
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
session_start();


if($_GET['tipo']=='personal_listado_paciente_le') {
	$busqueda = $_GET['buscar'];
	$where="";
	if ($busqueda!=""){
		if ($_GET['orden']=="rut"){
		$where = " where (".$_GET['orden'].") = '".($busqueda)."'";
			
		}
		else{	
		$where = " where upper(".$_GET['orden'].") like '%".strtoupper($busqueda)."%'";
		}
	}
	$orden = $_GET['orden'];
	$orderby = "ORDER BY ".$orden;
	$sql="SELECT rut, nombre||' '||appaterno,num_parte,glosa_especialidad,num_parte,TO_CHAR(fc_parte,'dd/mm/yy')
				,cie10.glosa_diag
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad 
			  inner join cie10 on parte_quirurgico.diagnostico=cie10.COD_DIAG
			  $where and activo=1  
			  and( latex = 1 or rayos = 1 or sangre = 1
        or preanestesia = 1 or upc = 1 or insumos_especifico = 1
        or obsinstrumental is not null)
			  $orderby ";
	$personal = $db->Execute($sql);
	//print($sql);
	print("<center>
		<table style='width:101%;' id='tabla_usuarios' name='tabla_usuarios'>
		<thead>
			<tr class='theader' onclick='unsel_tr(\"tabla_usuarios\",\"tfila1\",\"tfila2\");cancelar();'>
				<td style='text-align: center;'>
					<b>Rut</b>
				</td>
				<td style='text-align: center;'>
					<b>Nombre</b>
				</td>
				<td style='text-align: center;'>
					<b>Fecha Parte</b>
				</td>
			<td style='text-align: center;'>
					<b>Diagn&oacute;stico</b>
				</td>
			
			</tr>
			</thead>
    		<tr>
			 <tbody>
			
					<td colspan='13'>
						<div style='height:300px;overflow:auto;'>
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
			onClick='seleccionar_paciente(\"".$personal->fields[0]."\",\"".$personal->fields[4]."\");'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:15%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:30%;'>".$personal->fields[1]."</td>
		<td style='text-align: left;width:15%;'>".$personal->fields[5]."</td>
		<td style='text-align: left;width:30%;'>".htmlentities($personal->fields[6])."</td>
	
		</tr>
		";
		print($html);
		$personal->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
	
}


if($_GET['tipo']=='personal') {
	$busqueda = $_GET['buscar'];
	
	$sql="SELECT rut, nombre||' '||appaterno||' '||apmaterno as nombre,edad,fono
	FROM parte_quirurgico	WHERE rut=$busqueda";
	$personal = $db->Execute($sql);
	//print($personal);
	for($i=0;$i <= 3;$i++) {
		$datos[$i]=($personal->fields[$i]);
	}
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);	
}

if($_GET['tipo']=='deptos') {

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
	



$html ="<table class='theader' width='90%' heigth='70%'>
				<td style='text-align: center;'>
					<b>Requiere Aprobaci&oacute;n</b>
				</td>
				<td style='text-align: center;'>
					<b>Servicio que Aprueba</b>
				</td>
				<td style='text-align: center;'>
					<b>Usuario</b>
				</td>
				<td style='text-align: center'>
					<b>Fecha</b>
				</td>
				</table><tr>
				<table class='theader' width='100%' heigth='70%'>";
$i=1;
$sum=0;
while (!$personal->EOF) {
	

		

		

if($personal->fields[0]==1){
	$sum++;
			if(in_array(1,$chequeos)){
				
			$ver = 'checked';
			$out='disabled';	
			$class='mouse_over3';
		}else{
			$ver = '';
			$out='';	
			$class='mouse_over';
			}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =1 ";
					$rsa = $db->Execute($sql);
					$user = $rsa->fields[0];
					$fc 	= $rsa->fields[1];
					
	if(in_array(1,$permisos)){
					$html.="<tr    class='$class' ><td style='width:3%;text-align:left;'>";
					$html.="<input type='checkbox' id='lat' name='lat' value='' $ver $out >	</td>";
				}else{
					$class='mouse_over2';
					$html.="<tr    class='$class' ><td style='width:3%;text-align:left;'>";
					$html.="<input type='checkbox' id='lat' name='lat' value='' $ver disabled ></td>";
					
					}
					
			$html.="	
					<td style='width:15%;text-align:left;'>Latex</td>
					<td style='width:15%;text-align:left;'>Centro Quirurgico</td>
					<td style='width:15%;text-align:left;'>Supervisor: $user</td>
					<td style='width:15%;text-align:left;'>$fc</td>
				
					</tr>";

	}
	
if($personal->fields[2]==1){
	$sum++;
		if(in_array(2,$chequeos)){
			
		$ver = 'checked';
		$out='disabled';	
		$class='mouse_over3';
		}else{
			$ver = '';
			$out='';	
			$class='mouse_over';
			}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =2 ";
					$rsa = $db->Execute($sql);
					$user = $rsa->fields[0];
					$fc 	= $rsa->fields[1];
			
	if(in_array(1,$permisos)){
					$html.="<tr    class='$class' ><td style='width:3%;text-align:left;'>";
					$html.="<input type='checkbox' id='ray' name='ray' value='' $ver $out ></td>";
				}else{
					$class='mouse_over2';
					$html.="<tr    class='$class' ><td style='width:3%;text-align:left;'>";
					$html.="<input type='checkbox' id='ray' name='ray' value='' $ver disabled ></td>";
					
					}
				$html.="	<td style='width:15%;text-align:left;'>Rayos</td>
					<td style='width:15%;text-align:left;'>Centro Quirurgico</td>
					<td style='width:15%;text-align:left;'>Supervisor: $user</td>
					<td style='width:15%;text-align:left;'>$fc</td>
			
					</tr>";

	}		
if($personal->fields[6]!=null){
	$sum++;
	
	if(in_array(3,$chequeos)){
			
		$ver = 'checked';
		$out='disabled';	
		$class='mouse_over3';
		}else{
			$ver = '';
			$out='';	
			$class='mouse_over';
			
			}
			
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =3 ";
					$rsa = $db->Execute($sql);
					$user = $rsa->fields[0];
					$fc 	= $rsa->fields[1];
					
				if(in_array(1,$permisos)){
					
					$html.="<tr class='$class'><td style='width:10%;text-align:left;'>";
					$html.="<input type='checkbox'id='inst' name='inst' value='' $ver $out ></td>";
					}else{
						$class='mouse_over2';
						$html.="<tr class='$class'><td style='width:10%;text-align:left;'>";
						$html.="<input type='checkbox'id='inst' name='inst' value='' $ver disabled ></td>";
					}
	
	$html.="<td style='width:15%;text-align:left;'>Instrumental:".htmlentities($personal->fields[6])."</td>
					<td style='width:15%;text-align:left;'>Centro Quirurgico</td>
					<td style='width:15%;text-align:left;'>Supervisor: $user</td>
					<td style='width:15%;text-align:left;'>$fc</td>
			
					</tr>";

		
}	

if($personal->fields[1]==1){
$sum++;				
					if(in_array(4,$chequeos)){
						
					$ver = 'checked';
					$out='disabled';	
					$class='mouse_over3';
					}else{
						$ver = '';
						$out='';	
						$class='mouse_over';
						}
						$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =4 ";
						$rsa = $db->Execute($sql);
						$user = $rsa->fields[0];
						$fc 	= $rsa->fields[1];
					
				if(in_array(2,$permisos)){
					$html.="<tr class='$class'><td style='width:3%;text-align:left;'>";
					$html.="	<input type='checkbox' id='pre' name='pre' value='' $ver $out  ></td>";
				}else{
						$class='mouse_over2';
						$html.="<tr class='$class'><td style='width:3%;text-align:left;'>";
						$html.="<input type='checkbox' id='pre' name='pre' value='' $ver disabled  ></td>";
					
					}
					$html.="<td style='width:15%;text-align:left;'>Preanestesia</td>
								<td style='width:15%;text-align:left;'>Poli Anestesia</td>
								<td style='width:15%;text-align:left;'>M&eacute;dico Anestesista: $user</td>
								<td style='width:15%;text-align:left;'>$fc</td>
								</tr>";
	}
						
//				}	
//}


if($personal->fields[3]==1){		
$sum++;	
					if(in_array(5,$chequeos)){
						
					$ver = 'checked';
					$out='disabled';	
					$class='mouse_over3';
				
					}else{
						$ver = '';
						$out='';	
						$class='mouse_over';
						
						}
					$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =5 ";
					$rsa = $db->Execute($sql);
					$user = $rsa->fields[0];
					$fc 	= $rsa->fields[1];
				
		
		if(in_array(3,$permisos)){
			
				$html.="<tr class='$class'><td style='width:3%;text-align:left;'>";
				$html.="<input type='checkbox' id='upc' name='upc' value='' $ver $out ></td>";
			}else{
				$class='mouse_over2';
				$html.="<tr class='$class'><td style='width:3%;text-align:left;'>";
				$html.="<input type='checkbox' id='upc' name='upc' value='' $ver disabled ></td>";
			
			}	
			$html.="<td style='width:15%;text-align:left;'>CAMA UPC</td>
							<td style='width:15%;text-align:left;'>UPC</td>
							<td style='width:15%;text-align:left;'>M&eacute;dico Jefe UPC: $user</td>
							<td style='width:15%;text-align:left;'>$fc</td>
							</tr>";
	
			
}


if($personal->fields[4]==1){
$sum++;	
			if(in_array(6,$chequeos)){
			
		$ver = 'checked';
		$out='disabled';
		$class='mouse_over3';
					
		}else{
			$ver = '';
			$out='';	
			$class='mouse_over';
					
			}
			$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =6 ";
			$rsa = $db->Execute($sql);
			$user = $rsa->fields[0];
			$fc 	= $rsa->fields[1];
			
		if(in_array(4,$permisos)){		
			
			$html.="<tr class='$class'><td style='width:3%;text-align:left;'>
							<input type='checkbox' id='san' name='san' value='' $ver $out ></td>";
			}else{
			$class='mouse_over2';		
			$html.="<tr class='$class'><td style='width:3%;text-align:left;'>
							<input type='checkbox' id='san' name='san' value='' $ver disabled ></td>";
				}
			
			$html.=" <td style='width:15%;text-align:left;'>Donates Sangre</td>
							<td style='width:15%;text-align:left;'>Banco Sangre</td>
							<td style='width:15%;text-align:left;'>Tecn&oacute;logo Jefe: $user</td>
							<td style='width:15%;text-align:left;'>$fc</td>
							</tr>";
		
			
}	

if($personal->fields[5]==1){
$sum++;
			if(in_array(7,$chequeos)){
			
				$ver = 'checked';
				$out='disabled';	
				$class='mouse_over3';
	
				}else{
					$ver = '';
					$out='';	
					$class='mouse_over';
		
					}
				$sql ="select usuario,TO_CHAR(fecha,'dd-mm-yy HH:MM AM')as fecha from requerimientos where num_parte = $parte and num_req =7 ";
				$rsa = $db->Execute($sql);
				$user = $rsa->fields[0];
				$fc 	= $rsa->fields[1];
			
	if(in_array(5,$permisos)){
			$html.="<tr class='$class'><td style='width:3%;text-align:left;'>
							<input type='checkbox' id='ins' name='ins' value='' $ver $out ></td>";
			}else{
			$class='mouse_over2';
			$html.="<tr class='$class'><td style='width:3%;text-align:left;'>
							<input type='checkbox' id='ins' name='ins' value='' $ver disabled ></td>";
			
			}
			$html.="<td style='width:15%;text-align:left;'>Insumos Especificos:".htmlentities($personal->fields[7])." </td>
							<td style='width:15%;text-align:left;'>Insumos Clinicos</td>
							<td style='width:15%;text-align:left;'>Enfermera Insumos: $user</td>
							<td style='width:15%;text-align:left;'>$fc</td>
							</tr>";
		
		}
		
		
		
		
		
		
	$sql_sum="update ingreso set total_check = $sum where num_parte = $parte";	
	$rs= $db->Execute($sql_sum);
//echo($sum);	
$personal->movenext();
$i++;
}
$html.="</tr></table>";
print($html);
}



if($_GET['tipo']=='guardar_req'){
	$sum=0;
	$data = $_GET['resultado'];
 $parte = $_GET['part'];
	
	
	if($data==lat){
				$sql="update requerimiento set latex = 1
					where num_parte = $parte";
				$rs = $db->Execute($sql);
		$sum++;
		}
			if($data==ray){
		$sql="update requerimiento set rayos = 1
				where num_parte = $parte";
			$rs = $db->Execute($sql);
		$sum++;
			//	print('rayos');
			}
			if($data==inst){
			
			$sql="update requerimiento set instrumental = 1
				where num_parte = $parte";
			$rs = $db->Execute($sql);
		$sum++;
			//	print('rayos');
			}
	print($sum);
	/*
			if(in_array('pre',$id)){
				$pre=1;
				$sum++;
			}
				if(in_array('ins',$id)){
					$ins=1;
					$sum++;			
				}
	print($sum);
	
	/*
	$sum=0;
	$lat	='';
	$pre	='';
	$ins	='';
	$inst	='';
	$ray	='';
	$san	='';
	$upc	='';
	
	if($id =='lat'){
		$lat=1;
		$sum++;
	}
		if($id =='upc'){
			$upc=1;
			$sum++;
		}
			if($id =='pre'){
				$pre=1;
				$sum++;
			}
				if($id =='ins'){
					$ins=1;
					$sum++;			
				}
					if($id =='inst'){
						$inst=1;
						$sum++;
					}
						if($id =='ray'){
							$ray=1;
							$sum++;
						}
							if($id =='san'){
							$san=1;
							$sum++;
						}
//	print($sum);	
	$sql="select count(num_parte) from requerimiento where num_parte = $parte";
	$rs = $db->Execute($sql);
	$dato = $rs->fields[0];
	//print($dato);
	if($dato==0){
	
	$sql="insert into requerimiento (num_parte,latex,preanestesia,rayos,upc,sangre,insumos,instrumental)
				values($parte,$lat,$pre,$ray,$upc,$san,$ins,$inst)";
	$rs = $db->Execute($sql);
	print($sql);
	}
	if($dato==1){
	$ray;
	$lat;
			
	$sql="update requerimiento set latex = $lat,preanestesia = $pre, rayos=$ray , 
				sangre=$san,upc=$upc,instrumental = $inst , insumos=$ins
				where num_parte = $parte";
	$rs = $db->Execute($sql);
	print($sql);
//	}
	*/
}





if($_GET['tipo']=='carga_perfil_boton') {
	$busca=$_GET['busca'];
	$datos=array();
	$sql="select latex from requerimientos where num_parte=$busca";
	$rs = $db->Execute($sql);
	$i=0;
		while (!$rs->EOF) {
					$datos[$i]=$rs->fields[0];
					$i++;
					$rs->movenext();
					
			}
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);
	
}



if($_GET['tipo']=='guardar_req2'){
	$sum=0;
	$data 		= $_GET['resultado'];
 	$parte 		= $_GET['part'];
	$usuario 	= $_SESSION ['rut'];
	//print($data);	
	
	if($data==lat){
			$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =1";
			$rs1 = $db->Execute($sql_1);
			if($rs1->EOF){
			
					$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
					values ( 'latex', 1,$parte,current_timestamp,'$usuario')";		
					$rs = $db->Execute($sql);
					$sum++;
				}
			}
			
			if($data==ray){
		
			$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =2";
			$rs1 = $db->Execute($sql_1);
			
			if($rs1->EOF){
			
					$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
					values ( 'Rayos', 2,$parte,current_timestamp,'$usuario')";		
					$rs = $db->Execute($sql);
					$sum++;
				}
			}
			
			if($data==inst){
		
						$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =3";
						$rs1 = $db->Execute($sql_1);
		
							if($rs1->EOF){
		
							$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
							values ( 'Instrumental', 3,$parte,current_timestamp,'$usuario')";		
							$rs = $db->Execute($sql);
					//		print($sql);
							$sum++;
							}
			}
			
				if($data==pre){
		
						$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =4 ";
						$rs1 = $db->Execute($sql_1);
							
							if($rs1->EOF){
							$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
							values ( 'Preanestesia', 4,$parte,current_timestamp,'$usuario')";		
							$rs = $db->Execute($sql);
							$sum++;
							}
			}
			
				if($data==upc){
		
						$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =5 ";
						$rs1 = $db->Execute($sql_1);
							
							if($rs1->EOF){
							$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
							values ( 'UPC', 5,$parte,current_timestamp,'$usuario')";		
							$rs = $db->Execute($sql);
							$sum++;
							}
			}
						if($data==san){
		
						$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =6";
						$rs1 = $db->Execute($sql_1);
							
							if($rs1->EOF){
							$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
							values ( 'Sangre', 6,$parte,current_timestamp,'$usuario')";		
							$rs = $db->Execute($sql);
							$sum++;
							}
			}
			
					
			
					if($data==ins){
		
						$sql_1="select glosa_req from requerimientos where num_parte = $parte and num_req =7";
						$rs1 = $db->Execute($sql_1);
							
							if($rs1->EOF){
							$sql="insert into requerimientos (glosa_req,num_req,num_parte,fecha,usuario)
							values ( 'Insumos', 7,$parte,current_timestamp,'$usuario')";		
							$rs = $db->Execute($sql);
							$sum++;
							}
			}
			
}


















?>