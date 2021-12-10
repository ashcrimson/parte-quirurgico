<?php
session_start();
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
include('../funciones.bus.php');
ini_set('display_errors','1');
 

if($_REQUEST['tipo']=='personal_listado') {
	
	$busqueda 			 = $_REQUEST['buscar'];
	//$medico_tratante = $_SESSION['centro']['usuario'];
	$registro 	=  $_SESSION ['centro']['usuario'];
	$usu  	 	= split("@sanidadnaval",$registro);
	$medico_tratante	= $usu[0];
				
	//echo($medico_tratante);
	//ECHO($_REQUEST['buscar']); 
$valores1 = array();
	$sql="SELECT especialidad
				FROM parte_quirurgico
				where  medico_tratante= ? group by especialidad ";
	$valores1[] = $medico_tratante;
	$rs = $db->Execute($sql, $valores1);
	$espe = $rs->fields[0];
	if($espe == 1){

	$sql="SELECT rut, nombre||' '||appaterno,num_parte,glosa_especialidad,fono,fono2,
	to_char(fc_parte,'dd/mm/yyyy HH24:MI '),contactado,num_parte,activo
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad 
			  where  especialidad = 1 $orderby ";
	$activo=$_REQUEST['activo'];
		
		}else{
	
	$sql="SELECT rut, nombre||' '||appaterno,num_parte,glosa_especialidad,fono,fono2,
	to_char(fc_parte,'dd/mm/yyyy HH24:MI '),contactado,num_parte,activo
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad = especialidad.id_especialidad 
			  where  lower(medico_tratante)='$medico_tratante'  $orderby ";
	$activo=$_REQUEST['activo'];
}
	//echo($activo);
	if($activo !=1){
	
	if ($busqueda!=""){
		if ($_REQUEST['orden']=="rut"){
		$vwhere[]= " (".$_REQUEST['orden'].") =? ";
		$valores[]=$_REQUEST["buscar"];
    	
		   }
		else{	
		$vwhere[] = "  upper(".$_REQUEST['orden'].") like '%".strtoupper($busqueda)."%'";
		
  
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
		$orderby = "ORDER BY 2 desc";
	
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
					<b>Paciente</b>
				</td>
				<td style='text-align: center;center;width:25%;'>
					<b>Especialidad</b>
				</td>
				<td style='text-align: center;center;width:5%;'>
					<b>Cerrado</b>
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
		if(($personal->fields[9])== 0){
			$ubicado = "<img src='imagenes/mal.png' border='0px'>";
		}else{
			$ubicado = "<img src='imagenes/bien.png' border='0px'>";
			}
		
			$nota = "<img src='imagenes/reclamo.png' border='0px'>";
			
			
		$html="
			<tr id='tabla_usuarios_".$i."' class='$clase'
			onClick='mostrar(\"".$personal->fields[2]."\");'
			onMouseOver='h_i(this);mouseintr(\"tabla_usuarios\",".$i.",\"tmover\",\"tselect\")' 
			onMouseOut='mouseouttr(\"tabla_usuarios\",".$i.",\"".$clase."\",\"tselect\")'>
		<td style='text-align: center;width:15%;'>".$personal->fields[6]."</td>
		<td style='text-align: center;width:10%;'>".$personal->fields[0]."</td>
		<td style='text-align: left;width:25%;'>".utf8_encode($personal->fields[1])."</td>
		<td style='text-align: left;width:25%;'>".utf8_encode($personal->fields[3])."</td>
		<td style='text-align: left;width:3%;' title='Parte Cerrado' >".$ubicado."</td>
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
	$registro 	=  $_SESSION ['centro']['usuario'];
	$usu  	 	= split("@sanidadnaval",$registro);
	$medico_tratante	= $usu[0];

	
	$valores = array();
		$sql="SELECT parte_quirurgico.especialidad,especialidad.glosa_especialidad,
		count(parte_quirurgico.especialidad)  
				FROM parte_quirurgico
				inner join especialidad on parte_quirurgico.especialidad=especialidad.id_especialidad
				where medico_tratante = ? 
				GROUP BY parte_quirurgico.especialidad,especialidad.glosa_especialidad
				ORDER BY parte_quirurgico.especialidad DESC";
	$valores[] = $medico_tratante;			
	$rs = $db->Execute($sql,$valores);
	
		
	//print($sql);
	
	echo("<select  name='filtro_esp' id='filtro_esp' style='width:140px;' onchange='cargar_listado2(this.value);' >");
	echo("<option value=100  >--Todos--</option>");
	
		while (!$rs->EOF) {
		
		echo "<option value='".$rs->fields[0]."'  >".htmlentities($rs->fields[1])."(".($rs->fields[2]).")</option>";
		$rs->movenext();
		}
	
	echo("</select>");
	
}



if($_GET['tipo']=='cargar_diagnosticos') {
	$buscar=$_GET['buscar'];
	$cod=$_GET['buscar'];
	
		$buscar = str_replace(" ","%",$buscar);
//		print($buscar);

	echo "<select size='5'  style='width:80%;' name='diagnosa1' id='diagnosa1' ondblclick='valor_diag();' onkeypress='valor_diag();' >";
	
	$sql="SELECT cod_diag,glosa_diag  FROM cie10 
				where cod_diag like '%".strtoupper($cod)."%' or glosa_diag like '%".strtoupper($buscar)."%'
				ORDER BY cod_diag desc ";
	$rs = $db->Execute($sql);
	//print($sql);}
	
	
												while (!$rs->EOF) {
													echo "<option  value='".$rs->fields[0]."-".$rs->fields[1]."' selected>".$rs->fields[0]." - ".($rs->fields[1])."</option>";
													$rs->movenext();
												}
	echo "</select>";
}


if($_GET['tipo']=='cargar_intervenciones') {
	$buscar=$_GET['buscar'];
	$cod=$_GET['buscar'];
	
		$buscar = str_replace(" ","%",$buscar);
//		print($buscar);

	echo "<select size='5' style='width:80%;' name='int' id='int' ondblclick='valor_inter();' onkeypress='valor_inter();' >";
	
	$sql="SELECT codprest,corroper,glosa_intervencion  FROM intervencion  
				where codprest like '%".strtoupper($cod)."%'or glosa_intervencion like '%".strtoupper($buscar)."%'
				ORDER BY codprest desc";
	$rs = $db->Execute($sql);
	//print($sql);}
	
	
												while (!$rs->EOF) {
													echo "<option  value='".$rs->fields[0]."-".$rs->fields[2]."-".$rs->fields[1]."' selected>".$rs->fields[0]." - ".htmlentities($rs->fields[2])."</option>";
													$rs->movenext();
												}
	echo "</select>";
}

if($_GET['tipo']=='cargar_cl_asa') {
	$buscar=$_GET['buscar'];

		$sql="SELECT num_asa,glosa_asa  FROM cl_asa  
					where num_asa = $buscar
					ORDER BY num_asa asc";
	$rs = $db->Execute($sql);
	echo("<select  name='clase' id='clase' style='width:80px;' >");
												while (!$rs->EOF) {
													echo "<option  value='".$rs->fields[0]."' >".$rs->fields[1]."</option>";
													$rs->movenext();
												}
	echo "</select>";
	
}

if($_REQUEST['tipo']=='cerrar_parte') {
	$valores = array();
	$sql="update parte_quirurgico set activo=5 where num_parte = ?";
	$valores[]=$_REQUEST['parte'];
	$rs = $db->Execute($sql,$valores);
	if(!$rs){
		$results = 0;
		//print($rs);
  //print_r($valores);
  //print($db->ErrorMsg());
		
	}else{
		
		$results = 1;
		}
		print($results);
}



if($_REQUEST['tipo']=='actualizar_parte') {
	
	$nro_parte = $_REQUEST['parte'];
//	print($nro_parte);
	$registro 	=  $_SESSION ['centro']['usuario'];
	$usu  	 	= split("@sanidadnaval",$registro);
	$medico_tratante	= $usu[0];


	$valores = array();
	$sql_1 = "update parte_quirurgico set fono = ? , obs= ? , aislamiento = ?,preanestesia = ?,upc = ?,latex = ?,rayos = ?,
	prioridad = ?,taco = ?, sangre = ?,fono2 = ?, lado = ?, anestesia = ?,biopsia = ?,obsinstrumental = ?,tpo_cirugia = ?,
	otrosd = ?, otrosi = ?, examen_pre = ?,diagnostico = ? , intervencion = ? , medico_tratante=?
	 where num_parte = $nro_parte ";
			
		$valores[0]		= $_REQUEST['fono'];
		$valores[1]   = $_REQUEST['obs'];
		$valores[2]   = $_REQUEST['aislaresp'];
		$valores[3] 	= $_REQUEST['prearesp'];
		$valores[4]	  = $_REQUEST['upcresp'];
		$valores[5] 	= $_REQUEST['latexresp'];
		$valores[6] 	= $_REQUEST['rayosresp'];
		$valores[7] 	= $_REQUEST['prioresp'];
		$valores[8] 	= $_REQUEST['tacoresp'];
		$valores[9] 	= $_REQUEST['sangresp'];	
		$valores[10]	 = $_REQUEST['fono2'];
		$valores[11]	 = $_REQUEST['lado'];
		$valores[12] 	 = $_REQUEST['anessuge'];	
		$valores[13]   = $_REQUEST['biop'];	
  	$valores[14]	 = $_REQUEST['obsinstru'];
		$valores[15]	 = $_REQUEST['tpo'];
		$valores[16]   = $_REQUEST['otrosd'];	
		$valores[17]	 = $_REQUEST['otrosi'];
		$valores[18]	 = $_REQUEST['exampreo'];
		$valores[19]	 = $_REQUEST['diag'];
   	$valores[20] 	 = $_REQUEST['inter'];
   	$valores[21] 	 = $medico_tratante;
	/*	
	 $valores[12] 	 = $_REQUEST['esperesp'];
		$valores[14]	 = $_REQUEST['obsinsu'];
		$valores[17]	 = $_REQUEST['clase'];	
		$valores[22]	 = $_REQUEST['dig_inter'];
		
		*/
		$recordset = $db->Execute($sql_1, $valores);
  if(!$recordset){
  $results= 0;
  
  print_r($valores);
  print($db->ErrorMsg());
	}else{
	
	$results=1;
	
	}	
	$db->disconnect();
	echo json_encode($results);
}




?>
