<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	$fecha = date("d-m-Y");
	require_once("../conexion/conexion.php");
	if($_GET['form']=='notas'){
?>
<html>
	<head>
		<script type="text/javascript" src="../scripts/prototype.js"></script>
		<script type="text/javascript" src="../scripts/getElementsByAttribute.js"></script>
		<script type="text/javascript" src="../scripts/json.js"></script>
		<script type="text/javascript" src="../scripts/calendar.js"></script>
		<script type="text/javascript" src="../scripts/calendar-es.js"></script>
		<script type="text/javascript" src="../scripts/calendar-setup.js"></script>
		<script type="text/javascript" src="../scripts/menu.js"></script>
		<script type="text/javascript" src="../scripts/scrolltable.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="../css/calendar-blue.css" title="win2k-cold-1" />
		<link rel="stylesheet" href="../css/notas.css" type="text/css">
		<link rel="stylesheet" href="../css/indexphp.css" type="text/css">		
		
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	</head>
	<script>
		var idmensaje='<?php echo($_GET["idmensaje"]);?>';
		
		salir = function(){
			window.close();
		}
		
	

		guardar_nota = function(){
			
			var texto = $('texto1').value;
			texto				 = texto.replace(/=/g,String.fromCharCode(215));
			texto				 = texto.replace(/\'/g,String.fromCharCode(221));
			texto				 = texto.replace(/\?/g,String.fromCharCode(227));
			texto				 = texto.replace(/\%/g,String.fromCharCode(230));
			texto				 = texto.replace(/\&/g,String.fromCharCode(222));
	
			var param ='tipo=guardar_nota&texto='+texto+'&idmensaje='+idmensaje+'&tpaviso=1&fc_plazo=';
 			var myAjax = new  Ajax.Request(
				'nota_db.php', 
				{
					method: 'post', 
					parameters: param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						alert("Nota Guardada Exitosamente.");
						window.opener.notas(idmensaje);
						salir();
					}
				}
			);
		}

	
	</script>
</head>
<body>
<div id="contenedor">
	<input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
	<label for="tab-1" class="tab-label-1">Notas</label>
	<div class="conten" style="width:95%;">
		<div class="content-1" style="width:95%;">
			<table style="width:100%;">
				<tr>
					<td>
						<b>Nota</b>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<textarea style="width:99%;" rows='8' id='texto1' name='texto1'></textarea>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td style='text-align: center;width:50%;'>
						<input type='submit'  style="visibility:visible"   onClick='guardar_nota();' value='Guardar Nota'>
					</td>	
					<td style='text-align: center;width:50%;'>
						<input type='submit'  style="visibility:visible"   onClick='salir();' value='Salir'>
					</td>
				</tr>
			</table>
		</div>
		<!--div class="content-2" style="width:95%;">
			<table style="width:100%;">
				<tr>
					<td>
						<b>Nota</b>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<textarea style="width:99%;" rows='8' id='texto2' name='texto2'></textarea>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<b>Fecha Plazo</b>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<input style="visibility:visible" type="text" name="fc_plazo" id="fc_plazo"  size="10"  value="<?php echo($fecha)?>">
						<img src="../imagenes/date_magnify.png" id="fecha1_boton" disabled >
						<script>
							Calendar.setup({inputField:'fc_plazo',ifFormat:'%d-%m-%Y',showsTime:false,button:'fecha1_boton'});
						</script>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<b>Personal en Departamento y en Departamento de la Distribuci&oacute;n</b>
					</td>	
				</tr>
				<tr>
					<td>
						<div class="content-2" name='divpersonas2' id='divpersonas2' style="height:150px;width:100%;position:relative;overflow:auto">
						</div>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td style='text-align: center;width:50%;'>
						<input type='submit'  style="visibility:visible"  onClick='guardar_nota2();' value='Publicar Tarea'>
					</td>	
					<td style='text-align: center;width:50%;'>
						<input type='submit'  style="visibility:visible"  onClick='salir();' value='Salir'>
					</td>	
				</tr>
			</table>	
		</div>
		<div class="content-3" style="width:95%;">
			<table style="width:100%;">
				<tr>
					<td>
						<b>Nota</b>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<textarea style="width:99%;" rows='8' id='texto3' name='texto3'></textarea>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td>
						<b>Personal en Departamento y en Departamento de la Distribuci&oacute;n</b>
					</td>	
				</tr>
				<tr>
					<td>
						<div class="content-3" name='divpersonas3' id='divpersonas3' style="height:200px;width:100%;position:relative;overflow:auto">
						</div>
					</td>
				</tr>
			</table>
			<table style="width:100%;">
				<tr>
					<td style='text-align: center;width:50%;'>
						<input type='submit'  style="visibility:visible"  onClick='guardar_nota3();' value='Publicar Nota'>
					</td>	
					<td style='text-align: center;width:50%;'>
						<input type='submit'  style="visibility:visible"  onClick='salir();' value='Salir'>
					</td>	
				</tr>
			</table>
		</div-->
	</div>
</div>
</body>
</html>
<?php
}
?>
