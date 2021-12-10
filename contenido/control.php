<?php
	require_once("../conexion/conexion.php");
	if($_GET['form']=='control') {
?>

<head>
	
	<link rel="stylesheet" href="css/usuarios2.css" type="text/css">
</head>	
<script>	
	listado_ingresos = function() {
		
		var inicio=1;
	
		//alert(inicio);
		var myAjax= new Ajax.Updater(
				'divlistado',
				'contenido/control_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=control_tramitacion&inicio='+inicio,
					onComplete: function(pedido_datos) {
						$('divdetalle').style.display='none';
						$('divlistado').style.display='block';
						$('btnvolver').style.display='none';
						
						$('tablafiltro').style.display='block';
						$('tablafiltro2').style.display='block';

						var ddd="d";
						cargar_pato(ddd);
						cargar_filtro_condicion();
						cargar_filtro_especialidad();
						
						
						
				
					}
				}
		);
	}
	
		listado_ingresos_filtros = function() {
		
		var filtro_cond  = document.getElementById('filtro_cond').value;
		var filtro_esp 	 = document.getElementById('filtro_esp').value;
		var filtro_base  = document.getElementById('filtro_base').value;
		var fc1_filtro   = document.getElementById('fc1_filtro').value;
		var fc2_filtro 	 = document.getElementById('fc2_filtro').value;
		var orden 			 = document.getElementById('orden').value;
		var filtro 			 = document.getElementById('filtro').value;
		var tpcirugia 	 = document.getElementById('tpcirugia').value;
		var priori 			 = document.getElementById('priori').value;
		var salud 			 = document.getElementById('sis_salud').value;
		var cma   			 = document.getElementById('cma').value;
		
		var param = '&filtro_cond='+filtro_cond+'&filtro_esp='+filtro_esp+'&fc1_filtro='+fc1_filtro+'&fc2_filtro='+fc2_filtro;
	  param = param +'&filtro_base='+filtro_base+'&orden='+orden+'&filtro='+filtro+'&tpcirugia='+tpcirugia+'&priori='+priori+'&salud='+salud+'&cma='+cma;

		//alert(param);
		var myAjax= new Ajax.Updater(
				'divlistado',
				'contenido/control_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=control_tramitacion&param='+param,
					onComplete: function(pedido_datos) {
					//alert(pedido_datos.responseText);
    			
						$('divdetalle').style.display='none';
						$('divlistado').style.display='block';
						$('btnvolver').style.display='none';
						
						$('tablafiltro').style.display='block';
						$('tablafiltro2').style.display='block';

				//		cargar_filtro_condicion();
					}
				}
						
		
		);
		var base = filtro_base;
		if(base==-1){
			var ddd = filtro_esp;
			cargar_pato(ddd);
		}
	
	
	}


	listado_ingresos_filtros2 = function(){
		var ddd = document.getElementById('filtro_patolo').value;
		listado_ingresos_filtros();
		//alert(ddd);
		}

	detallenotas = function(idmensaje){
		ruta= 'docnavales/visornotas.php?form=visornotas&idmensaje='+idmensaje;
		vernotas = window.open(ruta,'vernotas','left=200,top=100,width=850,height=500,status=0');
		vernotas.focus();
	}
cerrar = function(idusuario,fila){
	var prueba = idusuario;
	alert(prueba);
			$('divdetalle').style.display='block';
			$('divlistado').style.display='none';
	seleccionar_usuario(idusuario,fila);		
	
	
	}
	
	seleccionar_usuario = function(nump) {
	
		$('filtrox').style.display='none';
		$('foto_ver_fonos').src = "imagenes/agregar.png";
		$('foto_ver_fonos').title='Contactos Telef\u00f3nicos';

		//	alert(nump);
			var myAjax = new Ajax.Request(
				'contenido/control_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=personal&buscar='+nump,
					onComplete: function(pedido_datos) {
    				//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
    				$('divlistado').style.display='none';
						$('divdetalle').style.display='block';
						$('tablafiltro').style.display='none';
						$('tablafiltro2').style.display='none';

						$('func_usuario').value = datos[0];
						$('func_usuario').disabled=true;
						$('func_nombre').value = datos[1]+" "+datos[2]+" "+datos[3];
						$('func_nombre').disabled=true;
						$('edad').value = datos[4];
						$('edad').disabled=true;
						$('medico').value = datos[8];
						$('medico').disabled=true;
						$('fc_parte').value = datos[6];
						$('fc_parte').disabled=true;
						$('espe').value = datos[7];
						$('espe').disabled=true;
						$('parte').value = datos[9];
						$('obs').value = datos[10];
						$('obs').disabled = true;
						$('func_llico').value = datos[5];
						$('func_llico').disabled=false;
						$('base').value = datos[11];
						$('base').disabled=true;
						$('salud').value = datos[12];
						$('salud').disabled=true;
						$('categ').value = datos[13];
						$('categ').disabled=true;
						$('fc_dig').value = datos[14];
						$('fc_dig').disabled=true;
						$('fc_pab').value = datos[15];
						$('cond').value = datos[16];
						cargar_medi(datos[9]);
						notas(datos[9]);
						
						$('agregar_boton').style.display='none';
						$('cancelar_boton').style.display='block';
						$('guardar_boton').style.display='block';
						$('guardarcargo_boton').style.display='block';
						
					}
				}
			);
					
		}
		
		ver_parte = function(){
			
				var  num =  document.getElementById('parte').value;
			ver_solicitud_win = window.open('pdf/parte_pdf.php?tipo=ver&num='+num,'ver_solicitud','left=200,top=10,status=1');
			ver_solicitud_win.focus();
		
	/*		
		var ruta	 = 'contenido/ingresoparte.php?form=ingreso&identificador='+$('parte').value;
		buscar_win = window.open(ruta,'mensaje','left=500,top=100,width=1100,height=650,status=0');
		buscar_win.focus();
	*/
	}
	ver_examen = function(){
		var idmensaje= $('func_usuario').value;
		
		var ruta	 = 'contenido/examenes_paciente.php?form=examenes&identificador='+idmensaje;
		buscar_win = window.open(ruta,'mensaje','left=500,top=100,width=700,height=250,status=0');
		buscar_win.focus();
	
	}
	
	listado_ingresos();
	

	agregar_notas = function(){
		
		var ruta = 'docnavales/nota.php?form=notas&idmensaje='+$('parte').value;
		nota = window.open(ruta,'nota','left=10,top=10,width=850,height=400,status=0');
		nota.focus();
	}
	
		notas = function(xxx){
		//	alert('hola');
		var param= 'tipo=lista_notas&idmensaje='+xxx;
	//	alert(param);
		
		var myAjax = new Ajax.Updater(
				'divnotas', 
				'contenido/control_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true,
					onComplete: function() {
						var alto = $('X-alto').value * 1 - 680;
					//	alert($('X-alto').value);
					//	alert(alto);
						
						$('divnotas').style.height = alto + 'px';
						//alert(pedido_datos.responseText);
					}
				}
		);
	}
	
		add_ref = function(){
			
			
		var param = 'tipo=medicamento&buscar='+$('txt_referencia').value+'&nombre='+$('parte').value;
	//alert(param);
		var myAjax = new  Ajax.Request(
			'contenido/usuarios_db.php', 
			{
				method: 'get', 
				parameters: param,
				evalScripts: true,
				onComplete: function(pedido_datos) {

		var us=$('parte').value;
		cargar_medi(us);
		$('txt_referencia').value='';
		
				}
			}
		)
		
			
}


  rem_ref = function(xxxx){
  	
  	var borra = $('val_referidos').value=xxxx;
  	
  	
  	}
rem_ref2 = function(){
	
	var as = $('val_referidos').value;
	var param = 'tipo=borrar_medicamento&buscar='+as;
	//alert(param);
		var myAjax = new  Ajax.Request(
			'contenido/usuarios_db.php', 
			{
				method: 'get', 
				parameters: param,
				evalScripts: true,
				onComplete: function(pedido_datos) {
			//	alert(pedido_datos.responseText);
	
	
		var us=$('parte').value;
		cargar_medi(us);
				}
			}
		)
		
	
	
	
	}
	
		cargar_medi = function(usu) {
			//alert(idusuario);
				var myAjax = new Ajax.Updater(
					'patolo2', 
					'contenido/usuarios_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_medi&buscar='+usu,
						evalScripts: true
					}
				);
		}
		
		guardar_detalle_ingreso = function(){

			var parte = document.getElementById('parte').value;
			var cond = document.getElementById('cond').value;
			var fc_pab = document.getElementById('fc_pab').value;

			param = '&cond='+cond+'&fc_pab='+fc_pab+'&parte='+parte;
			//alert(param);
					var myAjax = new  Ajax.Request(
					'contenido/control_db.php', 
					{
						method: 'get', 
						parameters:'tipo=guardar_detalle&param='+param,
						evalScripts: true,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
					alert('Datos del Paciente Ingresados');
						
			cargar_filtro_condicion();
			notas(parte);

						}
					}
				);
			
			}
		
		cargar_filtro_condicion = function() {
			//alert(inicio);
				var myAjax = new Ajax.Updater(
					'filtro_condicion', 
					'contenido/control_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_filtro_condicion',
						evalScripts: true,
					}
				);
		}
		
		cargar_filtro_especialidad = function() {
			//alert(inicio);
				var myAjax = new Ajax.Updater(
					'filtro_especialidad', 
					'contenido/control_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_filtro_especialidad',
						evalScripts: true,
						
					}
					
				);
		}
		
		cargar_pato = function(ddd) {
		
		//alert(ddd);
				var myAjax = new Ajax.Updater(
					'patolos', 
					'contenido/control_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_pato&buscar='+ddd,
						evalScripts: true
					}
				);
		}
		
		
		limpiar_fc_inicial = function(){
			
			$('fc1_filtro').value="";
			listado_ingresos_filtros();
			}
			
		limpiar_fc_final = function(){
			
			$('fc2_filtro').value="";
			listado_ingresos_filtros();
			}
			
		mouser = function(event){
		
		var x;
		x=event.clientX - 250;
		$('X-ancho').value = screen.width;
		$('X-alto').value = screen.height;
		$('X-coord').value = x + 'px';
	}
		
		
		ver_fonos = function(){
		
		listado_contactos();	
		$('filtrox').style.left = $('X-coord').value;
		
		if ($('filtrox').style.display == 'none'){
					$('filtrox').style.display = 'block';
					$('foto_ver_fonos').src = "imagenes/delete.png";
			
		} else {
					$('filtrox').style.display = 'none';
					$('foto_ver_fonos').src = "imagenes/agregar.png";
		}
	 }
	 
	  justNumbers = function(e)
		{
		var keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum == 8) || (keynum == 46))
		return true;
		 
		return /\d/.test(String.fromCharCode(keynum));
		}
		
		
guardar_contacto = function(){
			
			var tp_contacto 	= document.getElementById('tp_contacto').value;
			var fono_contacto =	document.getElementById('fono_contacto').value;		
			var rut					  = document.getElementById('func_usuario').value;
			
			if(tp_contacto==-1){
					alert('Debe Seleccionar Tipo Contacto');
					$('tp_contacto').focus();
					return;
				}
					if(fono_contacto==""){
						alert('Debe Ingresar Contacto');
						$('fono_contacto').focus();
						return;
					}

					
					
						
			var param = '&tp_contacto='+tp_contacto+'&fono_contacto='+fono_contacto+'&rut='+rut;
			//alert(param);
			var myAjax = new  Ajax.Request(
				'contenido/usuarios_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=guardar_telefonos&param='+param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
				//		alert(pedido_datos.responseText);
				var existe = (pedido_datos.responseText);
						 listado_contactos();
			
					if(existe==1){
						alert('Contacto ya Existe');
						}
				
				
					} 
				}
				
			);
				
			
}
		
		
borrar_contacto = function(val_eli){
		
		var myAjax = new  Ajax.Request(
				'contenido/usuarios_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=borrar_contacto&buscar='+val_eli,
					evalScripts: true,
					onComplete: function(pedido_datos) {
				//		alert(pedido_datos.responseText);
				var existe = (pedido_datos.responseText);
					listado_contactos();
					
					} 
				}
				
			);
}	

listado_contactos = function() {
			
			var parte = document.getElementById('func_usuario').value;
			//alert(parte);
				var myAjax = new Ajax.Updater(
					'cargar_listado_contactos', 
					'contenido/usuarios_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_listado_contactos&buscar='+parte,
						evalScripts: true
					}
				);
		}		


ver_check = function(num){
	
		$('filtrox_check').style.left = 450 +'px';
		
		$('filtrox_check').style.width = 600 +'px';
	
	
		if(num!=0){
		requisitos_parte(num);
		}else{
			var num = $('parte').value;
			//alert(num);
			requisitos_parte(num);
			}	
		
		
		if ($('filtrox_check').style.display == 'none'){
					$('filtrox_check').style.display = 'block';
		} else {
					$('filtrox_check').style.display = 'none';
		}
		
}
	 
	 


	requisitos_parte = function(num) {
	
	
		var myAjax = new Ajax.Updater(
				'requisitos', 
				'contenido/control_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=ver_checks&parte='+num,
					evalScripts: true,
					onComplete: function() {
					//	alert(pedido_datos.responseText);
					}
				}
		);
	}	 
	
	
</script>
<div class='contenido' onMouseOver='h_i(this);' >
	<table border=1 >
		<tr>
			<td style='text-align:center;width:90%;'>
				<b>Lista de Espera Definitiva</b>
			</td>
			</tr>
		</table>
		<table style='width:98%;display:block;' align='center'   name='tablafiltro' id='tablafiltro' border=1 >	
			<tr>	
				<td>
						<b>Condici&oacute;n:</b>
				</td>
				<td>
						<div id='filtro_condicion' name='filtro_condicion' style='float:left;'  >
						</div>
				</td>
				<td >
						<b>Fecha Inicial:</b>
				</td>
				<td>		
						<input type="text" class='textbox' name="fc1_filtro" id="fc1_filtro" value=""  size="7">
						<img src="imagenes/date_magnify.png" id="fc1_filtro_boton">
						<img src="imagenes/delete.png" id='fini'onclick='limpiar_fc_inicial();' title='Limpiar Campo' >
					
				</td>
						<script>
										Calendar.setup({
								        inputField		:    'fc1_filtro',
								        ifFormat			:    '%d-%m-%y',
								        showsTime			:    false,
								        button				:   'fc1_filtro_boton'
								    });
						</script>
				</td>
				<td>
						<b>Fecha Final :</b>
				</td>
						<td>		
								<input type="text" class='textbox' name="fc2_filtro" id="fc2_filtro" value="" onchange='listado_ingresos_filtros();' size="7">
								<img src="imagenes/date_magnify.png" id="fc2_filtro_boton">
								<img src="imagenes/delete.png" id='ffin'onclick='limpiar_fc_final();' title='Limpiar Campo' >
					
						</td>
								<script>
										Calendar.setup({
								        inputField		:    'fc2_filtro',
								        ifFormat			:    '%d-%m-%y',
								        showsTime			:    false,
								        button				:   'fc2_filtro_boton'
								    });
								</script>
							</td>	
						<td>
								<b>Especialidad:</b>
						</td>
						<td>
								<div id='filtro_especialidad' name='filtro_especialidad' style='float:left;'  >
								</div>
						</td>
						<td style='text-align: right;'>
								<b>Grupo Base:</b>
						</td>
						<td>
								<div id='patolos' name='patolos' style='float:left;'  >
								</div>
						</td>
					
						<td style='text-align:center;width:10%;'>
								<input type="button" onClick='listado_mensajes();' id="btnvolver" name="btnvolver" style="display:block;" value="Volver"/>
						</td>
		
						
			
		</tr>
	<table style='width:98%;display:block;' align='center'  name='tablafiltro2' id='tablafiltro2'  >
				<tr class='tfila2'>
					
					<td style='text-align: right;'>
						<b>Ordenar por:</b>
					</td>
					<td style='text-align: left;'>
						<select name='orden' id='orden' style='width:100px;'>
							<option value='rut' selected >Rut</option>
							<option value='nombre' >Nombre</option>
							<option value='appaterno' >Apellido</option>
						</select>
					</td>
					<td style='text-align: right;'>
						<b>Buscar:</b>
					</td>
					<td style='text-align: left;'>
						<input type='text' name='filtro' id='filtro' style='width:100px;' onKeyUp='listado_ingresos_filtros();'>
					</td>
					<td style='text-align: right;'>
						<b>Tipo Cirug&iacute;a:</b>
					</td>
					<td style='text-align: left;'>
						<select name='tpcirugia' id='tpcirugia' style='width:100px;' onchange='listado_ingresos_filtros();' >
							<option value='-1'>--------</option>
							<option value='0'>Electiva</option>
							<option value='1' >Urgencia</option>
						</select>
					</td>
					<td style='text-align: right;'>
						<b>Prioridad:</b>
					</td>
					<td style='text-align: left;'>
						<select name='priori' id='priori' style='width:100px;' onchange='listado_ingresos_filtros();'>
							<option value='-1'>--------</option>
							<option value='0'>No</option>
							<option value='1'>Si</option>
						</select>
					</td>
					<td style='text-align:right;'>
							<b>Sistema Salud:</b>
						</td>
						<td>
							<select id='sis_salud' name='sis_salud'  class='combo' onchange='listado_ingresos_filtros();' >
								<option value='-1'>--------</option>
								<option value='1'>Armada</option>
								<option value='2'>Sisan</option>
								<option value='3'>Otras</option>
								<option value='4'>Particulares</option>
		
							</select>
						</td>
					<td style='text-align: right;'>
						<b>CMA:</b>
					</td>
					<td style='text-align: left;'>
						<select name='cma' id='cma' style='width:50px;' onchange='listado_ingresos_filtros();'>
							<option value='-1'>--------</option>
							<option value='0'>No</option>
							<option value='1'>Si</option>
						</select>
					</td>
	

				</tr>
			</table>	
	</table>
	<div id='divlistado' class='contenido' style='display:block;'>
	</div>
	<div id='divdetalle' class='contenido' style='display:none;'>
	<table border=0 >
		<tr>
			
	<div class='tfila2' style='width:98%;height:20%;float: left;'>
		<div  id='registro'>
			<center>
				<table  style='width:90%;' align='center' border=0 >
					<tr class='tfila2'>
						
						<td style='text-align: right;'>
							Nombre:
						</td>	
						<td>
							<input type='text' class='textbox' name='func_nombre' id='func_nombre' style='width:250px;' DISABLED>
							<input type='hidden' name='largopass' id='largopass' value='' >
					
						</td>
						
							<td style='text-align: right;'>
							Rut:
						</td>
						<td>
							<input type='text' name='func_usuario' id='func_usuario' style='width:65px;' DISABLED>
						
						</td>
						
						<td style="text-align:right;" id='pass1'>
							Edad:
						</td>
						<td>
							<input type='text' name='edad' id='edad' style='width:50px;' DISABLED>
						</td>
						
						<td style='text-align: right;'>
							Tel&eacute;fono:
						</td>
						<td>
							<input type='text' name='func_llico' id='func_llico' style='width:70px;' >
							<img  id='foto_ver_fonos' onclick='ver_fonos();'onMouseOver='h_i(this);' >

				
						</td>
						</tr>
						<tr class='tfila2'>
					
						<td style='text-align:right;'>
							M&eacute;dico:
						</td>
						<td>
							<input type='text' name='medico' id='medico' style='width:100px;' >
						</td>
						<td style='text-align:right;' >
										Fecha Parte
						</td>
						<td>				
									<input type="text" class='textbox' name="fc_parte" id="fc_parte" value="" size="10">
									<!--img src="imagenes/date_magnify.png" id="fecha1_boton" disabled -->
						</td>
									<!--script>
											Calendar.setup({
									        inputField		:    'fc_parte',
									        ifFormat			:    '%d-%m-%Y',
									        showsTime			:    false,
									        button				:   'fecha1_boton'
									    });
									</script-->
						</td>
						
						<td style='text-align:right;'>
								Fecha Digitaci&oacute;n
						</td>
						<td>		
								<input type="text" class='textbox' name="fc_dig" id="fc_dig" value="<?php Echo($fecha)?>" size="10">
						</td>
						<td style='text-align:right;' >
								Fecha Pabell&oacute;n
						</td>
						<td>		
								<input type="text" class='textbox' name="fc_pab" id="fc_pab" value="" size="10">
								<img src="imagenes/date_magnify.png" id="fecha3_boton">
						</td>
								<script>
										Calendar.setup({
								        inputField		:    'fc_pab',
								        ifFormat			:    '%d-%m-%y',
								        showsTime			:    false,
								        button				:   'fecha3_boton'
								    });
								</script>
							</td>
							</tr>
						<tr class='tfila2'>
						
						<td style='text-align:right;'>
							Sistema Salud:
						</td>
						<td>
							<select id='salud' name='salud'  class='combo'>
								<option value='-1'>----Seleccione----</option>
								<option value='1'>Armada</option>
								<option value='2'>Sisan</option>
								<option value='3'>Otras</option>
								<option value='4'>Particulares</option>
		
							</select>
						</td>
						
					<td style='text-align: right;'>
							Categor&iacute;a:
						</td>
						<td>
							<select id='categ' name='categ'  class='combo'>
								<option value='-1'>----Seleccione----</option>
								<option value='1'>S&iacute mismo</option>
								<option value='2'>Carga</option>
		
							</select>
						</td>	
				
							<td style='text-align:right;'>
							Especialidad:
						</td>
						<td>
							<select id='espe' name='espe'  class='combo'>
								<option value=-1>-----------------</option>
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
					<td style='text-align: right;'>
							Grupo Base:
						</td>
						<td>
							<select id='base' name='base'  class='combo'>
								<option value=-1>-----------------</option>
											<?php 
												$sql="select id_patologia,glosa_patologia from patologias ORDER BY glosa_patologia asc ";
												$rs = $db->Execute($sql);
												while (!$rs->EOF) {
													echo "<option value=".$rs->fields[0]." SELECTED>".htmlentities($rs->fields[1])."</option>";
													$rs->movenext();
												}											
											 ?>
					
							</select>
						</td>
							</tr>
						<tr class='tfila2'>
					
					<td style='text-align: right;'>
							Condicion:
						</td>
						<td>
							<select id='cond' name='cond'  class='combo'>
								<option value='-1'>----Seleccione----</option>
								<option value='0'>LE</option>
								<option value='1'>PR</option>
								<option value='2'>SU</option>
								<option value='3'>OP</option>
		
							</select>
						</td>	
				</tr>
				<table style='width:90%;'align='center' border=1 >
			<tr>
				<td width="227" rowspan="2">
							Medicamentos:
						
		    	<input type=text size=30 id="txt_referencia" name="txt_referencia" onClick="cam_ref();" value="">
		    </td>
		    <td width="50">
		    	<input type="button" value="-->"  name="b_add_ref" id="b_add_ref" onclick="add_ref();">
		    </td>
		    <td width="300" rowspan="2">
		    	<div id='patolo2' style='float:left;' disabled >
						</div>
		  
		    	<input type="hidden" name="val_referidos" id="val_referidos" value="">
		    	<input type="hidden" name="parte" id="parte" value="">
		  
		    </td>
		    
		  </tr>
		  <tr>
		    <td>
		    	<input type="button" value="<--"  name="b_rem_ref" id="b_rem_ref" onclick="rem_ref2();">
		    </td>
		  </tr>
		</table>
				<table  style='width:90%;' align='center'  border=1 >
				
							<tr>
					
							<td style='width:30%;'>
								Observaciones:
							</td>
							<td>
									<textarea  cols='2' rows='4' id='obs' name='obs' ></textarea>
		
							</td>	
					<td style='width:30%;'>
										<div onclick='ver_parte();'>
											<img title='PARTE MEDICO PACIENTE' src='imagenes/parte.png'">
										</div>	
											
					</td>			
					<td style='width:15%;'>
										<div onclick='ver_check(0);'>
											<img title='REQUERIMIENTOS' src='imagenes/check3.png'">
										</div>
																			
					</td>
				<td style='width:30%;'>
				<input type="button" onClick='agregar_notas();' name="btnnotas" value="Agregar Notas"/>
			</td>	
				</tr>	
			</table>
		<!--table border="2px" width="90%" id="barra" style="display:block">
		<tr style='heigth:25px;'>
			<td style='width:20%;text-align:center;'>
				<input type="button" onClick='agregar_notas();' name="btnnotas" value="Agregar Notas"/>
			</td>
		</tr>
	</table-->				
	<table style='width:90%;' align='center' >
		<tr>
			<td width="200px" style='text-align: left;'>
				<div class='sub-content3' name='divnotas' id='divnotas' style="height:100px;width:98%;">
				</div>
			</td>
		</tr>
	</table>
					
					<table style='width:90%;' align='center' >
							<td>
									<div  id='agregar_boton' style='width:80px;'>
										<input type='button' onClick='agregar_usuario();' value='Agregar'>
									</div>
							</td>
							<td>
									<div  id='guardar_boton' style='width:80px;display: none;'>
									<input type='button' onClick='guardar_detalle_ingreso();' value='Guardar'>
									</div>
							</td>
							<td>
							
									<div  id='borrar_boton' style='width:80px;display: none;'>
										<input type='button' onClick='borrar_usuario();' value='Eliminar'>
									</div>
							</td>
							<td>
							
									<div  id='cancelar_boton' style='width:80px;display: none;'>
											<input type="button" onClick='listado_ingresos_filtros();' id="btnvolver" name="btnvolver" style="display:block;" value="Volver"/>
									</div>
							</td>
			</table>
				</table>
			</center>
		
		</div>
		
			
			
			
		</tr>
	</table>
	
	</div>
</div>
</html>
		<input id="X-coord" type="hidden" value="">
		<input id="X-ancho" type="hidden" value="">
		<input id="X-alto" type="hidden" value="">
</body>

<?php
	$html.= "<div id='filtrox' name='filtrox'  class='filtrodiv' style='display:none;'>";
							$html.= "<table>
														<tr>
															<td style='text-align:center;'>
																<img src='imagenes/fono2.png'>
															</td>
														<tr>
												</table>
												<table>
													<tr>
															<td style='text-align:center;'>
															<select id='tp_contacto' name='tp_contacto' style='width:80px' class='combo'>
															<option value='-1'>-Seleccione-</option>
															<option value='casa'>Casa</option>
															<option value='movil'>M&oacute;vil</option>
															<option value='familiar'>Familiar</option>
															<option value='trabajo'>Trabajo</option>
															<option value='cercano'>Cercano</option>
															<option value='llico'>Llico</option>
									
														</select>
															</td>
															<td td style='text-align:center;'>
																<input type='text' name='fono_contacto' id='fono_contacto' size='10' onkeypress='return justNumbers(event);' >
															</td>
													</tr>
													</table>
													<table>
													<tr>		
															<td td style='text-align:center;'>
																<input type='button' name='contacto' id='contacto' value='Guardar' onclick='guardar_contacto();'  >
															</td>
													</tr>		
												</table>
												<table>
													<div id='cargar_listado_contactos' name='cargar_listado_contactos'>
													</div>
												</table>";
							$html.= "</div>";
							print($html);
	$html.= "<div id='filtrox_check' name='filtrox_check'  class='filtrodiv' style='display:none;'>";
							$html.= "<table>
													<tr>
															<td style='text-align:center;'>
															<b>Requerimientos</b>
															</td>
													</tr>
													<tr>
													<table>
															<div  class='fpapel'name='requisitos' id='requisitos' style='height:250px;width:99%;position:relative;'  >
															</div>
													</table>	
												
													<tr>
											</table>";
							$html.= "</div>";
							print($html);
			
	

}
?>