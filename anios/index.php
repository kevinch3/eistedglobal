<?php include ("../header.php");
$query_anio = "SELECT * FROM anio ORDER BY Id_anio DESC";
$anio = mysqli_query($link, $query_anio) or die(mysqli_error());
$row_anio = mysqli_fetch_assoc($anio);
$totalRows_anio = mysqli_num_rows($anio);
?>
  <div class="wrapper">
    <div class="app-menu">
      <div class="menualto">
        <i class="icon-bookmark"></i> Evento <?php echo $_SESSION["a"];?>
      </div>
      <div class="item-list">
        <div class="menu-sma">
  				<ul>
  					<li class="grupo"><a href="comision.php" class="fancybox fancybox.iframe"><span>Comisi&oacute;n directiva </span></a></li>
  					<li class="grupo"><a href="presentadores.php" class="fancybox fancybox.iframe"><span>Presentadores </span></a></li>
  					<li class="grupo"><a href="coorjurados.php"><span>Coord. y Jurados</span></a></li>
  				</ul>
  				<ul>
  					<li><a href="balance.php" class="fancybox fancybox.iframe"><span>Balance anual</span></a></li>
  					<li><a href="../competencias/presente.php" ><span>Competencias  <i class="fa fa-external-link-square"></i></span></a></li>
  					<li><a href="relacionados.php" class="fancybox fancybox.iframe"><span>Archivos varios</span></a> </li>
  				</ul>
        </div>
      </div>
      <div class="menubajo">
        <?php include ("../footer.php"); ?>
      </div>
    </div>
  </div>
</body>
</html>
