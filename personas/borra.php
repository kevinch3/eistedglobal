<?
require_once('../Connections/ServidorUB.php');
$segundos = 3;
$p=$_GET['p'];
sleep($segundos);
mysqli_query($link, "DELETE FROM persona WHERE id_persona='$p'");

?>
 <html>
	<head>
	<script type="text/javascript">
	var cuentaInicial = "<?php echo $segundos ?>";
	function fin() {
	window.location="javascript:parent.jQuery.fancybox.close();";
	}

	function unoMenos() {
	with (
	document.forms["cuenta"]["regresiva"]) value = 'Borrando... '+cuentaInicial+' segundos.';
	if (
	cuentaInicial-- > 0
	)
	setTimeout("unoMenos()", 1000);
	else fin();
	}
	function ini() {
	with (
	document.forms["cuenta"]["regresiva"]) value = 'Borrando... '+cuentaInicial--+' segundos.';
	setTimeout("unoMenos()", 1000);
	}
	</script>
	<script type="text/javascript">
    setTimeout("history.back(1)",<?php echo $segundos ?>000)
	</script>
	</head>
	<body onLoad="ini();" style="height: 100px;">
  	<form name="cuenta" action="">
	   <input name="regresiva" type="text" size="55" readonly style="border:0px;">
   </form>
</body>
</html>
