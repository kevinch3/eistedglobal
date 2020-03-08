<div id="izq1"><a href="../aplicacion.php?a=<?php echo $_SESSION["a"]; ?>"><i class="fa fa-arrow-circle-left"></i> Volver</a></div>
<div id="der1"><a class="fa fa-info-circle" href="#" title="<?php echo dameVERSION(); ?>"></a><a href="../salir.php"><i class="fa fa-sign-out"></i> Salir </a><div id="reloj"></div></div>
<?php mysqli_close($link); ?>
