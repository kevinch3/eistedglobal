<?php
require_once('../Connections/ServidorUB.php');
if(isset($_GET['exito'])){
  $exito=$_GET['exito'];
} else {
  $exito = NULL;
}

$p=$_GET['p'];
// if (!function_exists("GetSQLValueString")) {
// function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
// {
//   if (PHP_VERSION < 6) {
//     $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
//   }
//
//   $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
//
//   switch ($theType) {
//     case "text":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;
//     case "long":
//     case "int":
//       $theValue = ($theValue != "") ? intval($theValue) : "NULL";
//       break;
//     case "double":
//       $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
//       break;
//     case "date":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;
//     case "defined":
//       $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
//       break;
//   }
//   return $theValue;
// }
// }

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE persona SET Nombre=%s, Apellido=%s, FechaNac=%s, Nacionalidad=%s, Residencia=%s, Email=%s, Telefono=%s WHERE id_persona=%s",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Apellido'], "text"),
                       GetSQLValueString($_POST['FechaNac'], "date"),
                       GetSQLValueString($_POST['Nacionalidad'], "text"),
                       GetSQLValueString($_POST['Residencia'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Telefono'], "text"),
                       GetSQLValueString($_POST['id_persona'], "int"));

  // mysqli_select_db($link, $database_ServidorUB);
  $Result1 = mysqli_query($link, $updateSQL) or die(mysqli_error());

  $updateGoTo = "modificar.php?exito=si";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

// mysqli_select_db($link, $database_ServidorUB);
$query_personas = "SELECT * FROM persona WHERE id_persona='$p' ORDER BY Nombre ASC";
$personas = mysqli_query($link, $query_personas) or die(mysqli_error());
$row_personas = mysqli_fetch_assoc($personas);
$totalRows_personas = mysqli_num_rows($personas);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php require_once('../embed.php'); ?>

<script language="javascript" type="text/javascript">
$(function(){
	$('#datepicker').datepicker({dateFormat: 'yy-mm-dd', changeYear: true,  yearRange: "1930:2015",  });
	$(selector).datepicker($.datepicker.regional['es']);


});
</script>
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
<script type="text/javascript" src="../../shadowbox/shadowbox.js"></script>
<script type="text/javascript"> Shadowbox.init(); </script>
</head>

<body>
<center>
<?php if ($exito === "si"){
	echo "<div align=\"center\"><h3>Fué cambiado exitosamente</h3></div>";
} ?>
  <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
   <table id="one-column-emphasis"  align="center">
      <colgroup>
    	<col class="oce-first" />
      <tr valign="baseline">
        <td nowrap align="right">Nombre:</td>
        <td><input type="text" name="Nombre" value="<?php echo htmlentities($row_personas['Nombre'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Apellido:</td>
        <td><input type="text" name="Apellido" value="<?php echo htmlentities($row_personas['Apellido'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">FechaNac:</td>
        <td> <label for="fecha"><input type="text" id="datepicker" name="FechaNac" value="<?php echo htmlentities($row_personas['FechaNac'], ENT_COMPAT, ''); ?>"/></label></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Nacionalidad:</td>
        <td><input type="text" name="Nacionalidad" value="<?php echo htmlentities($row_personas['Nacionalidad'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Residencia:</td>
        <td><input type="text" name="Residencia" value="<?php echo htmlentities($row_personas['Residencia'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Email:</td>
        <td><input type="text" name="Email" value="<?php echo htmlentities($row_personas['Email'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Telefono:</td>
        <td><input type="text" name="Telefono" value="<?php echo htmlentities($row_personas['Telefono'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" class="button button-blue" value="Actualizar registro"></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="id_persona" value="<?php echo $row_personas['id_persona']; ?>">
    <div align="center">
      <table width="200" border="0">
        <tr>
          <td width="97"> <a href="borra.php?p=<?php echo $row_personas['id_persona']; ?>" > <img align="middle" src="../table-images/delete.png" width="16" height="16" alt="borrar">Borrar</a></td>
          <td width="97"> <a href="javascript:history.back(1)">Volver</a></td>
        </tr>
      </table>
    </div>
</form>
  <p>&nbsp;</p>
</center>
</body>
</html>
<?php mysqli_free_result($personas); ?>
