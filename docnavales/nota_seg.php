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
				'nota_seg_db.php', 
				{
					method: 'post', 
					parameters: param,
					evalScripts: true,
					onComplete: function(pedido_datos) {
					//	alert(pedido_datos.responseText);
						alert("Nota Guardada Exitosamente.");
						notas();
						limpiar();
				//		salir();
					}
				}
			);
		}
		
	notas = function(){
		//	alert('hola');
		var param= 'tipo=lista_notas&idmensaje='+idmensaje;
	//	alert(param);
		
		var myAjax = new Ajax.Updater(
				'divnotas', 
				'nota_seg_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true,
					onComplete: function() {
				//		var alto = $('X-alto').value * 1 - 680;
					//	alert($('X-alto').value);
					//	alert(alto);
						
					//	$('divnotas').style.height = alto + 'px';
						//alert(pedido_datos.responseText);
					}
				}
		);
	}	
	
notas();

limpiar = function(){
	
	$('texto1').value = "";
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
	
	</div>
</div>
<table style='width:90%;' align='center' >
		<tr>
			<td width="200px" style='text-align: left;'>
				<div class='sub-content3' name='divnotas' id='divnotas' style="height:100px;width:98%;">
				</div>
			</td>
		</tr>
	</table>
	
</body>
</html>
<?php
}
?>
