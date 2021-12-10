<?php
	require_once("../conexion/conexion.php");
	$fecha = date("d-m-y");
	if($_GET['form']=='tabla') {
?>
<head>
	<link rel="stylesheet" href="css/usuarios.css" type="text/css">
	
</head>	
	<script>
		
		
	cargar_filtro_especialidad = function() {
			//alert(inicio);
				var myAjax = new Ajax.Updater(
					'filtro_especialidad', 
					'contenido/tabla_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_filtro_especialidad',
						evalScripts: true,
						
					}
					
				);
		}
			
cargar_filtro_especialidad();	
	
		

cargar_listado = function() {
	
	$('encabezado').style.display='block';
	$('listado').style.display='block';
	$('divdetalle').style.display='none';
				
	
	var activo = 1;
			param = 'tipo=personal_listado&activo='+activo;
			var myAjax = new Ajax.Updater(
				'listado', 
				'contenido/tabla_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true,
						onComplete: function(pedido_datos) {
				//		alert(pedido_datos.responseText);
			//	alert(pedido_datos.responseText);
				
				}
			}
				
			);

}


			
cargar_listado2 = function() {
	

			param = 'tipo=personal_listado&orden='+$('orden').value+'&buscar='+$('filtro').value;
			param = param +'&filtro_esp='+$('filtro_esp').value+'&fc1_filtro='+$('fc1_filtro').value+'&fc2_filtro='+$('fc2_filtro').value;
			var myAjax = new Ajax.Updater(
				'listado', 
				'contenido/tabla_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					//alert(pedido_datos.responseText);
				
				}
					
				}
				
				
			);

}




limpiar = function(){
	
				$('fc1_filtro').value ='';
				$('fc2_filtro').value = '';
				cargar_listado();
}
	

		
	ver_parte = function(){
	
			var  num =  document.getElementById('parte').value;
			ver_solicitud_win = window.open('pdf/parte_pdf.php?tipo=ver&num='+num,'ver_solicitud','left=200,top=10,status=1');
			ver_solicitud_win.focus();
	
	}




		cargar_listado();
		

		

	
		
		
		
		marcado = function(xxx){
			
			
			var myAjax = new  Ajax.Request(
				'contenido/tabla_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=ubicado&param='+xxx,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					resp = (pedido_datos.responseText);
					
					if (resp==1){
 
  											alert("Problemas al Ingresar Datos:");
 									}else{
 										
 										alert("Paciente LLamado");
 										}
 					cargar_listado();
						
					}
				}
			);	
			
	}
		
seleccionar_paciente = function(nump) {
	
			$('fecha_boton').src = "imagenes/agregar.png";

		//	alert(nump);
		$('listado').style.display='none';
		$('encabezado').style.display='none';
		$('divdetalle').style.display='block';
		$('nuevo_pab').value=-1;		
		$('hora1').value=-1;
		$('hora2').value=-1;
		$('nuevo_tp_anes').value=-1;
			var myAjax = new Ajax.Request(
				'contenido/tabla_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=personal&buscar='+nump,
					onComplete: function(pedido_datos) {
    				//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
    				$('listado').style.display='none';
						$('divdetalle').style.display='block';
						$('horai').value=datos[0];
						$('horaf').value=datos[1];
						var aux = datos[2].split(":");
						pab 	= aux[0];
						fecha = aux[1];
						$('pab').value=pab;
						$('fecha').value=fecha;
						$('fecha_insc').value = datos[3];
						$('anes').value = datos[4];
						$('idpab').value = datos[5];
						$('espe').value = datos[6];
						
						
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
	
	reprogramacion = function(){
		
		
		$('agenda_nueva').style.left = $('X-coord').value;
		if ($('agenda_nueva').style.display == 'none'){
					$('agenda_nueva').style.display="block";
					$('fecha_boton').src = "imagenes/delete.png";
			
		} else {
					$('agenda_nueva').style.display = 'none';
					$('fecha_boton').src = "imagenes/agregar.png";
		}
			
			var idpab = document.getElementById('idpab').value;
			var espe  = document.getElementById('espe').value;
		//	alert(idpab);
				var myAjax = new Ajax.Updater(
					'cargar_listado_pabellones', 
					'contenido/tabla_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_listado_pabellones&idpab='+idpab+'&espe='+espe,
						onComplete: function(pedido_datos) {
    				//alert(pedido_datos.responseText);
    				}
					}
				);
				
		
		}
		
		
		
			
	</script>
	<body onMouseMove="mouser(event);">
	<div class='tfila2' style='width:100%;' >
		<input id="X-coord" type="hidden" value="">
		<input id="X-ancho" type="hidden" value="">
		<input id="X-alto" type="hidden" value="">


		</tr>
		<center>
			<table class='tableuser' style='width:98%;' id='encabezado'>
				<tr class='tfila2'>
					<input type="hidden" id='idpab' >
					<input type="hidden" id='espe' >
					<td style='text-align: right;'>
						<b>buscar por:</b>
					</td>
					<td style='text-align: left;'>
						<select name='orden' id='orden' style='width:100px;' onchange='cargar_listado2();'>
							<option value='rut'>Rut</option>
							<option value='nombre' >Nombre</option>
							<option value='appaterno' selected>Apellido</option>
						</select>
					</td>
					<td style='text-align: right;'>
						<b>Ingrese:</b>
					</td>
					<td style='text-align: left;'>
						<input type='text' name='filtro' id='filtro' style='width:100px;' onKeyUp='cargar_listado2();'>
					</td>
					<td >
						<b>Fecha Inicial:</b>
				</td>
				<td>		
						<input type="text" class='textbox' name="fc1_filtro" id="fc1_filtro" value="" onchange='cargar_listado2();'  size="7">
						<img src="imagenes/date_magnify.png" id="fc1_filtro_boton">
						<img src="imagenes/delete.png" id='fini'onclick='limpiar();' title='Limpiar Campo' >
					
				</td>
						<script>
										Calendar.setup({
								        inputField		:    'fc1_filtro',
								        ifFormat			:    '%d/%m/%Y',
								        showsTime			:    false,
								        button				:   'fc1_filtro_boton'
								    });
						</script>
				</td>
				<td>
						<b>Fecha Final :</b>
				</td>
						<td>		
								<input type="text" class='textbox' name="fc2_filtro" id="fc2_filtro" value="" onchange='cargar_listado2();' size="7">
								<img src="imagenes/date_magnify.png" id="fc2_filtro_boton">
								<img src="imagenes/delete.png" id='ffin'onclick='limpiar();' title='Limpiar Campo' >
					
						</td>
								<script>
										Calendar.setup({
								        inputField		:    'fc2_filtro',
								        ifFormat			:     '%d/%m/%Y',
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
				
				</tr>
			</table>
		</center>
		<!--span><img src='imagenes/listado_user.png'><b> Usuarios del Sistema</b></span-->
		<div class='fpapel' id='listado' style='height:400px;'>
		</div>
		<div id='divdetalle' class='contenido' style='display:none;'>
	<center>
	<table border=0 >
		<tr>
			
	<div class='tableuser' style='width:98%;'>
				<table class='tableuser' style='width:98%;' >
					<tr >
						
						<td>
							Pabell&oacute;n:
						</td>	
						<td>
							
						<input type="text" id='pab' size='7'>
						</td>
						<td>
							<select id='nuevo_pab' name='nuevo_pab'    >
								<option value='-1'>--------</option>
								<option value='A1'>A1</option>
								<option value='A2'>A2</option>
								<option value='B1'>B1</option>
								<option value='B2'>B2</option>
								<option value='B3'>B3</option>
								<option value='B4'>B4</option>
								<option value='T1'>T1</option>
								<option value='C1'>C1</option>
								<option value='C2'>C2</option>
		
							</select>
						</td>
						<td>
							Fecha Insc.:
						</td>	
						<td>
							<input type="text" id='fecha_insc' size='7'>
							
						</td>
						
						<td>
							Fecha Pab.:
						</td>	
						<td>
							<input type="text" id='fecha' size='7'>
							<img  onclick='reprogramacion();' id="fecha_boton">
						
				</td>
						
						<td>
							Hora Inicio:
						</td>	
						<td >
							
						<input type="text" size='7' id='horai'>
						</td>
						<td>
							<select id='hora1' name='hora1' style='width:70px;display:block;' >
								<option value='-1'>--------</option>
								<option value='08:00'>08:00</option>
								<option value='08:30'>08:30</option>
								<option value='09:00'>09:00</option>
								<option value='09:30'>09:30</option>
								<option value='10:00'>10:00</option>
								<option value='10:30'>10:30</option>
								<option value='11:00'>11:00</option>
								<option value='11:30'>11:30</option>
								<option value='12:00'>12:00</option>
								<option value='12:30'>12:30</option>
								<option value='13:00'>13:00</option>
								<option value='13:30'>13:30</option>
							</select>
						
						</td>
						<td style='text-align: right;'>
							Hora Termino:
						</td>	
						<td >
						<input  type="text" size='7' id='horaf'>
					</td>
						<td>	
							<select id='hora2' name='hora2' style='width:70px;display:block;' >
								<option value='-1'>--------</option>
								<option value='08:00'>08:00</option>
								<option value='08:30'>08:30</option>
								<option value='09:00'>09:00</option>
								<option value='09:30'>09:30</option>
								<option value='10:00'>10:00</option>
								<option value='10:30'>10:30</option>
								<option value='11:00'>11:00</option>
								<option value='11:30'>11:30</option>
								<option value='12:00'>12:00</option>
								<option value='12:30'>12:30</option>
								<option value='13:00'>13:00</option>
								<option value='13:30'>13:30</option>
							</select>
						
						</td>
					</tr>
					</table>
					<table class='tableuser' style='width:98%;'>	
					
					<tr>
						<td style='text-align: right;'>
							Anestesia:
						</td>	
						<td >
							
						<input type="text" id='anes' size='40'>
						</td>
						<td>
							<select id='nuevo_tp_anes' name='nuevo_tp_anes'   >
								<option value='-1'>--------</option>
								<option value='1'>General</option>
								<option value='2'>Local</option>
								<option value='3'>Raquidea</option>
								
							</select>
						</td>
						</tr>
					</table>
					<table style='width:98%;' align='center' >	
						<tr>
				
						<td style='text-align: right;'>
							Anestesista:
						</td>	
						<td>
							
						<input type="text" id='anestesista' size='25'>
						</td>
					
						<td style='text-align: right;'>
							Cirujanos:
						</td>	
						<td>
						<input type="text" id='anes' size='30'>
						<input type="text" id='anes' size='30'>
						<input type="text" id='anes' size='30'>
						
						</td>		
					</tr>
					<tr>	
					<td style='text-align: right;'>
							Observaciones:
						</td>	
						<td>
									<textarea  cols='100' rows='1' id='nuevo_obs' name='nuevo_obs' ></textarea>
						</td>	
				</table>			
					<table style='width:98%;' align='center' >
							<td>
									<div  id='guardar_boton' style='width:80px;display: block;'>
									<input type='button' onClick='guardar_detalle_ingreso();' value='Guardar'>
									</div>
							</td>
							<td>
							
									<div  id='cancelar_boton' style='width:80px;display:block;'>
											<input type="button" onClick='cargar_listado();' id="btnvolver" name="btnvolver" style="display:block;" value="Volver"/>
									</div>
							</td>
					</table>
				
		
		</div>
		
	</table>
	</center>
	</tr>
	</div>

</body>
	
<?php
	$html.= "<div id='agenda_nueva' name='agenda_nueva' class='agenda_nueva'   style='display:none;'>";
							$html.= "<table>
														<tr>
															<td style='text-align:center;'>
																<img src='imagenes/check3.png'>
															</td>
														<tr>
												</table>
												<table>
													<tr>
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
													<div id='cargar_listado_pabellones' name='cargar_listado_pabellones'>
													</div>
												</table>";
							$html.= "</div>";
							print($html);

}
?>