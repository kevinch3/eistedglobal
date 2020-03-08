<?php
if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page']){
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	} else{
		$limit = " LIMIT $items";
}
if(isset($_GET['q']) ){
		$q =  htmlentities($_GET['q']); //para ejecutar consulta
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
/*
echo "aux: ";
print_r($aux);

echo "laconsu: ";
print_r($laconsu);

echo "query: ";
print_r($query);
*/

?>	<registros><p><?php
		if($aux['total'] and isset($busqueda)){
				echo $aux['total']." <i class=\"fa fa-user\"></i> ";
			}elseif($aux['total'] and !isset($q)){
				echo $aux['total']." <i class=\"fa fa-user\"></i> ";
			}elseif(!$aux['total'] and isset($q)){
			?>
				<i class="icon-remove-sign"></i>
				<div class="agregar">
					<div class="mini">
					<h3 style="color: #262C3F;">No existe  "<?php echo $q; ?>", pero podemos agregarlo.</h3>
					<ul>
					<li><a href="../personas/agrega.php?redir=../obras/agregar.php&type=IND&a=<?php echo $a;?>&participante=<?php echo $q; ?>" class="fancybox fancybox.iframe"><i class="icon-user"> </i>  Individuo </a></li>
					<li><a href="../personas/agrega.php?redir=../obras/agregar.php&type=GRU&a=<?php echo $a;?>&participante=<?php echo $q; ?>" class="fancybox fancybox.iframe"><i class="icon-group"> </i>  Conjunto </a></li>
					</ul>
					</div>
				</div>
			<?php
			}
	?></p></registros>

	<?php
		if($aux['total']>0){
			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			if(isset($q))
					$p->target("buscador.php?q=".urlencode($q));
				else
					$p->target("buscador.php");
			$p->currentPage($page);
			echo "\t<div class=\"registros\">\n";
			$r=0;
			  while($row = mysqli_fetch_assoc($query)){
				if ($row['tipo'] == "IND"){
          echo "\t\t<li id=\"IND\" class=\"row$r\">
		 <a href=\"#\" onclick=\"cargar('#divtest', 'info.php?p={$row['id_persona']}')\" ><i class=\"fa fa-user\"></i> ".$row['Nombre']." ".$row['Apellido']."</a></li>\n";
		  if($r%2==0)++$r;else--$r;
				} else {
				echo "\t\t<li id=\"GRU\" class=\"row$r\" >
		 <a href=\"#\" style=\";\" onclick=\"cargar('#divtest', 'info.php?p={$row['id_persona']}')\" ><i class=\"fa fa-users\"></i> ".$row['Nombre']." ".$row['Apellido']."</a></li>\n";
		 if($r%2==0)++$r;else--$r;
				}
        }
			$p->show();
            echo "\t</div>\n";
        }
    ?>
