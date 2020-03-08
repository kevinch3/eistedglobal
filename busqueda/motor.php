<?
if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";

if(isset($_GET['q']) ){
		$q = sql_quote($_GET['q']); //para ejecutar consulta
		$busqueda = htmlentities($q); //para mostrar en pantalla

		$sqlStr = "SELECT * FROM $tabla WHERE $item LIKE '%$q%' OR $item1 LIKE '%$q%'";
		$sqlStrAux = "SELECT count(*) as total FROM $tabla WHERE $item LIKE '%$q%'";
	}else{
		$sqlStr = "SELECT * FROM $tabla";
		$sqlStrAux = "SELECT count(*) as total FROM $tabla";
	}


$aux = Mysql_Fetch_Assoc(mysql_query($sqlStrAux,$link));
$query = mysql_query($sqlStr.$limit, $link);
?>	<p><?php
		if($aux['total'] and isset($busqueda)){
				echo "{$aux['total']} Resultado".($aux['total']>1?'s':'')." que coinciden con tu b&uacute;squeda \"<strong>$busqueda</strong>\".";
			}elseif($aux['total'] and !isset($q)){
				echo "Total de registros: {$aux['total']}";
			}elseif(!$aux['total'] and isset($q)){
				echo"No hay registros que coincidan con tu b&uacute;squeda \"<strong>$busqueda</strong>\"";
			}
	?></p>

	<?php 
		if($aux['total']>0){
			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			if(isset($q))
					$p->target("buscador.php?q=".urlencode($q)."&b=".$_GET['b']);
				else
					$p->target("buscador.php?b=".$_GET['b']);
			$p->currentPage($page);
			$p->show();
			echo "\t<table class=\"registros\">\n";
			echo "<tr class=\"titulos\"><td>Titulo</td></tr>\n";
			$r=0;
			  while($row = mysql_fetch_assoc($query)){
          echo "\t\t<tr class=\"row$r\"><td>
		 <a href=\"?p={$row['id_comp']}\" target=\"_blank\">".htmlentities($row['descripcion'],ENT_QUOTES | ENT_IGNORE, "UTF-8")."</a></td></tr>\n";
          if($r%2==0)++$r;else--$r;
        }
            echo "\t</table>\n";
            $p->show();
        }
    ?>
	
