<?php
$host = $_SERVER['HTTP_HOST'];
 if($host == "www.eisteddfodpatagonia.com" or $host == "eisteddfodpatagonia.com") {
$sitio = "http://www.eisteddfodpatagonia.com/eistedglobal/";
 } else {
$sitio = "http://localhost/";
   //$sitio = "http://pctrelew.com/eistedglobal/";
}
//DEPRECATED 24/11/13

//$sitio =  "http://".$_SERVER[HTTP_HOST]."/eistedglobal";
?>
