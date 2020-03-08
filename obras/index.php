<?php include ("../header.php");?>
<div class="wrapper">
  <div class="app-menu">
    <div class="menualto">
       <i class="icon-bookmark"></i> Evento <?php echo $_SESSION["a"];?>
    </div>
    <div class="item-list">
       <div class="menu-sma">
           <ul>
               <li><div class="persona"> <a href="agregar.php?a=<?php echo $_SESSION["a"];?>&eis=<?php echo $_SESSION["edicion"];?>" class="fancybox fancybox.iframe"><span>Agregar</span></a></div></li>
               <li><div class="persona"> <a href="comp_test.php?a=<?php echo $_SESSION["a"];?>&eis=<?php echo $_SESSION["edicion"];?>"><span>Listar</span></a></div></li>
               <li><div class="inscripcion"> <a href="chat.php?a=<?php echo $_SESSION["a"];?>&eis=<?php echo $_SESSION["edicion"];?>"><span>Chat Evento</span></a></div></li>
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
