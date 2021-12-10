<?php
	require_once("../conexion/conexion.php");
	$fecha = date("d-m-y");
	if($_GET['form']=='perfil') {
?>
<head>
	<link rel="stylesheet" href="css/usuarios.css" type="text/css">
	
</head>	
	<script>
		cargar_listado = function() {
			param = 'tipo=personal_listado&orden='+$('orden').value+'&buscar='+$('filtro').value;
			var myAjax = new Ajax.Updater(
				'listado', 
				'contenido/perfiles_db.php', 
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

				
	
	
	}
	

		seleccionar_usuario = function(idusuario) {
			//alert(idusuario);
			var myAjax = new Ajax.Request(
				'contenido/perfiles_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=usuario&buscar='+(idusuario),
					onComplete: function(pedido_datos) {
    		//		alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
						$('func_nombre').value = datos[0];
						$('func_nombre').disabled=true;
						$('rut').value = datos[1];
						$('rut').disabled=true;
						$('nombre').value=datos[2];
						$('cargo').value=datos[3];
					
						$('agregar_boton').style.display='none';
						$('cancelar_boton').style.display='block';
						$('guardar_boton').style.display='block';
						cargar_perfil();
			//			cargar_cargos(idusuario);
					$('hola').style.display='block';
						$('guardarcargo_boton').style.display='block';
			//			cargar_listado_permisos(idusuario);
					
					}
				}
			);
		}
		
		
		cargar_perfil = function(){
			
								
    						$('mod_pab').checked=false;
    						$('mod_parte').checked=false;
    						$('mod_admi').checked=false;
    						$('mod_adm').checked=false;
			
			var busca = document.getElementById('nombre').value;
		//	alert(busca);
			param = 'tipo=carga_perfil&busca='+busca;
			var myAjax = new Ajax.Request(
				 
				'contenido/perfiles_db.php', 
				{
					method: 'get', 
					parameters: param,
					onComplete: function(pedido_datos) {
    			//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
    			for (x=0;x<datos.length;x++){
    						var dd= (datos[x]);
    					if(dd==1){
    						$('mod_admi').checked=true;
    						$('admision').style.display='block';
								
    						}
    						if(dd==2){
    						$('mod_pab').checked=true;
    						$('pabe').style.display='block';
								
    						}
    						
    						if(dd==3){
    						$('mod_parte').checked=true;
    						}
    						if(dd==4){
    						$('mod_adm').checked=true;
    						$('adm_usu').style.display='block';
								}
								cargar_perfil_boton();
    				}
    			}
				}
				
			);
		}
		
		cargar_perfil_boton = function(){
			
								$('ie').checked=false;
    						$('le').checked=false;
    						$('re').checked=false;
    						$('pa').checked=false;
    						$('ap').checked=false;
    						$('pu').checked=false;
    					
    						
			var busca = document.getElementById('nombre').value;
		//	alert(busca);
			param = 'tipo=carga_perfil_boton&busca='+busca;
			var myAjax = new Ajax.Request(
				 
				'contenido/perfiles_db.php', 
				{
					method: 'get', 
					parameters: param,
					onComplete: function(pedido_datos) {
    			//alert(pedido_datos.responseText);
    				datos = JSON.parse(pedido_datos.responseText);
    			for (x=0;x<datos.length;x++){
    						var dd= (datos[x]);
    					if(dd==1){
    						$('ie').checked=true;
    						}
    						if(dd==2){
    						$('le').checked=true;
    						}
    						if(dd==3){
    						$('re').checked=true;
    						}
    						if(dd==4){
    						$('pa').checked=true;
    						}
    						if(dd==5){
    						$('ap').checked=true;
    						}
    						if(dd==6){
    						$('pu').checked=true;
    						}
    				}
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
		var numparte = document.getElementById('parte').value;
		//alert(numparte);
		var ruta	 = 'contenido/ingresoparte.php?form=ingreso&identificador='+numparte;
		buscar_win = window.open(ruta,'mensaje','left=500,top=100,width=1100,height=550,status=0');
		buscar_win.focus();
	
	}


		cargar_pato = function(pato2) {
			
				var myAjax = new Ajax.Updater(
					'patolos', 
					'contenido/perfiles_db.php',
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
					'contenido/perfiles_db.php',
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
			'contenido/perfiles_db.php', 
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
			'contenido/perfiles_db.php', 
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


		cargar_listado();
		
		
		guardar_ingreso = function(){
		
		
		var fc_pab				= document.getElementById('fc_pab').value;
		var fc_dig				= document.getElementById('fc_dig').value;
		var salud					= document.getElementById('salud').value;
		var categ				  = document.getElementById('categ').value;
		var parte  = document.getElementById('parte').value;
		var patolo				= document.getElementById('patolo').value;
		
			
   			    	
			param='&fc_pab='+fc_pab+'&fc_dig='+fc_dig+'&salud='+salud+'&categ='+categ+'&parte='+parte+'&patolo='+patolo;
			
		//	alert(param);

			var myAjax = new  Ajax.Request(
				'contenido/perfiles_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=guardar_ingreso&param='+param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
					 alert("Paciente Ingresado Correctamente.:");
					 limpiar();
					 cargar_listado();
						
						} 
					}
				
		);
}
		
		
		
		
		
		activar = function(){
			
			var adm 	  = 0;
			var admusu  = 0;
			var admpab  = 0;
			var admpart = 0;
			var ie			=0;
		
	if($('mod_adm').checked==true){
			admusu=1;
		$('adm_usu').style.display='block';
		}else{
				$('adm_usu').style.display='none';
			}
	
			if($('mod_admi').checked==true){
					adm=1;
				$('admision').style.display='block';
				}else{
						$('admision').style.display='none';
					}
					
					if($('mod_pab').checked==true){
						admpab=1;
					$('pabe').style.display='block';
					}else{
							$('pabe').style.display='none';
						}
			
						if($('mod_parte').checked==true){
								admpart=1;
							}
			
			//alert(adm);
}
		
		guardar_perfiles = function(){
			
			var ie	=0;
			var le	=0;
			var re	=0;
			var pa	=0;
			var pu  =0;
			var ap = 0;
			var adm 	  = 0;
			var admusu  = 0;
			var admpab  = 0;
			var admpart = 0;
			var cargo = document.getElementById('cargo').value;
			
		
							if($('ie').checked==true){
								ie=1;
							}
								if($('le').checked==true){
									le=2;
								}
									if($('re').checked==true){
										re=3;
									}
										if($('pa').checked==true){
											pa=4;
										}
											if($('ap').checked==true){
												ap=5;
											}
												if($('pu').checked==true){
													pu=6;
												}
							
							
								if($('mod_adm').checked==true){
									admusu=4;
								}	
									if($('mod_admi').checked==true){
										adm=1;
									}
										if($('mod_pab').checked==true){
											admpab=2;
										}	
											if($('mod_parte').checked==true){
												admpart=3;
											}
			var param = '&ie='+ie+'&le='+le+'&re='+re+'&pa='+pa+'&pu='+pu+'&ap='+ap+'&admusu='+admusu+'&adm='+adm+'&admpab='+admpab+'&admpart='+admpart+'&nombre='+$('nombre').value+'&cargo='+cargo;
		//	alert(param);
			var myAjax = new  Ajax.Request(
				'contenido/perfiles_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=guardar_perfiles&param='+param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
					 alert("Perfiles Ingresados.:");
					// limpiar();
					// cargar_listado();
						
						} 
					}
				
		);
			
}
		
		
		
		
		
		
	</script>
	<div class='tfila2' style='width:30%;float: left;' >
			
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
							<option value='id_usuario'>Rut</option>
							<option value='nombre' selected >Usuario</option>
						</select>
					</td>
				</tr>
			</table>
		</center>
		<div class='fpapel' id='listado' style='height:300px;overflow:auto;'>
		</div>
	</div>
	
	<div class='tfila2' style='width:70%;float: left;'>
		<div  class='tfila2' id='registro'>
			<center>
				<table  style='width:98%;' align='center' border=0>
					<tr class='tfila2'>
						
						<td style='text-align: right;'>
							Nombre:
						</td>	
						<td>
							<input type='text' class='textbox' name='func_nombre' id='func_nombre' style='width:200px;' DISABLED>
							<input type='hidden' name='largopass' id='largopass' value='' >
					
						</td>
						
							<td style='text-align: right;'>
							Rut:
						</td>
						<td>
							<input type='text' name='rut' id='rut' style='width:65px;' DISABLED>
						
						</td>
							<td style='text-align: right;'>
							Cargo:
						</td>
							<td style='text-align: left;'>
								<select name='cargo' id='cargo' style='width:250px;' >
									<option value='0'>--Sin Cargo--</option>
									<option value='1'>Supervisor - Centro Quirurgico</option>
									<option value='2' >Medico Anestesista - Poli Anestesia</option>
									<option value='3'>Medico Jefe UPC - UPC</option>
									<option value='4'>Tecnologo Jefe - Banco Sangre</option>
									<option value='5'>Enfermera - Insumos Clinicos</option>
						
								</select>
						
						</td>
					</tr>
				</table>
				
			</center>
		</div>
		
	</div>

<div class='tfila2' style='width:20%;height:250px;float:left;'>
		<center>
			<table class='tableuser' style='width:98%;'>
				<tr class='tfila2'>
					<td style='text-align: right;'>
						<b>Habilitar Menu</b>
					</td>
				</tr>
				<tr class='tfila2'>
					<td style='text-align: left;'>
						Administracion
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id="mod_adm" name="mod_adm" value="" onclick='activar();' >
					</td>
				</tr>
				<tr class='tfila2'>
				
					<td style='text-align: left;'>
						Modulo Admision
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id="mod_admi" name="mod_admi" value="" onclick='activar();' >
					</td>
					</tr>
				<tr class='tfila2'>
				
					<td style='text-align: left;'>
						Pabellon
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id="mod_pab" name="mod_pab" value="" onclick='activar();' >
					</td>
					</tr>
				<tr class='tfila2'>
				
					<td style='text-align: left;'>
						Parte Medico
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id="mod_parte" name="mod_parte" value="" onclick='activar();' >
					</td>
				</tr>
				
			</table>
		</center>
	</div>
<div class='tfila2' style='width:50%;float: left;' >
			
		<center>
			<table class='tableuser' style='width:98%;'>
				<tr class='tfila2'>
					<td style='text-align: center;'>
						<b>Botones Sub-Menu:</b>
					</td>
				</tr>
				
				<tr class='tfila2' id='adm_usu' style='display:none;' >
					<td style='text-align: left;'>
						Perfil Usuario
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id='pu' name="pu" value="">
					</td>
				</tr>
				
				<tr class='tfila2' id='admision' style='display:none;' >
					<td style='text-align: left;'>
						Ingreso Pacientes
					</td>
					<td style='text-align: left;'>
							<input  type="checkbox" id='ie' name="ie" value="">
					</td>
					<td style='text-align: left;'>
						Lista Espera
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id='le' name="le" value="">
					</td>
					<td style='text-align: left;'>
						Requerimientos
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id='re' name="re" value="">
					</td>
					<td style='text-align: left;'>
						Pabellon
					</td>
					<td style='text-align: left;'>
							<input type="checkbox" id='pa' name="pa" value="">
					</td>
				</tr>
				
				
				<tr class='tfila2' id='pabe' style='display:none;' >
					<td style='text-align: left;'>
						Asignar Pabellon
					</td>
					<td style='text-align: left;'>
							<input  type="checkbox" id='ap' name="ap" value="">
					</td>
				</tr>
				
			</table>
		</center>
		<input type="hidden" id='nombre' value=''>
	</div>

	
<div  style='width:70%;float:left;' >	
			<table  style='width:38%;'>
							<td>
									<div  id='agregar_boton' style='width:80px;' style='width:80px;display:none;' >
										<input type='button' value='Agregar'>
									</div>
							</td>
							<td>
									<div  id='guardar_boton' style='width:80px;display: none;' onMouseOver='h_i(this);' >
									<input type='button' onClick='guardar_perfiles();' value='Guardar'>
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
<?php
	}
?>