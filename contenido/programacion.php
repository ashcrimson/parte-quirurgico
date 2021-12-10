 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
//ini_set('display_errors','1');
require_once('../conexion/conexion.php');
if($_GET['form']=='ingreso'){
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<script type="text/javascript" src="../scripts/tinymce/tinymce.min.js"></script>
	<link rel="stylesheet" href="../css/usuarios.css" type="text/css" />
	<link rel="stylesheet" href="../scripts/chosen/docsupport/style.css">
	<link rel="stylesheet" href="../scripts/chosen/docsupport/prism.css">
	<link rel="stylesheet" href="../scripts/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../css/calendar-blue.css" title="win2k-cold-1" />


<script type="text/javascript" src="../scripts/calendar.js"></script>
<script type="text/javascript" src="../scripts/calendar-es.js"></script>
<script type="text/javascript" src="../scripts/calendar-setup.js"></script>
<script type="text/javascript" src="../scripts/getElementsByAttribute.js"></script>
<script type="text/javascript" src="../scripts/prototype.js"></script>
<script type="text/javascript" src="../scripts/json.js"></script>
<script type="text/javascript" src="../scripts/menu.js"></script>
</head>

<script>
			cargar_cargos2 = function() {
			param = 'tipo=programacion&idusuario='+15067442;
			
			var myAjax = new Ajax.Updater(
				'cargos', 
				'usuarios_db.php', 
				{
					method: 'get', 
					parameters: param,
					evalScripts: true
				}
				
			);
		}

cargar_cargos2();
		
	</script>

	
		<div class='fpapel' id='cargos' style='height:150px;'>
		</div>
	
	
</script>

</html>
<?php
}
?>