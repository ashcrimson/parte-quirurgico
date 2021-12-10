 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
//ini_set('display_errors','1');
require_once('../conexion/conexion.php');

if($_GET['form']=='ingreso'){
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<script type="text/javascript" src="../scripts/tinymce/tinymce.min.js"></script>
	<link rel="stylesheet" href="../css/ingreso.css" type="text/css" />
	<link rel="stylesheet" href="../scripts/chosen/docsupport/style.css">
	<link rel="stylesheet" href="../scripts/chosen/docsupport/prism.css">
	<link rel="stylesheet" href="../scripts/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../css/calendar-blue.css" title="win2k-cold-1" />


<script type="text/javascript" src="../scripts/calendar.js"></script>
<script type="text/javascript" src="../scripts/calendar-es.js"></script>
<script type="text/javascript" src="../scripts/calendar-setup.js"></script>
<script type="text/javascript" src="../scripts/getElementsByAttribute.js"></script>
<script type="text/javascript" src="../scripts/prototype.js"></script>
<script type="text/javascript" src="../scripts/json.js"></script>
<script type="text/javascript" src="../scripts/menu.js"></script>
</head>

<script>
	var  idparte = '<?php echo($_GET["identificador"]);?>';
//$registro 	=  $_SESSION ['centro']['usuario'];
//	$usu  	 	= split("@sanidadnaval",$registro);
	var medico_tratante	= '<?php echo($_SESSION['centro']["usuario"]);?>';
 	var corte = medico_tratante.split('@sanidadnaval.cl');
	var usuario = corte[0];
//	alert(usuario);
	
	
	verifica_parte = function(idparte){
	if(idparte!=-1){
		
		//param = 'tipo=cargar_datos_parte&buscar='+idparte;
			//alert(param);
			var myAjax = new Ajax.Request(
				'ingresoparte_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=cargar_datos_parte&buscar='+idparte,
					onComplete: function(pedido_datos) {
    				//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
		
						$('nombre').value = datos[0];
						$('nombre').disabled=true;
						$('appaterno').value = datos[1];
						$('appaterno').disabled=true;
						$('apmaterno').value = datos[2];
						$('apmaterno').disabled=true;
						if(datos[3]==0){
							$('edad').value ="";
							$('edad').disabled=true;
						}else{
							$('edad').value = datos[3];
							$('edad').disabled=true;
						}
						$('fono').value = datos[4];
						$('fono').disabled=true;
						$('especialidad').value = datos[5];
   					$('especialidad').disabled=true;
						$('tp_ciru').value = datos[6];
   					$('tp_ciru').disabled=true;
						if(datos[7]==1){
   						$('cmasi').checked = true;
   					}else{
   							$('cmano').checked = true;
   						}
						$('rut').value = datos[8];
   					$('rut').disabled=true;	
						$('diagnosa').value = datos[9];
   					$('diagnosa').disabled = true;
						$('inter1').value = datos[10];
   					$('inter1').disabled = true;
						$('conseinfo').value = datos[11];
						$('conseinfo').disabled = true;	
   				
   					if(datos[12]==1){
   						$('aislasi').checked = true;
   					}else{
   							$('aislano').checked = true;
   					
   						}
   					if(datos[13]==1){
   						$('preasi').checked = true;
   					}else{
   							$('preano').checked = true;
   					
   						}if(datos[14]==1){
   						$('upcsi').checked = true;
   					}else{
   							$('upcno').checked = true;
   					
   						}if(datos[15]==1){
   						$('latexsi').checked = true;
   					}else{
   							$('latexno').checked = true;
   					
   						}if(datos[16]==1){
   						$('rayossi').checked = true;
   					}else{
   							$('rayosno').checked = true;
   					
   						}if(datos[17]==1){
   						$('priosi').checked = true;
   					}else{
   							$('priono').checked = true;
   					
   						}if(datos[18]==1){
   						$('tacosi').checked = true;
   					}else{
   							$('tacono').checked = true;
   					
   						}if(datos[19]==1){
   						$('sangsi').checked = true;
   					}else{
   							$('sangno').checked = true;
   					
   						}if(datos[20]==1){
   						$('espesi').checked = true;
   					}else{
   							$('espeno').checked = true;
   					
   						}
   						
   					$('exampreo').value=datos[21];
   					$('exampreo').disabled=true;	
   					$('tpo').value=datos[22];
   					$('tpo').disabled=true;	
   				
//						$('clase').value=datos[23];
//						$('clase').disabled=true;	
  						var v_asa = datos[23];
						//alert(v_asa);
						carga_cl_asa(v_asa);

   					$('obs').value=datos[24];	
   					$('obsinstru').value=datos[25];	
   					if(datos[20]==1){
   						$('obsinsu').value=datos[26];	
   						$('tablainsumos').style.display='block';
   					}
   					$('anessuge').value=datos[27];	
   					$('biop').value=datos[28];
   					$('biop').disabled=true;	
   					$('parte').value= idparte;
						
   				
   					$('bt_guardar').style.display='none';
            $('bt_cerrar').style.display='block';
   					$('bt_pdf').style.display='block';
			}
		}
	);
}	
}	
verifica_parte(idparte);		
	

	guardar_parte = function(){
		
		
	  var diag				 	 = document.getElementById('diag').value;
   	var inter 	 			 = document.getElementById('inter').value;
   	var dig_inter 	 	 = document.getElementById('dig_inter').value;
   	var conseinfo 		 = document.getElementById('conseinfo').value;
   	var tpo	  				 = document.getElementById('tpo').value;
   	var especialidad 	 = document.getElementById('especialidad').value;
   	var rut 				 	 = document.getElementById('rut').value;
		var nombre				 = document.getElementById('nombre').value;
		var appaterno			 = document.getElementById('appaterno').value;
		var apmaterno			 = document.getElementById('apmaterno').value;
		var edad					 = document.getElementById('edad').value;
		var edad_m				 = document.getElementById('edad_m').value;
		var edad_d				 = document.getElementById('edad_d').value;
		var fono					 = document.getElementById('fono').value;
		var fono2					 = document.getElementById('fono2').value;
		var exampreo			 = document.getElementById('exampreo').value;
		var biop				   = document.getElementById('biop').value;
		var obsinsu				 = document.getElementById('obsinsu').value;
		var obsinstru			 = document.getElementById('obsinstru').value;
		var obs					   = document.getElementById('obs').value;
		var tp_ciru 			 = document.getElementById('tp_ciru').value;
		var clase 			   = document.getElementById('clase').value;
		var anessuge 			 = document.getElementById('anessuge').value;
		var biop 				   = document.getElementById('biop').value;
		var dv_rut         = document.getElementById('dv_rut').value;
		var otrosd 			 	 = document.getElementById('otrosd').value;
		var otrosi 				  = document.getElementById('otrosi').value;
		var lado 				  = document.getElementById('lado').value;
		var medicos_asociados = document.getElementById('medicos_asociados').value;
		if(medicos_asociados==0){
			dr_aso = usuario;
			}
			else{
			dr_aso = medicos_asociados;	
			}
		/*	if(medicos_asociados==0){
				
				medicos_asociados = '<?php echo($_session['rut']) ?>';
							
				}
				
			alert(medicos_asociados);	
		*/
				

		var cmaresp   = '0';
		var aislaresp = '0';
		var prearesp  = '0';
		var upcresp   = '0';
		var latexresp = '0';
		var rayosresp = '0';
		var prioresp  = '0';
		var tacoresp  = '0';
		var esperesp  = '0';
		var sangresp  = '0';		
		
	//	alert(especialidad);
		
	
				    	
    	
    	
    	if(tp_ciru == -1){
				    	
				    	alert('Debe Indicar Tipo Cirug\u00eda');
				    	return;
				    	}
   
				
   	if(especialidad == -1){
    	
    	alert('Debe Indicar Especialidad');
    	return;
    	}
    	
  /* if (($('cmasi').checked==false)&&($('cmano').checked==false)){
						alert('Debe Indicar S\u00ed/No CMA prueba');
						return;
							
					}*/
					
			if(tp_ciru == 0){
				
				if (($('cmasi').checked==false)&&($('cmano').checked==false)){
						alert('Debe Indicar S\u00ed/No CMA prueba');
						return;
					}
						if ($('cmasi').checked==true){
							 cmaresp = '1';
						}
					}else{
						
								 cmaresp = '10';
						
						}
   
   
		    if(rut==""){
		    	
		    	alert('Debe Indicar Rut Paciente');
		     $('rut').focus();
		  
		    	return;
		    	}
				    if(nombre==""){
				    	
				    	alert('Debe Indicar Nombre Paciente');
				    	$('nombre').focus();
				    	return;
				    	} 
						    if(appaterno==""){
						    	
						    	alert('Debe Indicar Apellido Paterno Paciente');
						    	$('appaterno').focus();
						  
						    	return;
						    	}
								    if(apmaterno==""){
								    	
								    	alert('Debe Indicar Apellido Materno Paciente');
								    	$('apmaterno').focus();
								  
								    	return;
								    	}		
										   /* if(edad==""){
										    	
										    	alert('Debe Indicar Edad Paciente');
										    	$('edad').focus();
										  
										    	return;
										    	}*/
										    				
    	
										    	if(diag=="")
										    	{
										    		alert('Debe Seleccionar Diagn\u00f3stico');
										    		return;
										    		}
											    	if(inter=="")
											    	{
											    		alert('Debe Seleccionar Intervenci\u00f3n');
											    		return;
											    		}
   
													    if(conseinfo==0){
													    	$('foto_error').src="../imagenes/cancel2.png";
													    
													    	alert('Debe Entregar y Firmar el Consentimiento Informado');
													    	return;
													    	}
													    	 	if(clase==-1)
													    	{
													    		alert('Debe ingresar Clase ASA');
													    		return;
													    		}
															    	if(tpo==-1)
															    	{
															    		alert('Debe ingresar Tiempo Quir\u00fargico');
															    		return;
															    		}
    	
    	
    	if (($('aislasi').checked==false)&&($('aislano').checked==false)){
				alert('Debe Indicar Sí/No Aislamiento');
				return;
					
			}
				if ($('aislasi').checked==true){
					aislaresp = '1';
				}
					
    	
		    	if (($('preasi').checked==false)&&($('preano').checked==false)){
						alert('Debe Indicar S\u00ed/No Preanestesia');
						return;
							
					}
						if ($('preasi').checked==true){
							 prearesp = '1';
						}
							    
    	
				    	if (($('upcsi').checked==false)&&($('upcno').checked==false)){
								alert('Debe Indicar S\u00ed/No Cama UPC');
								return;
									
							}
								if ($('upcsi').checked==true){
									 upcresp = '1';
								}
									
						
									if (($('latexsi').checked==false)&&($('latexno').checked==false)){
										alert('Debe Indicar S\u00ed/No Alergia Latex');
										return;
											
									}
										if ($('latexsi').checked==true){
											 latexresp = '1';
										}
											
									
											if (($('rayossi').checked==false)&&($('rayosno').checked==false)){
												alert('Debe Indicar S\u00ed/No Equipo Rayos');
												return;
													
											}
												if ($('rayossi').checked==true){
													var rayosresp = '1';
												}
													
				
													if (($('priosi').checked==false)&&($('priono').checked==false)){
														alert('Debe Indicar S\u00ed/No Prioridad');
														return;
															
													}
														if ($('priosi').checked==true){
															 prioresp = '1';
														}
																	
													
															if (($('tacosi').checked==false)&&($('tacono').checked==false)){
																alert('Debe Indicar S\u00ed/No Usuario Taco');
																return;
																	
															}
																if ($('tacosi').checked==true){
																	 tacoresp = '1';
																}
																			
															
																	if (($('espesi').checked==false)&&($('espeno').checked==false)){
																		alert('Debe Indicar S\u00ed/No Insumos Espec\u00edficos');
																		return;
																			
																	}
																	if (($('espesi').checked==true)&&(obsinsu=='')){
																		alert('Debe Escribir en Campo de Texto Insumos Espec\u00edficos');
																		return;
																			
																	}
																		if (($('espesi').checked==true)&&(obsinsu!='')){
																			 esperesp = '1';
																		}
																					
																	
																			if (($('sangsi').checked==false)&&($('sangno').checked==false)){
																				alert('Debe Indicar S\u00ed/No Donantes Sangre');
																				return;
																					
																			}
																				if ($('sangsi').checked==true){
																					 sangresp = '1';
																				}
										
																			
					if(exampreo==-1)
			    	{
			    		alert('Debe ingresar Examen Preoperatorio');
			    		return;
			    	}
							
					    	
			param='&diag='+diag+'&inter='+inter+'&conseinfo='+conseinfo+'&tpo='+tpo+'&especialidad='+especialidad;
			param= param + '&rut='+rut+'&nombre='+nombre+'&appaterno='+appaterno+'&apmaterno='+apmaterno+'&edad='+edad;
			param= param + '&fono='+fono+'&exampreo='+exampreo+'&biop='+biop+'&obsinstru='+obsinstru+'&obs='+obs+'&obsinsu='+obsinsu+'&cmaresp='+cmaresp+'&tp_ciru='+tp_ciru;
			param= param + '&aislaresp='+aislaresp+'&prearesp='+prearesp+'&upcresp='+upcresp+'&latexresp='+latexresp;
			param= param + '&rayosresp='+rayosresp+'&prioresp='+prioresp+'&tacoresp='+tacoresp+'&esperesp='+esperesp;
			param= param + '&sangresp='+sangresp+'&clase='+clase+'&anessuge='+anessuge+'&biop='+biop+'&dv_rut='+dv_rut;
			param= param + '&otrosd='+otrosd+'&otrosi='+otrosi+'&dig_inter='+dig_inter+'&edad_m='+edad_m+'&edad_d='+edad_d;
			param= param + '&fono2='+fono2+'&medico_asociado='+dr_aso+'&lado='+lado;
			
			//alert(param);

			var myAjax = new  Ajax.Request(
				'ingresoparte_db.php', 
				{
					method: 'post', 
					parameters: 'tipo=guardar_parte&param='+param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
			//		alert(pedido_datos.responseText);
				//	 datos = JSON.parse(pedido_datos.responseText);
					 	   resp = (pedido_datos.responseText);
				
				if (resp==0){
 						
 						alert("Error.:");
						
 						}else{
							 
							 alert("Parte Ingresado Correctamente.: Recuerde apretar 'Enviar Parte a Admision' para cerrar el parte");


							$('parte').value=resp;
							var idpartes=resp;
							verifica_parte(idpartes);
						}
						
					} 
				}
				
		);
}

	cerrar = function(){
			window.close();
		

		
	}
	
	
cerrar_parte = function(){
		
		var  num = $('parte').value;
		//alert(parte);
			var myAjax = new  Ajax.Request(
				'ingresoparte_db.php', 
				{
					method: 'post', 
					parameters: 'tipo=cerrar_parte&parte='+num,
					evalScripts: true,
					onComplete: function(pedido_datos) {
				   resp = (pedido_datos.responseText);
				   //alert(pedido_datos.responseText);
						if (resp==0){
 						
 						alert("Error.:");
						
 						}else{
							alert("PARTE CERRADO CORRECTAMENTE.:");
							//volver();
							//cargar_listado();
							 $('bt_cerrar').style.display='none';
						}
						
						}
					}
				);	
		}		
	
	
cargar_paciente = function() {
			if($('rut').value=='')
			{
				limpiar();
				return;
				}
			param = 'tipo=datos_paciente&buscar='+$('rut').value;
		//	alert(param);
			var myAjax = new Ajax.Request(
				'ingresoparte_db.php', 
				{
					method: 'get', 
					parameters: param,
					onComplete: function(pedido_datos) {
    	//			alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
			//			$('func_usuario').value = datos[0];
			//			$('func_usuario').disabled=false;
						
						if(datos[0]!=null){
						$('nombre').value = datos[0];
						$('nombre').disabled=true;
						$('appaterno').value = datos[1];
						$('appaterno').disabled=true;
						if(datos[2]==""){
						$('apmaterno').disabled=false;
						}else{
						$('apmaterno').disabled=true;
						}
						$('apmaterno').value = datos[2];
						$('edad').value = datos[3];
						$('edad').disabled=true;
						$('edad_m').value = datos[6];
						$('edad_m').disabled=true;
						$('edad_d').value = datos[7];
						$('edad_d').disabled=true;
						
						$('fono').value = datos[4];
						$('fono').disabled=false;
						$('dv_rut').value = datos[5];
						$('dv_rut').disabled=false;
						$('rut').disabled=true;

				}if(datos[5]==null){
					
					alert("Rut es incorrecto, verifique y vuelva a buscar");
					limpiar();
					$('rut').focus();
					
					}
				
					
					/*else{
						alert('Paciente Nuevo. Por Favor, Ingrese Manualmente Todos sus Datos');
						limpiar();
						$('nombre').focus();
						$('nombre').disabled=false;
						$('appaterno').disabled=false;
						$('apmaterno').disabled=false;
						$('edad').disabled=false;
						$('fono').disabled=false;
						
						
						
						
						}*/
				
		//				alert($('nombre').value);
				}
			}
			);
		}

limpiar = function(){
	
	
$('nombre').value = "";
$('appaterno').value = "";
$('apmaterno').value = "";
$('edad').value = "";
$('fono').value = "";
$('dv_rut').value="";
$('rut').value="";
//$('cama').value = "";
	
	
	}
	
	cambiar_foto = function(){
		var ci = $('conseinfo').value;
		if(ci==0){
		$('foto_error').src="../imagenes/bien.png";
		}
	}
	
	
	activarcampo = function(){
		
		if ($('espesi').checked==true){
				$('tablainsumos').style.display='block';
			}
					if ($('espeno').checked==true){
							$('tablainsumos').style.display='none';
						}	
		
		
		}
	
	cambiarprioridad = function(){
		
		
		}
		
	cargar_diagnostico = function() {
					$('intervencion').style.display='none';
					$('diagnos').style.display='block';
		
	
				var resp = document.getElementById('diagnosa').value; 
			//	var xxx = document.getElementById('diagnosa1').value; 
				
				///alert(xxx);
				var myAjax = new Ajax.Updater(
					'diagnos', 
					'ingresoparte_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_diagnosticos&buscar='+resp,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						// alert("Parte Ingresado Correctamente.:");
						}
					}
				);
		}	
		
	valor_diag = function(){
		var diagnostico = $('diagnosa1').value;
		var cod_diag = diagnostico.split("-");
		codigo_diag = cod_diag[0];
		nombre_diag = cod_diag[1];
		$('diagnosa').value = nombre_diag;
		$('diag').value = codigo_diag;
		$('diagnosa1').style.display='none';
		//alert($('diagnosa').value);
		
		}	
	
	cargar_intervencion = function() {
	
					$('intervencion').style.display='block';
					$('diagnos').style.display='none';
		
				var resp = document.getElementById('inter1').value; 
			//	var xxx = document.getElementById('diagnosa1').value; 
				
				///alert(xxx);
				var myAjax = new Ajax.Updater(
					'intervencion', 
					'ingresoparte_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_intervenciones&buscar='+resp,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						// alert("Parte Ingresado Correctamente.:");
						}
					}
				);
		}		
	
	valor_inter = function(){
		var interv = $('int').value;
		var dato_int = interv.split("-");
		codigo_int = dato_int[0];
		nombre_int = dato_int[1];
		dig_int 	 = dato_int[2];
		
		$('inter1').value = nombre_int;
		$('inter').value = codigo_int;
		$('dig_inter').value = dig_int;
		
		$('int').style.display='none';
		//alert($('diagnosa').value);
		
		}		

cargar_clasificacion = function() {
	
				var tp_cirugia = document.getElementById('tp_ciru').value; 
				
				
				var myAjax = new Ajax.Updater(
					'cl_asa', 
					'ingresoparte_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_asa&buscar='+tp_cirugia,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						// alert("Parte Ingresado Correctamente.:");
						}
					}
				);
				if(tp_cirugia==0){
					
					$('tabla_cma').style.display="block";
					opciones_check(-1);
					
					}
				if(tp_cirugia==2){
					
					$('tabla_cma').style.display="none";
					opciones_check(1);
			
					}
					if(tp_cirugia==1){
					
					$('tabla_cma').style.display="none";
					opciones_check(-1);
			
					}
		}
		
		
	carga_cl_asa = function(valor_asa){
		
				var myAjax = new Ajax.Updater(
					'cl_asa', 
					'ingresoparte_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_cl_asa&buscar='+valor_asa,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						// alert("Parte Ingresado Correctamente.:");
						}
					}
				);
		
		}			
		
ver_pdf = function() {
		var  num = $('parte').value;
			ver_solicitud_win = window.open('../pdf/parte_pdf.php?tipo=ver&num='+num,'ver_solicitud','left=10,top=10,status=1');
			ver_solicitud_win.focus();
				window.close();

}		

  justNumbers = function(e)
		{
		 tecla = e.which || e.keyCode; 
   patron = /\d/; // Solo acepta números 
   te = String.fromCharCode(tecla); 
   return (patron.test(te) || tecla == 9 || tecla == 8);  
		}


opciones_check = function(xxx){
	
		if(xxx==1){
		$('aislano').checked=true;
		$('preano').checked=true;
		$('upcno').checked=true;
		$('latexno').checked=true;
		$('rayosno').checked=true;
		$('priono').checked=true;
		$('tacono').checked=true;
		$('espeno').checked=true;
		$('sangno').checked=true;
		$('tablainsumos').style.display='none';
		
		var aislaresp = '0';
		var prearesp  = '0';
		var upcresp   = '0';
		var latexresp = '0';
		var rayosresp = '0';
		var prioresp  = '0';
		var tacoresp  = '0';
		var esperesp  = '0';
		var sangresp  = '0';						
		}else{
			
				$('aislano').checked ="";
				$('preano').checked	 ="";
				$('upcno').checked	 ="";
				$('latexno').checked ="";
				$('rayosno').checked ="";
				$('priono').checked  ="";
				$('tacono').checked  ="";
				$('espeno').checked  ="";
				$('sangno').checked  ="";
				$('aislasi').checked ="";
				$('preasi').checked	 ="";
				$('upcsi').checked	 ="";
				$('latexsi').checked ="";
				$('rayossi').checked ="";
				$('priosi').checked  ="";
				$('tacosi').checked  ="";
				$('espesi').checked  ="";
				$('sangsi').checked  ="";
			
				$('tablainsumos').style.display='none';
			
			
			}
}

asociar_doc = function(){
	
	if($('especialidad').value==3){
		$('asocia').style.display='block';
		$('medicos_asociados').style.display='block';
	}else{
		$('asocia').style.display='none';
		$('medicos_asociados').style.display='none';
		
		}
}
	
</script>
<body onload='departamentos();'>
<div id='mensajex' class='fondo_envio2' style='text-align:center;'>
	<table>
				<b>Solicitud de Pabell&oacute;n</b>
				<input  type='hidden' id='parte' name='parte'>
			
	</table>
</div>	
	<div id='mensaje' class='fondo_envio' style='text-align:center;'>
	
<div id='memox'>
	<table style='width:97%;' border='0px' align='center'>
	<tr>
	
		<td>
			<b>Tipo Cirug&iacute;a</b>
		</td>
		<td>
						<select name="tp_ciru"  style="width:80%;" id="tp_ciru" onchange='cargar_clasificacion();' >
				      		<option value="-1">-------------</option>
									<option value="0" >Cirugia Mayor </option>
									<option value="2" >Cirugia Menor </option>
									<option value="1" >Urgencia</option>
					</select>		
		
		</td>
		<td>
			<b>Especialidad</b>
		</td>
		<td>
				<select name="especialidad"  style="width:150px" id="especialidad"  onclick="asociar_doc();" >
					<option value="-1">-----------------</option>
											<?php 
												$sql="SELECT id_especialidad,glosa_especialidad  FROM especialidad ORDER BY glosa_especialidad asc ";
												$rs = $db->Execute($sql);
												while (!$rs->EOF) {
													echo "<option value=".$rs->fields[0].">".htmlentities($rs->fields[1])."</option>";
													$rs->movenext();
												}											
											 ?>
					
					</select>		
	
		</td>
	
	<td id='tabla_cma' style='display:none;'>
			<b>CMA</b>
	
		<input type="radio" name="cmaresp" id="cmasi" value=1 >Si
		<input type="radio" name="cmaresp" id="cmano" value=0 >No
	</td>
		
	</tr>
	<tr>
	<td id='asocia' name='asocia' style='display:none;'>
			<b>M&eacute;dico asociado</b>
		</td>
		<td>
				<select name="medicos_asociados"  style="width:150px;display:none;" id="medicos_asociados"   >
					<option value="0">-----------------</option>
											<?php 
												$sql="SELECT id_medico,nom_medico  FROM medicos ORDER BY nom_medico asc ";
												$rs = $db->Execute($sql);
												while (!$rs->EOF) {
													echo "<option value=".$rs->fields[0].">".htmlentities($rs->fields[1])."</option>";
													$rs->movenext();
												}											
											 ?>
					
					</select>		
	
		</td>
	
	</tr>
</TABLE>
		
<table style='width:97%;' border='1px' >
	<tr>
		<td>
			<b>Ingrese Rut Paciente</b>
		</td>
		<td>
			<input size='8'id="rut" value=""  onkeypress='return justNumbers(event);'>
			<input  size='2'id="dv_rut" >
			<input type="button" value="Buscar"  onclick='cargar_paciente();' >
			<input type="hidden" size='3'id="dv_rut" disabled >
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	
	</tr>
	<tr>
		<td>
			<b>Nombre</b>
		</td>
		<td>
			<input  size='30'id="nombre"  value="">
		</td>
		<td>
			<b>Apellido Paterno</b>
		</td>
		<td>
			<input size='30'id="appaterno"  value="">
		</td>
		<td>
			<b>Apellido Materno</b>
		</td>
		<td>
			<input size='30'id="apmaterno" value="">
		</td>
	</tr>

	<tr>	
		<td>
			<b>Edad</b>
		</td>
		<td>
			<input size='1'id="edad" name="edad"  >A&ntilde;os
			<input size='1'id="edad_m" name="edad_m"  >Meses
			<input size='1'id="edad_d" name="edad_d"  >D&iacute;as
			
		</td>		
		<td>
			<b>Tel&eacute;fono</b>
		</td>
		<td>
			<input size='10'id="fono" value=""> 
			<input size='10'id="fono2" value="">
		
		</td>		
			<td></td>
		<td></td>
	
		
	</tr>
</table>	
<table style='width:97%;' border='10px' align='center'>
	
	<tr>
		<td style="width:20%;">
			<b>Diagn&oacute;sticos: </b>
<a href="https://intranet.sanidadnaval.cl/app/pdf/AyudaCie10.pdf" target="_blank" title="Ayuda CI10"><img  id='foto_consentimiento'src="../imagenes/cons.png" ></a>

		</td>
			<td  style="width:70%;">
				<input   name='diagnosa'style="width:80%;"  id='diagnosa'  onkeyup='cargar_diagnostico();'  >
				<input  type='hidden' id='diag' name='diag'>
				<div id='diagnos'style="width:80%;" style='float:left;display:none;' >
				
</div>
				
			</td>

		
	</tr>
<tr>
		<td style="width:20%;">
			<b>Otros Diag.: </b>
		</td>
		<td style="width:20%;">
				<textarea  cols='100' rows='1' id='otrosd' name='otrosd' ></textarea>
		</td>
	</tr>	
	<tr>
		<td style="width:20%;">
			<b>Intervenci&oacute;n: </b>
		</td>
			<td  style="width:70%;">
					<input   name='inter1'style="width:80%;"  id='inter1'  onkeyup='cargar_intervencion();'  >
					<input  type='hidden' id='inter' name='inter'>
					<input  type='hidden' id='dig_inter' name='dig_inter'>
					
							<div id='intervencion'style="width:80%;" style='float:left;display:none;' >
							</div>
						
			</td>
			<td style='width:20%;'  align='left'>
					<select name="lado"  style="width:70px" id="lado"  >
				      		<option value="1" selected >No Aplica</option>
									<option value="2" >Izquierda</option>
									<option value="3" >Derecha</option>
									<option value="4" >Bilateral</option>
					</select>		
		</td>
	</tr>
<tr>
		<td style="width:20%;">
			<b>Otras Interv.: </b>
		</td>
		<td style="width:20%;">
			<textarea  cols='100' rows='1' id='otrosi' name='otrosi' ></textarea>
		</td>
	</tr>

	<tr>
		<td style="width:20%;">
			<b>Consentimiento Informado: </b>
<a href="http://acreditacion.hospitalnaval.cl/index.php?option=com_content&view=article&id=50&Itemid=72&dir=JSROOT%2FConsentimientos/Consentimientos" target="_blank" title="Consentimiento Informado"><img  id='foto_consentimiento'src="../imagenes/cons.png" ></a>
				
</td>
	
		<td align='lef'>
						<select name="conseinfo"  style="width:80%;" id="conseinfo"  >
				      		<option value="0" >-------------</option>
									<option value="1" > Firmado y Archivado  en Ficha Cl&iacute;nica</option>
					</select>		
				<img id='foto_error' >
			
	</td>
		<!--td colspan='3'rowspan="2" style='align:left;' >
		</td-->
		
	</tr>

</table>

<table style='width:97%;' border='1px' align='left'>
	<tr>
		
		<td style='width:20%;' >
			<b>Clasificaci&oacute;n ASA</b>
		</td>
		<td>
			<div name='cl_asa' id='cl_asa'style="width:80%;" style='float:left;display:none;' >
			</div>
			<input type='hidden' id='clase_valor' name='clase_valor' >	
			
		</td>
		<td>
			<b>Tiempo Quir&uacute;rgico</b>
		</td>
		<td style='width:20%;'  align='left'>
					<select name="tpo"  style="width:60px" id="tpo"  >
				      		<option value="-1">-------------</option>
									<option value="0" >30</option>
									<option value="1" >60</option>
									<option value="2" >90</option>
									<option value="3" >120</option>
									<option value="4" >150</option>
									<option value="5" >180</option>
									<option value="6" >210</option>
									<option value="7" >240</option>
									<option value="8" >270</option>
									<option value="9" >300</option>
								
					</select>		
			<b>Mins.</b>
		</td>
	</tr>	
</table>
<table style='width:97%;' border='1px' align='left'>
	
	<tr>
		<td>
			<b>Anestesia Sugerida</b>
		</td>
		<td>
			<input size='140px'id="anessuge" value="">
		</td>
		
	
	</tr>	
</table>
&nbsp;
		<!--div  class='fondo_envio'name='divdeptos' id='divdeptos' style="height:150px;width:99%;position:relative;overflow:auto"  >
		</div-->
		
		
<table style='width:97%;' border='1px' align='left'>
	<td>
			<b>Chequear como:</b>
		</td>
		<td style='width:20%;'  align='left'>
					<select name="todono"  style="width:90px" id="todono" onchange="opciones_check(this.value);" >
				      		<option value="-1">-------------</option>
									<option value="1" >Todos No</option>
					</select>		
		</td>
	<tr>
		<td style='width:20%;' >
			<b>Aislamiento</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="aislaresp" id="aislasi" value=1 >Si
			<input type="radio" name="aislaresp" id="aislano" value=0 >No
		</td>		
		
		<td style='width:20%;'>
			<b>Evaluacion Preanestesica</b>
		</td>
		<td style='width:10%;'align='left' >
			<input type="radio" name="prearesp" id="preasi" value=1 >Si
			<input type="radio" name="prearesp" id="preano" value=0 >No
			
		</td>		
	<td style='width:20%;' >
			<b>Necesidad Cama UPC</b>
		</td>
		<td style='width:10%;' align='left'>
			<input type="radio" name="upcresp" id="upcsi"  value=1 >Si
			<input type="radio" name="upcresp" id="upcno"  value=0 >No
				
		</td>
	</tr>
	<tr>
			<td style='width:20%;'>
			<b>Alergia Latex</b>
		</td>
		<td style='width:10%;' align='left'>
			<input type="radio" name="latexresp" id="latexsi"  value=1 >Si
			<input type="radio" name="latexresp" id="latexno"  value=0 >No
		</td>	
		
		<td style='width:20%;' >
			<b>Equipo Rayos</b>
		</td>
		<td style='width:10%;'align='left'>
			<input type="radio" name="rayosresp" id="rayossi"  value=1 >Si
			<input type="radio" name="rayosresp" id="rayosno"  value=0 >No
				
		</td>		
		
		<td style='width:20%;' >
			<b>Prioridad</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="prioresp" id="priosi" value=1 >Si
			<input type="radio" name="prioresp" id="priono" value=0 >No
				
		</td>		

	</tr>	
	<tr>
		<td style='width:20%;' >
			<b>Usuario Taco</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="tacoresp" id="tacosi" value=1 >Si
			<input type="radio" name="tacoresp" id="tacono" value=0 >No
		</td>		
		
		<td style='width:20%;' >
			<b>Insumos Especificos</b>
		</td>
		<td style='width:10%;' align='left' onclick='activarcampo();' >
			<input type="radio" name="esperesp" id="espesi" value=1 >Si
			<input type="radio" name="esperesp" id="espeno" value=0 >No
		
		</td>		
	<td style='width:20%;' >
			<b>Necesidad Donantes Sangre</b>
		</td>
		<td style='width:10%;' align='left'>
			<input type="radio" name="sangresp" id="sangsi" value=1 >Si
			<input type="radio" name="sangresp" id="sangno" value=0 >No
				
		</td>
	</tr>
	<tr>
		<td style='width:20%;' >
			<b>Examen Preoperatorio</b>
		</td>
		<td style='width:20px'  align='left' >
			<select name="exampreo"  style="width:100px" id="exampreo"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Realizados</option>
									<option value="1" >Solicitados</option>
									<option value="2" selected >No Aplica</option>
			</select>		
		</td>		
	
		<td style='width:20%;' >
			<b>Biopsia</b>
		</td>
		<td style='width:20px'  align='left' >
			<select name="biop"  style="width:80px" id="biop"  >
				      		<option value="0" >Externa</option>
									<option value="1" >R&aacute;pida</option>
									<option value="2" >Diferida</option>
									<option value="4" >Citometr&iacute;a de Flujo</option>
									<option value="3" selected >No Aplica</option>
			</select>		
		</td>
	
	</tr>	
</table>

	

		
<table style='width:97%;' border='0px' align='center'>
<tr>
		<td>
			<b>Instrumental.: </b>
		</td>
	</tr>
	<tr>	
		<td>
				<textarea  cols='190' rows='1' id='obsinstru' name='obsinstru' ></textarea>
			
		</td>
	</tr>
</table>
		
<table style='width:97%;' border='0px' align='center'>
<tr>
		<td>
			<b>Observaciones.: </b>
		</td>
	</tr>
	<tr>	
		<td>
				<textarea  cols='190' rows='1' id='obs' name='obs' ></textarea>
			
		</td>
	</tr>
</table>	

<table id='tablainsumos' style="width:97%;display:none;" border='0px' align='center' >
	<tr>
				<td>
					<b>Insumos Espec&iacute;ficos.: </b>
				</td>
	</tr>
	<tr>	
				<td>
						<textarea  cols='190' rows='1' id='obsinsu' name='obsinsu' ></textarea>
				</td>
	</tr>
</table>	

		<table style='width:97%;' border='0px' align='center' >
			<tr>
				<td style='width:200px;' align='right' >
					<input type="button" onclick="cerrar();" value='Salir'>
				</td>
				<td  style='width:200px;' >
						<input type="button" onClick='guardar_parte();' style="margin-left:120px;" id='bt_guardar'  name="commit" value="Guardar Parte"/>	
				</td>
				<td  style='width:30%;' >
						<input type="button" onClick='cerrar_parte();' style="display:none;" id='bt_cerrar'  name="commit" value="Enviar Parte a Admision"/>	
				</td>
				<td  style='width:30%;' >
						<input type="button" onClick='ver_pdf();' style="display:none;" id='bt_pdf'  name="commit" value="Ver Parte PDF"/>	
				</td>
			</tr>
		</table>
	</div>
</body>
  <script src="../scripts/chosen/prototype.js" type="text/javascript"></script>
  <script src="../scripts/chosen/chosen.proto.js" type="text/javascript"></script>
  <script src="../scripts/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">


  </script>

</html>
<?php
}
?>