<?php

// if the from is loaded from WordPress form loader plugin, 
// the phpfmg_display_form() will be called by the loader 
if( !defined('FormmailMakerFormLoader') ){
    # This block must be placed at the very top of page.
    # --------------------------------------------------
	require_once( dirname(__FILE__).'/form.lib.php' );
    phpfmg_display_form();
    # --------------------------------------------------
};


function phpfmg_form( $sErr = false ){
		$style=" class='form_text' ";

?>

<form name="frmFormMail" action='' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onsubmit(this);'>
<input type='hidden' name='formmail_submit' value='Y'>
<div id='err_required' class="form_error" style='display:none;'>
    <label class='form_error_title'>Por favor revise los campos necesarios</label>
</div>

            
            
<ol class='phpfmg_form' >

<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>Nombre, Seudonimo, o Denominacion</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_0"  id="field_0" value="<?php  phpfmg_hsc("field_0", ""); ?>" class='text_box'>
	<div id='field_0_tip' class='instruction'>Ingrese su nombre</div>
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>Apellido</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_1"  id="field_1" value="<?php  phpfmg_hsc("field_1", ""); ?>" class='text_box'>
	<div id='field_1_tip' class='instruction'>Ingrese su apellido (en caso de ser coro, dejar en blanco)</div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>Nacionalidad</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_2"  id="field_2" value="<?php  phpfmg_hsc("field_2", ""); ?>" class='text_box'>
	<div id='field_2_tip' class='instruction'>País o Estado Nacional del que proviene</div>
	</div>
</li>

<li class='field_block' id='field_3_div'><div class='col_label'>
	<label class='form_field'>Provincia</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_3"  id="field_3" value="<?php  phpfmg_hsc("field_3", ""); ?>" class='text_box'>
	<div id='field_3_tip' class='instruction'>Provincia o Estado Provincial (intermedio)</div>
	</div>
</li>

<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>Ciudad</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4", ""); ?>" class='text_box'>
	<div id='field_4_tip' class='instruction'>Ciudad o Municipio al que pertenece</div>
	</div>
</li>

<li class='field_block' id='field_5_div'><div class='col_label'>
	<label class='form_field'>DNI</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_5"  id="field_5" value="<?php  phpfmg_hsc("field_5", ""); ?>" class='text_box'>
	<div id='field_5_tip' class='instruction'>Solo en caso de ser una sola persona</div>
	</div>
</li>

<li class='field_block' id='field_6_div'><div class='col_label'>
	<label class='form_field'>Fecha de Nacimiento</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	
<?php
    $field_6 = array(
        'month' => "-MM- =,|01|02|03|04|05|06|07|08|09|10|11|12",
        'day' => "-DD- =,|01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31",
        'startYear' => date("Y")-99,
        'endYear' => date("Y")+0,
        'yearPrompt' => '-YYYY-',
        'format' => "dd/mm/yyyy",
        'separator' => "/",
        'field_name' => "field_6", 
    );
    phpfmg_date_dropdown( $field_6 );
?>

	<div id='field_6_tip' class='instruction'>Fecha en la que nació (en caso de ser una sola persona)</div>
	</div>
</li>

<li class='field_block' id='field_7_div'><hr class='sectionbreak'> 
Campos de contacto
</li>
<li class='field_block' id='field_8_div'><div class='col_label'>
	<label class='form_field'>Telefono de referencia</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_8"  id="field_8" value="<?php  phpfmg_hsc("field_8", ""); ?>" class='text_box'>
	<div id='field_8_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_9_div'><div class='col_label'>
	<label class='form_field'>Email</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_9"  id="field_9" value="<?php  phpfmg_hsc("field_9", ""); ?>" class='text_box'>
	<div id='field_9_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_10_div'><div class='col_label'>
	<label class='form_field'>Direccion Postal</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_10"  id="field_10" value="<?php  phpfmg_hsc("field_10", ""); ?>" class='text_box'>
	<div id='field_10_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_11_div'><div class='col_label'>
	<label class='form_field'>Competencia a inscribirse</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_11"  id="field_11" value="<?php  phpfmg_hsc("field_11", ""); ?>" class='text_box'>
	<div id='field_11_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_12_div'><div class='col_label'>
	<label class='form_field'>Alguna observacion</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_12" id="field_12" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_12"); ?></textarea>

	<div id='field_12_tip' class='instruction'>Ingrese solo aquellos datos que considere relevantes</div>
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'>Código de seguridad
  <label class='form_field'>:</label> <label class='form_required' >*</label> <div class='col_field'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>


            <li>
            <div class='form_submit_block col_field'>
	
                <input type='submit' value='Inscribir' class='form_button'>
                <span id='phpfmg_processing' style='display:none;'>
                    <img id='phpfmg_processing_gif' src='<?php echo PHPFMG_ADMIN_URL . '?mod=image&amp;func=processing' ;?>' border=0 alt='Procesando...'> <label id='phpfmg_processing_dots'></label>
                </span>
            </div>
            </li>
            
</ol>
            
            


</form>




<?php
			
    phpfmg_javascript($sErr);

} 
# end of form




function phpfmg_form_css(){
    $formOnly = isset($GLOBALS['formOnly']) && true === $GLOBALS['formOnly'];
?>
<style type='text/css'>
<?php 
if( !$formOnly ){
    echo"
body{
    margin-left: 18px;
    margin-top: 18px;
}

body{
    font-family : Verdana, Arial, Helvetica, sans-serif;
    font-size : 13px;
    color : #474747;
    background-color: transparent;
}

select, option{
    font-size:13px;
}
";
}; // if
?>

ol.phpfmg_form{
    list-style-type:none;
    padding:0px;
    margin:0px;
}

ol.phpfmg_form li{
    margin-bottom:5px;
    clear:both;
    display:block;
    overflow:hidden;
	width: 100%
}


.form_field, .form_required{
    font-weight : bold;
}

.form_required{
    color:red;
    margin-right:8px;
}

.field_block_over{
}

.form_submit_block{
    padding-top: 3px;
}

.text_box, .text_area, .text_select {
    width:300px;
}

.text_area{
    height:80px;
}

.form_error_title{
    font-weight: bold;
    color: red;
}

.form_error{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #F4F6E5;
    border-bottom: 1px dashed #ff0000;
}

div.instruction_error{
    color: red;
    font-weight:bold;
}

hr.sectionbreak{
    height:1px;
    color: #ccc;
}

#one_entry_msg{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

<?php phpfmg_text_align();?>    



</style>

<?php
}
# end of css
 
# By: formmail-maker.com
?>