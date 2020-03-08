
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('../embed.php'); ?>
<title>Alta de competencia</title>
<script language="javascript" type="text/javascript">
  function limitText(limitField, limitCount, limitNum) {
  	if (limitField.value.length > limitNum) {
  		limitField.value = limitField.value.substring(0, limitNum);
  	} else {
  		limitCount.value = limitNum - limitField.value.length;
  	}
  }
</script>
<style>
input[type="text"], textarea {
border-radius: 0;
}
.izquierda{
float: left;
}
.derecha{
float: right;
width: 350px;
}
.sugerencias{background: #b8dbc1;font-weight: bolder;}
.sugcheck{
background: #bcc7e0;
padding: 3px;
display: inline-block;
margin: 2px;
}
td{
text-align: right;}
select{
padding: 0;}
</style>

<script src="../wysiwyg/ckeditor.js"></script>
</head>
<body>
	<?php
  $query_categorias = "SELECT id_cat, nombre FROM categoria";
  $categorias = mysqli_query($link, $query_categorias) or die(mysqli_error());
  $row_categorias = mysqli_fetch_assoc($categorias);
  $totalRows_categorias = mysqli_num_rows($categorias);

  if(isset($_GET['exito'])){
    if ($_GET[exito] == "si") {
  	echo "<div style=\"position: fixed; padding: 15px; font-weight: bolder; top: 0; background: #b8dbc1; width: 100%; margin:0;\"><i class=\"fa fa-check-square-o\"></i> Exito al agregar ".$_GET['comp']."</div>";
  	 }
  } ?>
	</div>
  <form action="agrega2.php" method="post" name="form1" id="form1" style="text-align: center;margin: 50px;">

		<div class="dato">
		<input name="id_comp" type="text" placeholder="<?php echo "Competencia $a($eis)"; ?>" onKeyDown="limitText(this.form.id_comp,this.form.countdown,3);"
	onKeyUp="limitText(this.form.id_comp,this.form.countdown,3);" maxlength="15">
		</div>

		<div class="dato">
				<select name="categoria">
				 <option selected value="">Categoria</option>
				<?php do {?>
					<option value="<?php echo $row_categorias['id_cat']?>"
            <?
            // if (!(strcmp($row_categorias['id_cat'], $row_categorias[''])))
            // {echo "selected=\"selected\"";}
            ?>

            >
            <?php echo $row_categorias['nombre']?></option>
				<?php }
        while ($row_categorias = mysqli_fetch_assoc($categorias));
				$rows = mysqli_num_rows($categorias);
				if($rows > 0) {
					mysqli_data_seek($categorias, 0);
					$row_categorias = mysqli_fetch_assoc($categorias);
				}
				?>
				</select>
		</div>

		<div class="dato">
			<select name="idioma">
			  <option selected value="">Idioma</option>
  			<option value="Cymraeg">Galés</option>
  			<option value="Castellano">Castellano</option>
  			<option value="English">Inglés</option>
  			<option value="Aleman">Aleman</option>
  			<option value="Polaco">Polaco</option>
  			<option value="Frances">Francés</option>
  			<option value="Portugues">Portugues</option>
  			<option value="Italiano">Italiano</option>
  			<option value="Otro">Otro</option>
  			<option value="">No usa idioma</option>
			</select>
		</div>

		<div class="dato">
			<select name="grupind">
					<option selected value="">Individual/Grupal</option>
					<option value="GRU">Grupal</option>
					<option value="IND">Individual</option>
			</select>
		</div>
		<div class="dato">
		<h4>Ingrese la descripción</h4>
			<textarea id="wysiwyg"  name="descripcion"  placeholder="Inserte una descripcion"></textarea>
		</div>
		<input type="button" id="toggle" value="Mostrar Opcionales" style="font-size:14px;cursor:pointer;margin:15px;padding:5px;"/>
		<div id="hide" style="display:none">
			<div class="dato">
			<h4>Ingrese el Contenido</h4>
				<textarea id="wysiwyg01"  name="xt_texto"  placeholder="Ingrese el contenido (Opcional)"></textarea>
			</div>
		</div>
        <div>
		<input type="submit" class="boton-verde" value="Insertar registro" />
		</div>
	 <input type="hidden" name="fk_anio" value="<?php echo $a;?>" size="32"></input>
    <input type="hidden" name="MM_insert" value="form1" />
	<script>
    CKEDITOR.replace( 'wysiwyg' );
	   CKEDITOR.replace( 'wysiwyg01' );
    </script>
  </form>
</body>
</html>
<?php mysqli_free_result($categorias); ?>
