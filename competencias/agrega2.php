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
$descripcion	= $_POST["descripcion"]; 
$idioma 		= $_POST["idioma"]; 
$xt_texto		= $_POST["xt_texto"]; 
$fk_anio		= $_SESSION["a"]; 
$grupind		= $_POST["grupind"];
$descripcion 	= str_replace("'","`",$descripcion);

if ($xt_texto == "") {
$xt_texto = NULL;
}

if ($id_comp == "") {  
header("Location: agrega.php?a=$fk_anio&exito=no"); 
} 

$cadena0 = $id_comp[strlen($id_comp)-3];
$caden00 = $id_comp[strlen($id_comp)-2];


if ($cadena0 == "") {  
$cadena1 = "0$id_comp" ;
} else {   
$cadena1 = $id_comp ;
}  

if ($caden00 == "") {  
$cadena3 = "0$cadena1" ;
} else {  
$cadena3 = $cadena1 ;
} 

$cadena2 = $eis.$fk_anio.$cadena3;

mysql_select_db($database_ServidorUB, $ServidorUB);
mysql_query ("INSERT INTO `competencia` (`id_comp`, `categoria`, `descripcion`, `idioma`, `fk_anio`, `grupind`, `xt_texto`) VALUES ('$cadena2', '$categoria', '$descripcion', '$idioma', '$fk_anio', '$grupind', '$xt_texto')", $ServidorUB );
header("Location: agrega.php?exito=si&comp=$cadena2"); ?>
<a href="agrega.php?exito=si&comp=<?php echo $cadena2;?>"> Volver </a>
<script language="javascript">
self.location="agrega.php?exito=si&comp=<?php echo $cadena2;?>";
</script>
<?
?> 
</body> 
</html>