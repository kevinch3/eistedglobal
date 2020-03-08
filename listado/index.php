<?php $age = date("Y");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../style2.css" rel="stylesheet" type="text/css">
<link href="../boton.css" rel="stylesheet" type="text/css">
<style type="text/css" media="all">@import "../../shadowbox/shadowbox.css";</style>


<style type="text/css">
option {font-family: verdana; color: black}
option.Poesia {background-color: #eaeaf4;  color: #000;}
option.Prosa {background-color: #fefefe}
option.Recitacion {background-color: #eaeaf4}
option.dos {background-color: #fefefe}
SELECT.css{ font-family: verdana; color: white; background-color:#666;}
</style>
<style type="text/css">
div.selectBox {
   position: relative;
   width: 230px;
   height: 22px;
   border: 1px solid #036;
   background: url(http://www.cmacias.com/wp-content/uploads/2009/button.png) 210px center no-repeat;
}
   div.selectBox div.box {
      position: absolute;
      left: 3px;
      top: 3px;
      width: 200px;
      height: 16px;
      line-height: 16px;
      font-family: arial;
      font-size: 11px;
      color: #036;
      overflow: hidden;
   }
   div.selectBox select {
	position: absolute;
	left: -1px;
	top: -1px;
	width: 220px;
	height: 24px;
	border: 1px solid #036;
	opacity: 0;
	filter: alpha(Opacity=0);
	-moz-opacity: 0;
	cursor: pointer;
	z-index:100;
   }
      div.selectBox select option{
         padding: 4px;
         font-size: 11px;
         color: #036;
         border-bottom: 1px solid #eee;
         cursor: pointer;
      }
      div.selectBox select option.ultimo{
         border-bottom: 0px none;
      }
</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="../../shadowbox/shadowbox.js"></script>
<script type="text/javascript"> Shadowbox.init(); </script>
</head>

<body>
<center><p><img src="../table-images/logo.png" alt="" /></p>
 <table width="153" height="108" border="0">
    <tr>
      <td align="center" valign="bottom" background="../table-images/images/menuuncolor_01.png" id="vzebra-children">Evento <?php echo $age ;?></td>
    </tr>
  </table>

  <table width="191" border="0">
  <tr>
        <td width="105" rowspan="2"><div align="center"><h3>Individual</h3><p><a href="ver.php?a=<?php echo $age ;?>&type=IND" rel="shadowbox;height=500" class="button button-blue">Listar</a></p>
 <p>
 <a href="agrega.php?type=IND" rel="shadowbox;height=500" class="button button-blue">Agregar</a></p></div> </tr>
  		<td width="105" rowspan="2"><div align="center"><h3>Grupal</h3>
  		    <p><a href="ver.php?a=<?php echo $age ;?>&type=GRU" rel="shadowbox;height=500" class="button button-blue">Listar</a></p>
 <p>
 <a href="agrega.php?type=GRU" rel="shadowbox;height=500" class="button button-blue">Agregar</a></p> </div>
  </td>
  </table>
<a href="../aplicacion.php"><img src="http://www.bajabound.com/images/global/goback.png" alt="volver" width="16" height="16" border="0" align="middle">Volver</a>

<?php include("../version.php"); ?>
</center> 

</body>
</html>
