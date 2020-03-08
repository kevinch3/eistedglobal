<?php 
require_once('../Connections/ServidorUB.php');
require_once('../Connections/Limitado.php');
$age =$_GET['a'];
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_anio = "SELECT * FROM `anio`";
$anio = mysql_query($query_anio, $ServidorUB) or die(mysql_error());
$row_anio = mysql_fetch_assoc($anio);
$totalRows_anio = mysql_num_rows($anio);

$maxRows_competencias = 20;
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
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<?php include("scripts.php") ;?>

<title>Competencias a�o <?php echo $age ; ?> << </title>
</head>

<body>
<h2>Listado de Competencias - [Edici&oacute;n <?php echo $age ; ?>]</h2>
<!-- PRUEBA DE ACORDION -->

<div id="accordion">
<?php do { ?>
	<h3>Competencia 
	  <?php 
$idcomp = $row_competencias['id_comp'];
	if (substr($idcomp, -2,-1)== 0){
		$competencia = substr($idcomp,-1);
	} else if (substr($idcomp, -3,-2)== 0){
		$competencia = substr($idcomp,-2);
	} else {
		$competencia = substr($idcomp,-3);
	}
	echo $competencia ; 

$cat = $row_competencias['categoria'];	
$SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'";
$QUERY3 =  mysql_query ($SQL3);
$categ = mysql_fetch_array($QUERY3);
echo "- <b title=\"$categ[nomcym]\">".$categ[nombre]."</b>";
?>
	</h3>
	<div><a href="expandir.php?c=<?php echo $row_competencias['id_comp']; ?>" rel="shadowbox;height=200;width=350" title="Competencia <?php echo $row_competencias['descripcion']; ?>" > <?php 	  
	  echo $row_competencias['descripcion']; ?></a><br />
      <p><b>Idioma: </b><?php echo $row_competencias['idioma']; ?></p>
      <?php if ($row_competencias['cont'] != NULL){
	  echo "<p><b>Contenido: </b>".$row_competencias['cont']."</p>";
	  }?>      
	  <?php if ($row_competencias['extra'] != NULL){
	  echo "<p><b>Descarga: </b><a href=\"".$row_competencias['extra']."\"><img src=\"../iconos/pdf.png\" /> Contenido adicional. </a></p>"; 
	  }?>
	  <div align="center">
      
      <?
    $query_ganadores = "SELECT * FROM Obra WHERE competencia = ".$idcomp." ORDER BY puesto ASC" ;
	$ganadores = mysql_query($query_ganadores, $ServidorUB) or die(mysql_error());
	$row_ganadores = mysql_fetch_assoc($ganadores);
	$totalRows_ganadores = mysql_num_rows($ganadores);
		?>
        <?php if ($totalRows_ganadores != 0){
			echo "<h3>".$totalRows_ganadores." ganadores</h3>";
			
   
			do {
			

$query_persona = "SELECT id_persona, Nombre, Apellido, Residencia FROM persona WHERE id_persona = \"".$row_ganadores["fk_particip"]."\"";
$persona = mysql_query($query_persona, $ServidorUB) or die(mysql_error());
$row_persona = mysql_fetch_assoc($persona);
	
	
	$vid = $row_ganadores["VIDEOURLS"];
	$videourl = explode(',', $vid);
	$img = $row_ganadores["PHOTOURLS"];
	$imgurl = explode(',', $img);?>
    <table border="0">
     <tr><td>
     
     <?php 
	 echo "<p>".$row_ganadores["puesto"].") ";
	 echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." (".$row_persona["Residencia"].")"; ?></td>
     <?	
	 if ($vid != NULL){
	 	for($j=0;$j<count($videourl);$j++){
		echo "<td><div class=\"thumbnail-item\"><a href=\"http://www.youtube.com/v/".$videourl[$j]."\" rel=\"shadowbox;width=405;height=340\" ><img src=\"../iconos/yt.png\"></a><div class=\"tooltip\"><img src=\"http://i.ytimg.com/vi/".$videourl[$j]."/default.jpg\"> <span class=\"overlay\"></span></div></div></td>";
		}
		}?>
    
     <?	
	 if ($img != NULL) {
		for($j=0;$j<count($imgurl);$j++){
		echo "<td><a href=\"".$imgurl[$j]."\" rel=\"shadowbox\" ><img src=\"../iconos/img.png\"></a></td>";
		}
		}?>
      </tr>
	</table>
	<?php 

	} while ($row_ganadores = mysql_fetch_assoc($ganadores));
	}
	?>
    
      </div>
	</div>
    
    <?php } while ($row_competencias = mysql_fetch_assoc($competencias));?>
</div>


<!-- FIN PRUEBA DE ACORDION -->
<div align="center">
<table border="0">
  <tr>
    <td><?php if ($pageNum_competencias > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, 0, $queryString_competencias); ?>">Primero</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_competencias > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, max(0, $pageNum_competencias - 1), $queryString_competencias); ?>">Anterior</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_competencias < $totalPages_competencias) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, min($totalPages_competencias, $pageNum_competencias + 1), $queryString_competencias); ?>">Siguiente</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_competencias < $totalPages_competencias) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, $totalPages_competencias, $queryString_competencias); ?>">&Uacute;ltimo</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</div>

<?php include("../version.php"); ?>

</body>
</html>
<?php
mysql_free_result($anio);

mysql_free_result($competencias);

mysql_free_result($ganadores);
?>
