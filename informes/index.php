<?php include ("../header.php");?>

<div class="wrapper">
   <div class="app-menu">
       <div class="menualto">
           <i class="icon-bookmark"></i> Búsqueda - <?php echo $_SESSION["a"];?>
       </div>
       <div id="helper">
           <div class="explicacion">
           <h4>Modo de uso <i class="icon-asterisk"></i></h4>
           <ul>
               <li>Desde aquí podrá generar informes específicos sobre Personas, Competencias, Obras de años anteriores, etc. Puede sugerir más informes a su administrador.</li>
           </ul>
           </div>

		<p style="color: red; background: black;"> <i class="icon-frown icon-2x"></i> Lamentablemente, este panel no funciona al momento!</p>
       </div>
       <div class="mini" style="padding-left: 300px;">
               <ul>
                   <li><i class="icon-user icon-2x"></i> Personas</li>
                   <li><div><a href="#"><span>Listar a todos los individuos</span></a></div></li>
                   <li><div><a href="#"><span>Listar a todos los grupos</a></div></li>
				   <li><div><a href="#"><span>Listar a quienes participaron este año</a></div></li>
				   <li><div><a href="#"><span>Listar a quienes participaron otro año</a></div></li>
               </ul>
               <ul>
                   <li><i class="icon-file-alt icon-2x"></i> Inscripciones</li>
                   <li><div><a href="#"><span>Listar a todos los inscriptos de este año</span></a></div></li>
                   <li><div><a href="#"><span>Listar a todos los inscriptos de otro año</a></div></li>
               </ul>
			   <ul>
                   <li><i class="icon-file-alt icon-2x"></i> Inscripciones</li>
                   <li><div><a href="#"><span>Listar a todos los inscriptos de este año</span></a></div></li>
                   <li><div><a href="#"><span>Listar a todos los inscriptos de otro año</a></div></li>
               </ul>
			   <ul>
                   <li><i class="icon-file-alt icon-2x"></i> Inscripciones</li>
                   <li><div><a href="#"><span>Listar a todos los inscriptos de este año</span></a></div></li>
                   <li><div><a href="#"><span>Listar a todos los inscriptos de otro año</a></div></li>
               </ul>
           </div>
       <div class="menubajo">
         <?php include ("../footer.php"); ?>
       </div>
    </div>
</div>
</body>
</html>
