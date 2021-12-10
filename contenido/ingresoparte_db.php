<?php
session_start();
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');
include('../funciones.bus.php');
//ini_set('display_errors','0');



if($_REQUEST['tipo']=='guardar_parte') {
	
		$sql="select max(num_parte) from parte_quirurgico";
		$rs = $db->Execute($sql);
		$numero 	= $rs->fields[0];
		$num_max  = $numero + 1; 
		$fc = date("d-m-y H:i");
		

	$valores = array();
	$sql_1 = "INSERT INTO parte_quirurgico 
		VALUES
	(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,TO_TIMESTAMP(?, 'DD-MM-RRHH24:MI:SSXFF'),?,?,?,?,?,?,?,?,?,?,?,?,null,?)";
			
	 	$valores[1]	 	 = $_REQUEST['rut'];
		$valores[2]		 = $_REQUEST['nombre'];
		$valores[3]		 = $_REQUEST['appaterno'];
		$valores[4]		 = $_REQUEST['apmaterno'];
		$valores[0]    = $num_max;	
		$valores[26]	 = $_REQUEST['diag'];
   	$valores[27] 	 = $_REQUEST['inter'];
  
		$valores[5]		 = $_REQUEST['edad'];
		if($valores[5]==""){
			$valores[5]=0;
			}
		$valores[6]		 = $_REQUEST['fono'];
		if($valores[6]==""){
			$valores[6]=1;
			}
		$valores[7] 	 = $_REQUEST['conseinfo'];
   	$valores[8]		 = $_REQUEST['tp_ciru'];
		$valores[9]		 = $_REQUEST['especialidad'];
   	$valores[10]	 = $_REQUEST['tpo'];
   	$valores[11] 	 = $_REQUEST['cmaresp'];
		$valores[12]   = $_REQUEST['aislaresp'];
		$valores[13] 	 = $_REQUEST['prearesp'];
		$valores[14]	 = $_REQUEST['upcresp'];
		$valores[15] 	 = $_REQUEST['latexresp'];
		$valores[16] 	 = $_REQUEST['rayosresp'];
		$valores[17] 	 = $_REQUEST['prioresp'];
		$valores[18] 	 = $_REQUEST['tacoresp'];
		$valores[19] 	 = $_REQUEST['sangresp'];	
		$valores[20] 	 = $_REQUEST['esperesp'];
		$valores[21]   = $_REQUEST['obs'];
		if($valores[21]==""){
			$valores[21]=null;
			}
		$valores[22]	 = $_REQUEST['obsinsu'];
		if($valores[22]==""){
			$valores[22]=null;
			}
		$valores[23]	 = $_REQUEST['obsinstru'];
		if($valores[23]==""){
			$valores[23]=null;
			}
		$valores[24]	 = $_REQUEST['exampreo'];
		$valores[25]   = $fc;
		
		$valores[28]	 = $_REQUEST ['medico_asociado'];
		
	 	$valores[29]	 = $_REQUEST['clase'];	
		$valores[30]	 = 0;	
		$valores[31] 	 = $_REQUEST['anessuge'];	
		if($valores[31]==""){
			$valores[31]=null;
			}
		$valores[32]   = $_REQUEST['biop'];	
		$valores[33]	 = $_REQUEST['dv_rut'];
		if($valores[33]==""){
			$valores[33]=null;
			}
		$valores[34]   = $_REQUEST['otrosd'];	
		$valores[35]	 = $_REQUEST['otrosi'];
		$valores[36]	 = $_REQUEST['dig_inter'];
		$valores[37]	 = $_REQUEST['edad_m'];
		$valores[38]	 = $_REQUEST['edad_d'];
		$valores[39]	 = $_REQUEST['fono2'];
		if($valores[39]==""){
			$valores[39]=1;
			}
				$valores[40]	 = $_REQUEST['lado'];
	
		
		$recordset = $db->Execute($sql_1, $valores);
  if(!$recordset){
  $results= 0;
  
  print_r($valores);
  print($db->ErrorMsg());
	}else{
	
	$results=$num_max;
	
	}	
	//$json = new Services_JSON();
	//$myjson = $json->encode($results);
	//print($myjson);
	$db->disconnect();
	echo json_encode($results);
}



if($_GET['tipo']=='datos_paciente') {
	$busqueda = $_GET['buscar'];
        /*
	$sql="select NOMBRE ,APPATERNO,APMATERNO,EDAD,FONO
				from parte_quirurgico 
				where RUT = $busqueda ";
	$personal = $db->Execute($sql);
        */
        $datos=array();
        $busq=explode("-",$busqueda);
        $result=array();
        $result=retorna_datos_referencial($busq[0]);
        if(isset($result)){
        if($result["fecha_nac"] != ""){
	//  $dias = mktime(0,0,0,substr($result["fecha_nac"],5,2),substr($result["fecha_nac"],8,2),substr($result["fecha_nac"],0,4));
	//  $result["edad"] = (int)((time()-$dias)/31556926 );
	
	$fecha_de_nacimiento = substr($result["fecha_nac"],0,4)."-".substr($result["fecha_nac"],5,2)."-".substr($result["fecha_nac"],8,2);
	$fecha_actual = date ("Y-m-d"); 
  $array_nacimiento = explode ( "-",$fecha_de_nacimiento);
  $array_actual = explode ( "-", $fecha_actual );
  $anos =  $array_actual[0] - $array_nacimiento[0];
  $meses = $array_actual[1] - $array_nacimiento[1]; 
  $dias =  $array_actual[2] - $array_nacimiento[2]; 
  if ($dias < 0)
    { 
    
      --$meses;   
switch ($array_actual[1]) {
  case 1:     $dias_mes_anterior=31; break;
  case 2:     $dias_mes_anterior=31; break;
  case 3: 
    if (bisiesto($array_actual[0]))
      {
	$dias_mes_anterior=29; break;
      } else {
      $dias_mes_anterior=28; break;
    }
  case 4:     $dias_mes_anterior=31; break;
  case 5:     $dias_mes_anterior=30; break;
  case 6:     $dias_mes_anterior=31; break;
  case 7:     $dias_mes_anterior=30; break;
  case 8:     $dias_mes_anterior=31; break;
  case 9:     $dias_mes_anterior=31; break;
  case 10:     $dias_mes_anterior=30; break;
  case 11:     $dias_mes_anterior=31; break;
  case 12:     $dias_mes_anterior=30; break;
  }

  $dias=$dias + $dias_mes_anterior;
} 
   if ($meses < 0)
    {
     --$anos;
      $meses=$meses + 12;
   } 
   $edad=array();
   $edad["a"]=$anos;
   $edad["m"]=$meses;
   $edad["d"]=$dias;
	  
	  
	  
	  
        } 
	$datos[0]=trim(utf8_encode($result["primer_nombre"]). " " .utf8_encode($result["segundo_nombre"]));
	$datos[1]=utf8_encode($result["apellido_paterno"]);
	$datos[2]=utf8_encode($result["apellido_materno"]);
	$datos[3]=$edad["a"];
	$datos[4]="";
	$datos[5]=$result["dv_run"];
        }
   if($datos[5]==""){
   	
   	print("RUT INCORRECTO");
   	}     
  $datos[6]=$edad["m"];
	$datos[7]=$edad["d"];
	      
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);
}
  

if($_GET['tipo']=='cargar_datos_parte') {
	$busqueda = $_GET['buscar'];

	$sql="select NOMBRE ,APPATERNO,APMATERNO,EDAD,FONO,ESPECIALIDAD,TP_CIRUGIA,CMA,RUT,GLOSA_DIAG
				,GLOSA_INTERVENCION,CONSENTIMIENTO,AISLAMIENTO,PREANESTESIA,UPC,LATEX,RAYOS,PRIORIDAD,TACO,SANGRE
				,INSUMOS_ESPECIFICO,EXAMEN_PRE,TPO_CIRUGIA,CLASE,OBS,OBSINSTRUMENTAL,OBSINSUMOS,ANESTESIA,BIOPSIA,EDAD_M,
				EDAD_D,FONO2,ACTIVO,DV_RUT,EDAD_M,EDAD_D,DIAGNOSTICO,INTERVENCION,LADO
				from parte_quirurgico 
				inner join cie10 on parte_quirurgico.diagnostico=cie10.COD_DIAG
        inner join intervencion on parte_quirurgico.INTERVENCION = intervencion.CODPREST
				where num_parte = $busqueda ";
	$personal = $db->Execute($sql);
	//print($sql);
	$datos[0]=$personal->fields[0];
	$datos[1]=utf8_encode($personal->fields[1]);
	$datos[2]=utf8_encode($personal->fields[2]);
	$datos[3]=$personal->fields[3];
	$datos[4]=$personal->fields[4];
	$datos[5]=$personal->fields[5];
	$datos[6]=$personal->fields[6];
	$datos[7]=$personal->fields[7];
	$datos[8]=$personal->fields[8];
	$datos[9] =$personal->fields[9];
	$datos[10]=$personal->fields[10];
	$datos[11]=$personal->fields[11];
	$datos[12]=$personal->fields[12];
	$datos[13]=$personal->fields[13];
	$datos[14]=$personal->fields[14];
	$datos[15]=$personal->fields[15];
	$datos[16]=$personal->fields[16];
	$datos[17]=$personal->fields[17];
	$datos[18]=$personal->fields[18];
	$datos[19]=$personal->fields[19];
	$datos[20]=$personal->fields[20];
	$datos[21]=$personal->fields[21];
	$datos[22]=$personal->fields[22];
	$datos[23]=$personal->fields[23];
	$datos[24]=$personal->fields[24];
	$datos[25]=$personal->fields[25];
	$datos[26]=$personal->fields[26];
	$datos[27]=$personal->fields[27];
	$datos[28]=$personal->fields[28];
	$datos[29]=$personal->fields[29];
	$datos[30]=$personal->fields[30];
	$datos[31]=$personal->fields[31];
	$datos[32]=$personal->fields[32];
	$datos[33]=$personal->fields[33];
	$datos[34]=$personal->fields[34];
	$datos[35]=$personal->fields[35];
	$datos[36]=$personal->fields[36];
	$datos[37]=$personal->fields[37];
	$datos[38]=$personal->fields[38];
	$json = new Services_JSON();
	$myjson = $json->encode($datos);
	print($myjson);
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
if($_GET['tipo']=='cargar_asa') {
	$buscar=$_GET['buscar'];

	if($buscar==0 ||$buscar==2 ){
	$sql="SELECT num_asa,glosa_asa  FROM cl_asa  
				where num_asa between 1 and 5
				ORDER BY num_asa asc";
	}
		if($buscar==1){
		$sql="SELECT num_asa,glosa_asa  FROM cl_asa  
					where num_asa between 6 and 10
					ORDER BY num_asa asc";
		}			
	$rs = $db->Execute($sql);
	//print($sql);
	
	echo("<select  name='clase' id='clase' style='width:80px;'>");
	echo("<option value=-1  >-------</option>");

												while (!$rs->EOF) {
													echo "<option  value='".$rs->fields[0]."' >".$rs->fields[1]."</option>";
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
	//$valores = array();
	$valor = $_REQUEST['parte'];
	$sql="update parte_quirurgico set activo=5 where num_parte = $valor ";
	//$valores[1] = $_REQUEST['parte'];
	//$rs = $db->Execute($sql,$valores);
	$rs = $db->Execute($sql);
	if(!$rs){
		$results = 0;
	//print_r($valores);
  //print($db->ErrorMsg());
		
	}else{
		
		$results = 1;
		}
		print($results);
		
}

?>