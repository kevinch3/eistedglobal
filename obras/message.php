<?php 
$archivo = "../../eisteddfod/2013/wp-content/themes/2k13RES/msg.html";
	if (isset($_GET['msg'])){
		if (file_exists($archivo)) {
		   $f = fopen($archivo,"a+");
		} else {
		   $f = fopen($archivo ,"w+");
		}
      $nick = isset($_GET['nick']) ? $_GET['nick'] : "Oculto";
      $msg  = isset($_GET['msg']) ? htmlentities($_GET['msg']) : ".";
      $line = "<eisteddfod><span title=\"".date("d/m/y H:i:s")."\" class=\"name\"><i class=\"icon-globe\"></i> $nick: </span><span class=\"txt\">$msg</span></eisteddfod>";
		fwrite($f,$line."\r\n");
		fclose($f);
		
		echo $line;
		
	} else if (isset($_GET['all'])) {
	   $flag = file($archivo);
	   $content = "";
	   foreach ($flag as $value) {
	   	$content .= $value;
	   }
	   echo $content;

	}
?>	