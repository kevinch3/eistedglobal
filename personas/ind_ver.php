<?php if (!function_exists("GetSQLValueString")) {
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
$query_personas = "SELECT * FROM persona WHERE tipo = '$type' ORDER BY Apellido ASC";
$personas = mysql_query($query_personas, $ServidorUB) or die(mysql_error());
$row_personas = mysql_fetch_assoc($personas);
$totalRows_personas = mysql_num_rows($personas);
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

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="../../shadowbox/shadowbox.js"></script>
<script type="text/javascript"> Shadowbox.init(); </script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<center>
<table border="0" align="center" id="one-column-emphasis" summary="2007 Major IT Companies' Profit">
  <thead>
  <tr>
    <th>Nombre</th>
    <th>Fecha Nacimiento</th>
    <th>Nacionalidad</th>
    <th>Residencia</th>
    <th>Email</th>
    <th>Tel&eacute;fono</th>
    <th></th>   
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td><?php echo $row_personas['Apellido']. ", ".$row_personas['Nombre'];  ?></td>
      <td><?php echo $row_personas['FechaNac']; ?></td>
      <td><?php echo $row_personas['Nacionalidad']; ?></td>
      <td><?php echo $row_personas['Residencia']; ?></td>
      <td><?php echo $row_personas['Email']; ?></td>
      <td><?php echo $row_personas['Telefono']; ?></td>
      <td><a href="modificar.php?p=<?php echo $row_personas['id_persona']; ?>"><img src="http://doc.windev.com/en-US/ui/modify.gif" border="0"></a></td>
    </tr>
    <?php } while ($row_personas = mysql_fetch_assoc($personas)); ?>
</table>
</center>
</body>
</html>
<?php
mysql_free_result($personas);
?>

