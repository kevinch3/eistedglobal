<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

  $editFormAction = $_SERVER['PHP_SELF'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  }

  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO persona (id_persona, Nombre, Nacionalidad, Residencia, Email, tipo) VALUES (%s, %s, %s, %s, %s, %s)",
                         GetSQLValueString($_POST['id_persona'], "int"),
                         GetSQLValueString($_POST['Nombre'], "text"),
                         GetSQLValueString($_POST['Nacionalidad'], "text"),
                         GetSQLValueString($_POST['Residencia'], "text"),
                         GetSQLValueString($_POST['Email'], "text"),
  					   GetSQLValueString($_POST['tipo'], "text"));

    $Result1 = mysqli_query($link, $insertSQL) or die(mysqli_error());

    if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
  }

  $query_personas = "SELECT * FROM persona ORDER BY Apellido ASC";
  $personas = mysqli_query($link, $query_personas) or die(mysqli_error());
  $row_personas = mysqli_fetch_assoc($personas);
  $totalRows_personas = mysqli_num_rows($personas);
  ?>
  <head>
  <title>Alta GRUPO</title>
  <?php require_once('../embed.php'); ?>

  </head>
  <body style="height: 250px;">
  <center>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table id="one-column-emphasis"  align="center">
        <colgroup>
      	<col class="oce-first" />
      </colgroup>
      <tr valign="baseline">
        <td width="203" align="right" nowrap="nowrap">Nombre del Conjunto/Coro:</td>
        <td width="237"><input type="text" name="Nombre" value="<?php echo $participante; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nacionalidad:</td>
        <td><input type="text" name="Nacionalidad" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Provincia / Ciudad:</td>
        <td><input type="text" name="Residencia" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Email:</td>
        <td><input type="text" name="Email" size="50" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="hidden" name="tipo" value="GRU" />
          <input type="submit" class="button button-blue" value="Insertar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />

  </form>
  </center>
  </body>
  <script language="javascript" type="text/javascript">
    $(function(){
    	$('#datepicker').datepicker({dateFormat: 'yy-mm-dd', changeYear: true,  yearRange: "1910:2015",  });
    	$(selector).datepicker($.datepicker.regional['es']);
    });
  </script>
  <?php mysqli_free_result($personas); ?>
</html>
