<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include('funciones.bus.php');
verifica_sesion(false);
 session_start();
?>
<!--div class='tiempo'>
<td>	
<div id="div_session_timeout" class="ui-state-highlight" style="float: left; width: 90%;  font-size: .8em; text-align: center;">
   <script language="javascript" type="text/javascript">
      var dateStamp = new Date("<?php echo date('D M j Y H:i:s'); ?>"); 
      var intStamp = Number(dateStamp);
      function getTime() {
         now = new Date(intStamp); 
         y2k = new Date("<?php echo date('M j Y H:i:s', time() + 1600); ?>");
         days = (y2k - now) / 1000 / 60 / 60 / 24;
         daysRound = Math.floor(days);
         hours = (y2k - now) / 1000 / 60 / 60 - (24 * daysRound);
         hoursRound = Math.floor(hours);
         minutes = (y2k - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
         minutesRound = Math.floor(minutes);
         seconds = (y2k - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
         secondsRound = Math.round(seconds);
         sec = (secondsRound == 1) ? " segundo" : " segundos";
         min = (minutesRound == 1) ? " minuto, " : " minutos, ";
         hr = (hoursRound == 1) ? " hora, " : " horas, ";
         dy = (daysRound == 1)  ? " d\355a, " : " d\355as, "
         if (daysRound+hoursRound+minutesRound+secondsRound == '0000'){
            document.getElementById("session_timeout").innerHTML = '<span style="color: red;">La sesi\363n ha expirado.</span><br />' + hoursRound + hr + minutesRound + min + secondsRound + sec;
        
        window.open("logout.php", "_self");
         } else {
            document.getElementById("session_timeout").innerHTML = "Tiempo restante de esta sesi\363n: <br />" +  minutesRound + min + secondsRound + sec;
            newtime = window.setTimeout("getTime();", 1000);
            intStamp = intStamp + 1000; 
         } 
      } 
      window.onload=getTime;
      
   </script>
   <span id="session_timeout"></span>
</td>
<td>
<form method="post">  
 <input type="button" value="Renovar" onclick="window.location.reload()" />
 <!--img src="imagenes/actualiza2.png"  title="Renovar Tiempo Sesión" onclick="window.location.reload()"; onMouseOver='h_i(this);' -->

</form>
</td>
</div>

</div-->
<html>
<head>
	<title>Agenda Quir&uacute;rgica</title>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/index.css" type="text/css">
	<link rel="stylesheet" href="css/screen.css" type="text/css">
	<link rel="stylesheet" href="css/menu_desp.css" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="css/calendar-blue.css" title="win2k-cold-1" />
</head>
<script src="scripts/menu.js" type="text/javascript"></script>
<script src="scripts/json.js" type="text/javascript" language="javascript" charset="utf-8"></script>
<script src="scripts/prototype.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/getElementsByAttribute.js"></script>

<script src="scripts/menu.js" type="text/javascript"></script>

<script src="scripts/prototype.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="scripts/calendar-es.js"></script>
<script type="text/javascript" src="scripts/calendar-setup.js"></script>

<script>
	

	parte = function(iditem){
		var identificador = iditem;
		var ruta	 = 'contenido/ingresoparte.php?form=ingreso&identificador=-1';
		buscar_win = window.open(ruta,'mensaje','left=20,top=10,width=1100px,height=700px,status=0');
		buscar_win.focus();
	}
	
	
	//window.onbeforeunload = salirsistema;
	

	function salirsistema(){
		var exit = confirm("Esta seguro de salir del sistema?");
		if(exit==true){
			var param= '';
			var myAjax = new  Ajax.Request(
				'contenido/index_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true,
					onComplete: function() {
						
						window.open("logout.php", "_self");
					}
				}
			);
		}
	} 
	
	desarrollo = function(){
		
		alert('M&oacute;dulo en Desarrollo');
				
		}



</script>
<body onMouseMove="mouser(event);" onMouseUp='mouse_up();'>
<div id='banner' class='menu-banner' style='width:99%;'>
	<div id='escudo' class='logo'>
		<img src='imagenes/escudo3.png' width='74px' height='110px;'>
	</div>	
	<div id='persona' class='usuario' >
		<?php
			if ($_SESSION['rut']*1 < 10000000){
				$rutfoto = "0".$_SESSION['rut'].".png";
			} else {
				$rutfoto = $_SESSION['rut'].".png";
			}

			if (file_exists("fotos/".$rutfoto)==1){
				print("<img src='fotos/".$rutfoto."'width='65px' height='74px;'>");
			} else {
				print("<img src='imagenes/usuario_foto.png'width='65px' height='74px;'>");
			}
		?>
	</div>
	
	<div id='persona_nom' class='persona_nombre' >
		<b>
		<?php
		if($_SESSION ['centro']['usuario']=='')
			{
			  
			print('Nombre Usuario');
			
			}
			else{
				
				$registro 	=  $_SESSION ['centro']['usuario'];
				$usu  	 	= split("@sanidadnaval",$registro);
				$medico_tratante	= $usu[0];
				//$nom_completo				= $nombre[1];
				//$cargo 							= $nombre[2];
				$usuario 						= "Hola,".$_SESSION ["centro"]['nombres'] ." ".$_SESSION ["centro"]['apellido_paterno']."<br/>".$cargo;
		
		
		//	echo($usuario);
			
			}
		?>
	</b>
	<table class='tabla1'>
		<td style='text-align: center;width:250px;'>
			<?php echo($usuario)?>
						
		</td>	
		<td>
		<img src='imagenes/logout.png' onMouseOver='h_i(this);' border="0px" title='Salir del Sistema' onclick='salirsistema();'>

		</td>
	</table>
	
	</div>
	
	
	<!--div id='persona_nom' class='persona_nombre' >
		<b>
		<?php
		if($_SESSION ['nombre']=='')
			{
			  
			print('Nombre Usuario');
			
			}
			else{
			print($_SESSION ['nombre']);
			}
		?>
	</b>
		&nbsp;&nbsp;
		<img src='imagenes/logout.png' onMouseOver='h_i(this);' border="0px" title='Salir del Sistema' onclick='salirsistema();'>
	</div-->
	<div class="menu_desp" id='divmenu' value='5' >
		<ul>
<?php if(($_SESSION['centro']['tipo_usuario']==2)){ ?>
			<li>
				<a href="#">Administraci&oacute;n</a>
					<ul>
					<li><a href="#" onClick='cambiar_pagina("perfil","perfil");'>Perfil Usuario</a></li>
			
				</ul>
			
			</li>
<?php }  if(($_SESSION['centro']['tipo_usuario'] >1)){ ?> 
			<li>
				<a href="#">M&oacute;dulo Admisi&oacute;n</a>
<?php } ?>
				<ul>
					<li><a href="#" onClick='cambiar_pagina("seguimiento","seguimiento");'>Seguimiento Partes</a></li>
					<li><a href="#" onClick='cambiar_pagina("usuario","usuarios");'>Ingreso Pacientes</a></li>
					<li><a href="#" onClick='cambiar_pagina("casilla","control");'>Lista Espera </a></li>
<?php   if(($_SESSION['centro']['tipo_usuario'] >1)&&($_SESSION['centro']['tipo_usuario'] < 4)){ ?> 
					<li><a href="#" onClick='cambiar_pagina("examenes","examenes");'>Requerimientos</a></li>
					<li><a href="#" onClick='cambiar_pagina("Pabellon","admision_pab1");'>Asignar Pabell&oacute;n</a></li>
					<li><a href="#" onClick='cambiar_pagina("tabla","tabla");'>Tabla Quir&uacute;rgica</a></li>
<?php } ?>				
				</ul>
			</li>
<?php if(($_SESSION['centro']['tipo_usuario']==3)||($_SESSION['centro']['tipo_usuario']== 2)){ ?>
			<li>
				<a href="#">Pabell&oacute;n</a>
				<ul>
					<li><a href="#" onClick='cambiar_pagina("Visar","visados");'>Editar Pabell&oacute;n</a></li>
			
			
				</ul>
			</li>
<?php } ?>
			<li>
<?php if(($_SESSION['centro']['tipo_usuario']< 3)){ ?>
				<a href="#">Protocolo</a>
				<ul>

					<li><a href="#" onClick='cambiar_pagina("Protocolo","protocolo");'>Protocolo Operatorio</a></li>
				</ul>
			</li>
			
			<li>
				<a href="#"  >Parte M&eacute;dico</a>
				<ul>
					<li><a href="#" onClick='parte();'>Crear Partes</a></li>
					<li><a href="#" onClick='cambiar_pagina("Ver Partes","ver_partes");'>Ver Partes</a></li>
			
				</ul>

			</li>
<?php } ?>			
		</ul>
	</div>
</div>
<div id='contenedor' class='contenedor'>
	
	<div id='contenido2' class='content' style='width:97%;height:98%;'>
	</div>
</div>
<input id="X-coord" type="hidden" value="">
<input id="Y-coord" type="hidden" value="">
<input id="X-ancho" type="hidden" value="">
<input id="X-alto" type="hidden" value="">
</body>
<script>
	$('X-ancho').value = screen.width;
	$('X-alto').value = screen.height;

</script>
</html>
