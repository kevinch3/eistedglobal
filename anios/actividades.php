<?php $anio = $_SESSION["a"]; ?>
<ul>
	<li><a href="comision.php?a=<?php echo $anio; ?>" rel="shadowbox;height=700;width=600" ><p>Ver comisi&oacute;n directiva </p></a></li>
	<li><a href="presentadores.php?a=<?php echo $anio; ?>" rel="shadowbox;height=700;width=600"  ><p>Ver presentadores </p></a></li>
	<li><a href="coorjurados.php?a=<?php echo $anio; ?>"><p>Coordinadores y Jurados </p></a></li>
	<li><a href="balance.php?a=<?php echo $anio; ?>"><p>Conocer balance anual </p></a></li>
	<li><a href="../competencias/presente.php?a=<?php echo $anio; ?>" rel="shadowbox"  ><p>Listado de competencias</p></a></li>
	<li><a href="relacionados.php?a=<?php echo $anio; ?>" rel="shadowbox;height=700;width=600"  ><p>Archivos relacionados con <?php echo $anio; ?></p></a> </li>
</ul>
