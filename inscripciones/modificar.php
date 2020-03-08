<?php require_once('../Connections/ServidorUB.php');
 $in=$_GET['in'];

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE inscriptos SET fk_comp=%s, seudonimo=%s, WHERE id_inscripto=%s",
                       GetSQLValueString($_POST['fk_comp'], "int"),
                       GetSQLValueString($_POST['seudonimo'], "text"),
                       GetSQLValueString($_POST['id_inscripto'], "int"));

$Result1 = mysqli_query($link, $updateSQL);

  $updateGoTo = "ver.php?a=$a"  ;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$query_inscriptos = "SELECT * FROM inscriptos WHERE id_inscripto='$in'";
$inscriptos = mysqli_query($link, $query_inscriptos) or die(mysqli_error());
$row_inscriptos = mysqli_fetch_assoc($inscriptos);
$totalRows_inscriptos = mysqli_num_rows($inscriptos);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php require_once('../embed.php'); ?>
<script language="javascript" type="text/javascript">
function obtiene_fecha() {
    var fecha_actual = new Date()
    var dia = fecha_actual.getDate()
    var mes = fecha_actual.getMonth() + 1
    var anio = fecha_actual.getFullYear()
    if (mes < 10)
        mes = '0' + mes
    if (dia < 10)
        dia = '0' + dia
    return (anio + "/" + dia + "/" + mes)
}
function MostrarFecha() {
   document.write(obtiene_fecha())
}
</script>
<script type="text/javascript"> Shadowbox.init(); </script>
<title>Actualizar</title>
</head>
<body>
  <center>
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">

      <?
      $persona = $row_inscriptos['fk_persona'];
      $query_persona =  mysqli_query ($link, "SELECT * FROM persona WHERE id_persona = $persona");
      $array_persona = mysqli_fetch_array($query_persona);
      ?>
      <h1><?php echo $array_persona['Nombre']." ".$array_persona['Apellido']; ?></h1>
      <h2>Competencia:</h2>
      <?
      $query_competencias = mysqli_query($link, "SELECT * FROM competencia WHERE fk_anio = $a ORDER BY id_comp ASC");
      ?>
      <select name="fk_comp" required>
      <?
      while ( $array_competencias = mysqli_fetch_array($query_competencias)){
      $cat = $array_competencias['categoria'];

      $query_categoria =  mysqli_query ($link, "SELECT * FROM categoria WHERE id_cat = $cat");
      $resultado3 = mysqli_fetch_array($query_categoria);

      $idcomp = $array_competencias['id_comp'] ;
      $competencia =  $idcomp;
      //$competencia = $idcomp[6].$idcomp[7].$idcomp[8] ;
      echo "<option value='".$array_competencias['id_comp']."'>".$competencia.")</b> [". $resultado3['nombre']."] ".substr($array_competencias['descripcion'], 0, 25)."... </option>";
      }
      ?>
      </select>
      <span>
        <h2>Seudonimo (opc):</h2>
          <input type="text" name="seudonimo" value="<?php echo htmlentities($row_inscriptos['seudonimo'], ENT_COMPAT, ''); ?>">
        <?
        // $fecha1 = $row_inscriptos['fechainscrip'];
        // $nuevaFecha=implode('-',array_reverse(explode('-',$fecha1)));
        // echo $nuevaFecha;
        ?>
        <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="id_inscripto" value="<?php echo $row_inscriptos['id_inscripto']; ?>">
        <input type="submit" class="button button-blue" value="Actualizar registro">
      </span>

    </form>
</center>
<div align="center">
<?
if ($row_inscriptos['baja'] == "0") {
echo
" <a href=\"borra.php?in=".$row_inscriptos['id_inscripto']." \" > <img src=\"../table-images/delete.png\" alt=\"borrar\" width=\"16\" height=\"16\" border=\"0\" align=\"middle\"> Dar baja</a> " ;
} else {
echo "El inscripto se dió de baja";
}
?>
<a href="javascript:history.back(1)">Volver</a>
</div>
</body>
</html>
<?php mysqli_free_result($inscriptos); ?>
