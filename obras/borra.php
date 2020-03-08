
<?php
require_once('../Connections/ServidorUB.php');
require_once('../funciones.php');

$obra=$_GET['obra'];
$url=$_GET['url'];
sleep(1);
$query = mysqli_query($link, "DELETE FROM Obra WHERE id_obra ='000'") or die(mysqli_error());
echo $query;
//$query = mysqli_query($link, "DELETE FROM Obra WHERE id_obra ='$obra'") or die(mysqli_error());
$query_fetch = mysqli_fetch_assoc($query);
echo $query_fetch;
?>
Borrando...
<script type="text/javascript">
  // setTimeout("location.href = '<?php echo base64_decode($url); ?>';",1000)
</script>
<body onLoad="ini();" style="height: 100px;">
<form name="cuenta" action="" >
<input name="regresiva" type="text" size=55" readonly style="border:0px;">
</form>
</body>
