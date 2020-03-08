<?php require_once('../Connections/ServidorUB.php');

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "actualizar")) {
  $updateSQL = sprintf("UPDATE anio SET presentadores=%s, presentadoresimg=%s WHERE Id_anio='$a'",
                       GetSQLValueString($_POST['presentadores'], "text"),
                       GetSQLValueString($_POST['presentadoresimg'], "text"),
                       GetSQLValueString($_POST['Id_anio'], "int"));

  // mysql_select_db($database_ServidorUB, $ServidorUB);
  $Result1 = mysqli_query($link, $updateSQL) or die(mysql_error());

  $updateGoTo = "presentadores.php?a=$a";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

// mysql_select_db($database_ServidorUB, $ServidorUB);
$query_aniomod = "SELECT * FROM anio WHERE Id_anio='$a'";
$aniomod = mysqli_query($link, $query_aniomod) or die(mysql_error());
$row_aniomod = mysqli_fetch_assoc($aniomod);
$totalRows_aniomod = mysqli_num_rows($aniomod);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../style2.css" rel="stylesheet" type="text/css">
<link href="../boton.css" rel="stylesheet" type="text/css">
<style type="text/css" media="all">@import "../../shadowbox/shadowbox.css";</style>


<style type="text/css">
option {font-family: verdana; color: black}
option.Poesia {background-color: #eaeaf4;  color: #000;}
option.Prosa {background-color: #fefefe}
option.Recitacion {background-color: #eaeaf4}
option.dos {background-color: #fefefe}
SELECT.css{ font-family: verdana; color: white; background-color:#666;}
</style>
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


<body>
<center>
<h1><?php echo $a;?></h1>
<p><br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="actualizar">
<textarea name="presentadoresimg" cols="60" rows="3"><?php echo $row_aniomod['presentadoresimg'];?></textarea></p>
 <br>
  <p><textarea name="presentadores" cols="60" rows="20"><?php echo $row_aniomod['presentadores'];?></textarea></p>
  <p>
   <input type="hidden" name="Id_anio" value="<?php echo $anio ; ?>" >
  </p>
  <input type="hidden" name="MM_update" value="actualizar">
  <input type="submit" class="button button-blue" value="Actualizar registro">
</form>
<div class="oce-first" align="center"><a href="javascript:history.back(1)"><img align="middle" width="16" height="16" alt="volver">Volver</a>
</div>
</center>

<p>&nbsp;</p>
</body>
</html>
