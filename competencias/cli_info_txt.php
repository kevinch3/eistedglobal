<?php
require_once('../Connections/ServidorUB.php');
$noauth = TRUE;
require_once('../funciones.php');
//
/* verificar la conexi�n */
if (mysqli_connect_errno()) {
    printf("Conexion fallida: %s\n", mysqli_connect_error());
    exit();
}

if (!isset($_GET['c'])){
  echo "Error ref competencia";
  exit();
} else {
  $c = $_GET['c'];
}

$eis 	= strtoupper(substr($c,0,2));
$a		= substr($c,2,4);
$idcomp	= substr($c,6,6);
//echo	$eis.$a.$idcomp;
/*
mysql_select_db($database_ServidorUB, $ServidorUB);
$query_categorias = "SELECT id_cat, nombre FROM categoria";
$categorias = mysql_query($query_categorias, $ServidorUB) or die(mysql_error());
$row_categorias = mysql_fetch_assoc($categorias);
$totalRows_categorias = mysql_num_rows($categorias);
*/
mysqli_select_db($link, $database_ServidorUB);
$query  = "SELECT id_comp,xt_texto FROM competencia WHERE id_comp = '$c' ";
$mquery = mysqli_query($link, $query) or die(mysql_error());
$row_q	= mysqli_fetch_assoc($mquery);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/diseno.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<title>Informaci�n de Competencia (Texto)</title>
</head>
<body style="height: 360px; width: 450px;overflow: hidden;">
	<div class="wrapperInfo">
		<div class="InDOWN">
			<div class="center">
				<?php echo $row_q['xt_texto']; ?>
			</div>
		</div>
		<div class="foot">
			<div class="foot_menuizq cerocero">
			<a href="cli_info.php?c=<?php echo $c; ?>"><i class="fa fa-arrow-circle-left"></i> Volver</a>
			</div>
		</div>
	</div>
</body>
</html>
