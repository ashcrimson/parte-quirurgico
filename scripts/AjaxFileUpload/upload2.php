<?php
/**
* upload2.php
*
* @uses ejemplo de uso
* @version 1.0
* @author Damian Suarez
*
* Este Archivo forma parte de un conjunto de archivos posteados en un tutorial denominado 'Ajax File Upload ?'
* Dicho post se encuentra en http://cabeza-de-raton.blogspot.com/2007/02/ajax-file-upload_4846.html
* 
* Mi Blog: http://blog.cabezaderaton.com.ar
* Mi Email: rdsuarez@gmail.com
*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>Ajax File Upload - Formulario</title>
	<link rev="made" href="mailto:rdsuarez@gmail.com" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
<form method="post" enctype="multipart/form-data" action="controlUpload2.php" target="iframeUpload">
	Archivo: <input name="fileUpload" type="file" onchange="javascript: submit()" />
	<br /><iframe name="iframeUpload" style="display:none"></iframe>
</form>
<p><a href="verArchivos.php">Ver Archivos</a></p>
</body>
</html>


