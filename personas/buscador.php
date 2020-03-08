<?php
include ("../header.php");
function sql_quote( $value )
{
    if( get_magic_quotes_gpc() )
    {$value = stripslashes( $value );}
    if( function_exists( "mysqli_real_escape_string" ) )
    {$value = mysqli_real_escape_string( $value );}
    else
    {$value = addslashes( $value );}
    return $value;
}
require('include/pagination.class.php');

$items = 20;
$page = 1;
$tabla = "persona";
$item = "Nombre";
$item1 = "Apellido";

if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";

if(isset($_GET['q']) ){
		$q = htmlentities($_GET['q']); //para ejecutar consulta
		$busqueda = htmlentities($q); //para mostrar en pantalla

		$sqlStr = "SELECT * FROM $tabla WHERE $item LIKE '%$q%' OR $item1 LIKE '%$q%' ORDER BY Nombre ASC";
		$sqlStrAux = "SELECT count(*) as total FROM $tabla WHERE $item LIKE '%$q%' OR $item1 LIKE '%$q%' ORDER BY Nombre ASC";
	}else{
		$sqlStr = "SELECT * FROM $tabla ORDER BY Nombre ASC";
		$sqlStrAux = "SELECT count(*) as total FROM $tabla";
	}
$laconsu = mysqli_query($link, $sqlStrAux);
$query = mysqli_query($link,$sqlStr.$limit);
$aux = mysqli_fetch_assoc($laconsu);
?>
<script>
 function cargar(div, desde) {
                $(div).load(desde);
            }
</script>
  <div class="wrapper">
    <div class="app-menu">
      <div class="menualto">
        <form class="form-derecha" onsubmit="return buscar()">
          <input type="text" class="input-grande" id="q" name="q" value="<?php if(isset($q)) echo $busqueda;?>" onKeyUp="return buscar()">
          <i class="fa fa-search fa-2x" style="padding-left:10px;padding-right:10px;"></i>
          <span id="loading"></span>
        </form>
      </div>
      <div id="panel-izq">
        <div id="helper">
          <div class="explicacion">
            <h4>Modo de uso <i class="fa fa-asterisk"></i></h4>
            <ul>
              <li><?php echo htmlentities("Sólo con un \"Enter\", el siguiente formulario buscará según nombre o apellido.");?></li>
            </ul>
            <h4>Agregar Personas <i class="icon-asterisk"></i></h4>
            <ul>
              <li style="display: inline-table;margin-bottom: 2px;padding: 10px 0;"><a href="../personas/agrega.php?redir=../obras/agregar.php&type=IND&a=<?php echo $a;?>" class="fancybox fancybox.iframe" style="padding: 10px;"><i class="fa fa-user"></i>  Individuo </a></li>
              <li style="display: inline-table;margin-bottom: 2px;padding: 10px 0;"><a href="../personas/agrega.php?redir=../obras/agregar.php&type=GRU&a=<?php echo $a;?>" class="fancybox fancybox.iframe" style="padding: 10px;"><i class="fa fa-users"></i>  Conjunto </a></li>
            </ul>
          </div>
        </div>
        <div id="infoframe">
          <div id="divtest">Haga clic sobre alguna persona</div>
        </div>
      </div>
      <div class="mini" style="min-height: 380px;">
        <div id="resultados">
          <?php include("motor.php");?>
        </div>
      </div>
    </div>
    <div class="menubajo">
      <?php include ("../footer.php"); ?>
    </div>
  <!-- </div>
  </div> -->
</body>
</html>
