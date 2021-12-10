 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
//ini_set('display_errors','1');
require_once('../conexion/conexion.php');
if($_GET['form']=='ingreso2'){
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
	var  idmensaje = '<?php echo($_GET["identificador"]);?>';
	var ext = '<?php echo($_GET["ext"]);?>';
	if(ext==1){
		var  idrespuesta = '<?php echo($_GET["idrespuesta"]);?>';
		
		}else{
				var  idrespuesta = "";
		}

	
	
	
		var usuario = '<?php echo($_SESSION["rut"]);?>';
	//	alert(usuario);
	
	departamentos = function() {
		var myAjax = new Ajax.Updater(
				'divdeptos', 
				'ingreso_db.php', 
				{
					method: 'post', 
					parameters: 'tipo=deptos&idmensaje='+idmensaje,
					evalScripts: true,
					onComplete: function() {
						//alert(pedido_datos.responseText);
					}
				}
		);
	}

	guardar_parte = function(){
		
	  var diagnostico 	 = document.getElementById('diag').value;
   	var intervencion 	 = document.getElementById('inter').value;
   	var consentimiento = document.getElementById('consentimiento_informado').value;
   	var tiempo 				 = document.getElementById('tpo').value;
   	var especialidad 	 = document.getElementById('especialidad').value;
   	var rut 				 	 = document.getElementById('rut').value;
		var nombre				 = document.getElementById('nombre').value;
		var appaterno			 = document.getElementById('appaterno').value;
		var apmaterno			 = document.getElementById('apmaterno').value;
		var edad					 = document.getElementById('edad').value;
		var fono					 = document.getElementById('fono').value;
		//var cama					 = document.getElementById('cama').value;
									   
    if(especialidad==-1){
    	
    	alert('Debe Indicar Especialidad');
    	return;
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
    if(edad==""){
    	
    	alert('Debe Indicar Edad Paciente');
    	$('edad').focus();
  
    	return;
    	}			
    	
    	if(diagnostico==-1)
    	{
    		alert('Debe Seleccionar Diagnóstico');
    		return;
    		}
    	if(intervencion==-1)
    	{
    		alert('Debe Seleccionar Intervención');
    		return;
    		}
   
    if(consentimiento==1){
    	$('foto_error').src="../imagenes/cancel2.png";
    
    	alert('Debe Entregar y Firmar el Consentimiento Informado');
    	return;
    	}
    	if(tiempo==-1)
    	{
    		alert('Debe ingresar Tiempo Quirúrgico');
    		return;
    		}
    	
    
		var dept 				 = document.getElementById('dept').value;
		var idrespuesta  = document.getElementById('idrespuesta').value;
		var separo			 = dept.split("-");
		var cargousuario = separo[0];	
		var cddepto			 = separo[1];	
		var cddiv				 = separo[2];
		var tema 				 = document.getElementById('tema').value;
    var tipo_edicion = document.getElementById('tipo_edicion').value;
		var clasifi 		 = document.getElementById('clasifi').value;
		var prioridad 	 = document.getElementById('prioridad').value;
		var originador 	 = document.getElementById('originador').value;
		var txtdestino 	 = document.getElementById('txtdestino').value;
	  var txtfaro 		 = document.getElementById('txtfaro').value;
		var txtxmt 			 = document.getElementById('txtxmt').value;
		var resp 				 = document.getElementById('idrespuesta').value;
		var plazo1 			 = document.getElementById('plazo1').value;
		var obs					 = tinyMCE.get('camp');
		var contenido		 = escape(obs.getContent());
		contenido				 = contenido.replace(/=/g,String.fromCharCode(215));
		var reqrespuesta = '0';
			//alert('1');
			
			seleccionareferencias();
			var referencias = $('val_referidos').value;
			//alert(referencias);
			
			var destinos="";
				obj = $('txtdestino');
				var j = 0;
				for (i=0; opt=obj.options[i];i++) {
				if (opt.selected){
				if (j==0) {
				destinos = opt.value;
				} else {
				destinos = destinos+","+opt.value;
			//	alert(destinos);
				}
				j++;
				}
			}
			
			var faros="";
				obj = $('txtfaro');
				var j = 0;
				for (i=0; opt=obj.options[i];i++) {
				if (opt.selected){
				if (j==0) {
				faros = opt.value;
				} else {
				faros = faros+","+opt.value;
			//	alert(destinos);
				}
				j++;
				}
			}
			var xmt="";
				obj = $('txtxmt');
				var j = 0;
				for (i=0; opt=obj.options[i];i++) {
				if (opt.selected){
				if (j==0) {
				xmt = opt.value;
				} else {
				xmt = xmt+","+opt.value;
			//	alert(destinos);
				}
				j++;
				}
			}
			
			
			//alert('2');
			if(tema ==''){
				
				alert('Debe Ingresar Titulo del Mensaje')
				return;
				}
			
						if(tipo_edicion == -1){
				
								alert('Debe Ingresar Tipo de Edición')
								return;
								}			
								
												
										if(clasifi == -1){
								
												alert('Debe Ingresar Clasificación')
												return;
												}			
								
								
																if(prioridad == -1){
														
																		alert('Debe Ingresar Prioridad')
																		return;
																		}			
																		
																						
																				if(originador == -1){
																		
																						alert('Debe Ingresar Originador')
																						return;
																						}
																							if(contenido == ''){
																			
																							alert('Debe Ingresar Texto')
																							return;
																							}			
																						
																							if (($('reqrespuestasi').checked==false)&&($('reqrespuestano').checked==false)){
																												alert("Debe seleccionar si requiera respuesta.");
																												return;
																											}
																											if ($('reqrespuestasi').checked==true){
																												reqrespuesta	= '1';
																												}
																													
																													if((reqrespuesta	=='1')&&(plazo1=='')){
																													
																													alert('Debe ingresar Fecha de Plazo')
																													return;
																													}
		if(dept == '-1'){
			alert('Debe Ingresar Departamento Originador')
			return;
		}	
			param ='&tema='+tema+'&resp='+resp+'&id='+idmensaje+'&tipo_edicion='+tipo_edicion+'&cddepto='+cddepto+'&cddiv='+cddiv+'&val_referidos='+referencias+'&idrespuesta='+idrespuesta;
			param = param + '&clasifi='+clasifi+'&prioridad='+prioridad+'&originador='+originador+'&reqrespuesta='+reqrespuesta+'&dept='+dept;
			param = param + '&txtdestino='+destinos+'&txtfaro='+faros+'&txtxmt='+xmt+'&contenido='+contenido+'&usuario='+cargousuario+'&plazo1='+plazo1;
	//		alert(param);
//alert(param);
			var myAjax = new  Ajax.Request(
				'ingreso_db.php', 
				{
					method: 'post', 
					parameters: 'tipo=guardar_mensaje&param='+param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
						if (pedido_datos.responseText.indexOf("ERROR")==-1){
							var idmen = (pedido_datos.responseText);
							$('idmensaje').value = idmen;
							distribuir(idmen);	
							alert('MENSAJE INGRESADO CORRECTAMENTE.\nAHORA PUEDE ADJUNTAR ARCHIVO');
							$('archivo_up').disabled = false;
							$('bt_guardar').disabled = true;
							$('bt_agregar_notas').disabled =false;
							$('bt_tramitar').disabled =false;
						} else {
							alert(pedido_datos.responseText);
						}
					}
				}
		);
}


	distribuir = function(idmen) {
		var checkboxs = getElementsByAttribute(document.getElementById("divdeptos"), "*", "id");
		var param = "";
		for (var i=0; i<checkboxs.length; i++) {
			if (checkboxs[i].checked) {
				var id=checkboxs[i].id;
				param = 'tipo=distribuir&idmensaje='+idmen+'&cddepartamento='+id;
				var myAjax = new Ajax.Request(
					'ingreso_db.php', 
					{
						method: 'post', 
						parameters: param,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						}
					}
				);
			}
		}
	}


lista_archivos = function(){
		var param= 'tipo=lista_archivos&idmensaje='+$('idmensaje').value;
		var myAjax = new Ajax.Updater(
				'adjuntos', 
				'ingreso_db.php', 
				{
					method: 'post', 
					parameters: param,
					evalScripts: true,
					onComplete: function() {
						//alert(pedido_datos.responseText);
					}
				}
		);
	
	}
	
	
	eliminar_archivo = function(idmensaje, orden){
		confirma=confirm('Eliminar archivo adjunto?');
		if (confirma) {
			var myAjax = new  Ajax.Request(
				'ingreso_db.php', 
				{
					method: 'post', 
					parameters: 'tipo=eliminar_archivo&idmensaje='+idmensaje+'&orden='+orden,
					evalScripts: true,
					onComplete: function(pedido_datos) {
						lista_archivos();
					}
				}
			);
		}
	}
	
	ver_archivo = function(idmensaje, orden){
		ver_adjunto = window.open('../scripts/visoradjunto.php?idmensaje='+idmensaje+'&orden='+orden,'ver_adjunto','left=000,top=100,width=1000,height=600');
	}

	cerrar = function(){
			window.close();
		
<?php
	if (isset($_GET["gestion"])){
		if ($_GET["gestion"] == '1'){

			print("window.opener.listado_mensajes('numero','asc');");
			print("window.opener.listado_mensajes_transmitidos('numero','asc');");
			//print("alert('Mensaje modificado');");
			print("window.opener.gestionmensaje(".$_GET["identificador"].");");
		} else {
			print("window.opener.listado_mensajes('numero','asc');");
			print("window.opener.listado_mensajes_transmitidos('numero','asc');");
		}
	} else {
		print("window.opener.listado_mensajes('numero','asc');");
		print("window.opener.listado_mensajes_transmitidos('numero','asc');");
	}
?>	
		
	}


	addOption = function(selectObject,optionText,optionValue) {
		var optionObject = new Option(optionText,optionValue);
		var optionRank = selectObject.options.length;
		selectObject.options[optionRank]=optionObject;
	}
	
	deleteOption =function(selectObject,optionRank) {
		if (selectObject.options.length!=0) { selectObject.options[optionRank]=null; }
	}
	
	add_ref = function() {
		var param = 'tipo=agregarreferencia&txtreferencia='+$('txt_referencia').value;
		var myAjax = new  Ajax.Request(
			'ingreso_db.php', 
			{
				method: 'post', 
				parameters: param,
				evalScripts: true,
				onComplete: function(pedido_datos) {
					if (pedido_datos.responseText*1 != -1){
						addOption($('referidos'), $('txt_referencia').value, pedido_datos.responseText);
						$('txt_referencia').value = "";
						$('b_add_ref').disabled = true;
					} else {
						alert('NO EXISTE REFERENCIA');
					}
				}
			}
		)
	}
	
	valida = function() {
		var param = 'tipo=agregarreferencia&txtreferencia='+$('resp').value;
		//alert(param);
		
		var myAjax = new  Ajax.Request(
			'ingreso_db.php', 
			{
				method: 'post', 
				parameters: param,
				evalScripts: true,
				onComplete: function(pedido_datos) {
				
		//		alert(pedido_datos.responseText);
				if (pedido_datos.responseText*1 != -1){
					$('idrespuesta').value = pedido_datos.responseText;  
						alert('MENSAJE ASOCIADO');
					} else {
						alert('NO EXISTE MENSAJE');
					}
				}
			}
		)
	}
	
	
	
	
	sel_ref = function (){
		$('b_add_ref').disabled = true;
		$('b_rem_ref').disabled = false;
		$('b_ver_ref').disabled = false;
	}

	cam_ref = function (){ 
		$('b_add_ref').disabled = false;
		if ((event.which && event.which == 13) || (event.keyCode && event.keyCode == 13)){
			add_ref();
		}
	}

	rem_ref = function () {
		deleteOption($('referidos'),$('referidos').selectedIndex);
		$('b_add_ref').disabled = true;
		$('b_rem_ref').disabled = true;
		$('b_ver_ref').disabled = true;
	}
	
	ver_ref = function(){
		var idmensaje = $('referidos').options[$('referidos').selectedIndex].value;
		//alert(idmensaje);
		ver_referencia = window.open('mensaje.php?form=idmensaje&idmensaje='+idmensaje,'ver_referencia','left=000,top=100,width=1000,height=600');
	
	}
	
	seleccionareferencias = function(){
		var lista= $('referidos');
		largo = lista.options.length;
		valores = "";
		for(i=0;i<largo;i++){
			newOpt = lista.options[i].text;
			if(newOpt!='')
			lista.options[i].selected=true;
			valores = valores + lista.options[i].value + ";";
			
		}
		$('val_referidos').value = valores;
	}

	tramitar = function(){
		var dept 				 = $('dept').value;
		var idmensaje		 = $('idmensaje').value;
		var separo			 = dept.split("-");
		var cargousuario = separo[0];	
		var cddepto			 = separo[1];	
		var cddiv				 = separo[2];
	//	window.close();
		var ruta = 'tramitar.php?form=redistribuir&idmensaje='+idmensaje+'&dep='+cddepto+'&div='+cddiv+'&interno='+1;
		redistribucion= window.open(ruta,'redistribucion','left=200,top=100,width=850,height=500,status=0');
		redistribucion.focus();
	}
	
	agregar_notas = function(){
		var ruta = '../docnavales/nota.php?form=notas&idmensaje='+$('idmensaje').value;
		nota = window.open(ruta,'nota','left=10,top=10,width=850,height=600,status=0');
		nota.focus();
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
				'ingreso_db.php', 
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
						$('apmaterno').value = datos[2];
						$('apmaterno').disabled=true;
						$('edad').value = datos[3];
						$('edad').disabled=true;
						$('fono').value = datos[4];
						$('fono').disabled=true;
					//	$('cama').value = datos[5];
					//	$('cama').disabled=true;
					}else{
						alert('Paciente Nuevo. Por Favor, Ingrese Manualmente Todos sus Datos');
						limpiar();
						$('nombre').focus();
						$('nombre').disabled=false;
						$('appaterno').disabled=false;
						$('apmaterno').disabled=false;
						$('edad').disabled=false;
						$('fono').disabled=false;
					//	$('cama').disabled=false;
						
						
						
						
						}
				
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
//$('cama').value = "";
	
	
	}
	
	cambiar_foto = function(){
		var ci = $('consentimiento_informado').value;
		if(ci==0){
		$('foto_error').src="../imagenes/bien.png";
		}
	}
	
	
	
</script>
<body onload='departamentos();'>
<div id='mensajex' class='fondo_envio2' style='text-align:center;'>
	<table>
				<b>Solicitud de Pabell&oacute;n</b>
	</table>
</div>	
	<div id='mensaje' class='fondo_envio' style='text-align:center;'>
	
<div id='memox'>
	<table style='width:77%;' border='0px' align='center'>
	<tr>
		<td>
			<b>Especialidad</b>
		</td>
		<td>
				<select name="especialidad"  style="width:150px" id="especialidad"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Traumatología</option>
									<option value="1" >Oftalmología</option>
									<option value="2" >Urología</option>
									<option value="3" >Otorrino</option>
									<option value="4" >Cirugía</option>
									<option value="5" >Vascular</option>
									<option value="6" >Neurocirugía</option>
									<option value="6" >Cirugía Plástica</option>
									<option value="6" >Mama</option>
			
					</select>		
	
		</td>
		<td>
			<b>Tipo Cirug&iacute;a</b>
		</td>
		<td>
				<select name="tp_atencion"  style="width:80%;" id="tp_atencion"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Electiva</option>
									<option value="1" >Urgencia</option>
					</select>		
		
		</td>
	<td>
			<b>CMA</b>
		</td>
		<td align='left' >
		<input type="radio" name="si" value="Si">Si
		<input type="radio" name="si" value="No">No
		
		</td>
	</tr>
</TABLE>
		
<table style='width:97%;' border='0px' align='LEFT'>
	<tr>
		<td>
			<b>Ingrese Rut Paciente</b>
		</td>
		<td style='width:20px'  align='left' >
			<input size='15'id="rut" value="" align='left'  onchange='cargar_paciente();'>
		</td>	
	</tr>
	<tr>
		<td style='width:33%;'>
			<b>Nombre</b>
		</td>
		<td>
			<input src='img/input.png' size='40'id="nombre" value="">
		</td>
		<td style='width:33%;'>
			<b>Apellido Paterno</b>
		</td>
		<td>
			<input size='40'id="appaterno" value="">
		</td>
		<td style='width:33%;' >
			<b>Apellido Materno</b>
		</td>
		<td>
			<input size='40'id="apmaterno" value="">
		</td>
	</tr>

	<tr>	
		<td style='width:33%;'>
			<b>Edad</b>
		</td>
		<td style='width:20px'  align='left' >
			<input size='10'id="edad" name="edad" align='left' >
			<b>Años</b>
		</td>		
		<td style='width:33%;'>
			<b>Tel&eacute;fono</b>
		</td>
		<td style='width:20px'  align='left'>
			<input size='10'id="fono" value="">
			<input size='10'id="fono2" value="">
		</td>		
		
		<!--td style='width:33%;'  >
			<b>Piso/Cama  </b>
							
		</td>
		<td style='width:20px'  align='left'>	
			<input size='10'id="cama" value="" align='left' >
		</td-->
	</tr>
<table>	
<table style='width:97%;' border='10px' align='center'>
	
	<tr>
		<td style="width:20%;">
			<b>Diagn&oacute;sticos: </b>
		</td>
		<td>
			<select name="diag"  style="width:80%;" id="diag"   >
							      	<option value=-1>-----------------</option>
											<?php 
												$sql="SELECT cod_diag,glosa_diag  FROM cie10 ORDER BY glosa_diag asc ";
												$rs = $db->Execute($sql);
												while (!$rs->EOF) {
													echo "<option value=".$rs->fields(0).">".htmlentities($rs->fields(1))." ".htmlentities($rs->fields(2))."</option>";
													$rs->movenext();
												}											
											 ?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">
			<b>Intervenci&oacute;n: </b>
		</td>
	
		<td>
						<select name="inter"  style="width:80%;" id="inter"   >
							      	<option value=-1>-----------------</option>
											<?php 
												$sql="SELECT codprest,glosa_intervencion  FROM intervencion ORDER BY glosa_intervencion asc ";
												$rs = $db->Execute($sql);
												while (!$rs->EOF) {
													echo "<option value=".$rs->fields(0).">".htmlentities($rs->fields(1))." ".htmlentities($rs->fields(2))."</option>";
													$rs->movenext();
												}											
											 ?>
			</select>
		
	
		</td>
		<tr>
		<td style="width:20%;">
			<b>Consentimiento Informado: </b>
		</td>
	
		<td align='lef'>
						<select name="consentimiento_informado"  style="width:80%;" id="consentimiento_informado"  onchange='cambiar_foto();' >
				      		<option value="1" selected >-------------</option>
									<option value="0" >Fue Entregado al paciente, luego Firmado y Archivado  en Ficha Clínica</option>
					</select>		
				<img id='foto_error'src="">
		</td>

	</tr>

</table>

<table style='width:80%;' border='1px' align='left'>
	<tr>
		<!--td style='width:50%;' >
			<b>1er Cirujano</b>
		</td>
		<td style='width:20px'  align='left' >
			<select name="filtro_sucursal"  style="width:180px" id="filtro_sucursal"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Cirujano A</option>
									<option value="1" >Cirujano B</option>
									<option value="2" >Cirujano C</option>
			</select>		
		</td>		
		</td-->
		<td style='width:20%;' >
			<b>Clasificaci&oacute;n ASA</b>
		</td>
		<td>
			<select name="filtro_sucursal"  style="width:150px;" id="filtro_sucursal"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Clase 1</option>
									<option value="1" >Clase 2</option>
									<option value="2" >Clase 3</option>
									<option value="3" >Clase 4</option>
									<option value="4" >Clase 5</option>

			</select>		
		</td>		
	<td>
			<b>Tiempo Quirúrgico</b>
		</td>
		<td style='width:20px'  align='left'>
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
<table style='width:80%;' border='1px' align='left'>
	
	<tr>
		<td>
			<b>Anestesia Sugerida</b>
		</td>
		<td style='width:20px'  align='left'>
			<input size='150px'id="anestesia" value="">
		</td>
		
	
	</tr>	
</table>
&nbsp;
		<!--div  class='fondo_envio'name='divdeptos' id='divdeptos' style="height:150px;width:99%;position:relative;overflow:auto"  >
		</div-->
		
		
<table style='width:90%;' border='1px' align='left'>
	<tr>
		<td style='width:20%;' >
			<b>Aislamiento</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="sia" value="Si">Si
			<input type="radio" name="sia" value="No">No
		</td>		
		
		<td style='width:20%;'>
			<b>Evaluacion Preanestesica</b>
		</td>
		<td style='width:10%;'align='left' >
			<input type="radio" name="sib" value="Si">Si
			<input type="radio" name="sib" value="No">No
			
		</td>		
	<td style='width:20%;' >
			<b>Necesidad Cama UPC</b>
		</td>
		<td style='width:10%;' align='left'>
			<input type="radio" name="sic" value="Si">Si
			<input type="radio" name="sic" value="No">No
				
		</td>
	</tr>
	<tr>
			<td style='width:20%;'>
			<b>Alergia Latex</b>
		</td>
		<td style='width:10%;' align='left'>
			<input type="radio" name="sipa" value="Si">Si
			<input type="radio" name="sipa" value="No">No
		</td>	
		
		<td style='width:20%;' >
			<b>Equipo Rayos</b>
		</td>
		<td style='width:10%;'align='left'>
			<input type="radio" name="sid" value="Si">Si
			<input type="radio" name="sid" value="No">No
				
		</td>		
		
				<td style='width:20%;' >
			<b>Prioridad</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="sip" value="Si">Si
			<input type="radio" name="sip" value="No">No
				
		</td>		

	</tr>	
	<tr>
		<td style='width:20%;' >
			<b>Usuario Taco</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="sif" value="Si">Si
			<input type="radio" name="sif" value="No">No
		</td>		
		
		<td style='width:20%;' >
			<b>Insumos Especificos</b>
		</td>
		<td style='width:10%;' align='left' >
			<input type="radio" name="sih" value="Si">Si
			<input type="radio" name="sih" value="No">No
		
		</td>		
	<td style='width:20%;' >
			<b>Necesidad Donantes Sangre</b>
		</td>
		<td style='width:10%;' align='left'>
			<input type="radio" name="sig" value="Si">Si
			<input type="radio" name="sig" value="No">No
				
		</td>
	</tr>
	<tr>
		<td style='width:20%;' >
			<b>Examen Preoperatorio</b>
		</td>
		<td style='width:20px'  align='left' >
			<select name="filtro_sucursal"  style="width:100px" id="filtro_sucursal"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Realizados</option>
									<option value="1" >Solicitados</option>
			</select>		
		</td>		
	
		<td style='width:20%;' >
			<b>Biopsia</b>
		</td>
		<td style='width:20px'  align='left' >
			<select name="filtro_sucursal"  style="width:80px" id="filtro_sucursal"  >
				      		<option value="-1">-------------</option>
									<option value="0" >Externa</option>
									<option value="1" >Rapida</option>
									<option value="2" >Diferida</option>
			</select>		
		</td>
	
	</tr>	
<table>		
	<table style='width:80%;' border='1px' align='left'>
	
	<tr>
		<td>
			<b>Instrumental</b>
		</td>
		<td style='width:20px'  align='left'>
			<input size='150px'id="anestesia" value="">
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
				<textarea  cols='200' rows='4' id='camp' name='camp' ></textarea>
			
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
				
			</tr>
		</table>
	</div>
</body>
  <script src="../scripts/chosen/prototype.js" type="text/javascript"></script>
  <script src="../scripts/chosen/chosen.proto.js" type="text/javascript"></script>
  <script src="../scripts/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
  document.observe('dom:loaded', function(evt) {
    var config = {
      '.chosen-select': {no_results_text: "Casilla no existe!"}
    }
    var results = [];
    for (var selector in config) {
      var elements = $$(selector);
      for (var i = 0; i < elements.length; i++) {
        results.push(new Chosen(elements[i],config[selector]));
      }
    }
    return results;
  });
  
 	if(idmensaje != -1){
		var myAjax = new  Ajax.Request(
			'ingreso_db.php', 
			{
				method: 'post', 
				parameters: 'tipo=cargar_mensaje&idmensaje='+idmensaje,
				evalScripts: true,
				onComplete: function(pedido_datos) {
				//	alert(pedido_datos.responseText);
					datos = JSON.parse(pedido_datos.responseText);
					$('tema').value= datos[0];
			  	$('clasifi').value= datos[1];
					$('originador').value= datos[2];
				  $('tipo_edicion').value= datos[4];
				  //tinymce.execCommand('mceSetContent',false,datos[3]);
					$('prioridad').value= datos[5];
					$('plazo1').value= datos[6];
					$('resp').value= datos[9];
					$('idrespuesta').value= datos[10];
					if(datos[7]==1){
						$('reqrespuestasi').checked = true;
					}
						else{
							$('reqrespuestano').checked = true;
							$('plazo1').value= "";
							
						}
					departamentos();
					lista_archivos();
					$('archivo_up').disabled = false;
				}
			}
		);
	}

  </script>

</html>
<?php
}
?>