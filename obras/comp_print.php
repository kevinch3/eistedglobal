<?php 
require_once('../Connections/ServidorUB.php');
$age =$_GET['a'];

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_anio = "SELECT * FROM `anio`";
$anio = mysql_query($query_anio, $ServidorUB) or die(mysql_error());
$row_anio = mysql_fetch_assoc($anio);
$totalRows_anio = mysql_num_rows($anio);

$maxRows_competencias = 200;
$pageNum_competencias = 0;
if (isset($_GET['pageNum_competencias'])) {
  $pageNum_competencias = $_GET['pageNum_competencias'];
}
$startRow_competencias = $pageNum_competencias * $maxRows_competencias;

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_competencias = "SELECT * FROM competencia WHERE fk_anio='$age' ORDER BY id_comp ASC";
$query_limit_competencias = sprintf("%s LIMIT %d, %d", $query_competencias, $startRow_competencias, $maxRows_competencias);
$competencias = mysql_query($query_limit_competencias, $ServidorUB) or die(mysql_error());
$row_competencias = mysql_fetch_assoc($competencias);

if (isset($_GET['totalRows_competencias'])) {
  $totalRows_competencias = $_GET['totalRows_competencias'];
} else {
  $all_competencias = mysql_query($query_competencias);
  $totalRows_competencias = mysql_num_rows($all_competencias);
}
$totalPages_competencias = ceil($totalRows_competencias/$maxRows_competencias)-1;


$queryString_competencias = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_competencias") == false && 
        stristr($param, "totalRows_competencias") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_competencias = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_competencias = sprintf("&totalRows_competencias=%d%s", $totalRows_competencias, $queryString_competencias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style>
tr{
padding: 5px;}
.titulo-competencia{
background: #c6c6c6;
color: #000000;

}

</style>
<title>Competencias a�o <?php echo $age ; ?> [Version Imprimible]</title>
</head>
<body>
<div id="header" align="center">
<div id="page-wrap">
<table id="report">
        <?php 
		 do {
$idcomp = $row_competencias['id_comp'];
	if (substr($idcomp, -2,-1)== 0){
		$competencia = substr($idcomp,-1);
	} else if (substr($idcomp, -3,-2)== 0){
		$competencia = substr($idcomp,-2);
	} else {
		$competencia = substr($idcomp,-3);
	}
	
$cat = $row_competencias['categoria'];	
$SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'";
$QUERY3 =  mysql_query ($SQL3);
$categ = mysql_fetch_array($QUERY3);
?>
        <tr class="titulo-competencia">
            <td><?php echo $competencia ; ?></td>
            <td><?php echo $categ[nombre]; ?></td>
            <td><?php
	// Limitador de caracteres
		// Inicializamos las variables
	$tamano = 70; // tama�o m�ximo
	$contador = 0;
	$descripcion = $row_competencias['descripcion'];
		// Cortamos la cadena por los espacios
	$arraydescripcion = split(' ',$descripcion);
	$descripcion = '';
		// Como quedar�a...
	while($tamano >= strlen($descripcion) + strlen($arraydescripcion[$contador])){
		$descripcion .= ' '.$arraydescripcion[$contador];
		$contador++;
	}
	$descriptor = explode("<ul>",$descripcion);
	echo $descriptor[0];
	// Fin de Limitador de caracteres
	?></td>
            <td>
			<?php if ($row_competencias['idioma'] == "Cymraeg"){?>
            <p>Gal�s </p>
                <?} else if ($row_competencias['idioma'] == "Castellano"){ ?>	
			<p>Espa�ol </p>
                <?php } else {echo " Otro idioma ";}?>	
			</td>
        </tr>
		
        <tr>
            <td colspan="5">
        <?
    $query_ganadores = "SELECT * FROM Obra WHERE competencia = ".$idcomp." ORDER BY puesto ASC" ;
	$ganadores = mysql_query($query_ganadores, $ServidorUB) or die(mysql_error());
	$row_ganadores = mysql_fetch_assoc($ganadores);
	$totalRows_ganadores = mysql_num_rows($ganadores);
		?>
		
        <?php if ($totalRows_ganadores == 0){
			} else {
				do {
		$query_persona = "SELECT id_persona, Nombre, Apellido, Residencia, Nacionalidad FROM persona WHERE id_persona = \"".$row_ganadores["fk_particip"]."\"";
		$persona = mysql_query($query_persona, $ServidorUB) or die(mysql_error());
		$row_persona = mysql_fetch_assoc($persona);
	?>
	<li>
     <?php 
	 echo "<b>".$row_ganadores["puesto"].") </b>";
	 if ($row_persona["Residencia"] != NULL){
	 echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." (".$row_persona["Residencia"].", ".$row_persona["Nacionalidad"].")"; 
	 } else {
		 echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." - ".$row_persona["Nacionalidad"]; }?>
    
        </li>
	<?php echo "<br />";
	} while ($row_ganadores = mysql_fetch_assoc($ganadores));
	}
	?> 
    </td>    
    </tr>
        <?php } while ($row_competencias = mysql_fetch_assoc($competencias));?>
    </table>
    </div>
    </div>
<!-- FIN Tabla nueva-->
   
<div align="center" style="padding: 5px; background: black; color: white;">
<?php echo date("d/m/Y - H:i:s");  ?> | Asociaci�n Eisteddfod del Chubut 
</div>
</body>
</html>
<?php mysql_free_result($anio);mysql_free_result($competencias);mysql_free_result($ganadores); ?>
