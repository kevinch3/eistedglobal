<?php require_once('../Connections/ServidorUB.php');

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
// }?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <?php require_once('../funciones.php');
  $editFormAction = $_SERVER['PHP_SELF'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  }

  if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "actualizar")) {
    $updateSQL = sprintf("UPDATE anio SET comision=%s, comisionimg=%s WHERE Id_anio='$a'",
                         GetSQLValueString($_POST['comision'], "text"),
                         GetSQLValueString($_POST['comisionimg'], "text"),
                         GetSQLValueString($_POST['Id_anio'], "int"));

    $Result1 = mysqli_query($link, $updateSQL) or die(mysqli_error());

    $updateGoTo = "comision.php?a=$a";
    if (isset($_SERVER['QUERY_STRING'])) {
      $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
      $updateGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $updateGoTo));
  }

  $query_aniomod = "SELECT comision, comisionimg FROM anio WHERE Id_anio='$a'";
  $aniomod = mysqli_query($link, $query_aniomod) or die(mysqli_error());
  $row_aniomod = mysqli_fetch_assoc($aniomod);
  $totalRows_aniomod = mysqli_num_rows($aniomod);
  ?>
<body>
<center>
<h1><?php echo $a;?></h1>
<p><br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="actualizar">
<textarea name="comisionimg" cols="60" rows="3"><?php echo $row_aniomod['comisionimg'];?></textarea></p>
 <br>
  <p><textarea name="comision" cols="60" rows="20"><?php echo $row_aniomod['comision'];?></textarea></p>
  <p>
   <input type="hidden" name="Id_anio" value="<?php echo $anio ; ?>" >
  </p>
  <input type="hidden" name="MM_update" value="actualizar">
  <input type="submit" class="button button-blue" value="Actualizar registro">
</form>
<div class="oce-first" align="center"><a href="javascript:history.back(1)">Volver</a>
</div>
</center>

<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($aniomod);
?>
