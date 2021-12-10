<?php
session_start();
require_once('../conexion/conexion.php');
require_once('../scripts/class.ezpdf.php');
	$tipo= $_GET['tipo'];
//	echo($tipo);
/*	$driver='oci8';
	$server = '172.25.16.24:1521/lawen.hnv.sanidadnaval.cl';
	$user = 'parte';
	$password = 'parte';
	include('adodb/adodb.inc.php');
	$db = ADONewConnection($driver);
	$db->debug = FALSE;
	$db->PConnect($server, $user, $password);
	*/
//include('../conexion/conexion.php');
	include('../scripts/json.php');
	include('../scripts/funciones.php');
//	include ('../scripts/class.ezpdf.php');
//	require("../scripts/class.phpmailer.php");
$usuario = $_SESSION['rut'];
$horate = date('h:i:s A');
$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
   $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
       'Miercoles', 'Jueves', 'Viernes', 'Sabado');
     
    $fecha_actual = $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
//Datos de paciente

$num = $_GET['num'];
echo($num);
$db->Execute("set names utf8");
	
$sql="select NOMBRE ,APPATERNO,APMATERNO,EDAD,FONO,GLOSA_ESPECIALIDAD,TP_CIRUGIA,CMA,RUT,GLOSA_DIAG
				,GLOSA_INTERVENCION,CONSENTIMIENTO,AISLAMIENTO,PREANESTESIA,UPC,LATEX,RAYOS,PRIORIDAD,TACO,SANGRE
				,INSUMOS_ESPECIFICO,EXAMEN_PRE,TPO_CIRUGIA,CLASE,OBS,OBSINSTRUMENTAL,OBSINSUMOS,ANESTESIA,BIOPSIA,
				MEDICO_TRATANTE, TO_CHAR(FC_PARTE,'dd-mm-yyyy'),TO_CHAR(FC_PARTE,'HH:MM AM'),CONSENTIMIENTO,
				GLOSA_ASA,DV_RUT,OTROSD,OTROSI,LADO
				from parte_quirurgico 
				inner join especialidad on parte_quirurgico.especialidad=especialidad.id_especialidad
        inner join cie10 on parte_quirurgico.diagnostico=cie10.COD_DIAG
        inner join intervencion on parte_quirurgico.INTERVENCION||parte_quirurgico.DIG_INTERV = intervencion.CODPREST||intervencion.CORROPER
		    inner join cl_asa on parte_quirurgico.clase = cl_asa.num_asa
				where num_parte =$num";
																		

	//print($sql);
	
	$personal=$db->Execute($sql);
	
	$nombre							=utf8_decode($personal->fields[0]);
	$appaterno					=utf8_decode($personal->fields[1]);
	$apmaterno					=utf8_decode($personal->fields[2]);
	$edad								=$personal->fields[3];
	$fono								=$personal->fields[4];
	$especialidad				=$personal->fields[5];
	$tp_cirugia					=$personal->fields[6];
	$cma								=$personal->fields[7];
	$rut								=$personal->fields[8];
	$glosa_diag					=$personal->fields[9];
	$glosa_intervencion	=$personal->fields[10];
	$consentimiento			=$presonal->fields[11];
	$aislamiento				=$personal->fields[12];
	$preanestesia				=$personal->fields[13];
	$upc								=$personal->fields[14];
	$latex							=$personal->fields[15];
	$rayos							=$personal->fields[16];
	$prioridad					=$personal->fields[17];
	$taco								=$personal->fields[18];
	$sangre							=$personal->fields[19];
	$insumos_especifico	=$personal->fields[20];
	$examen_pre					=$personal->fields[21];
	$tpo								=$personal->fields[22];
	$clase							=$personal->fields[23];
	$obs								=utf8_encode($personal->fields[24]);
	$obs_instrumental		=utf8_decode($personal->fields[25]);
	$obs_insumos				=utf8_decode($personal->fields[26]);
	$anestesia					=utf8_decode($personal->fields[27]);
	$biopsia						=$personal->fields[28];
	$medico 						=$personal->fields[29];
	$fecha_parte 				=$personal->fields[30];
	$hora				 				=$personal->fields[31];
	$consentimiento			=$personal->fields[32];
	$asa								=$personal->fields[33];
	$dv_rut							=$personal->fields[34];
	$otrosd							=$personal->fields[35];
	$otrosi							=$personal->fields[36];
	$lado								=$personal->fields[37];
	
	
	if($edad==0){
		
		$edad='';
		}
	
	$valor = split("-",$fecha_parte);
$dia = $valor[0];
$mes = $valor[1];
$ano = $valor[2];
if($mes == 1){
	$nom_mes = 'Enero';
	}
	if($mes == 2){
	$nom_mes = 'Febrero';
	}if($mes == 3){
	$nom_mes = 'Marzo';
	}if($mes == 4){
	$nom_mes = 'Abril';
	}if($mes == 5){
	$nom_mes = 'Mayo';
	}if($mes == 6){
	$nom_mes = 'Junio';
	}if($mes == 7){
	$nom_mes = 'Julio';
	}if($mes == 8){
	$nom_mes = 'Agosto';
	}if($mes == 9){
	$nom_mes = 'Septiembre';
	}if($mes == 10){
	$nom_mes = 'Octubre';
	}if($mes == 11){
	$nom_mes = 'Noviembre';
	}if($mes == 12){
	$nom_mes = 'Diciembre';
	}
	
 	
if($consentimiento==1){
	
	$consentimiento = 'Sí';
}else{
	$consentimiento = 'No';
	
	}

if($aislamiento==1){
	
	$aislamiento = 'Sí';
}else{
	$aislamiento = 'No';
	
	}
if($preanestesia==1){
	
	$preanestesia = 'Sí';
}else{
	$preanestesia = 'No';
	
	}
if($upc==1){
	
	$upc = 'Sí';
}else{
	$upc = 'No';
	
	}
if($latex==1){
	
	$latex = 'Sí';
}else{
	$latex = 'No';
	
	}	
if($rayos==1){
	
	$rayos = 'Sí';
}else{
	$rayos = 'No';
	
	}
	if($prioridad==1){
	
	$prioridad = 'Sí';
}else{
	$prioridad = 'No';
	
	}
	if($taco==1){
	
	$taco = 'Sí';
}else{
	$taco = 'No';
	
	}

	if($sangre==1){
	
	$sangre = 'Sí';
}else{
	$sangre = 'No';
	
	}

if($cma==1){
	
	$cma = 'Sí';
}else if($cma==10){

$cma='No Aplica';
}else{
	
	$cma = 'No';
}

if($examen_pre==0){
	
	$examen_pre = 'Realizados';
}else{
	$examen_pre = 'Solicitados';
	
	}
		if($insumos_especifico==1){
	
	$insumos = 'Sí';
}else{
	$insumos = 'No';
	
	}
	
	
if($biopsia==0){
	$biopsia = 'Externa';
}
	if($biopsia==1){
		$biopsia = 'Rápida';
		}
		if($biopsia==2){	
			$biopsia = 'Diferida';
		}
		if($biopsia==3){	
			$biopsia = 'No Aplica';
		}
		if($biopsia==4){	
			$biopsia = 'Citometría de Flujo';
		}


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
			
		if($tp_cirugia==0){
			$tp_cirugia_nom='Electiva Mayor';
			}if($tp_cirugia == 1 ){
					$tp_cirugia_nom ='Urgencia';
					}if($tp_cirugia==2){
						$tp_cirugia_nom='Electiva Menor';
							}	

if(($lado == 1) || ($lado== null)){
	$nom_lado = 'No Aplica';
	}
	if($lado == 2){
	$nom_lado = 'Izquierda';
	}if($lado == 3){
	$nom_lado = 'Derecha';
	}if($lado == 4){
	$nom_lado = 'Bilateral';
	}


if($fono==1){
	
		$sql="select min(orden) from contacto_paciente where rut = $rut ";
		$rs2 = $db->Execute($sql);
		$resultado = $rs2->fields[0];
		
		if($resultado!=null){
		$sql="select contacto from contacto_paciente where rut = $rut and orden = $resultado ";
		$rs = $db->Execute($sql);
		$fononuevo = $rs->fields[0];
	
		}
		
		
	$fono = $fononuevo;
	}

	
//Creo PDF

$pdf =& new Cezpdf('LETTER');
$pdf->selectFont('../scripts/fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1,1,2,1.5);
$pdf->addText(puntos_cm(17),puntos_cm(26),12,"PARTE Nro.");

$pdf->addText(puntos_cm(17),puntos_cm(24.5),10,"$num");
$pdf->line(puntos_cm(1.9),puntos_cm(27.5),puntos_cm(20),puntos_cm(27.5));
$pdf->addJpegFromFile('../imagenes/escudo.jpg',puntos_cm(3),puntos_cm(24.2));
$pdf->line(puntos_cm(16),puntos_cm(25),puntos_cm(20),puntos_cm(25));
$pdf->addText(puntos_cm(8.8),puntos_cm(26),12,"PARTE QUIRÚRGICO");
$pdf->line(puntos_cm(1.9),puntos_cm(24),puntos_cm(20),puntos_cm(24));
$pdf->line(puntos_cm(1.9),puntos_cm(24),puntos_cm(1.9),puntos_cm(27.5));
$pdf->line(puntos_cm(20),puntos_cm(24),puntos_cm(20),puntos_cm(27.5));

$pdf->line(puntos_cm(6.2),puntos_cm(24),puntos_cm(6.2),puntos_cm(27.5));
$pdf->line(puntos_cm(16),puntos_cm(24),puntos_cm(16),puntos_cm(27.5));
$pdf->ezText("");
$pdf->ezText("");

$pdf->line(puntos_cm(1.9),puntos_cm(23.2),puntos_cm(20),puntos_cm(23.2));

$pdf->addJpegFromFile('../imagenes/linea1.jpg',puntos_cm(1.9),puntos_cm(22.7));
$pdf->addText(puntos_cm(10),puntos_cm(22.8),10,"Datos Paciente");
$pdf->line(puntos_cm(1.9),puntos_cm(22.7),puntos_cm(20),puntos_cm(22.7));
$pdf->addText(puntos_cm(3),puntos_cm(22.3),10,"Nombre");
$pdf->addText(puntos_cm(5.7),puntos_cm(22.3),9,": $nombre $appaterno $apmaterno");
$pdf->addText(puntos_cm(13),puntos_cm(22.3),10,"Edad");
$pdf->addText(puntos_cm(15.2),puntos_cm(22.3),10,": $edad ");

$pdf->addText(puntos_cm(3),puntos_cm(21.8),10,"Rut");
$pdf->addText(puntos_cm(5.7),puntos_cm(21.8),10,": $rut-$dv_rut");
$pdf->addText(puntos_cm(13),puntos_cm(21.8),10,"Fono");
$pdf->addText(puntos_cm(15.2),puntos_cm(21.8),10,": $fono");

$pdf->addText(puntos_cm(3),puntos_cm(21.3),10,"Médico Tratante");
$pdf->addText(puntos_cm(5.7),puntos_cm(21.3),10,": $medico");
$pdf->addText(puntos_cm(3),puntos_cm(20.3),10,"Consentimiento");
$pdf->addText(puntos_cm(5.7),puntos_cm(20.3),10,": $consentimiento");

$pdf->addText(puntos_cm(3),puntos_cm(20.8),10,"Fecha Parte");
$pdf->addText(puntos_cm(5.7),puntos_cm(20.8),10,": $dia de $nom_mes de $ano");
$pdf->addText(puntos_cm(13),puntos_cm(21.3),10,"Especialidad");
$pdf->addText(puntos_cm(15.2),puntos_cm(21.3),10,": $especialidad");

$pdf->addText(puntos_cm(13),puntos_cm(20.8),10,"Hora Parte");
$pdf->addText(puntos_cm(15.2),puntos_cm(20.8),10,": $hora");

$pdf->line(puntos_cm(1.9),puntos_cm(20),puntos_cm(20),puntos_cm(20));
$pdf->line(puntos_cm(1.9),puntos_cm(20),puntos_cm(1.9),puntos_cm(23.2));
$pdf->line(puntos_cm(20),puntos_cm(20),puntos_cm(20),puntos_cm(23.2));

//$pdf->line(puntos_cm(1.9),puntos_cm(20.1),puntos_cm(20),puntos_cm(20.1));
$pdf->addText(puntos_cm(3),puntos_cm(19),10,"Tipo Cirugía");
$pdf->addText(puntos_cm(5.2),puntos_cm(19),9,": $tp_cirugia_nom / $asa");
$pdf->addText(puntos_cm(3),puntos_cm(18.5),10,"Tiempo");
$pdf->addText(puntos_cm(5.2),puntos_cm(18.5),9,": $tiempo");



$pdf->addText(puntos_cm(3),puntos_cm(18),10,"Diagnóstico");
$pdf->addText(puntos_cm(5.2),puntos_cm(18),8,": $glosa_diag");
$pdf->addText(puntos_cm(3),puntos_cm(17.5),10,"Otros Diag.");
if ($otrosd!=""){
	$pdf->addText(puntos_cm(5.2),puntos_cm(17.5),9,": $otrosd");

}else{
	$pdf->addText(puntos_cm(5.2),puntos_cm(17.5),9,": No Descrito.:");
	
	}

//$pdf->ezSetY(puntos_cm(19.5));
//$pdf->ezText($glosa_diag,9);
$pdf->addText(puntos_cm(3),puntos_cm(17),10,"Intervención");
$pdf->addText(puntos_cm(5.2),puntos_cm(17),8,": $glosa_intervencion");
	$pdf->addText(puntos_cm(3),puntos_cm(16.6),10,'Otras Interv.');

if ($otrosi!=""){
	$pdf->addText(puntos_cm(5.2),puntos_cm(16.6),9,": $otrosi");
}else{
	$pdf->addText(puntos_cm(5.2),puntos_cm(16.6),9,": No Descrita.:");
	
	}
	
	
	$pdf->addText(puntos_cm(13),puntos_cm(19),10,'Anestesia');
$pdf->addText(puntos_cm(13),puntos_cm(18.5),10,"Sector Interv.");
$pdf->addText(puntos_cm(15.2),puntos_cm(18.5),9,": $nom_lado");



if ($anestesia!=""){
	$pdf->addText(puntos_cm(15.2),puntos_cm(19),9,": $anestesia");
}else{
	$pdf->addText(puntos_cm(15.2),puntos_cm(19),9,": No Descrita.:");
	
	}

$pdf->line(puntos_cm(1.9),puntos_cm(19.5),puntos_cm(20),puntos_cm(19.5));

$pdf->addJpegFromFile('../imagenes/linea1.jpg',puntos_cm(1.9),puntos_cm(19.5));
$pdf->addText(puntos_cm(10),puntos_cm(19.6),10,"Procedimiento");


$pdf->line(puntos_cm(1.9),puntos_cm(16.5),puntos_cm(20),puntos_cm(16.5));

$pdf->addJpegFromFile('../imagenes/linea1.jpg',puntos_cm(1.9),puntos_cm(16));
$pdf->addText(puntos_cm(10),puntos_cm(16.2),10,"Requisitos");
$pdf->line(puntos_cm(1.9),puntos_cm(16),puntos_cm(20),puntos_cm(16));


$pdf->addText(puntos_cm(3),puntos_cm(15.5),10,"Aislamiento");
$pdf->addText(puntos_cm(7.3),puntos_cm(15.5),10,": $aislamiento");
$pdf->addText(puntos_cm(3),puntos_cm(15),10,"Alergia Latex");
$pdf->addText(puntos_cm(7.3),puntos_cm(15),10,": $latex");
$pdf->addText(puntos_cm(3),puntos_cm(14.5),10,"Usuario Taco");
$pdf->addText(puntos_cm(7.3),puntos_cm(14.5),10,": $taco");
$pdf->addText(puntos_cm(3),puntos_cm(14),10,"Equipo Rayos");
$pdf->addText(puntos_cm(7.3),puntos_cm(14),10,": $rayos");
$pdf->addText(puntos_cm(3),puntos_cm(13.5),10,"Evaluación Preanestesica");
$pdf->addText(puntos_cm(7.3),puntos_cm(13.5),10,": $preanestesia");
$pdf->addText(puntos_cm(3),puntos_cm(13),10,"Biopsia");
$pdf->addText(puntos_cm(7.3),puntos_cm(13),10,": $biopsia");


$pdf->addText(puntos_cm(13),puntos_cm(15.5),10,"Prioridad");
$pdf->addText(puntos_cm(17.7),puntos_cm(15.5),10,": $prioridad");
$pdf->addText(puntos_cm(13),puntos_cm(15),10,"Necesidad Cama UPC");
$pdf->addText(puntos_cm(17.7),puntos_cm(15),10,": $upc");
$pdf->addText(puntos_cm(13),puntos_cm(14.5),10,"Insumos Específicos");
$pdf->addText(puntos_cm(17.7),puntos_cm(14.5),10,": $insumos");
$pdf->addText(puntos_cm(13),puntos_cm(14),10,"Necesidad Donantes Sangre");
$pdf->addText(puntos_cm(17.7),puntos_cm(14),10,": $sangre");
$pdf->addText(puntos_cm(13),puntos_cm(13.5),10,"CMA");
$pdf->addText(puntos_cm(17.7),puntos_cm(13.5),10,": $cma");
$pdf->addText(puntos_cm(13),puntos_cm(13),10,"Examen Preoperatorio");
$pdf->addText(puntos_cm(17.7),puntos_cm(13),10,": $examen_pre");


$pdf->line(puntos_cm(1.9),puntos_cm(12.5),puntos_cm(20),puntos_cm(12.5));





/*
$pdf->line(puntos_cm(1.9),puntos_cm(14.1),puntos_cm(20),puntos_cm(14.1));
$pdf->addText(puntos_cm(10),puntos_cm(17.2),10,"xxx");
$pdf->line(puntos_cm(1.9),puntos_cm(13.6),puntos_cm(20),puntos_cm(13.6));
*/
//$pdf->addText(puntos_cm(5),puntos_cm(17.5),10,"$causas");

$pdf->ezSetY(puntos_cm(16.6));
//$pdf->ezText($obs_instrumental,9);
//$pdf->addText(puntos_cm(3),puntos_cm(14.5),10,"Acciones:");
//$pdf->addText(puntos_cm(5),puntos_cm(15.5),10,"$acciones");
$pdf->ezSetY(puntos_cm(14.5));
//$pdf->ezText($obs_instrumental,9);
//$pdf->line(puntos_cm(1.9),puntos_cm(11),puntos_cm(20),puntos_cm(11));
$pdf->line(puntos_cm(1.9),puntos_cm(12.5),puntos_cm(1.9),puntos_cm(20));
$pdf->line(puntos_cm(20),puntos_cm(12.5),puntos_cm(20),puntos_cm(20));
//$pdf->line(puntos_cm(1.9),puntos_cm(20),puntos_cm(1.9),puntos_cm(20.6));
//$pdf->line(puntos_cm(20),puntos_cm(20),puntos_cm(20),puntos_cm(20.6));

$pdf->line(puntos_cm(1.9),puntos_cm(12.5),puntos_cm(20),puntos_cm(12.5));
$pdf->addJpegFromFile('../imagenes/linea1.jpg',puntos_cm(1.9),puntos_cm(12));
$pdf->addText(puntos_cm(10),puntos_cm(12.1),10,"Instrumental");
$pdf->line(puntos_cm(1.9),puntos_cm(12),puntos_cm(20),puntos_cm(12));
//$pdf->addText(puntos_cm(3),puntos_cm(9.5),10,"Descripción.:");
$pdf->ezSetY(puntos_cm(11.8));
$pdf->ezText($obs_instrumental,9);
$pdf->line(puntos_cm(1.9),puntos_cm(10),puntos_cm(20),puntos_cm(10));
$pdf->line(puntos_cm(1.9),puntos_cm(10),puntos_cm(1.9),puntos_cm(12.5));
$pdf->line(puntos_cm(20),puntos_cm(10),puntos_cm(20),puntos_cm(12.5));

$pdf->line(puntos_cm(1.9),puntos_cm(10),puntos_cm(20),puntos_cm(10));

$pdf->addJpegFromFile('../imagenes/linea1.jpg',puntos_cm(1.9),puntos_cm(9.5));
$pdf->addText(puntos_cm(10),puntos_cm(9.6),10,"Insumos Específicos");
$pdf->line(puntos_cm(1.9),puntos_cm(9.5),puntos_cm(20),puntos_cm(9.5));
//$pdf->addText(puntos_cm(3),puntos_cm(9.5),10,"Descripción.:");
if($insumos_especifico==1){
$pdf->ezSetY(puntos_cm(9.5));
$pdf->ezText($obs_insumos,9);
}else{
$pdf->ezSetY(puntos_cm(9.5));
$pdf->ezText("No Descritos.:",9);
	
}
$pdf->line(puntos_cm(1.9),puntos_cm(8),puntos_cm(20),puntos_cm(8));
$pdf->line(puntos_cm(1.9),puntos_cm(8),puntos_cm(1.9),puntos_cm(10));
$pdf->line(puntos_cm(20),puntos_cm(8),puntos_cm(20),puntos_cm(10));


$pdf->line(puntos_cm(1.9),puntos_cm(8),puntos_cm(20),puntos_cm(8));
$pdf->addJpegFromFile('../imagenes/linea1.jpg',puntos_cm(1.9),puntos_cm(7.5));

$pdf->addText(puntos_cm(10),puntos_cm(7.6),10,"Observaciones");
$pdf->line(puntos_cm(1.9),puntos_cm(7.5),puntos_cm(20),puntos_cm(7.5));
//$pdf->addText(puntos_cm(3),puntos_cm(9.5),10,"Descripción.:");
if($obs!=null){
$pdf->ezSetY(puntos_cm(7.5));
$pdf->ezText($obs,9);
}else{
$pdf->ezSetY(puntos_cm(7.5));
$pdf->ezText("No Descritas.:",9);
}
$pdf->line(puntos_cm(1.9),puntos_cm(6),puntos_cm(20),puntos_cm(6));
$pdf->line(puntos_cm(1.9),puntos_cm(6),puntos_cm(1.9),puntos_cm(8));
$pdf->line(puntos_cm(20),puntos_cm(6),puntos_cm(20),puntos_cm(8));

$pdf->line(puntos_cm(10),puntos_cm(4.5),puntos_cm(20),puntos_cm(4.5));
$pdf->addText(puntos_cm(10),puntos_cm(4),10,"Usuario Solicitante:");
$pdf->addText(puntos_cm(13.2),puntos_cm(4),10,"$usuario");
$pdf->addText(puntos_cm(10),puntos_cm(3.5),10,"Fecha/Hora:");
$pdf->addText(puntos_cm(13.2),puntos_cm(3.5),10,"$fecha_actual /$horate ");
$pdf->line(puntos_cm(10),puntos_cm(3),puntos_cm(20),puntos_cm(3));


$pdf->ezSetY(puntos_cm(17));

$pdf->ezText("");
$pdf->ezText("");

$pdf->ezText("");

$pdf->ezText("");
/*
if ($cantidad_condiciones>0){
	$pdf->ezText("Condiciones:");

}*/
$pdf->ezText("");
$pdf->ezText("");
if ($tipo=="ver") {
	$pdf->ezStream();
} 




?>