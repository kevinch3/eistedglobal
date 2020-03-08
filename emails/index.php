<?php include ("../header.php");

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_anio = "SELECT * FROM anio ORDER BY Id_anio DESC";
$anio = mysql_query($query_anio, $ServidorUB) or die(mysql_error());
$row_anio = mysql_fetch_assoc($anio);
$totalRows_anio = mysql_num_rows($anio);
?> 
<div class="wrapper">
   <div class="app-menu">
       <div class="menualto">
           <i class="icon-bookmark"></i> Evento <?php echo $_SESSION["a"];?>
       </div>
	   
       <div class="item-list">
           <div class="menu-sma">
			<p> <?php echo txtEIS($_SESSION["edicion"]); ?> </p>
				<?php $anio = $_SESSION["a"]; ?>
				<ul>
					<li><a href="comision.php" class="fancybox fancybox.iframe"><span>Comisi&oacute;n directiva </span></a></li>
					<li><a href="presentadores.php" class="fancybox fancybox.iframe"><span>Presentadores </span></a></li>
					<li><a href="coorjurados.php"><span>Coord. y Jurados</span></a></li>
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
<?php
mysql_free_result($anio);
?>
