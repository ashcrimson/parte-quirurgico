<?php
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
session_start();
if($_GET['tipo']=='personal_listado') {
	$busqueda = $_GET['buscar'];
	$where="";
	if ($busqueda!=""){
		if ($_GET['orden']=="id_usuario"){
		$where = " where (".$_GET['orden'].") = '".($busqueda)."'";
			
		}
		else{	
		$where = " where upper(".$_GET['orden'].") like '%".strtoupper($busqueda)."%'";
		}
	}
	$orden = $_GET['orden'];
	$orderby = "ORDER BY ".$orden;
	$sql="SELECT id_usuario,nombre 
				FROM usuario
			  $where   $orderby ";
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
					<b>Usuario</b>
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
			onClick='seleccionar_usuario(\"".$personal->fields[0]."\");'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:40%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:60%;'>".$personal->fields[1]."</td>
		</tr>
		";
		print($html);
		$personal->movenext();
		$i++;
	}
	
	print("</table></div></td></tr></tbody></table>");
	
}

if($_GET['tipo']=='usuario') {
	$busqueda = ($_GET['buscar']*1);
	//print($busqueda);
	$sql="SELECT u.usuario,u.id_usuario,u.nombre,cargo_usuario.ID_CARGO 
				FROM usuario u
				left join cargo_usuario on u.nombre = cargo_usuario.USUARIO
				WHERE id_usuario=$busqueda";
	$personal = $db->Execute($sql);
	//print($personal);
	for($i=0;$i <= 3;$i++) {
		$datos[$i]=($personal->fields[$i]);
	}
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);	
}

	

if($_GET['tipo']=='programacion') {
	$idusuario = $_GET['idusuario'];
	
	$sql="select nombres||' '||appaterno||' ' ||apmaterno as nombre,rut||' ' ||dvrut as rut,
				diagnostico,medico,fono,inscripcion,intervencion
				from usuario 
				where rut = '9184655' or rut = '15097401' ";
	$personal = $db->Execute($sql);
	print("<center>
		<b>MIERCOLES 18 MARZO 2015</b>
		<table style='width:98%;' id='tabla_cargos' name='tabla_cargos'>
			<tr class='theader2' onclick='unsel_tr(\"tabla_usuarios\",\"tfila1\",\"tfila2\");cancelar();'>
			<td style='text-align:center;width:30%;'>
				</td>
				
			</tr>");
	$i=0;
	
		$a=1;
	while (!$personal->EOF) {
		if(($i%2)==0) {
				$clase='tfila11';
		} else {
				$clase='tfila22';
		}
		$html="<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						
						<td style='text-align: LEFT;'>
					<hr><b>PAC: ".$a."</b></hr>
				</td>
					<td style='text-align: center;'><hr>".htmlentities($personal->fields(0))."</hr></td>
					</tr>
					<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						<td style='text-align: LEFT;'>
					<b>RUT: </b>
				</td>
					<td style='text-align: center;WIDTH:20px;'>".htmlentities($personal->fields(1))."</td>
					</tr>
					<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						<td style='text-align: LEFT;'>
					<b>DIAG: </b>
				</td>
					<td style='text-align: center;'>".htmlentities($personal->fields(2))."</td>
					</tr>
					<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						<td style='text-align: LEFT;'>
					<b>OP: </b>
				</td>
					<td style='text-align: center;'>".htmlentities($personal->fields(6))."</td>
					</tr>
					<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						<td style='text-align: LEFT;'>
					<b>DR: </b>
				</td>
					<td style='text-align: center;'>".htmlentities($personal->fields(3))."</td>
					
					</tr>
					
					<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						<td style='text-align: LEFT;'>
					<b>FONO: </b>
				</td>
					<td style='text-align: center;'>".htmlentities($personal->fields(4))."</td>
					
					</tr>
					
					<tr id='tabla_cargos_".$i."' class='$clase' onClick='seleccionar_cargo(\"".$personal->fields(0)."\",$i);'
						onMouseOver='h_i(this);mouseintr(\"tabla_cargos\",".$i.",\"tmover2\",\"tselect\")' 
						onMouseOut='mouseouttr(\"tabla_cargos\",".$i.",\"".$clase."\",\"tselect2\")'>
						<td style='text-align: LEFT;'>
					<b>FC INSC: </b>
				</td>
					<td style='text-align: center;'>".htmlentities($personal->fields(5))."</td>
					
					</tr>
					
					
					
					";
		print($html);
		$personal->movenext();
		$i++;
		$a++;
	}
	
	print("</table></center>");
	
}

if($_GET['tipo']=='cargar_pato') {
	$buscar=$_GET['buscar'];
	
	$sql="select glosa_patologia,id_patologia from patologias where codigo_patologia=$buscar";
	$rs = $db->Execute($sql);
	//print($sql);
	echo("<select  name='patolo' id='patolo' style='width:100px;' class='combo' >");
	echo("<option value=-1>-------------</option>");
	while (!$rs->EOF) {
		echo "<option value='".$rs->fields[1]."'>".htmlentities($rs->fields[0])."</option>";
		$rs->movenext();
	}
	echo("</select>");
}




if($_GET['tipo']=='cargar_medi') {
	$buscar=$_GET['buscar'];
	$sql="select id_medicamento,glosa_medicamento from medicamentos where num_parte=$buscar";
	$rs = $db->Execute($sql);
	
	echo " <select id='referidos' name='referidos'  size='5' multiple style='width:299px;' >";
	while (!$rs->EOF) {
		echo "<option value=".$rs->fields[0]." onclick='rem_ref(".$rs->fields[0].");' >".$rs->fields[1]."</option>";
		$rs->movenext();
	}
	echo "</select>";
}


if($_GET['tipo']=='medicamento') {
	$medicamento=$_GET['buscar'];
	$rut=$_GET['nombre'];
	$sql="insert into medicamentos (num_parte,glosa_medicamento)values($rut,'$medicamento')";
	$rs = $db->Execute($sql);
	
	
}

if($_GET['tipo']=='borrar_medicamento') {
	$codigo=$_GET['buscar'];
	$sql="delete  from medicamentos where id_medicamento = $codigo";
	$rs = $db->Execute($sql);
	
	
}

if($_GET['tipo']=='guardar_perfiles') {
	
	$ie			 =$_GET['ie'];
	$le			 =$_GET['le'];
	$re			 =$_GET['re'];
	$pa			 =$_GET['pa'];
	$pu			 =$_GET['pu'];
	$ap			 =$_GET['ap'];
	$usuario =$_GET['nombre'];
	$cargo 	 =$_GET['cargo'];
	
	$menu_perfil		=$_GET['admusu'];
	$menu_admision	=$_GET['adm'];
	$menu_pabellon	=$_GET['admpab'];
	$menu_parte			=$_GET['admpart'];
	
	if($menu_admision!=0){
	$sql="insert into perfil_usuario (id_perfil,usuario)
			values($menu_admision,'$usuario')";
	$rs = $db->Execute($sql);
}else{
	$sql="delete from perfil_usuario where id_perfil = 1 and usuario ='$usuario'";
	$rs = $db->Execute($sql);
	
	$sql2="delete from perfil_boton where id_perfil = 1 and usuario_boton ='$usuario'";
	$rs2 = $db->Execute($sql2);
	
	}
		if($menu_perfil!=0){
			$sql="insert into perfil_usuario (id_perfil,usuario)
					values($menu_perfil,'$usuario')";
			$rs = $db->Execute($sql);
			}else{
						$sql="delete from perfil_usuario where id_perfil = 4 and usuario ='$usuario'";
						$rs = $db->Execute($sql);
						}
			if($menu_pabellon!=0){
				$sql="insert into perfil_usuario (id_perfil,usuario)
						values($menu_pabellon,'$usuario')";
				$rs = $db->Execute($sql);
				}

			if($menu_parte!=0){
				$sql="insert into perfil_usuario (id_perfil,usuario)
						values($menu_parte,'$usuario')";
				$rs = $db->Execute($sql);
				}



if($ie!=0){
	$sql="insert into perfil_boton (id_boton,id_perfil,usuario_boton)
			values($ie,1,'$usuario')";
	$rs = $db->Execute($sql);
	}
		if($re!=0){
			$sql="insert into perfil_boton (id_boton,id_perfil,usuario_boton)
					values($re,1,'$usuario')";
			$rs = $db->Execute($sql);
			}
			if($le!=0){
				$sql="insert into perfil_boton (id_boton,id_perfil,usuario_boton)
						values($le,1,'$usuario')";
				$rs = $db->Execute($sql);
				}

			if($pa!=0){
				$sql="insert into perfil_boton (id_boton,id_perfil,usuario_boton)
						values($pa,1,'$usuario')";
				$rs = $db->Execute($sql);
				}
				if($pu!=0){
					$sql="insert into perfil_boton (id_boton,id_perfil,usuario_boton)
							values($pu,4,'$usuario')";
					$rs = $db->Execute($sql);
					}
					if($ap!=0){
						$sql="insert into perfil_boton (id_boton,id_perfil,usuario_boton)
								values($ap,2,'$usuario')";
						$rs = $db->Execute($sql);
						}


	$sql_2="select  id_cargo from cargo_usuario where usuario = '$usuario'";
	$rs_2 = $db->Execute($sql_2);
	$dato = $rs_2->fields[0];
	//print($rs_2);
		if(($dato < 0)||($dato ==null) ){
					$sql_2="insert into cargo_usuario (id_cargo,usuario)values($cargo,'$usuario')";
					$rs_2 = $db->Execute($sql_2);
			//		print($sql_2);
	
		}else{
			$sql_2="update cargo_usuario set id_cargo = $cargo where usuario = '$usuario'";
			$rs_2 = $db->Execute($sql_2);
		//	print($sql_2);
		}
	
	
//	print($sql);
	
	
}

if($_GET['tipo']=='carga_perfil') {
	$busca=$_GET['busca'];
	$datos=array();
	$sql="select id_perfil from perfil_usuario where usuario='$busca'";
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

if($_GET['tipo']=='carga_perfil_boton') {
	$busca=$_GET['busca'];
	$datos=array();
	$sql="select id_boton from perfil_boton where usuario_boton='$busca'";
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



if($_GET['tipo']=='cargar_listado_contactos') {
	$busqueda = $_GET['buscar'];
	$sql="SELECT tp_contacto, contacto,id_contacto 
				FROM contacto_paciente
				where rut = $busqueda 
			  ";
	$personal = $db->Execute($sql);
	//print($sql);
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
		<td style='text-align: center;width:45%;'>
		".$personal->fields[0]."</td>
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

if($_GET['tipo']=='guardar_telefonos') {
	
	$tp_contacto	 =$_GET['tp_contacto'];
	$fono_contacto =$_GET['fono_contacto'];
	$rut					 =$_GET['rut'];
	
	
	$sql="select count(id_contacto) from contacto_paciente where rut=$rut and contacto =$fono_contacto";
	$rs = $db->Execute($sql);
	$dato = $rs->fields[0];
	
	
	if($dato==0){
			$sql="insert into contacto_paciente(rut,tp_contacto,contacto)
			values($rut,'$tp_contacto',$fono_contacto)";
			$rs = $db->Execute($sql);
	}if($dato==1){
		print(1);
		}
}

if($_GET['tipo']=='borrar_contacto') {
	
	$buscar	=$_GET['buscar'];
	
	$sql="delete from contacto_paciente where id_contacto = $buscar";
	$rs = $db->Execute($sql);
	
	
}

?>
