<?php include ("../header.php");?>
  <body>
    <div class="wrapper">
      <div class="app-menu">
        <div class="menualto">
          <i class="icon-bookmark"></i> Inscripciones <?php echo $_SESSION["a"];?>
        </div>
        <div id="helper">
          <div class="explicacion">
            <h4>Modo de uso <i class="icon-asterisk"></i></h4>
            <ul>
              <li>Antes de participar, la totalidad de los inscriptos deben reunir ciertos requisitos.</li>
            </ul>
          </div>
        </div>
        <div class="mini">
          <ul style="padding-top:10px;">
            <li>
              <div>
                <a href="agrega.php?a=<?php echo $_SESSION["a"] ;?>" class="fancybox fancybox.iframe" title="Agregar inscripcion" ><span><i class="icon-plus-sign"></i> Agregar inscripcion</a>
              </div>
            </li>
            <li>
              <div>
                <a href="ver.php?estado=0&a=<?php echo $_SESSION["a"] ;?>" class="fancybox fancybox.iframe" title="Listado de inscriptos <?php echo $_SESSION["a"] ;?>"><span><i class="icon-list"></i> Listado de inscriptos </span></a>
              </div>
            </li>
          </ul>
        </div>
        <div class="menubajo">
          <?php include ("../footer.php"); ?>
        </div>
      </div>
    </div>
  </body>
</html>
