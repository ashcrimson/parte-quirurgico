<!DOCTYPE HTML>
<?php

$dia = $_GET['dia'];

if($dia == ""){
$dia = date('Y-n-d');
//echo($dia);

}
		function diaespanol($valor){
			
$valor = strtotime($valor);

switch (date('w', $valor)){
case 0: $nombreDia ="Domingo"; break;
case 1: $nombreDia ="Lunes"; break;
case 2: $nombreDia ="Martes"; break;
case 3: $nombreDia ="Miercoles"; break;
case 4: $nombreDia ="Jueves"; break;
case 5: $nombreDia ="Viernes"; break;
case 6: $nombreDia ="Sabado"; break;
}
return $nombreDia;
}
//el dia desde el q comienzo a mostrar es recibido por get, en caso de no venir tomo como base el dia actual.

//con este switch saco la fecha del dia inicial del calendario de la semana de 7 dias de domingo a sabado
$diaRecibido = $dia;
switch (date('w', strtotime($dia))){
case 0: $titleday = " Domingo "; $menos=0;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
//$iniciosemana = $diaRecibido;
break;
case 1: $titleday =" Lunes"; $menos=1;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
break;
case 2: $titleday =" Martes "; $menos=2;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
break;
case 3: $titleday =" Miercoles "; $menos=3;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
break;
case 4: $titleday =" Jueves "; $menos=4;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
break;
case 5: $titleday =" Viernes "; $menos=5;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
break;
case 6: $titleday =" Sabado "; $menos=6;
$iniciosemana = date("Y-m-d", strtotime("$diaRecibido -$menos day"));
break;
}
//creo los link de siguiente y anterior
$linkanterior = date("Y-m-d", strtotime("$iniciosemana -1 day"));
$linksiguiente = date("Y-m-d", strtotime("$iniciosemana +8 day"));

?>
<html>
<head>
	<!--link rel="stylesheet" href="css/index.css" type="text/css"-->
	
<script type="text/javascript" src="parte_quirurgico/scripts/prototype.js"></script>
<script type="text/javascript" src="parte_quirurgico/scripts/json.js"></script>
<script type="text/javascript" src="parte_quirurgico/scripts/menu.js"></script>
</head>
<style>
.tipo1 {
    background-color: red;
    font-size: 20px;
    height: 100px;
    margin: 10px;
    text-align: center;
    width: 598px;
}
.tipo2{
    background-color: grey;
    font-size: 40px;
    height: 100px;
    margin: 10px;
    text-align: center;
    width: 500px;
}
</style>

<script>
	
		cambiar = function(){
			var turno = $('turnos').value;
			
			if(turno==0){
			$('horapm').style.display='none';
			$('horapm1').style.display='none';
			$('horaam').style.display='block';
			$('horaam1').style.display='block';
			
			}
			if(turno==1){
			$('horapm').style.display='block';
			$('horapm1').style.display='block';
			$('horaam').style.display='none';
			$('horaam1').style.display='none';
				
			}
		}		
			
		listado_ingresos = function() {
		var orden 			 = document.getElementById('orden').value;
		var filtro 			 = document.getElementById('filtro').value;
		
		//var filtro_cond  = document.getElementById('filtro_cond').value;
		var filtro_esp 	 = document.getElementById('filtro_esp').value;
		var tpcirugia 	 = document.getElementById('tpcirugia').value;
		var priori 			 = document.getElementById('priori').value;
		var salud 			 = document.getElementById('sis_salud').value;
	
		var inicio=0;
	
		//alert(inicio);
		var myAjax= new Ajax.Updater(
				'divlistado',
				'contenido/admision_pab.php', 
				{
					method: 'get', 
					parameters: 'tipo=pabellon&inicio='+inicio+'&orden='+orden+'&filtro='+filtro+
					'&filtro_esp='+filtro_esp+'&tpcirugia='+tpcirugia+'&priori='+priori+'&salud='+salud,
					onComplete: function(pedido_datos) {
						$('divlistado').style.display='block';
						//alert(pedido_datos.responseText);
						
				
					}
				}
		);
	}
	
		listado_ingresos2 = function(xxx) {
		
		var inicio=xxx;
	
		//alert(inicio);
		var myAjax= new Ajax.Updater(
				'divlistado2',
				'contenido/admision_pab.php', 
				{
					method: 'get', 
					parameters: 'tipo=pabellon2&inicio='+inicio,
					onComplete: function(pedido_datos) {
						$('divlistado').style.display='block';
						
				
					}
				}
		);
	}
guardar_agenda = function(xxx){
	
	//alert(xxx);
	var num_parte = xxx;
	var paciente = $('id_pabe_paciente').value;
	//alert(paciente);
param = '&hora_agenda='+paciente+'&parte='+num_parte;
		//alert(param);
					var myAjax = new  Ajax.Request(
					'contenido/admision_pab.php', 
					{
						method: 'get', 
						parameters:'tipo=guardar_paciente_agenda&param='+param,
						evalScripts: true,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						var datos =pedido_datos.responseText;
					if(datos==1){
						alert('Paciente Agendado');
						listado_ingresos2(paciente);
					//	detalle_pabellon();
						
						}
					if(datos==0){
						alert('Tiempo Excedido');
						}
						if(datos==2){
						alert('Especialidad no Corresponde');
							
							}
							listado_ingresos();
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
	//	alert($('X-coord').value);
	}
		
		
		
	
	valor_dia = function(xxx){
		
	$('pabellon_asignado').style.display='none';
	
	$(xxx).className='cuadrado-20';
	
	var fc_valor =xxx;
	 
	//alert(fc_valor);
	
	var myAjax= new Ajax.Updater(
				'pabellon_asignado',
				'contenido/admision_pab.php', 
				{
					method: 'get', 
					parameters: 'tipo=pabellon_asignado&fc='+fc_valor,
					onComplete: function(pedido_datos) {
						$('divlistado').style.display='block';
						detalle_pabellon(fc_valor);
	
				
					}
				}
		);
}
	
detalle_pabellon = function(xx) {
	//	alert('yo');
		var inicio=xx;
	//lista_ingresos2(xxx);
	
		//alert(inicio);
		var myAjax= new Ajax.Updater(
				'detalle_pabellon',
				'contenido/admision_pab.php', 
				{
					method: 'get', 
					parameters: 'tipo=detalle_pabellon&inicio='+inicio,
					onComplete: function(pedido_datos) {
					//alert(pedido_datos.responseText);
				//var datos = (pedido_datos.responseText);
					
					}
				}
		
		);
	}	
	

borrar_lista = function(xxx,pab){
	
	var borrar = xxx;
	var id_pab = pab;
	//alert(pab);
	var paciente = $('id_pabe_paciente').value;
	//alert(paciente);
	var myAjax = new  Ajax.Request(
					'contenido/admision_pab.php', 
					{
						method: 'get', 
						parameters:'tipo=borrar_paciente_agenda&borrar='+borrar+'&id_pab='+id_pab,
						evalScripts: true,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						var datos =pedido_datos.responseText;
							listado_ingresos2(paciente);
							listado_ingresos();
					//		detalle_pabellon(paciente);
				
					}
				}
			);
	
	}
	
abrir_pab = function(xxx){
	//alert(xxx);
	$('id_pabe_paciente').value=xxx;
	$('semana').style.display='none';
	
	//$('botones').style.display='none';
	$('semana2').style.display='block';
	listado_ingresos2(xxx);
	}
	

listado_ingresos();	

cerrar_menu = function(){
	
		
		if($('opciones_filtro').style.display=='block')	
			{
			$('opciones_filtro').style.display='none';	
			$('foto_ver_fonos').src = "imagenes/agregar.png";
			}
			else{
			$('opciones_filtro').style.display='block';	
			$('foto_ver_fonos').src = "imagenes/delete.png";
				
				}			
	}



</script>	

		<input id="X-coord" type="hidden" value="">
		<input id="X-ancho" type="hidden" value="">
		<input id="X-alto" type="hidden" value="">


<div id='lista_inicio' style='width:50%;float: left;'  >

		<img   onclick=cerrar_menu(); src="imagenes/agregar.png" id='foto_ver_fonos' onMouseOver='h_i(this);' >
						
	<table id='opciones_filtro' style='display:none;'>
<td style='text-align: right;'>
						<b>Ordenar por xx:</b>
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
						<input type='text' name='filtro' id='filtro' style='width:100px;' onKeyUp='listado_ingresos();'>
					</td>
					<td style='text-align: right;'>
						<b>Tipo Cirug&iacute;a:</b>
					</td>
					<td style='text-align: left;'>
						<select name='tpcirugia' id='tpcirugia' style='width:100px;' onchange='listado_ingresos();' >
							<option value='-1'>--------</option>
							<option value='0'>Electiva</option>
							<option value='1' >Urgencia</option>
						</select>
					</td>
				<tr></tr>
					<td style='text-align: right;'>
						<b>Prioridad:</b>
					</td>
					<td style='text-align: left;'>
						<select name='priori' id='priori' style='width:100px;' onchange='listado_ingresos();'>
							<option value='-1'>--------</option>
							<option value='0'>No</option>
							<option value='1'>Si</option>
						</select>
					</td>
					<td style='text-align:right;'>
							<b>Sistema Salud:</b>
						</td>
						<td>
							<select id='sis_salud' name='sis_salud'  class='combo' onchange='listado_ingresos();' >
								<option value='-1'>--------</option>
								<option value='1'>Armada</option>
								<option value='2'>Sisan</option>
								<option value='3'>Otras</option>
								<option value='4'>Particulares</option>
		
							</select>
						</td>
						<td style='text-align: right;'>
						<b>Especialidad</b>
					</td>
					<td style='text-align: left;'>
						<select name='filtro_esp' id='filtro_esp' style='width:100px;' onchange='listado_ingresos();' >
								<option value='-1'>--------</option>
							<option value='0' >Traumatologia</option>
							<option value='1' >Oftalmologia</option>
							<option value='2' >Urologia</option>
							<option value='3' >Otorrino</option>
							<option value='4' >Cirugia</option>
							<option value='5' >Vascular</option>
							<option value='6' >Neurocirugia</option>
							<option value='7' >Cirugia Plastica</option>
							<option value='8' >Mama</option>
					
						</select>
					</td>
</table>					
					
			<tr>
				
	<div id='divlistado'  style='display:block;'>
	</div>
</tr>

	<div id='pabellon_asignado'   style='display:none;'>
	
	</div>
<div id='detalle_pabellon'  style='display:block;'>
	</div>
</div>	
	
<div id='listado_pabellon'  style='width:50%;float:right;'   >
<div id='contenido2'  >
<table id='semana' style='display:block;' >

<?php
require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');

for($i=1; $i<8; $i++){
$mostrable = date("d-m-Y", strtotime("$iniciosemana +$i day"));
$titleday = diaespanol($mostrable);
//echo " ".$titleday." ".$mostrable;



$sql="select  estado from pabellon where id_pab ='A1:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];

if($dato==0){
	
	$class = 'cuadrado-22';
	
}if($dato==1){
	$class = 'cuadrado-2';
	
}if($dato==2){
	$class = 'cuadrado-20';
	}
	if($dato==3){
	$class = 'cuadrado-30';
	}

$sql="select  estado from pabellon where id_pab ='A2:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class1 = 'cuadrado-22';
	
}if($dato==1){
	$class1 = 'cuadrado-2';
	
}if($dato==2){
	$class1 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class1 = 'cuadrado-30';
	}
	
$html="<td><table>
<td style='text-align:center;' >
<b>$titleday</b>
<hr>
<t/d>
<tr></tr> 
<td style='text-align:center;'>
$mostrable
</td>
<tr>
 
<td style='text-align:center;' $ver >
				<div   class='$class' $ver id= 'A1:".$mostrable."' onclick='detalle_pabellon(this.id)' style='display:block;'  >
					PAB A1
				</div>	
					
			</td>
	</tr><tr>		
			<td style='text-align:center;'  >
				<div  class='$class1' id= 'A2:".$mostrable."' onclick='detalle_pabellon(this.id)'  >
					PAB A2
				</div>	
					
			</td>
	</tr><tr>		
	
			<td style='text-align:center;'>
				<div  class='cuadrado-22' id= 'B1:".$mostrable."' onclick='detalle_pabellon(this.id)' >
					PAB B1
				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;'>
				<div  class='cuadrado-22' id= 'B2:".$mostrable."' onclick='detalle_pabellon(this.id)' >
					PAB B2 </td>	
				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='cuadrado-2' id= 'B3:".$mostrable."' onclick='detalle_pabellon(this.id)' >
					
				PAB B3

				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='cuadrado-2' id= 'B4-".$mostrable."' onclick='detalle_pabellon(this.id)' >
					
				PAB B4

				</div>
				</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='cuadrado-2' id= 'B5-".$mostrable."' onclick='detalle_pabellon(this.id)' >
					
				PAB B5

				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='cuadrado-2' id= 'T1-".$mostrable."' onclick='detalle_pabellon(this.id)' >
					
				PAB T1

				</div>	
					
			</td>
						</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='cuadrado-2' id= 'C1-".$mostrable."' onclick='detalle_pabellon(this.id)' >
					
				PAB C1

				</div>	
					
			</td>
						</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='cuadrado-2' id= 'C2-".$mostrable."' onclick='detalle_pabellon(this.id)' >
					
				PAB C2

				</div>	
					
			</td>
</tr>		
	
</table></td>";



echo($html);
				
}
						
?>
</table>
<table id='semana2' style='display:block;' >
	<input type='hidden' id='id_pabe_paciente'>
	<div id='divlistado2'  style='display:block;'>
		
	</div>
</table>	
	<a href="#" onClick='cambiar_pagina3("<?php ECho($linkanterior)?>","visados");'>Semana Anterior</a>
&nbsp;
&nbsp;

<td></td>
<a href="#" onClick='cambiar_pagina3("<?php ECho("")?>","visados");'>Semana Actual</a>
&nbsp;
&nbsp;

<td></td>
<a href="#" onClick='cambiar_pagina3("<?php ECho($linksiguiente)?>","visados");'>Semana Siguiente</a>
</div>
</div>


<div >
  
</div>
					
			</td>

</div>
</html>


