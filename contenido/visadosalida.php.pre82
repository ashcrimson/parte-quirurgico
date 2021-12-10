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
		
		var inicio=1;
	
		//alert(inicio);
		var myAjax= new Ajax.Updater(
				'divlistado',
				'contenido/pabellon_db.php', 
				{
					method: 'get', 
					parameters: 'tipo=pabellon&inicio='+inicio,
					onComplete: function(pedido_datos) {
						$('divlistado').style.display='block';
						
				
					}
				}
		);
	}
	
	detalle_pabellon = function(xx) {
	//	alert(xx);
		var inicio=xx;
		 document.getElementById('cod_pab').value=inicio;

		//alert(inicio);
		var myAjax= new Ajax.Updater(
				'detalle_pabellon',
				'contenido/pabellon_db.php', 
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
	
	
mouser = function(event){
		
		var x;
		x=event.clientX + 5;
		$('X-ancho').value = screen.width;
		$('X-alto').value = screen.height;
		$('X-coord').value = x + 'px';
	//	alert($('X-coord').value);
//	valor_dia();
 
					
	}
		
		
		
	
	valor_dia = function(xxx){
	
	$('pabellon_asignado').style.display='block';
	
//	$(xxx).className='cuadrado-20';
	var fc_valor =xxx;
	 
	//alert(fc_valor);
	
	var myAjax= new Ajax.Updater(
				'pabellon_asignado',
				'contenido/pabellon_db.php', 
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



/*
valor_dia1 = function(xxx){
	//var diario = $(xxx).value;
//	var aver = xxx;
//	$(aver).className='cuadrado-2';
//	alert(aver);
//	alert(diario);
	var checkboxs = getElementsByAttribute(document.getElementById('contenido_22'), '*', 'id');
			for (var i=0; i< 2; i++) {
				var id=checkboxs[i].id;
			//	alert(id);
			
			var myAjax = new  Ajax.Request(
					'contenido/pabellon_db.php', 
					{
						method: 'get', 
						parameters:'tipo=verifica_class&resultado='+id,
						evalScripts: true,
						onComplete: function(pedido_datos) {
						alert(pedido_datos.responseText);
						var dato = (pedido_datos.responseText);
						if(dato!=""){
							$(checkboxs[i].id).className='cuadrado-2';
							}
											
						}	
			
			
			}
		);		
	}
}
/*
	valor_dia1 = function(){
		
			var checkboxs = getElementsByAttribute(document.getElementById('contenido_22'), '*', 'id');
			for (var i=0; i< checkboxs.length; i++) {
					var id[i]=checkboxs[i].id;
				//alert(id);
				var myAjax = new  Ajax.Request(
					'contenido/pabellon_db.php', 
					{
						method: 'get', 
						parameters:'tipo=verifica_class&resultado='+id,
						evalScripts: true,
						onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
			//			var datos = (pedido_datos.responseText);
					//	alert(datos);
				//		if(id == datos){
					//		alert('aaa');
						//	}
						
				/*		if(datos > 0){
								$(checkboxs[i].id).className='cuadrado-20';
							}if(datos == 0){
							$(checkboxs[i].id).className='cuadrado-22';
								
								}
					//$(checkboxs[i].id).className='cuadrado-20';
				//	alert(id);		
					
				}
						
		}
		
	);
}				

			 			
}

valor_dia1();
*/




	
//listado_ingresos();

guardar_contacto = function(){
	
var turnos = $('turnos').value;
		if(turnos==0){
		var hora1 = $('hora1').value;
		var hora2 = $('hora2').value;
		}else{
			var hora1 = $('hora3').value;
			var hora2 = $('hora4').value;
	
			}
	var especialidad = $('especialidad').value;
	var fc = $('fc').value;
	var fc1 = fc.split(":");
	var pabellon = fc1[0];
	var fc_pabellon = fc1[1];
	
	var estado = $('estado').value;
	if(hora1 > hora2){
		alert('Intervalo de Horas Incorrecto');
		return;
		}
	
	
	param = '&hora1='+hora1+'&hora2='+hora2+'&especialidad='+especialidad+
	'&pabellon='+pabellon+'&id_pab='+fc+'&fc_pab='+fc_pabellon+'&turnos='+turnos+'&estado='+estado;
	//	alert(param);
					var myAjax = new  Ajax.Request(
					'contenido/pabellon_db.php', 
					{
						method: 'get', 
						parameters:'tipo=guardar_pab&param='+param,
						evalScripts: true,
						onComplete: function(pedido_datos) {
				//		alert(pedido_datos.responseText);
			//			alert('Datos del Paciente Ingresados');
				/*		var dato = pedido_datos.responseText;
						if(dato==0){
							alert('Horario Copado');
							}else{*/
							var xx = $('fc').value;
							detalle_pabellon(xx);
					//		}
						}
					}
				);
	
	
	}
	
	
cambiar_estado = function(valor_estado){
	//alert(valor_estado);
		var id_pab = $('fc').value;
	
		var res =confirm("Desea cambiar estado del pabellon?");
			if(res){
					var myAjax = new  Ajax.Request(
					'contenido/pabellon_db.php', 
					{
						method: 'get', 
						parameters:'tipo=guardar_pab_estado&estado='+valor_estado+'&id_pab='+id_pab,
						evalScripts: true,
						onComplete: function(pedido_datos) {
				
						}
					}
				);
			}
}

borrar_item = function(iditem){
 	
  var idcot = iditem;

	var cod= document.getElementById('cod_pab').value;
 	var myAjax = new Ajax.Request(
			'contenido/pabellon_db.php', 
			{
				method: 'get', 
				parameters: 'tipo=borrar_item&iditem='+iditem,
				onComplete: function(pedido_datos) {
				}
			}
	);
		detalle_pabellon(cod);
}


</script>	

		<input id="X-coord" type="hidden" value="">
		<input id="X-ancho" type="hidden" value="">
		<input id="X-alto" type="hidden" value="">
		<input id="cod_pab" type="hidden" value="">

		<input id="colorea" type="hidden" value="">


<div id='lista_inicio' style='width:50%;float: left;'  >

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
<div id='contenido_22' >
<table>

<?php

require_once('../conexion/conexion.php');
include('../scripts/json.php');
include('../scripts/funciones.php');

 

for($i=1; $i<8; $i++){
$mostrable = date("d-m-Y", strtotime("$iniciosemana +$i day"));
$titleday = diaespanol($mostrable);

//echo " ".$titleday." ".$mostrable;




$sql="select  estado,especialidad_pabellon.especialidad  from pabellon
left join especialidad_pabellon on pabellon.ID_PAB = especialidad_pabellon.ID_PAB 
where pabellon.id_pab ='A1:$mostrable'";

$rs = $db->Execute($sql);
$dato = $rs->fields[0];
$especialidad = $rs->fields[1];
if($dato==0){
	
	$class = 'cuadrado-22';
	
}if(($dato==1)&&($especialidad==0)){
	$class = 'cuadrado-2';
	//$class = 'amarillo';
}
if(($dato==1)&&($especialidad==4)){
	//$class = 'cuadrado-2';
	$class = 'lila';
}
if(($dato==1)&&($especialidad==9)){
	//$class = 'cuadrado-2';
	$class = 'cuadrado-30';
}

if(($dato==1)&&($especialidad==15)){
	$class = 'cuadrado-22';
	
}
if(($dato==1)&&($especialidad==2)){
	$class = 'cuadrado-2';
	
}
if(($dato==1)&&($especialidad==1)){
	$class = 'lila';
	
}
if(($dato==1)&&($especialidad==8)){
$class = 'amarillo';
	
}
if($dato==2){
	$class = 'cuadrado-20';
	}
	if($dato==3){
	$class = 'cuadrado-30';
	}
	
$sql="select  estado,especialidad_pabellon.especialidad  from pabellon
left join especialidad_pabellon on pabellon.ID_PAB = especialidad_pabellon.ID_PAB 
where pabellon.id_pab ='A2:$mostrable'";

$rs = $db->Execute($sql);
$dato = $rs->fields[0];
$especialidad = $rs->fields[1];
if($dato==0){
	
	$class1 = 'cuadrado-22';
	
}if(($dato==1)&&($especialidad==0)){
	$class = 'cuadrado-2';
	//$class1 = 'amarillo';
}
if(($dato==1)&&($especialidad==4)){
	//$class = 'cuadrado-2';
	$class = 'lila';
}
if(($dato==1)&&($especialidad==9)){
	//$class = 'cuadrado-2';
	$class1 = 'cuadrado-30';
}

if(($dato==1)&&($especialidad==15)){
	$class1 = 'cuadrado-22';
	
}
if(($dato==1)&&($especialidad==2)){
	$class1 = 'cuadrado-2';
	
}
if(($dato==1)&&($especialidad==1)){
	$class1 = 'lila';
	
}
if(($dato==1)&&($especialidad==8)){
$class1 = 'amarillo';
	
}
if($dato==2){
	$class1 = 'cuadrado-20';
	}
	if($dato==3){
	$class1 = 'cuadrado-30';
	}	


$sql="select  estado,especialidad_pabellon.especialidad  from pabellon
left join especialidad_pabellon on pabellon.ID_PAB = especialidad_pabellon.ID_PAB 
where pabellon.id_pab ='B1:$mostrable'";

$rs = $db->Execute($sql);
$dato = $rs->fields[0];
$especialidad = $rs->fields[1];
if($dato==0){
	
	$class2 = 'cuadrado-22';
	
}if(($dato==1)&&($especialidad==0)){
	$class = 'cuadrado-2';
	
}
if(($dato==1)&&($especialidad==4)){
	//$class = 'cuadrado-2';
	$class2 = 'lila';
}
if(($dato==1)&&($especialidad==9)){
	//$class = 'cuadrado-2';
	$class2 = 'cuadrado-30';
}

if(($dato==1)&&($especialidad==15)){
	$class2 = 'cuadrado-22';
	
}
if(($dato==1)&&($especialidad==2)){
	$class2 = 'cuadrado-2';
	
}
if(($dato==1)&&($especialidad==1)){
	$class2 = 'lila';
	
}
if(($dato==1)&&($especialidad==8)){
$class2 = 'amarillo';
	
}

if($dato==2){
	$class2 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class2 = 'cuadrado-30';
	}	
	
$sql="select  estado from pabellon where id_pab ='B2:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class3 = 'cuadrado-22';


	
}if($dato==1){
	
	$class3 = 'cuadrado-2';

	
}if($dato==2){
	$class3 = 'cuadrado-20';
	$ver = 'disabled';
		$ESP="";

	}
	
	if($dato==3){
	$class3 = 'cuadrado-30';
		$ESP="";

	}		
	

$sql="select  estado from pabellon where id_pab ='B3:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class4 = 'cuadrado-22';
	
}if($dato==1){
	$class4 = 'cuadrado-2';
	
}if($dato==2){
	$class4 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class4 = 'cuadrado-30';
	}
	
$sql="select  estado from pabellon where id_pab ='B4:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class5 = 'cuadrado-22';
	
}if($dato==1){
	$class5 = 'cuadrado-2';
	
}if($dato==2){
	$class5 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class5 = 'cuadrado-30';
	}
	
	
	$sql="select  estado from pabellon where id_pab ='B5:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class6 = 'cuadrado-22';
	
}if($dato==1){
	$class6 = 'cuadrado-2';
	
}if($dato==2){
	$class6 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class6 = 'cuadrado-30';
	}
	
	$sql="select  estado from pabellon where id_pab ='T1:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class7 = 'cuadrado-22';
	
}if($dato==1){
	$class7 = 'cuadrado-2';
	
}if($dato==2){
	$class7 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class7 = 'cuadrado-30';
	}
	
$sql="select  estado from pabellon where id_pab ='C1:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class8 = 'cuadrado-22';
	
}if($dato==1){
	$class8 = 'cuadrado-2';
	
}if($dato==2){
	$class8 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class8 = 'cuadrado-30';
	}
	
$sql="select  estado from pabellon where id_pab ='C2:$mostrable'";
$rs = $db->Execute($sql);
$dato = $rs->fields[0];


if($dato==0){
	
	$class9 = 'cuadrado-22';
	
}if($dato==1){
	$class9 = 'cuadrado-2';
	
}if($dato==2){
	$class9 = 'cuadrado-20';
	$ver = 'disabled';
	}
	
	if($dato==3){
	$class9 = 'cuadrado-30';
	}

$html="
<td>	
<table>
<td style='text-align:center;' >
<b>$titleday</b>
<hr>
<t/d>
<tr></tr> 
<td style='text-align:center;'>
$mostrable

</td>

<tr>		 

<td style='text-align:center;' >
				<div   class='$class' id='A1:".$mostrable."'   onclick='valor_dia(this.id)' style='display:block;'  >
					PAB A1
				</div>	
					
			</td>
	</tr>
<tr>		
			<td style='text-align:center;'  >
				<div  class='$class1' id='A2:".$mostrable."' onclick='valor_dia(this.id)'  >
					PAB A2
				</div>	
					
			</td>
	</tr><tr>		
	
			<td style='text-align:center;'>
				<div  class='$class2' id= 'B1:".$mostrable."' onclick='valor_dia(this.id)' >
					PAB B1
				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;'>
				<div  class='$class3' id= 'B2:".$mostrable."' onclick='valor_dia(this.id)' >
					PAB B2
					
					 </td>	
				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='$class4' id= 'B3:".$mostrable."' onclick='valor_dia(this.id)' >
					
				PAB B3

				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='$class5' id= 'B4:".$mostrable."' onclick='valor_dia(this.id)' >
					
				PAB B4

				</div>
				</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='$class6' id= 'B5:".$mostrable."' onclick='valor_dia(this.id)' >
					
				PAB B5

				</div>	
					
			</td>
			</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='$class7' id= 'T1:".$mostrable."' onclick='valor_dia(this.id)' >
					
				PAB T1
					
				</div>	
					
			</td>
						</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='$class8' id= 'C1:".$mostrable."' onclick='valor_dia(this.id)' >
					
				PAB C1

				</div>	
					
			</td>
						</tr><tr>		
	
				<td style='text-align:center;' >
				<div  class='$class9' id= 'C2:".$mostrable."' onclick='valor_dia(this.id)' >
					
				PAB C2

				</div>	
					
			</td>
</tr>		
	
</table></td>";



echo($html);
				
}
						
?>
</table>
	<a href="#" onClick='cambiar_pagina2("<?php ECho($linkanterior)?>","visados");'>Semana Anterior</a>
&nbsp;
&nbsp;

<td></td>
<a href="#" onClick='cambiar_pagina2("<?php ECho("")?>","visados");'>Semana Actual</a>
&nbsp;
&nbsp;

<td></td>
<a href="#" onClick='cambiar_pagina2("<?php ECho($linksiguiente)?>","visados");'>Semana Siguiente</a>

 
</div>
</div>



 
					
			

</html>


