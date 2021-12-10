<?php
	require_once("../conexion/conexion.php");
	
	if($_GET['form']=='examenes') {
?>
<head>
	<link rel="stylesheet" href="../css/index.css" type="text/css" />
	<link rel="stylesheet" href="../css/usuarios.css" type="text/css" />
</head>
<script type="text/javascript" src="../scripts/getElementsByAttribute.js"></script>
<script type="text/javascript" src="../scripts/prototype.js"></script>
<script type="text/javascript" src="../scripts/json.js"></script>
<script type="text/javascript" src="../scripts/menu.js"></script>
	<script>
		
	
	

		
		cargar_cargos2 = function() {
	var  idusuario = '<?php echo($_GET["identificador"]);?>';
	
			param = 'tipo=cargos2&idusuario='+idusuario;
			
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

	<table>
		<div class='fpapel' id='cargos' style='height:150px;'>
		
		</div>
	</table>	
<?php
	}
?>