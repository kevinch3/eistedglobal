<?php 
if ($_GET['a'] == NULL) {
$a = date("Y");
} else {
$a = $_GET['a']; 
}
?>
<?php include ("../header.php");?> 
<div class="wrapper">
   <div class="app-menu">
       <div class="menualto">
           <i class="icon-bookmark"></i> Evento <?php echo $a ;?>  
       </div>
	   <div id="helper">
           <div class="explicacion">
           <h4>Modo de uso <i class="icon-asterisk"></i></h4>
           <ul>
               <li>Listado de ganadores para uso interno, prensa o publico general que lo solicite: este panel genera los ganadores hasta el momento.</li>
           </ul>
           </div>
       </div>
	    <div class="mini">
               <ul>
                   <li><i class="icon-list icon-2x"></i> Listados de pantalla</li>
                   <li><div><a href="../listado/competencias.php?a=2013" target="_blank" title="Listado publico"><span>Listado publico</span></a></div></li>
                   <li><div><a href="comp_test.php?a=<?php echo $a; ?>" target="_blank" title="Listado con Graficos"><span>Listado con Opciones</span></a></div></li>
				   <li><div><a href="../pantallas/Pantallas/veredictos_pantalla.php" target="_blank" title="Listado de Veredictos"><span><i class="icon-desktop"></i> Ultimos Veredictos</span></a></div></li>
               </ul>
               <ul>
                   <li><i class="icon-print icon-2x"></i> Grupos</li>
                    <li><div><a href="comp_print.php?a=<?php echo $a; ?>" target="_blank" title="Listado para impresion" ><span>Listado p/ impresion</a></div></li>
                    <li><div><a href="comp_test_texto.php?a=<?php echo $a; ?>" target="_blank" title="Listado para impresion de texto plano" ><span>Listado sin formato</a></div></li>
               </ul>
        </div>
       <div class="menubajo">
           <div id="izq1"><a href="../index.php?a=<?php echo date("Y"); ?>"><i class="icon-chevron-sign-left"></i> Volver</a></div>
           <div id="der1"><a class="icon-info-sign" href="#" title="<?php include("../version.php"); ?>"></a><a href="salir.php"><i class="icon-signout"></i> Salir </a><div id="reloj"></div></div>
       </div>
    </div>
</div>
</body>
</html>