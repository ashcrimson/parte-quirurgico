<?php
	require_once("../conexion/conexion.php");
	$fecha = date("d-m-y");
	if($_GET['form']=='seguimiento') {
?>
<head>
	<link rel="stylesheet" href="css/usuarios.css" type="text/css">
	
</head>	
	<script>
		
		
	cargar_filtro_especialidad = function() {
			//alert(inicio);
				var myAjax = new Ajax.Updater(
					'filtro_especialidad', 
					'contenido/seguimiento_db.php',
					{
						method: 'get', 
						parameters: 'tipo=cargar_filtro_especialidad',
						evalScripts: true,
						
					}
					
				);
		}
			
cargar_filtro_especialidad();	
	
		

cargar_listado = function() {
	var activo = 1;
			param = 'tipo=personal_listado&activo='+activo;
			var myAjax = new Ajax.Updater(
				'listado', 
				'contenido/seguimiento_db.php', 
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
				'contenido/seguimiento_db.php', 
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
				'contenido/seguimiento_db.php', 
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
		
ver_nota = function(xxx){
		
		var ruta = 'docnavales/nota_seg.php?form=notas&idmensaje='+xxx;
		nota = window.open(ruta,'nota','left=10,top=10,width=850,height=560,status=0');
		nota.focus();
	}

		
	</script>
	<body>
	<div class='tfila2' style='width:90%;' >
			
		<span><img src='imagenes/busqueda.png'><b>Partes Ingresados</b></span>
		</tr>
		<center>
			<table class='tableuser' style='width:98%;'>
				<tr class='tfila2'>
					
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
	</div>

</body>
	
<?php
}
?>