<?php 
require_once('../Connections/ServidorUB.php'); 
require_once('../funciones.php');
//
/* verificar la conexi�n */
if (mysqli_connect_errno()) {
    printf("Conexi�n fallida: %s\n", mysqli_connect_error());
    exit();
}
$eis = strtoupper(substr($_SESSION["edicion"],0,2));
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/diseno.css" rel="stylesheet" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" /> 
</head> 
<body> 
<h2><i class="fa fa-refresh fa-spin fa-4x"></i></h2>
<?php 
$id_comp 		= $_POST["id_comp"]; 
$categoria		= $_POST["categoria"]; 
//$descripcion	= htmlentities($_POST["descripcion"], ENT_QUOTES | ENT_IGNORE, "ISO-8859-1"); 
$descripcion	= $_POST["descripcion"]; 
$idioma 		= $_POST["idioma"]; 
$fk_anio		= $_POST["fk_anio"]; 
$grupind		= $_POST["grupind"];
$preliminar		= $_POST["preliminar"]; 
$rank			= $_POST["rank"]; 
$xt_texto		= $_POST["xt_texto"]; 

if ($xt_texto == "") {
$xt_texto = NULL;
}

if ($_GET[borra] == "si") {  
mysql_select_db($database_ServidorUB, $ServidorUB);
$q= "DELETE FROM competencia WHERE id_comp='".$_GET[c]."'";
mysql_query ($q, $ServidorUB);
header("Location: agrega.php?borra=si&c=".$_GET[c].""); 
echo "borrando..."; ?>
<script language="javascript">
self.location="agrega.php?exito=si&comp=<?php echo $_GET[c];?>";
</script>
<?
exit();

} else {
$descripcion = str_replace("'","`",$descripcion);
$cadena11 = "$eis$fk_anio$id_comp" ;
$cadena11 = strtoupper($cadena11);
mysql_select_db($database_ServidorUB, $ServidorUB);
$q= "UPDATE competencia SET categoria='$categoria', descripcion='$descripcion', idioma='$idioma', preliminar='$preliminar', rank='$rank', grupind='$grupind', xt_texto='$xt_texto' WHERE id_comp='$cadena11' " ;

mysql_query ($q, $ServidorUB);
?>
<script language="javascript">
self.location="agrega.php?exito=si&comp=<?php echo $cadena11;?>";
</script>
<a href="agrega.php?exito=si&comp=<?php echo $cadena11;?>"> Volver </a>
<?php } ?> 
</body> 
</html>