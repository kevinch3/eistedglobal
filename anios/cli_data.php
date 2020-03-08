<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require_once('../Connections/ServidorUB.php');
$noauth = TRUE;
require_once('../funciones.php');

$consulta 	= $_GET['consulta'];
$eis 		= strtoupper($_GET['eis']);
$a			= $_GET['a'];

$query_anio = "SELECT * FROM anio WHERE Id_anio='$a'";
$anio = mysqli_query($link, $query_anio) or die(mysqli_error());
$row_anio = mysqli_fetch_assoc($anio);
$totalRows_anio = mysqli_num_rows($anio); ?>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<script src="<?php echo $sitio; ?>diseno/jquery.min.js" ></script>
<script type="text/javascript" src="../../shadowbox/shadowbox.js"></script>
<style type="text/css" media="all">@import "../../shadowbox/shadowbox.css";</style>
<script type="text/javascript"> Shadowbox.init({
    language: 'es',
    players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv']
});
</script>

<style>
.descr{
margin: 20px;
position: absolute;
width: 590px;
height: 300px;
overflow: auto;
}
h5{
font-size: 1.2em;
font-weight: bold;
}
b{
font-weight: bold;
}
</style>
</head>

<body style="width: 600px; height: 330px; margin: 0;">
<?
if (empty($eis) or empty($a) or empty($consulta)){
echo "ERROR EN LA CONSULTA";
exit();
}
echo $sitio;

if ($consulta == "presentadores"){?>
	<?php $imagenes = explode(",", $row_anio['presentadoresimg']); ?>
		<span class="descr"><?php echo $row_anio['presentadores']; ?></span>
		<div style="width: 100%;margin: 0;top: 180px;position: relative;text-align: center;background: black;">
		<?php foreach ($imagenes as $imagen){?>
			<a href="<?php echo $sitio.$imagen; ?>" rel="shadowbox"><img src="<?php echo $sitio.$imagen; ?>" style="width:30%; margin: 1%; display: inline;"/></a>
		<?php } ?>
		</div>
<?php } elseif ($consulta == "jurados"){?>
	<span class="descr"><?php echo $row_anio['jurado']; ?></span>
<?php } elseif ($consulta == "coordinadores"){ ?>
	<span class="descr"><?php echo $row_anio['coordinadores']; ?></span>
<?php } elseif ($consulta == "comision"){ ?>
<span class="descr"><?php echo $row_anio['comision']; ?></span>
<div style="width: 100%;margin: 0;top: 200px;position: relative;text-align: center;background: black;">
	<a href="<?php echo $sitio.$row_anio['comisionimg'] ?>" rel="shadowbox"><img src="<?php echo $sitio.$row_anio['comisionimg']; ?>" style="width:30%; margin: 1%; display: inline;"/></a>
</div>
<?} else {
echo "no se entiende la consulta";
exit();
}
?>
</body>
</html>
