<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require_once('funciones.php');
require_once($conectar);
// Buscar cambios en la edicion del eisteddfod
if (isset ($_GET["edicion"])){ $_SESSION["edicion"]= $_GET["edicion"]; }
if (isset ($_GET["a"])){ $_SESSION["a"]= $_GET["a"]; }
if ($_SESSION["a"] == " "){
echo "ERROR EN FECHA. ";
}
?>
<html>
<head>
<?php require_once('embed.php'); ?>
<title>Panel de datos del Eisteddfod del Chubut</title>
</head>
<body onload="startTime()" style="background: url(<?php echo $sitio;?>/images/<?php echo $_SESSION["edicion"]; ?>/bg.jpg) no-repeat center center fixed; -webkit-background-size: cover;  -moz-background-size: cover;  -o-background-size: cover;  background-size: cover;">
<div class="contenedor">
    <div class="header">
    <h1><img src="<?php echo $sitio; ?>/images/narciso.jpg" /><?php echo txtEIS($_SESSION["edicion"]);?></h1>
</div>
