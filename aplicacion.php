<?php include ("header.php"); ?>
<script language="JavaScript" type="text/JavaScript">
function changePage(newLoc) { nextPage = newLoc.options[newLoc.selectedIndex].value
if (nextPage != "") { document.location.href = nextPage } }
</script>
<div class="wrapper">
   <div class="app-menu">
       <div class="menualto">
	   ¡Bienvenido <b><?php echo $_SESSION["usr"];?></b>!
	    <form method="POST" name="menu_2" >
				 <select name="selectedPage" onChange="changePage(this.form.selectedPage)">
					<?php echo "<option>".txtEIS($_SESSION["edicion"])."</option>" ; ?>
					<option value = "#"> ----</option>
					<option value = "?edicion=chubut"> del Chubut</option>
					<option value = "?edicion=juventud"> de la Juventud</option>
				 </select>
		</form>
		<form method="POST" name="menu_1" >
				 <select name="selectedPage" onChange="changePage(this.form.selectedPage)">
					<?php echo "<option selected>".$_SESSION["a"]."</option>" ;
					foreach(range((int)date("Y"), 1950) as $year) {
						echo "\t<option value='?a=".$year."'>".$year."</option>\n\r";
					}
					?>
				 </select>
		</form>
       </div>
       <div class="item-list">

           <ul>
               <li><div class="persona"><a href="personas/index.php"><span>Personas</span></a></div></li>
               <li><div class="inscripcion"><a href="inscripciones/index.php"><span>Inscripciones</span></a></div></li>
               <li><div class="archivo"><a href="anios/index.php"><span>Archivo</span></a></div></li>
               <li><div class="busqueda"><a href="informes/index.php"><span>Informes</span></a></div></li>
               <li><div class="evento" id="verde"><a href="obras/index.php?a=<?php echo $_SESSION["a"];?>"><span><?php echo $_SESSION["a"];?></span></a></div></li>
           </ul>
       </div>
       <div class="menubajo">
           <div id="izq1"><a href="competencias/presente.php"><i class="fa fa-list"></i> Competencias <?php echo $_SESSION["a"]; ?></a><a href="pantallas/Pantallas/veredictos_pantalla.php"><i class="fa fa-desktop"></i> App Pantallas</a><a href="#"><i class="fa fa-stack-exchange"></i> Utilidades Email</a></div>
           <div id="der1"><a class="fa fa-info-circle" href="#" title="<?php echo dameVERSION(); ?>"></a><a href="salir.php"><i class="fa fa-sign-out"></i> Salir </a><div id="reloj"></div></div>

	   </div>
</div>
</div>
</body>
</html>
