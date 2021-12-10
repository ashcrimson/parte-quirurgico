<?php
	require_once("../conexion/conexion.php");
	if($_GET['form']=='examenes') {
?>

<head>
	
	<link rel="stylesheet" href="css/usuarios.css" type="text/css">
	<link rel="stylesheet" href="css/index.css" type="text/css">
<script src="scripts/menu.js" type="text/javascript"></script>
<script src="scripts/json.js" type="text/javascript" language="javascript" charset="utf-8"></script>
<script src="scripts/prototype.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/getElementsByAttribute.js"></script>

</head>	

	<script>
		
		cargar_listado = function() {
			
			param = 'tipo=personal_listado_paciente_le&orden='+$('orden').value+'&buscar='+$('filtro').value;
			var myAjax = new Ajax.Updater(
				'listado', 
				'contenido/examenes_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true
				}
				
			);
		}

		
		seleccionar_paciente = function(idusuario,parte) {
			$('filtrox').style.display='none';
			$('foto_ver_fonos').src = "imagenes/agregar.png";
			$('foto_ver_fonos').title='Contactos Telef\u00f3nicos';
	
			var myAjax = new Ajax.Request(
				'contenido/examenes_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=personal&buscar='+idusuario,
					onComplete: function(pedido_datos) {
    				//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
						$('idusuario').value = idusuario;
						$('func_usuario').value = datos[0];
						$('func_usuario').disabled=true;
						$('func_nombre').value = datos[1];
						$('func_nombre').disabled=true;
						$('edad').value = datos[2];
						$('edad').disabled=true;
						$('func_llico').value = datos[3];
						$('func_llico').disabled=true;
						$('parte_numero').value = parte;
				//		$('agregar_boton').style.display='none';
				//		$('borrar_boton').style.display='block';
					//	$('desbloquear_boton').style.display='block';
						$('cancelar_boton').style.display='block';
						$('guardar_boton').style.display='block';
						requisitos_parte(idusuario,parte);
					//	$('guardarcargo_boton').style.display='block';
					}
				}
			);
		}
		
		
	requisitos_parte = function(idusuario,parte) {
		
		var myAjax = new Ajax.Updater(
				'requisitos', 
				'contenido/examenes_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=deptos&rut='+idusuario+'&parte='+parte,
					evalScripts: true,
					onComplete: function() {
					//	alert(pedido_datos.responseText);
					}
				}
		);
	}
	guardar_requerimientos = function(){
		
		
		var part = document.getElementById('parte_numero').value;
		var param = '&part='+part;
		var idusuario = document.getElementById('idusuario').value;
	//	var resultado = new Array();
	//	var k = 0;
		var checkboxs = getElementsByAttribute(document.getElementById("requisitos"), "*", "id");
			for (var i=0; i<checkboxs.length; i++) {
				if (checkboxs[i].checked) {
					var id=checkboxs[i].id;
		//			resultado[k] = id;
		//			k++;
				
			
			
		
    //Lo convierto a objeto
  //  var jObject={};
   //7 for(i in resultado)
   // {
    //    jObject[i] = resultado[i];
   // }

    //Luego lo paso por JSON  a un archivo php llamado js.php

   // jObject= JSON.stringify(jObject);
    
		//alert(jObject);	
			
			
		//	var serializedArr = JSON.stringify(resultado);
		//	var unpackArr = JSON.parse( serializedArr );
			
		//	alert(unpackArr);


			
	//		alert('tipo=guardar_req2&param='+param+'&resultado='+id);
				

					var myAjax = new  Ajax.Request(
					'contenido/examenes_db.php', 
					{
						method: 'get', 
						parameters:'tipo=guardar_req2&param='+param+'&resultado='+id,
						evalScripts: true,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						//alert('Check Ingresado:.');
						requisitos_parte(idusuario,part);
					
						}
					}
				);
		}
	}
					
	
}		

		cargar_listado();
		
		
	ver_parte = function(){
		
		var  num = $('parte_numero').value;
window.open('pdf/parte_pdf.php?tipo=ver&num='+num);
/*
			ver_solicitud_win = window.open('pdf/parte_pdf.php?tipo=ver&num='+num,'ver_solicitud','left=10,top=10,status=1');
			ver_solicitud_win.focus();
			window.close();
		
		var ruta	 = 'contenido/ingresoparte.php?form=ingreso&identificador='+$('parte_numero').value;
		buscar_win = window.open(ruta,'mensaje','left=500,top=100,width=1100,height=650,status=0');
		buscar_win.focus();
	*/
	}
	
	mouser = function(event){
		
		var x;
		x=event.clientX + 5;
		$('X-ancho').value = screen.width;
		$('X-alto').value = screen.height;
		$('X-coord').value = x + 'px';
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
		
	</script>
	<div class='tfila2' style='width:40%;float: left;' >
			
		<span><img src='imagenes/busqueda.png'><b>B&uacute;squeda Pacientes</b></span>
		</tr>
		<center>
			<table class='tableuser' style='width:98%;'>
				<tr class='tfila2'>
					<td style='text-align: right;'>
						<b>Ordenar por:</b>
					</td>
					<td style='text-align: left;'>
						<select name='orden' id='orden' style='width:100px;' onchange='cargar_listado();'>
							<option value='rut'>Rut</option>
							<option value='nombres' >Nombre</option>
							<option value='appaterno' selected>Apellido</option>
						</select>
					</td>
					<td style='text-align: right;'>
						<b>Filtrar:</b>
					</td>
					<td style='text-align: left;'>
						<input type='text' name='filtro' id='filtro' style='width:100px;' onKeyUp='cargar_listado();'>
					<input type="hidden" id='parte_numero' >
					<input type="hidden" id='idusuario' >
					</td>
				</tr>
				
			</table>
		</center>
		<!--span><img src='imagenes/listado_user.png'><b> Usuarios del Sistema</b></span-->
		<div class='fpapel' id='listado' >
		</div>
	</div>
	<div class='tfila2' style='width:60%;float: left;'>
		<span><img src='imagenes/user.png'><b>Datos del Paciente</b></span>
		<div  class='tfila2' id='registro'>
			<center>
				<table  style='width:98%;'>
					<tr class='tfila2'>
						
						<td style='text-align: right;width:65px;'>
							Nombre:
						</td>	
						<td>
							<input type='text' class='textbox' name='func_nombre' id='func_nombre' style='width:180px;' DISABLED>
							<input type='hidden' name='largopass' id='largopass' value='' >
				
						</td>
							<td style='text-align: right;'>
							Rut:
						</td>
						<td>
							<input type='text' name='func_usuario' id='func_usuario' style='width:70px;' DISABLED>
							
						</td>
						
						<td style='text-align: right;' id='pass1'>
							Edad:
						</td>
						<td>
							<input type='text' name='edad' id='edad' style='width:20px;' DISABLED>
						</td>
						<td style='text-align: right;'>
							Tel&eacute;fono:
						</td>
						<td>
							<input type='text' name='func_llico' id='func_llico' style='width:80px;' DISABLED>
							<img  id='foto_ver_fonos' onclick='ver_fonos();'onMouseOver='h_i(this);' >
					
						</td>
						<td >
										<div onclick='ver_parte();' onMouseOver='h_i(this);' >
											<img title='PARTE MEDICO PACIENTE'  src='imagenes/parte.png'">
										</div>	
											
					</td>			
		
						
					</tr>
					
		
						
	</div>
	<table>
		<div  class='fpapel'name='requisitos' id='requisitos' style="height:250px;width:99%;position:relative;overflow:auto"  >
		</div>
	</table>	
	
	<table  style='width:48%;'>
							<td>
									<div  id='guardar_boton' style='width:80px;display: none;'>
									<input type='button' onClick='guardar_requerimientos();' value='Guardar'>
									</div>
							</td>
							<td>
							
									<div  id='borrar_boton' style='width:80px;display: none;'>
										<input type='button' onClick='borrar_usuario();' value='Eliminar'>
									</div>
							</td>
							<td>
							
									<div  id='cancelar_boton' style='width:80px;display: none;'>
										<input type='button' onClick='cancelar();' value='Cancelar'>
									</div>
							</td>
			</table>
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