<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Alta Persona</title>
  <?php require_once('../embed.php'); ?>
  </head>
  <body style="height: 300px;">
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
    $insertSQL = sprintf("INSERT INTO persona (id_persona, Nombre, Apellido, DNI, FechaNac, Nacionalidad, Residencia, Email, Telefono, tipo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                         GetSQLValueString($_POST['id_persona'], "int"),
                         GetSQLValueString($_POST['Nombre'], "text"),
                         GetSQLValueString($_POST['Apellido'], "text"),
  					   GetSQLValueString($_POST['DNI'], "text"),
                         GetSQLValueString($_POST['FechaNac'], "date"),
                         GetSQLValueString($_POST['Nacionalidad'], "text"),
                         GetSQLValueString($_POST['Residencia'], "text"),
                         GetSQLValueString($_POST['Email'], "text"),
                         GetSQLValueString($_POST['Telefono'], "text"),
  					   GetSQLValueString($_POST['tipo'], "text"));

    $Result1 = mysqli_query($link, $insertSQL) or die(mysqli_error());
    if ($redir==NULL){
    $insertGoTo = "agrega.php?exito=si&type=IND";
  	} else {
  	$insertGoTo = $redir;
  	}

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
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table id="one-column-emphasis"  align="center">
        <colgroup>
      	<col class="oce-first" />
      </colgroup>
      <tr valign="baseline">
        <td width="203" align="right" nowrap="nowrap">Nombre:</td>
        <td width="237"><input type="text" name="Nombre" value="<?php echo $participante; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Apellido:</td>
        <td><input type="text" name="Apellido" value="" size="32" /></td>
      </tr>
       <tr valign="baseline">
        <td nowrap="nowrap" align="right">DNI:</td>
        <td><input type="text" name="DNI" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Fecha de Nacimiento:</td>
        <td><!--input type="text" name="FechaNac" value="" size="32" /-->
         <label for="fecha"><input type="text" id="datepicker" name="FechaNac" size="32"/></label>
  </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nacionalidad:</td>
        <td><input type="text" name="Nacionalidad" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Residencia:</td>
        <td><input type="text" name="Residencia" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Email:</td>
        <td><input type="text" name="Email" size="50" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Tel&eacute;fono:</td>
        <td><input name="Telefono" type="text" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="hidden" name="tipo" value="IND" />
        <input type="submit" class="button button-blue" value="Insertar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  </body>
  <script language="javascript" type="text/javascript">
    $(function(){
    	$('#datepicker').datepicker({dateFormat: 'yy-mm-dd', changeYear: true,  yearRange: "1910:2015",  });
    	$(selector).datepicker($.datepicker.regional['es']);
    });
  </script>
  <?php mysqli_free_result($personas); ?>
</html>
