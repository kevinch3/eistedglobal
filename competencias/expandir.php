<?php require_once('../Connections/ServidorUB.php');
$age = date("Y");
 $c=$_GET['c'];

$query_anio = "SELECT * FROM anio";
$anio = mysqli_query($link, $query_anio) or die(mysqli_error());
$row_anio = mysqli_fetch_assoc($anio);
$totalRows_anio = mysqli_num_rows($anio);

$maxRows_competencias = 30;
$pageNum_competencias = 0;
if (isset($_GET['pageNum_competencias'])) {
  $pageNum_competencias = $_GET['pageNum_competencias'];
}
$startRow_competencias = $pageNum_competencias * $maxRows_competencias;

$query_competencias = "SELECT * FROM competencia WHERE id_comp='$c' ";
$query_limit_competencias = sprintf("%s LIMIT %d, %d", $query_competencias, $startRow_competencias, $maxRows_competencias);
$competencias = mysqli_query($link, $query_limit_competencias) or die(mysqli_error());
$row_competencias = mysqli_fetch_assoc($competencias);

if (isset($_GET['totalRows_competencias'])) {
  $totalRows_competencias = $_GET['totalRows_competencias'];
} else {
  $all_competencias = mysqli_query($link,$query_competencias);
  $totalRows_competencias = mysqli_num_rows($all_competencias);
}
$totalPages_competencias = ceil($totalRows_competencias/$maxRows_competencias)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
body{background: white;}
</style>
<title>Competencia <?php echo $age ; ?></title>
</head>
<body>
<center>
<p><?php echo $row_competencias['descripcion']; ?></p>
</center>
</body>
</html>
<?php mysqli_free_result($anio); mysqli_free_result($competencias);?>
