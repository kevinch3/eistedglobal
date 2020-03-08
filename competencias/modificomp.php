<?php
require_once('../Connections/ServidorUB.php');
require_once('../funciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Modificar competencia</title>
    <?php require_once('../embed.php');
    if (mysqli_connect_errno()) {
      printf("Conexión fallida: %s\n", mysqli_connect_error());
      exit();
    }
    $eis = strtoupper(substr($_SESSION["edicion"],0,2));
    $c = $_GET['c'];
    $eisCcompare = substr($c,0,2);

    if ($eis != $eisCcompare){
      echo "Hubo un error entre los valores pasados y los valores de cookie :( ";
      echo "<br>$eis (cookie) != $eisCcompare (GET)";
      die();
    }

    $query_competencias = "SELECT * FROM competencia WHERE id_comp='$c'";
    $competencias = mysqli_query($link, $query_competencias) or die(mysqli_error());
    $row_competencias = mysqli_fetch_assoc($competencias);
    $totalRows_competencias = mysqli_num_rows($competencias);
    //consulto competencias que sean $c

    $query_categorias = "SELECT id_cat, nombre FROM categoria";
    $query_categorias_filtro =	$query_categorias." WHERE id_cat= $row_competencias[categoria]";
    $QUERY3 = mysqli_query ($link, $query_categorias);
    $QUERY33=	mysqli_query ($link, $query_categorias_filtro);

    ?>
    <script src="../js/wysiwyg/ckeditor.js"></script>
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
  </head>
  <body>
  <div style="display: none;"id="dialog" title="Desea borrar?">
    Seguro?
  </div>
    <?php
    if(isset($_GET['exito'])){
      if ($_GET['exito'] == "si") {
        echo "<div style=\"position: fixed; padding: 15px; font-weight: bolder; top: 0; background: #b8dbc1; width: 100%; margin:0;\"><i class=\"fa fa-check-square-o\"></i> Exito al agregar ".$_GET['comp']."</div>";
      }
    } ?>
    <form action="modifica2.php" method="post" name="form1" id="form1" style="text-align: center;margin: 50px;">
      <div class="dato">
        <?php echo $eis.$a ; ?> - <b><?php $id= substr($row_competencias['id_comp'], -3); echo $id; ?></b>
        <input name="id_comp" type="hidden" value="<?php echo $id; ?>" maxlength="15" readonly="readonly">
      </div>
      <div class="dato">
        <select name="categoria">
          <?php  while ( $resultado33 = mysqli_fetch_array($QUERY33)){ ?>
            <option selected value="<?php echo $resultado33['id_cat']; ?>"><?php echo $resultado33['nombre']; ?></option>;
          <?php } ?>
          <?php while ( $resultado3 = mysqli_fetch_array($QUERY3)){ ?>
            <option value="<?php echo $resultado3['id_cat']; ?>"> <?php echo $resultado3['nombre']; ?> </option>
          <?php } ?>
        </select>
      </div>
      <div class="dato">
        <textarea id="wysiwyg" name="descripcion"><?php echo $row_competencias['descripcion'] ;?></textarea>
      </div>
      <!-- <input type="button" id="toggle" value="Mostrar Opcionales" style="font-size:14px;cursor:pointer;margin:15px;padding:5px;"/>
      <div id="hide" style="display:none"> -->
      <div class="dato">
        <h4>Contenido</h4>
        <textarea id="wysiwyg01"  name="xt_texto"><?php echo $row_competencias['xt_texto'] ;?></textarea>
      </div>
      <!-- </div> -->
      <div class="dato">
        <select name="idioma">
          <option  style="background: beige;" selected value="<?php echo $row_competencias['idioma'] ;?>"><?php echo $row_competencias['idioma'] ;?></option>
          <option value="Cymraeg">Gal&eacute;s</option>
          <option value="Castellano">Castellano</option>
          <option value="English">Ingl&eacute;s</option>
          <option value="Aleman">Aleman</option>
          <option value="Polaco">Polaco</option>
          <option value="Frances">Franc&eacute;s</option>
          <option value="Portugues">Portugues</option>
          <option value="Italiano">Italiano</option>
          <option value="Otro">Otro</option>
          <option value="">No usa idioma</option>
        </select>
      </div>
      <div class="dato">
        <select name="preliminar">
          <option selected value="<?php echo $row_competencias['preliminar']; ?>">
          <?php if ($row_competencias['preliminar'] == 0){ echo "No" ;} else { echo "Si";} ?>
          </option>
          <option value="0">Sin Preliminar</option>
          <option value="1">Con Preliminar</option>
        </select>
      </div>
      <div class="dato">
        <select name="rank">
          <option selected value="<?php echo $row_competencias['rank']; ?>">
          <?php if ($row_competencias['rank'] == 0){ echo "No" ;} else { echo "Si";} ?>
          </option>
          <option value="0">Competencia Clasica</option>
          <option value="1">Competencia Principal</option>
        </select>
      </div>
      <div class="dato">
        <select name="grupind">
        <option selected value="<?php echo $row_competencias['grupind']; ?>">
        <?php echo $row_competencias['grupind']; ?>
        </option>
        <option value="GRU">Grupal</option>
        <option value="IND">Individual</option>
        </select>
      </div>
      <div>
        <input type="submit" class="boton-verde" value="Modificar" />
        <input type="button" onclick="location.href='modifica2.php?borra=si&c=<?php echo $row_competencias['id_comp']; ?>'" class="boton-rojo confirmLink" value="Borrar" />
      </div>
      <input type="hidden" name="fk_anio" value="<?php echo $a;?>" size="32" />
      <input type="hidden" name="MM_insert" value="form1" />
      <script>
      CKEDITOR.replace( 'wysiwyg' );
      CKEDITOR.replace( 'wysiwyg01' );
      </script>
    </form>
  </body>
</html>
<?php mysqli_free_result($competencias); ?>
