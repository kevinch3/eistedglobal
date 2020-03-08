<?php require_once('../Connections/ServidorUB.php');
 $a = $_GET['a'];
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
$query_subidas = "SELECT * FROM subidas WHERE id_anio=$a";
$subidas = mysql_query($query_subidas, $ServidorUB) or die(mysql_error());
$row_subidas = mysql_fetch_assoc($subidas);
$totalRows_subidas = mysql_num_rows($subidas);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../style2.css" rel="stylesheet" type="text/css">
<link href="../boton.css" rel="stylesheet" type="text/css">

<link type="text/css" href="../jqueryui/css/redmond/jquery-ui-1.8.20.custom.css" rel="Stylesheet" />	
<script type="text/javascript" src="../jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../jqueryui/js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="../jqueryui/js/jquery.ui.datepicker-es.js"></script>

<script language="javascript" type="text/javascript">  
$(function(){
	$('#datepicker').datepicker({dateFormat: 'yy-mm-dd', changeYear: true,  yearRange: "1910:2005",  });
	$(selector).datepicker($.datepicker.regional['es']);

			
});


</script> 

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

</head>


<body>

<p>&nbsp;</p>
<center>
<table width="533" border="0" id="one-column-emphasis">
  <thead><tr>
    <th>Archivo</th>
    <th>Descripci&oacute;n</th>
  </tr></thead>
  <?php do { ?>
    <tr>
      <td><a href="archivos/<?php echo $row_subidas['archivo']; ?>"><?php echo $row_subidas['archivo']; ?></a></td>
      <td><?php echo $row_subidas['descripcion']; ?></td>
    </tr>
    <?php } while ($row_subidas = mysql_fetch_assoc($subidas)); ?>
</table>
</center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center">
 <form enctype="multipart/form-data" action="relacionadd.php" method="POST"> 
 
   
   <table border="0">
     <tr>
       <td>Archivo:</td>
       <td><input type="file" name="archivo"></td>
     </tr>
     <tr>
     <td>Detalles:</td>
      <td> <input type="text" name="data">   <input type="hidden" name="a" value="<?php echo $a;?>"></td>


     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><input type="hidden" name="a" value="<?php echo $a;?>">
 <input type="submit" value="Agregar"> </td>
     </tr>
   </table>
   
</form>
</div>
</body>
</html>
<?php
mysql_free_result($subidas);
?>
