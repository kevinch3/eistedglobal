<?php include ("../header.php");
if (isset($_GET['modificado'])) {
  $modificado = $_GET['modificado'];
}
$currentPage = $_SERVER["PHP_SELF"];
$age=$_SESSION["a"];
$eis = strtoupper(substr($_SESSION["edicion"],0,2));

$maxRows_competencias = 25;
$pageNum_competencias = 0;
if (isset($_GET['pageNum_competencias'])) {
  $pageNum_competencias = $_GET['pageNum_competencias'];
}
$startRow_competencias = $pageNum_competencias * $maxRows_competencias;

  $query_competencias = "SELECT id_comp,categoria,descripcion,idioma,rank FROM competencia WHERE id_comp  LIKE '".$eis.$age."%%%' ORDER BY id_comp ASC";
  $query_limit_competencias =  sprintf("%s LIMIT %d, %d", $query_competencias, $startRow_competencias, $maxRows_competencias);
//print_r($query_limit_competencias);
  $competencias = mysqli_query($link, $query_limit_competencias);
  $row_competencias = mysqli_fetch_assoc($competencias);

  $query_todas_competencias = "SELECT COUNT(id_comp) FROM competencia WHERE id_comp LIKE '".$eis.$age."%%%'";
  $todas_competencias = mysqli_query($link,$query_todas_competencias);
  $row_cnt = mysqli_num_rows($todas_competencias);
  echo "ROWCONT ".$row_cnt;
  print_r($query_todas_competencias);
  //Solo para contar y hacer paginación. Pasar todo a js//

if (isset($_GET['totalRows_competencias'])) {
  $totalRows_competencias = $_GET['totalRows_competencias'];
} else {
  $totalRows_competencias = $row_cnt;
}
$totalPages_competencias = ceil($totalRows_competencias/$maxRows_competencias)-1;
echo "TOTAL ROWS: ".$totalRows_competencias;
echo "TOTAL PAGES: ".$row_cnt;
$queryString_competencias = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_competencias") == false &&
        stristr($param, "totalRows_competencias") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_competencias = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_competencias = sprintf("&totalRows_competencias=%d%s", $totalRows_competencias, $queryString_competencias);

?>

<div class="wrapper">
   <div class="app-menu">
       <div class="menualto">
           <i class="icon-bookmark"></i> Evento <?php echo $_SESSION["a"];?>
       </div>

       <div class="item-list">
           <div class="menu-sma">
             <div id="resultados">
<div align="center">

</div>
<table style="left: 50px; position: relative;" >
  <thead>
  <tr>
    <th width="20">Comp.</th>
    <th width="100">Categoria</th>
    <th width="620">Descripcion</th>
    <th width="55">Idioma</th>
    <th width="120"></th>
  </tr>
  </thead>
  <?php do { ?>
      <tr style="height: 42px;">
      <td><?php echo acortameCOMP($row_competencias['id_comp']); ?>	</td>
      <td><?
      //print_r($row_competencias['id_comp']);
      //print_r($row_competencias);
  		$resultado3 = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM categoria WHERE id_cat = ".$row_competencias['categoria']." "));
  		$acortado = $resultado3['nombre'] ;
      echo "<b title=".$resultado3['nomcym'].">".substr($acortado, 0, 25)."</b>";
  		?> </td>
      <td><a href="cli_info.php?c=<?php echo $row_competencias['id_comp']; ?>" rel="shadowbox;height=370;width=600">
  			<?php echo strip_tags(acortameDESCR($row_competencias['descripcion'])); ?>
  		</a>
  	</td>

  	  <td><?php echo $row_competencias['idioma']; ?></td>
        <td>
  	<a href="modificomp.php?c=<?php echo $row_competencias['id_comp']; ?>" rel="shadowbox;height=600;width=650"><i class="fa fa-pencil-square-o"></i></a></td>
      </tr>

    <?
    } while ($row_competencias = mysqli_fetch_assoc($competencias));
?>
</table>
<div class="pagination" style="text-align: center;">
<?php if ($pageNum_competencias > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, 0, $queryString_competencias); ?>">Primero</a>
<?php } // Show if not first page ?>
<?php if ($pageNum_competencias > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, max(0, $pageNum_competencias - 1), $queryString_competencias); ?>">Anterior</a>
<?php } // Show if not first page ?>
<?php if ($pageNum_competencias < $totalPages_competencias) { // Show if not last page ?>
<a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, min($totalPages_competencias, $pageNum_competencias + 1), $queryString_competencias); ?>">Siguiente</a>
<?php } // Show if not last page ?>
<?php if ($pageNum_competencias < $totalPages_competencias) { // Show if not last page ?>
<a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, $totalPages_competencias, $queryString_competencias); ?>">&Uacute;ltimo</a>
<?php } // Show if not last page ?>
</div>
<div style="text-align: right;"><a href="agrega.php?a=<?php echo $age ; ?>" rel="shadowbox;height=600;width=650"><i class="fa fa-plus-circle"></i> Agregar Competencia</a></div>
</div>
           </div>
		   </div>
       </div>
       <div class="menubajo">
           <?php include ("../footer.php"); ?>
       </div>
    </div>
</div>
  </body>
</html>
