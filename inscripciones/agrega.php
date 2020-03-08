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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO inscriptos (id_inscripto, fk_persona, fk_comp, seudonimo, fechainscrip, anio_insc) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_inscripto'], "int"),
                       GetSQLValueString($_POST['fk_persona'], "int"),
                       GetSQLValueString($_POST['fk_comp'], "int"),
                       GetSQLValueString($_POST['seudonimo'], "text"),
                       GetSQLValueString($_POST['fechainscrip'], "date"),
					   GetSQLValueString($_POST['anio_insc'], "int"));

  mysqli_select_db($database_ServidorUB, $ServidorUB);
  $Result1 = mysqli_query($link, $insertSQL) or die(mysqli_error());

  $insertGoTo = "ver.php?a=$a";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
$query_inscripciones = "SELECT * FROM inscriptos";
$inscripciones = mysqli_query($link, $query_inscripciones) or die(mysqli_error());
$row_inscripciones = mysqli_fetch_assoc($inscripciones);
$totalRows_inscripciones = mysqli_num_rows($inscripciones);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('../embed.php'); ?>
<title>Alta Inscripto</title>
<!-- <script language="javascript" type="text/javascript">
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
   document.write ( obtiene_fecha() )
}
</script> -->
</head>
  <body>
    <center>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table id="one-column-emphasis"  align="center">
        <colgroup>
          <col class="oce-first" />
        </colgroup>
        <tr valign="baseline">
        <td nowrap="nowrap" align="right">Persona a inscribir:</td>
        <td><!--input type="text" name="fk_persona" value="" size="32" /-->
        <?
        $SQL1 = "SELECT * FROM persona ORDER BY Apellido ASC";
        $QUERY1 =  mysqli_query($link, $SQL1);
        ?>
        <select name="fk_persona">
          <?
          while ( $resultado1 = mysqli_fetch_array($QUERY1)){
            echo "<option value='".$resultado1['id_persona']."'> [".$resultado1['tipo']."]". $resultado1['Apellido'].", ". $resultado1['Nombre']." de ".$resultado1['Residencia']." </option>";
          }
          ?>
        </select>
        <a href="../personas/agrega.php">Agregar</a></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Competencia:</td>
          <td><!--input type="text" name="fk_comp" value="" size="32" /-->
            <?
            $SQL2 = "SELECT * FROM competencia WHERE fk_anio='$a' ORDER BY id_comp ASC";
            $QUERY2 =  mysqli_query ($link, $SQL2);
            ?>
            <select name="fk_comp">
            <?php while($resultado2 = mysqli_fetch_array($QUERY2)){
              $cat = $resultado2['categoria'];
              $SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'";

              $QUERY3 =  mysqli_query ($link, $SQL3);
              $resultado3 = mysqli_fetch_array($QUERY3);

              $competencia = substr($resultado2['id_comp'], -3);
              echo "<option value='".$resultado2['id_comp']."'> Comp. <b>". $competencia.")</b> [". $resultado3['nombre']."] ".substr($resultado2['descripcion'], 0, 10)."... </option>";
            }
            ?>
            </select>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Seudónimo:</td>
          <td><input type="text" name="seudonimo" value="" size="32" /></td>
        </tr>
        <?php $fecha_actual = date("Y/m/d"); ?><input type="hidden" name="fechainscrip" value="<?php echo $fecha_actual; ?>" />

        <tr valign="baseline">
          <td nowrap="nowrap" align="right"> </td>
          <td>
            <input type="submit" class="button button-blue" value="Insertar registro" />
          </td>
        </tr>
      </table>
      <input type="hidden" name="anio_insc" value="<?php echo $a; ?>" />
      <input type="hidden" name="MM_insert" value="form1" />
      </form>
    </center>
  </body>
</html>
<?php mysqli_free_result($inscripciones); ?>
