<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php require_once('../embed.php'); ?>
  <?php require_once('../Connections/ServidorUB.php');

//ARREGLAR ESTA HORRIBILIDAD
  if(isset($_GET['estado'])){
      $estado = $_GET['estado'];

      if ($estado == "1") {
        $varestado = "AND baja=1";
        $subtitulo = "deshabilitados";
      } else if ($estado == "todos"){
        $varestado = "" ;
        $subtitulo = "(todos)";
      } else {
          $estado = "0";
          $varestado = "AND baja=0";
          $subtitulo = "habilitados" ;
      }
  } else {
    $estado = "0";
    $varestado = "AND baja=0";
    $subtitulo = "habilitados" ;
  }

  $query_Inscriptos = "SELECT * FROM inscriptos WHERE anio_insc='$a ' $varestado ORDER BY fk_comp ASC";
  $Inscriptos = mysqli_query($link, $query_Inscriptos) or die(mysqli_error());
  $row_Inscriptos = mysqli_fetch_assoc($Inscriptos);
  $totalRows_Inscriptos = mysqli_num_rows($Inscriptos);
  ?>
<title>Ver inscriptos</title>
</head>
<body>
  <center>
    <h3>Mostrando inscriptos <b><?php echo $subtitulo ; ?></b> en <?php echo $a; ?></h3>
    <form method="get" action="ver.php">
      <select name="estado">
        <option value="todos">Todos</option>
        <option value="0">Inscriptos</option>
        <option value="1">Inscriptos deshabilitados</option>
      </select>
      <input type="hidden" name="a" value="<?php echo $a; ?>" />
      <input type="submit" value="ver">
    </form>
    <?php if (mysqli_num_rows($Inscriptos) > 1){ ;?>

    <table id="one-column-emphasis" border="0">
    <thead>
      <tr>
        <th width="178">Persona</th>
        <th width="151">Competencia</th>
        <th width="178">Seudónimo</th>
        <th width="178">Fecha de Inscripción</th>
        <th></th>
      </tr>
      </thead>
      <?php do { ?>
        <tr>
          <td>
          <?
      		$persona = $row_Inscriptos['fk_persona'];
      		$SQL1 = "SELECT * FROM persona WHERE id_persona='$persona' ";
      		$QUERY1 =  mysqli_query ($link, $SQL1);
      		$resultado1 = mysqli_fetch_array($QUERY1);
      		echo " ".$resultado1['Nombre']." ".$resultado1['Apellido'];
      		?>
          </td>
          <td><?
      		$idcomp = $row_Inscriptos['fk_comp'];
  				$competencia = substr("$idcomp", -3) ;

          echo $competencia ;

      		$SQL2 = "SELECT * FROM competencia WHERE id_comp='$idcomp' ";
      		$QUERY2 =  mysqli_query ($link, $SQL2);
      		$resultado2 = mysqli_fetch_array($QUERY2);

          $cat = $resultado2['categoria'];

      		$SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'";
      		$QUERY3 =  mysqli_query ($link, $SQL3);
      		$resultado3 = mysqli_fetch_array($QUERY3);
      		echo " [".$resultado3['nombre']."]";

      		?></td>
          <td><?php echo $row_Inscriptos['seudonimo']; ?></td>
          <td><?
        		$fecha1 = $row_Inscriptos['fechainscrip'];
        		$nuevaFecha=implode('-',array_reverse(explode('-',$fecha1)));
        		echo $nuevaFecha;
        		?></td>
          <td><a href="modificar.php?in=<?php echo $row_Inscriptos['id_inscripto']; ?>"><i class="fa fa-edit"></i></a></td>
        </tr>
      <?php } while ($row_Inscriptos = mysqli_fetch_assoc($Inscriptos)); ?>
    </table>
    <?php } else {
    echo "no hay registros";
    } ?>
  </center>
</body>
</html>
<?php mysqli_free_result($Inscriptos); ?>
