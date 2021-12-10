<?php
	require_once("../conexion/conexion.php");
	$fecha = date("d-m-y");
	if($_GET['form']=='usuarios') {
?>
<head>
	<link rel="stylesheet" href="css/usuarios.css" type="text/css">
	
</head>	
	<script>
		cargar_listado = function() {
			param = 'tipo=personal_listado&orden='+$('orden').value+'&buscar='+$('filtro').value;
			var myAjax = new Ajax.Updater(
				'listado', 
				'contenido/usuarios_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true
				}
				
			);
		}



limpiar = function(){
	
						$('func_usuario').value ='';
						$('func_nombre').value = '';
					//	$('func_appaterno').value ='';
					//	$('func_apmaterno').value ='';
						$('edad').value = '';
						$('medico').value = '';
						$('fc_parte').value ='';
						$('func_llico').value = '';
						$('espe').value =-1;
						$('obs').value = '';
						$('fc_pab').value='';
						$('fc_dig').value='';
						$('salud').value=-1;
						$('categ').value=-1;
						$('parte').value='';
						$('patolo').value=-1;

				
	
	
	}
	

		seleccionar_paciente = function(idusuario,fila) {
			
			$('filtrox').style.display='none';
			$('foto_ver_fonos').src = "imagenes/agregar.png";
			$('foto_ver_fonos').title='Contactos Telef\u00f3nicos';

			sel_tr('tabla_usuarios',fila,'tfila1','tfila2','tselect');
			var myAjax = new Ajax.Request(
				'contenido/usuarios_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=paciente&buscar='+(idusuario*1),
					onComplete: function(pedido_datos) {
    				//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
						$('func_usuario').value = datos[0];
						$('func_usuario').disabled=true;
						$('func_nombre').value = datos[1]+" "+datos[2]+" "+datos[3];
						$('func_nombre').disabled=true;
				//		$('func_appaterno').value = datos[2];
				//		$('func_appaterno').disabled=true;
				//		$('func_apmaterno').value = datos[3];
				//		$('func_apmaterno').disabled=true;
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
						$('ver').style.display='block';
						$('dv_rut').value = datos[11];
						$('dv_rut').disabled=true;
					
					//	alert($('parte').value);
						
						var pato2 = $('espe').value;
						cargar_pato(pato2);
						var usu = 	$('parte').value;
						cargar_medi(usu);
						
						if((datos[5]==1)||(datos[5]==null)){
								busca_fono();
								$('func_llico').value = '';
								$('func_llico').disabled=false;
							
							}else{
								$('func_llico').value = datos[5];
								$('func_llico').disabled=false;
							}
						$('agregar_boton').style.display='none';
						$('cancelar_boton').style.display='block';
						$('guardar_boton').style.display='block';
						cargar_cargos(idusuario);
						$('guardarcargo_boton').style.display='block';
						cargar_listado_permisos(idusuario);
						listado_contactos();

					}
				}
			);
		}
		
	
		cancelar = function() {
			unsel_tr("tabla_usuarios","tfila1","tfila2");
			
			$('func_usuario').value = '';
			$('func_usuario').disabled=true;

			$('func_dvrut').value = '';
			$('func_dvrut').disabled=true;

			$('func_nombre').value = '';
			$('func_nombre').disabled=true;
	
	//		$('func_appaterno').value = '';
	//		$('func_appaterno').disabled=true;
	
			$('func_pw').value = '';
			$('func_pw').disabled=true;
			
		//	$('func_apmaterno').value = '';
		//	$('func_apmaterno').disabled=true;

			$('func_llico').value = '';
			$('func_llico').disabled=true;

			$('func_grado').value = '';
			$('func_grado').disabled=true;

			$('func_email').value = '';
			$('func_email').disabled=true;

			$('copiar1').checked=false;
			$('copiar2').checked=true;
			$('imprimir1').checked=false;
			$('imprimir2').checked=true;
			$('odm1').checked=false;
			$('odm2').checked=true;
			$('copiar1').disabled=true;
			$('copiar2').disabled=true;
			$('imprimir1').disabled=true;
			$('imprimir2').disabled=true;
			$('odm1').disabled=true;
			$('odm2').disabled=true;
			
			$('agregar_boton').style.display='block';
			$('borrar_boton').style.display='none';
			$('desbloquear_boton').style.display='none';
			$('guardar_boton').style.display='none';
			$('cancelar_boton').style.display='none';
		}
			
	
		
		
	ver_parte = function(){
	
			var  num =  document.getElementById('parte').value;
			ver_solicitud_win = window.open('pdf/parte_pdf.php?tipo=ver&num='+num,'ver_solicitud','left=200,top=10,status=1');
			ver_solicitud_win.focus();
	
	/*
		var po_x=(screen.width/2)-(550/2); 
		var po_y=(screen.Height/2)-(1100/2); 
		var numparte = document.getElementById('parte').value;
		//alert(numparte);
		var ruta	 = 'contenido/ingresoparte.php?form=ingreso&identificador='+numparte;
		buscar_win = window.open(ruta,'mensaje','left=po_x,top=po_y,width=1100,height=550,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no');
		buscar_win.focus();
	*/
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
		
		
		cargar_pato = function(pato2) {
			
				var myAjax = new Ajax.Updater(
					'patolos', 
					'contenido/usuarios_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_pato&buscar='+pato2,
						evalScripts: true
					}
				);
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
		
		//cargar_medi();
		
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
				resp = (pedido_datos.responseText);
				
				if (resp==0){
 						
 						alert("Error al Ingresar Medicamento.:");
						
 						}else{
							var us=$('parte').value;
							cargar_medi(us);
							$('txt_referencia').value='';
						}
		
		
				}
			}
		);
		
			
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
				resp = (pedido_datos.responseText);
				
				if (resp==0){
 						
 						alert("Error al borrar Medicamento.:");
						
 						}else{
							var us=$('parte').value;
							cargar_medi(us);
						} 
	
				}
			}
		);
	}


		cargar_listado();
		
		
		guardar_ingreso = function(){
		
		
		var fc_pab				= document.getElementById('fc_pab').value;
		var fc_dig				= document.getElementById('fc_dig').value;
		var salud					= document.getElementById('salud').value;
		var categ				  = document.getElementById('categ').value;
		var parte				  = document.getElementById('parte').value;
		var patolo				= document.getElementById('patolo').value;
		
				if(fc_pab!=""){
			if(fc_dig > fc_pab){
				
				var corte = fc_dig.split("-");
				numero_fecha = corte[0]+corte[1]+corte[2];
				
				alert(numero_fecha);
				return;
				
				alert('Fecha de Pabell\u00f3n debe ser superior');
				return;
				}
			
			}
			
			if(salud ==-1){
				alert('Debe Indicar Sistema de Salud');
				return;
				}
			if(categ ==-1){
				alert('Debe Indicar Categor\u00eda');
				return;
				}
			/*	if(patolo ==-1){
				alert('Debe Indicar Patolog\u00eda');
				return;
				}*/
	
   			    	
			param='&fc_pab='+fc_pab+'&fc_dig='+fc_dig+'&salud='+salud+'&categ='+categ+'&parte='+parte+'&patolo='+patolo;
			
		//	alert(param);

			var myAjax = new  Ajax.Request(
				'contenido/usuarios_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=guardar_ingreso&param='+param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
									   resp = (pedido_datos.responseText);
					//   alert(resp);
					   
 						  if ((resp==0)||(resp==1)){
 
  											alert("Problemas al Ingresar Datos:");
 									}	
 									else{
 										 alert("Datos ingresados Correctamente:");
 										 limpiar();
									 	cargar_listado();
	
 										}
 						} 
					}
				
		);
}
		
		mouser = function(event){
		
		var x;
		x=event.clientX + 5;
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
					if(existe==0){
						alert('Error.:');
						}					
						else if(existe==1){
							alert('Contacto ya Existe');
						}
							if(existe==2){
												 listado_contactos();
												 busca_fono();
		
								//alert('Contacto Guardado Correctamente.:');
								}					
					
						
						
				$('tp_contacto').value="-1";
				$('fono_contacto').value="";		
		
				
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
				resp = (pedido_datos.responseText);
				
				if (resp==0){
 						
 						alert("Error al borrar.:");
						
 						}else if (resp==1){
						listado_contactos();
						busca_fono();
				
					} 
				}
			}
		);
	}
		
		
busca_fono = function(){
	
	var rut					  = document.getElementById('func_usuario').value;
	
		
	var myAjax = new  Ajax.Request(
				'contenido/usuarios_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=busca_telefonos&rut='+rut,
					evalScripts: true,
					onComplete: function(pedido_datos) {
				//		alert(pedido_datos.responseText);
						resp = (pedido_datos.responseText);
				
				if (resp==0){
 						
 						alert("Error al buscar Fono.:");
						
 						}else{
 							
 								$('func_llico').value = resp;
														
 							}
			
				
				
					} 
				}
				
			);
	
	
	}		
		
		
		
		
		
		
		
		
		
	</script>
	<body onMouseMove="mouser(event);" >
	<div class='tfila2' style='width:30%;float: left;' >
			
		<span><img src='imagenes/busqueda.png'><b>B&uacute;squeda Pacientes</b></span>
		</tr>
		<center>
			<table class='tableuser' style='width:98%;'>
				<tr class='tfila2'>
					<td style='text-align: right;'>
						<b>Filtrar:</b>
					</td>
					<td style='text-align: left;'>
						<input type='text' name='filtro' id='filtro' style='width:100px;' onKeyUp='cargar_listado();'>
					</td>
				</tr>
				<tr class='tfila2'>
					<td style='text-align: right;'>
						<b>Ordenar por:</b>
					</td>
					<td style='text-align: left;'>
						<select name='orden' id='orden' style='width:100px;' onchange='cargar_listado();'>
							<option value='rut'>Rut</option>
							<option value='nombre' >Nombre</option>
							<option value='appaterno' selected>Apellido</option>
						</select>
					</td>
				</tr>
			</table>
		</center>
		<!--span><img src='imagenes/listado_user.png'><b> Usuarios del Sistema</b></span-->
		<div class='fpapel' id='listado' style='height:300px;overflow:auto;'>
		</div>
	</div>
	<div class='tfila2' style='width:70%;float: left;'>
		<span><img src='imagenes/user.png'><b>Datos del Paciente</b></span>
		<div  class='tfila2' id='registro'>
			<center>
				<table  style='width:98%;' align='center' border=0>
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
							<input type='text' name='dv_rut' id='dv_rut' style='width:8px;' DISABLED>
						
						</td>
						
						<td style='text-align: right;' id='pass1'>
							Edad:
						</td>
						<td>
							<input type='text' name='edad' id='edad' style='width:50px;' DISABLED>
						</td>
						</tr>
						<tr class='tfila2'>
					
						<td style='text-align: right;'>
							Tel&eacute;fono:
						</td>
						<td>
							<input type='text' name='func_llico' id='func_llico' style='width:70px;' >
							<img  id='foto_ver_fonos' onclick='ver_fonos();'onMouseOver='h_i(this);' >

				
						</td>
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
						</tr>
						<tr class='tfila2'>
						
						<td style='text-align:right;'>
								Fecha Digitaci&oacute;n
						</td>
						<td>
								<input type="text" class='textbox' name="fc_dig" id="fc_dig" value="<?php Echo($fecha)?>" size="7" disabled >
								<img src="imagenes/date_magnify.png" id="fecha2_boton">
						</td>
								<script>
										Calendar.setup({
								        inputField		:    'fc_dig',
								        ifFormat			:    '%d-%m-%y',
								        showsTime			:    false,
								        button				:   'fecha2_boton'
								    });
								</script>
							</td>
						<td style='text-align:right;' >
								Fecha Pabell&oacute;n
						</td>
						<td>		
								<input type="text" class='textbox' name="fc_pab" id="fc_pab" value="" size="7">
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
						</tr>
						<tr class='tfila2'>
						
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
							<select id='espe' name='espe' onclick="cargar_division();" class='combo'>
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
						<div id='patolos' name='patolos' style='float:left;'  >
						</div>
						</td>
						
				
					</tr>
					<table style='width:98%;' align='center' border=1 >
			<center>
			<tr>
				<td width="227" rowspan="2" style='text-align:center;' >
							Medicamentos:
				
		    	<input type=text size=30 id="txt_referencia" name="txt_referencia" onClick="cam_ref();" value="">
		    </td>
		    <td width="50" style='text-align:center;'>
		    	<input type="button" value="-->"  name="b_add_ref" id="b_add_ref" onclick="add_ref();">
		    </td>
		    <center>
		    <td width="250" rowspan="2">
		    	
		    	<div id='patolo2' style='float:left;' disabled  >
						</div>
		  		
		    	<input type="hidden" name="val_referidos" id="val_referidos" value="">
		    	<input type="hidden" name="parte" id="parte" value="">
		  
		    </td>
		    </center>
		  </tr>
		  <tr>
		    <td style='text-align:center;'>
		    	<input type="button" value="<--"  name="b_rem_ref" id="b_rem_ref" onclick="rem_ref2();">
		    </td>
		  </tr>
		 </center> 
		</table>
				<table style='width:98%;' align='center' >
			
						<tr class='tfila2'>
					
							<td  style='text-align: right;'>
								Observaciones:
							</td>
							<td>
									<textarea  cols='2' rows='4' id='obs' name='obs' ></textarea>
		
							</td>	
							<td style='text-align:LEFT;'>
										<div onclick='ver_parte();' onMouseOver='h_i(this);'id='ver' style='display:none;' >
											<img title='PARTE MEDICO PACIENTE' src='imagenes/parte.png'">
										</div>	
							</td>				
							
				</tr>	
			</table>
				
				
			</center>
		</div>
		
				<table  style='width:48%;'>
							<td>
									<div  id='agregar_boton' style='width:80px;' style='width:80px;display:none;' >
										<input type='button' value='Agregar'>
									</div>
							</td>
							<td>
									<div  id='guardar_boton' style='width:80px;display: none;' onMouseOver='h_i(this);' >
									<input type='button' onClick='guardar_ingreso();' value='Guardar'>
									</div>
							</td>
							<td>
							
									<div  id='borrar_boton' style='width:80px;display: none;'>
										<input type='button' onClick='borrar_usuario();' value='Eliminar'>
									</div>
							</td>
							<td>
							
									<div  id='cancelar_boton' onMouseOver='h_i(this);' style='width:80px;display: none;'>
										<input type='button' onClick='cancelar();' value='Cancelar'>
									</div>
							</td>
			</table>		
	</div>
</div>
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
		
	}
?>