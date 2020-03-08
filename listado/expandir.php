<?php require_once('../Connections/Limitado.php'); 
$age = date("Y");
 $c=$_GET['c'];?>

<?php
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

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_anio = "SELECT * FROM `anio`";
$anio = mysql_query($query_anio, $ServidorUB) or die(mysql_error());
$row_anio = mysql_fetch_assoc($anio);
$totalRows_anio = mysql_num_rows($anio);

$maxRows_competencias = 30;
$pageNum_competencias = 0;
if (isset($_GET['pageNum_competencias'])) {
  $pageNum_competencias = $_GET['pageNum_competencias'];
}
$startRow_competencias = $pageNum_competencias * $maxRows_competencias;

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_competencias = "SELECT * FROM competencia WHERE id_comp='$c' ";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../style2.css" rel="stylesheet" type="text/css">
<link href="../boton.css" rel="stylesheet" type="text/css">

<style type="text/css" media="all">@import "../../shadowbox/shadowbox.css";</style>

<style type="text/css">
div.selectBox {
   position: relative;
   width: 230px;
   height: 22px;
   border: 1px solid #036;
   background: url(http://www.cmacias.com/wp-content/uploads/2009/button.png) 210px center no-repeat;
}
   div.selectBox div.box {
      position: absolute;
      left: 3px;
      top: 3px;
      width: 200px;
      height: 16px;
      line-height: 16px;
      font-family: arial;
      font-size: 11px;
      color: #036;
      overflow: hidden;
   }
   div.selectBox select {
	position: absolute;
	left: -1px;
	top: -1px;
	width: 220px;
	height: 24px;
	border: 1px solid #036;
	opacity: 0;
	filter: alpha(Opacity=0);
	-moz-opacity: 0;
	cursor: pointer;
	z-index:100;
   }
      div.selectBox select option{
         padding: 4px;
         font-size: 11px;
         color: #036;
         border-bottom: 1px solid #eee;
         cursor: pointer;
      }
      div.selectBox select option.ultimo{
         border-bottom: 0px none;
      }
</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="../../shadowbox/shadowbox.js"></script>
<script type="text/javascript"> Shadowbox.init(); </script>
<title>Competencias<?php echo $age ; ?></title>
</head>

<body>
<center>
<p><?php echo $row_competencias['descripcion']; ?></p>
</center>
</body>
</html>
<?php
mysql_free_result($anio);

mysql_free_result($competencias);
?>