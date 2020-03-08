<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "kevinch3@gmail.com" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "privix02031992" );

?>
<?php
/**
 * Copyright (C) : http://www.formmail-maker.com
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|");
    $public_functions = false !== strpos('|phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'17B1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1EQ11DGVqRxVgdGBpdGx2mIouJgsQaAkJR9TK0sjY6wPSCnbQya9W0paGrliK7D6guAEkdVIzRgbUhAE2MtQFTTKQBXa9oCFAslCE0YBCEHxUhFvcBAHxLygEuzacYAAAAAElFTkSuQmCC',
			'6C1C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQxmmMEwNQBITmcLa6BDCECCCJBbQItLgGMLowIIs1gBUMYXRAdl9kVHTVq2atjIL2X0hU1DUQfS2YhdzmIJqB9gtU1DdAnIzY6gDipsHKvyoCLG4DwBcn8udbxUiaQAAAABJRU5ErkJggg==',
			'F864' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkMZQxhCGRoCkMQCGlhbGR0dGlHFRBpdGxxa0dWxNjBMCUByX2jUyrClU1dFRSG5D6zO0dEB07zA0BAMsQBsbkETw3TzQIUfFSEW9wEA1HvPOWgWmHwAAAAASUVORK5CYII=',
			'1388' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7GB1YQxhCGaY6IImxOoi0Mjo6BAQgiYk6MDS6NgQ6iKDoZUBWB3bSyqxVYatCV03NQnIfmjqYGDbzsIhhcUsIppsHKvyoCLG4DwA26ska/wxUEAAAAABJRU5ErkJggg==',
			'F359' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNZQ1hDHaY6IIkFNIi0sjYwBASgiDE0ujYwOoigirWyToWLgZ0UGrUqbGlmVlQYkvtA6oDkVDS9jQ4gmzDsCECzQ6SV0dEBzS2sIQyhDChuHqjwoyLE4j4ARYbNLDW0H8wAAAAASUVORK5CYII=',
			'7877' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDA0NDkEVbWVsZGgIaRFDERBod0MWmANWBRZHcF7UybNXSVSuzkNzH6ABUN4WhFdle1gageQFAUSQxEaCYowNDALJYQANrKyvQBFQxoJvRxAYq/KgIsbgPAAcpy7SCzIXbAAAAAElFTkSuQmCC',
			'FEC9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkNFQxlCHaY6IIkFNIg0MDoEBASgibE2CDqIYIgxwsTATgqNmhq2dNWqqDAk90HUMUzF1MvQgCkmgGEHplsw3TxQ4UdFiMV9AMwtzMLZ+PaoAAAAAElFTkSuQmCC',
			'B943' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QgMYQxgaHUIdkMQCprC2MrQ6OgQgi7WKNDpMdWgQQVEHFAt0aAhAcl9o1NKlmZlZS7OQ3BcwhTHQtRGuDmoeQ6NraACqea0sjQ6N6HYA3dKI6hZsbh6o8KMixOI+AI+Hz68f566YAAAAAElFTkSuQmCC',
			'ADA8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQximMEx1QBJjDRBpZQhlCAhAEhOZItLo6OjoIIIkFtAq0ujaEABTB3ZS1NJpK1NXRU3NQnIfmjowDA0FioUGYjEPQ6yVFU1vQKtoCFAMxc0DFX5UhFjcBwCLbM6W/trTrAAAAABJRU5ErkJggg==',
			'5E41' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QkNEQxkaHVqRxQIaRBoYWh2mYohNdQhFFgsMAIoFwvWCnRQ2bWrYysyspSjuaxVpYEWzAywWGoBqL1AM3S0iUzDFWAPAbg4NGAThR0WIxX0AIPfM3xwNav0AAAAASUVORK5CYII=',
			'6A10' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYAhimMLQii4lMYQxhCGGY6oAkFtDC2goUDQhAFmsQaXSYwuggguS+yKhpK7NACMl9IVNQ1EH0toqGYoqB1KHaIQLWi+oW1gCRRsdQBxQ3D1T4URFicR8AZWbMwinZ7jEAAAAASUVORK5CYII=',
			'5B17' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkNEQximMIaGIIkFNIi0MoQwNIigijU6ookFBgDVTQHJIdwXNm1q2Kppq1ZmIbuvFayuFcXmVpFGhykg3Uh2QMQCkMVEpoD0Mjogi7EGiIYwhjqiiA1U+FERYnEfACAhy97rJqd5AAAAAElFTkSuQmCC',
			'260E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYQximMIYGIImJTGFtZQhldEBWF9Aq0sjo6IgixtAq0sDaEAgTg7hp2rSwpasiQ7OQ3Rcg2oqkDgwZHUQaXdHEWBtEGh3R7ADagOGW0FBMNw9U+FERYnEfAEPvyRxBc4OIAAAAAElFTkSuQmCC',
			'9EBE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGUMDkMREpog0sDY6OiCrC2gFijUEYooh1IGdNG3q1LCloStDs5Dcx+qKaR4DFvMEsIhhcws2Nw9U+FERYnEfAJTyygnuwjJvAAAAAElFTkSuQmCC',
			'5F7B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNEQ11DA0MdkMQCGkSAZKBDABYxESSxwAAgr9ERpg7spLBpU8NWLV0ZmoXsvlaguimMKOaBxQIYUcwLAIoxOqCKiUwRaWBtQNXLGgAWQ3HzQIUfFSEW9wEA6/DLkuF+SwUAAAAASUVORK5CYII=',
			'44D5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpI37pjC0soYyhgYgi4UwTGVtdHRAVscYwhDK2hCIIsY6hdEVKObqgOS+adOWLl26KjIqCsl9AVNEWlkbAhpEkPSGhoqGuqKJgd0CtANDrNEhIABdLJRhqsNgCD/qQSzuAwBJDMvNsTD2TgAAAABJRU5ErkJggg==',
			'0A27' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGUNDkMRYAxhDGB0dGkSQxESmsLayNgSgiAW0ijQ6AMUCkNwXtXTayiwQRHIfWF0rQysDil7RUIcpDFMYUOwAqgsAugfFLSKNjg5AV6K4WaTRNTQQRWygwo+KEIv7AEXqy3M+1MBKAAAAAElFTkSuQmCC',
			'1212' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7GB0YQximMEx1QBJjdWBtZQhhCAhAEhN1EGl0DGF0EEHRy9DoMIWhQQTJfSuzVi1dNW3Vqigk9wHVTQHCRgdUvQFAsVY0t0BUooixNgBFApDFRENEQx2BMGQQhB8VIRb3AQD4+sjWwl+QVwAAAABJRU5ErkJggg==',
			'F196' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkMZAhhCGaY6IIkFNDAGMDo6BASgiLEGsDYEOgigiDGAxZDdFxq1KmplZmRqFpL7QOoYQgLRzAOKAfWKoIkxYhPDdEsoupsHKvyoCLG4DwAoF8qmLkU1TwAAAABJRU5ErkJggg==',
			'0D0B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7GB1EQximMIY6IImxBoi0MoQyOgQgiYlMEWl0dHR0EEESC2gVaXRtCISpAzspaum0lamrIkOzkNyHpg5FTISAHdjcgs3NAxV+VIRY3AcAbzvLnIspTKAAAAAASUVORK5CYII=',
			'7549' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkNFQxkaHaY6IIu2igCxQ0AAuthURwcRZLEpIiEMgXAxiJuipi5dmZkVFYbkPkYHhkZXoB3IelkbgGKhAQ3IYiINIo0OjQ4odgQ0sLYC3YfiloAGxhAMNw9Q+FERYnEfANkPzOsFZyztAAAAAElFTkSuQmCC',
			'A237' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7GB0YQxhDGUNDkMRYA1hbWRsdGkSQxESmiABFAlDEAloZGh3Aogj3RS1dtXTV1FUrs5DcB1Q3BaiyFdne0FCGAKDMFAYU8xgdgGQAqhhrA2ujowOqmGioYygjithAhR8VIRb3AQBjWs0mgkQIowAAAABJRU5ErkJggg==',
			'608A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGVqRxUSmMIYwOjpMdUASC2hhbWVtCAgIQBZrEGl0dHR0EEFyX2TUtJVZoSuzpiG5L2QKijqI3laRRteGwNAQFDGQHYEo6iBuQdULcTMjithAhR8VIRb3AQAVTMswGf2EEgAAAABJRU5ErkJggg==',
			'775D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkNFQ11DHUMdkEVbGRpdGxgdArCIiSCLTWFoZZ0KF4O4KWrVtKWZmVnTkNzH6MAQwNAQiKKXFSSKJiYCFGVFEwsAijI6OqK4BSTGEMqI6uYBCj8qQizuAwBkvcq4J+0d3AAAAABJRU5ErkJggg==',
			'3C25' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7RAMYQxlCGUMDkMQCprA2Ojo6OqCobBVpcG0IRBWbIgIkA10dkNy3MmoakMiMikJ2H0hdK0ODCJp5DFMwxRwCGB2QxcBucWAIQHYfyM2soQFTHQZB+FERYnEfAP/Sy1N1i8xKAAAAAElFTkSuQmCC',
			'34BA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7RAMYWllDGVqRxQKmMExlbXSY6oCsspUhlLUhICAAWWwKoytro6ODCJL7VkYtXbo0dGXWNGT3TRFpRVIHNU801LUhMDQE1Y5W1oZAFHVAt2DohbiZEdW8AQo/KkIs7gMApF/Lo6BliHgAAAAASUVORK5CYII=',
			'17CA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7GB1EQx1CHVqRxVgdGBodHQKmOiCJiQLFXBsEAgJQ9DK0sgJJEST3rcxaNW0pkJyG5D6gugAkdVAxRgegWGgIihhrA2uDIJo6ESAORBETDQHyQh1RxAYq/KgIsbgPAMTbyGA6BIl1AAAAAElFTkSuQmCC',
			'6DAF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WANEQximMIaGIImJTBFpZQhldEBWF9Ai0ujo6Igq1iDS6NoQCBMDOykyatrK1FWRoVlI7guZgqIOorcVKBaKRQxNHcgtrGhiIDejiw1U+FERYnEfAGmpy7GtQOuEAAAAAElFTkSuQmCC',
			'E9C8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkMYQxhCHaY6IIkFNLC2MjoEBASgiIk0ujYIOohgiDHA1IGdFBq1dGnqqlVTs5DcF9DAGIikDirGANTLiGYeCxY7MN2Czc0DFX5UhFjcBwAVrs2stnx1cQAAAABJRU5ErkJggg==',
			'7032' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QkMZAhhDGaY6IIu2MoawNjoEBKCIsbYyNAQ6iCCLTRFpdGh0aBBBdl/UtJVZU4EUkvsYHcDqGpHtYG0AijUEtCK7RaQBZEfAFGSxgAaIW1DFQG5mDA0ZBOFHRYjFfQDEIcy2H0O3IQAAAABJRU5ErkJggg==',
			'0740' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7GB1EQx0aHVqRxVgDGIAiDlMdkMREpgDFpjoEBCCJBbQytDIEOjqIILkvaumqaSszM7OmIbkPqC6AtRGuDirG6MAaGogiJjKFtQFoC4odrAEiDWCbUdwMFkNx80CFHxUhFvcBALazzIFlAQsZAAAAAElFTkSuQmCC',
			'9C33' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WAMYQxlDGUIdkMREprA2ujY6OgQgiQW0ijQ4NAQ0iKCJMTSCRBHumzZ12qpVU1ctzUJyH6srijoIBOlFM08Aix3Y3ILNzQMVflSEWNwHALdHziQ03eDBAAAAAElFTkSuQmCC',
			'71F1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA1pRRFsZA1gbGKaiirGCxEJRxKYwgMRgeiFuiloVtTR01VJk9zE6oKgDQyAfQ0wEi1gAVjHWUJBbAgZB+FERYnEfAPBEyOc43DVBAAAAAElFTkSuQmCC',
			'7CF6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkMZQ1lDA6Y6IIu2sja6NjAEBKCIiTS4NjA6CCCLTRFpYAWKobgvatqqpaErU7OQ3MfoAFaHYh5rA0SvCJKYSAPEDmSxgAZMtwQ0AN3cwIDq5gEKPypCLO4DADEcy3jfMvUzAAAAAElFTkSuQmCC',
			'2C14' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nM2QsQ3AMAgEofAGHohsQGEaT4MLb2B5CE9pkoo4KRMlvGhOvHQCxmUU/pRX/AKjQANlx2ILhRIUz7hG3RJUz8CYdRt7v95tR87ej/c7JN9FOpgk76JRaXVRc1mYCFroxL7634O58Zuei81sw2fSOAAAAABJRU5ErkJggg==',
			'224A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHVqRxUSmsLYytDpMdUASC2gVaQSKBAQg624F6gx0dBBBdt+0VUtXZmZmTUN2XwDDFNZGuDowZHRgCGANDQwNQXYLSBRNnQhQFF0sNFQ01AFNbKDCj4oQi/sA3K/LtYPSh0QAAAAASUVORK5CYII=',
			'B5A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2QsQ2AMAwETZENwj6hoH8kTJFpTJENkhHSMCUBCSkGShD4u9NbPpmWywj9Ka/4MVqmSMlVDNEKMQE1C1aarnNW90Yjw8F2JfYp58X7qfJDpLkXJLUbCmOIZnbrnW6YYATKhdGUu1DOX/3vwdz4raceznnspRHAAAAAAElFTkSuQmCC',
			'18CE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7GB0YQxhCHUMDkMRYHVhbGR0CHZDViTqINLo2CDqg6mVtZQWSyO5bmbUybOmqlaFZSO5DUwcVA5mHTQzTDgy3hGC6eaDCj4oQi/sAqhDHBlkf9AEAAAAASUVORK5CYII=',
			'97ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQ11DHUMdkMREpjA0ujYwOgQgiQW0QsREUMVaWRFiYCdNm7pq2tLQlVnTkNzH6soQwIqml6GV0QFdTABoGrqYyBQRsBiyW1gDgGJobh6o8KMixOI+AOCfyh4u3/OWAAAAAElFTkSuQmCC',
			'EC70' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkMYQ1lDA1qRxQIaWBsdGgKmOqCIiTQAxQIC0MQYGh0dRJDcFxo1bdWqpSuzpiG5D6xuCiNMHUIsAFPM0YEBzQ7WRtcGBhS3gN3cwIDi5oEKPypCLO4DAL0gzf1OjyXvAAAAAElFTkSuQmCC',
			'B714' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nM2QsQ3AIAwEnyIbkH2cDVzghmlMwQYWQzBlKHFImSjxd6fX62T05RR/yit+wruQQXlibCiUUByrKEdCvfQqDMaTn+TeRnKe/EaPYYH8XqDBJDm2KRaXuDDhqEHIsa/+92Bu/E6Tq87c/C+5xQAAAABJRU5ErkJggg==',
			'E262' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM3QMQ7AIAhAURi8gb0PDt0ZZPE0OHgDPYKLp6zdJO3YJsL2YuIPMB6jsNP+0icRIwg0WozVFQzEbMznUwN5YzAN1C99kkbvbYy09M131QXK9g9gp1zAGNK0as3p3WKbDyFBiRvc78N96bsAuBHNVl8W9JgAAAAASUVORK5CYII=',
			'CC75' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WEMYQ1lDA0MDkMREWlkbHRoCHZDVBTSKNGCINYg0MDQ6ujoguS9q1bRVq5aujIpCch9Y3RQGEImqNwBNDGiHowOjgwiaW1yBKpHdB3ZzA8NUh0EQflSEWNwHAN49zKcgUNYuAAAAAElFTkSuQmCC',
			'D827' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGUNDkMQCprC2Mjo6NIggi7WKNLo2BKCJsbYCSSBEuC9q6cqwVSuzVmYhuQ+sDgTRzHOYwjAFQyyAIYAB3S0OjA7obmYNDUQRG6jwoyLE4j4AlnXNAgy+/UQAAAAASUVORK5CYII=',
			'0F60' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1EQx1CGVqRxVgDRBoYHR2mOiCJiUwRaWBtcAgIQBILaAWJMTqIILkvaunUsKVTV2ZNQ3IfWJ2jI0wdkt5AFDGIHQEodmBzC9hGNDcPVPhREWJxHwA/2ct4B9enSgAAAABJRU5ErkJggg==',
			'53EC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkNYQ1hDHaYGIIkFNIi0sjYwBIigiDE0ujYwOrAgiQUGMADVMToguy9s2qqwpaErs1Dc14qiDiYGNg9ZLKAV0w6RKZhuYQ3AdPNAhR8VIRb3AQBd6sqbq6l3KQAAAABJRU5ErkJggg==',
			'FECA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QkNFQxlCHVqRxQIaRBoYHQKmOqCJsTYIBARgiDE6iCC5LzRqatjSVSuzpiG5D00dslhoCIaYIIY6RodANDGQmx1RxAYq/KgIsbgPAGilzDk3Ps3eAAAAAElFTkSuQmCC',
			'1F82' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1EQx1CGaY6IImxOog0MDo6BAQgiYkCxVgbAoEksl6wugYRJPetzJoatip01aooJPdB1TU6oOllbQhoZcAUm4IuBnILsphoCNDGUMbQkEEQflSEWNwHAGzdySz8hW7cAAAAAElFTkSuQmCC',
			'0229' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeElEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGaY6IImxBrC2Mjo6BAQgiYlMEWl0bQh0EEESC2hlaHRAiIGdFLV01dJVK7OiwpDcB1Q3haGVYSqa3gCgaIMIih2MDkBRFDuAbmkAiSK7hdFBNNQ1NADFzQMVflSEWNwHAHVAyr9e5vIAAAAAAElFTkSuQmCC',
			'3F44' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7RANEQx0aHRoCkMQCpog0MLQ6NCKLMbQCxaY6tKKIgdQFOkwJQHLfyqipYSszs6KikN0HVMfa6OiAbh5raGBoCLod2NyCJiYagCk2UOFHRYjFfQA6H86gWTPvVgAAAABJRU5ErkJggg==',
			'EDC7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkNEQxhCHUNDkMQCGkRaGR2AJKpYo2uDABYxEI1wX2jUtJWpq1atzEJyH1RdKwOm3imYYgIBDBhuCXTA4mYUsYEKPypCLO4DAHp6zcZPnz3tAAAAAElFTkSuQmCC',
			'6EE2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDHaY6IImJTBFpYG1gCAhAEgtoAYkxOoggizWA1TWIILkvMmpq2NLQVauikNwXAjGvEdmOgFawWCsDptgUBixuwXSzY2jIIAg/KkIs7gMAlwvLqt8AyLYAAAAASUVORK5CYII=',
			'F0F1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA1qRxQIaGENYGximooqxtgLFQlHFRBpdGxhgesFOCo2atjI1dNVSZPehqcMjBrYDm1vQxIBuBrolYBCEHxUhFvcBAG/AzHJ8Jz3JAAAAAElFTkSuQmCC',
			'DC1A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QgMYQxmmMLQiiwVMYW10CGGY6oAs1irS4BjCEBCAJsYwhdFBBMl9UUunrVo1bWXWNCT3oalDFgsNQRNzQFcHcguaGMjNjKGOKGIDFX5UhFjcBwC5JM1Ok95jzwAAAABJRU5ErkJggg==',
			'CAC0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WEMYAhhCHVqRxURaGUMYHQKmOiCJBTSytrI2CAQEIIs1iDS6NjA6iCC5L2rVtJWpq1ZmTUNyH5o6qJhoKIZYI0gdqh0irSKNjmhuYQ0RaXRAc/NAhR8VIRb3AQAZ/s02w2OfGQAAAABJRU5ErkJggg==',
			'60F1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA1qRxUSmMIawNjBMRRYLaGFtBYqFoog1iDS6NjDA9IKdFBk1bWVq6KqlyO4LmYKiDqK3FZsY2A5sbkERA7sZ6JaAQRB+VIRY3AcARBDLfHJiv38AAAAASUVORK5CYII=',
			'C291' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WEMYQxhCGVqRxURaWVsZHR2mIosFNIo0ujYEhKKINTCAxGB6wU6KWrVq6crMqKXI7gOqm8IQEtCKpjeAoQFNrJHRgRFNDOiWBqBbUMRYQ0RDHUIZQgMGQfhREWJxHwBq48xipVVomwAAAABJRU5ErkJggg==',
			'85E5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDHUMDkMREpog0sDYwOiCrC2jFFAOqCwGKuToguW9p1NSlS0NXRkUhuU9kCkOjK4hGMQ+bmAhQjNFBBMUO1lbWBoYAZPexBjCGsIY6THUYBOFHRYjFfQDLUMtLbt3jbAAAAABJRU5ErkJggg==',
			'161F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7GB0YQximMIaGIImxOrC2MoQwOiCrE3UQaWREE2N0EGkA6oWJgZ20Mmta2KppK0OzkNzH6CDaiqQOprfRgSgxVgy9oiFAl4Q6oogNVPhREWJxHwBwlsYPuZZC+AAAAABJRU5ErkJggg==',
			'312C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7RAMYAhhCGaYGIIkFTGEMYHR0CBBBVtnKGsDaEOjAgiw2BagXKIbsvpVRq6JWrczMQnEfSF0rowOKza1AsSlYxAIYUewImAISYUBxi2gAayhraACKmwcq/KgIsbgPAASRx/oVnbC/AAAAAElFTkSuQmCC',
			'E6E5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHUMDkMQCGlhbWRsYHRhQxEQasYg1AMVcHZDcFxo1LWxp6MqoKCT3BTSIAs1jAKpGNc8VqxijA6oYyC0MAcjug7jZYarDIAg/KkIs7gMAgsLL4ZSrU9QAAAAASUVORK5CYII=',
			'D527' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM2QwQ2AMAgA4dEN6j64ASbl4whOgQ82qCP0oVPan0V9apRLeFxCcgG2yyj8iVf6hDsBQUmN4xwVe9LYOosalM8u1V05+saylG2d1qnpY4OZDAzcbXUZsndxJgZ2LgdDQvLNmIIMzn31vwe56dsBswTNHN2HcN0AAAAASUVORK5CYII=',
			'D41E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QgMYWhmmMIYGIIkFTGGYyhDC6ICsLqCVIZQRQ4zRFagXJgZ2UtTSpUtXTVsZmoXkvoBWkVYkdVAx0VAHDDEGTHVTMMVAbmYMdURx80CFHxUhFvcBAEtlyshnNF60AAAAAElFTkSuQmCC',
			'66D1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGVqRxUSmsLayNjpMRRYLaBFpZG0ICEURaxBpAIrB9IKdFBk1LWzpqqilyO4LmSLaiqQOordVpNGVCDGoW1DEoG4ODRgE4UdFiMV9AGvIzVNbMZuwAAAAAElFTkSuQmCC',
			'C2DE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WEMYQ1hDGUMDkMREWllbWRsdHZDVBTSKNLo2BKKKNTAgi4GdFLVq1dKlqyJDs5DcB1Q3hRVTbwCGWCOjA7oY0C0N6G5hDRENdUVz80CFHxUhFvcBABI4y0CKmzukAAAAAElFTkSuQmCC',
			'04FF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7GB0YWllDA0NDkMRYAximsoJkkMREpjCEoosFtDK6IomBnRS1FAhCV4ZmIbkvoFWkFVOvaKgrph0Y6oBuwRADuxlNbKDCj4oQi/sAE7rH/M2uwngAAAAASUVORK5CYII=',
			'CFA0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WENEQx2mMLQii4m0ijQwhDJMdUASC2gUaWB0dAgIQBZrEGlgbQh0EEFyX9SqqWFLV0VmTUNyH5o6hFgomlgjSF0Aih0gtwDFUNzCGgIWQ3HzQIUfFSEW9wEAVsjNU99MzVMAAAAASUVORK5CYII=',
			'71CD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMZAhhCHUMdkEVbGQMYHQIdAlDEWANYGwQdRJDFpjAAxRhhYhA3Ra2KWrpqZdY0JPcxOqCoA0PWBkwxEbAYqh1AN2C4JaCBNRTDzQMUflSEWNwHAFiEyGnczZxsAAAAAElFTkSuQmCC',
			'A826' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGaY6IImxBrC2Mjo6BAQgiYlMEWl0bQh0EEASC2hlbWUAiiG7L2rpyrBVKzNTs5DcB1bXyohiXmioSKPDFEYHERTzgGIB6GJAtzgwoOgNaGUMYQ0NQHHzQIUfFSEW9wEAXWbLzcBCP1YAAAAASUVORK5CYII=',
			'EF22' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkNEQx1CGaY6IIkFNIg0MDo6BASgibE2BDqIoInBSJj7QqOmhq1ambUqCsl9YBWtDI3odjBMAYqiiwUARdHd4gAURXEz0C2hgaEhgyD8qAixuA8AVdrM9PI0RQMAAAAASUVORK5CYII=',
			'F1A1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkMZAhimMLQiiwU0MAYwhDJMRRVjDWB0dAhFFWMIYG0IgOkFOyk0alXUUhBCch+aOoRYKBYxbOowxFhDgWKhAYMg/KgIsbgPAHB7y+vFwVhAAAAAAElFTkSuQmCC',
			'9AC8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WAMYAhhCHaY6IImJTGEMYXQICAhAEgtoZW1lbRB0EEERE2l0bWCAqQM7adrUaStTV62amoXkPlZXFHUQ2Coa6trAiGKeANg8VDtEpog0OqK5hTVApNEBzc0DFX5UhFjcBwCDJMylOeENxQAAAABJRU5ErkJggg==',
			'4400' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpI37pjC0gjGyWAjDVIZQhqkOSGKMIQyhjI4OAQFIYqxTGF1ZGwIdRJDcN23a0qVLV0VmTUNyX8AUkVYkdWAYGioa6oomBnIHuh1gt6G5BaubByr8qAexuA8A67TLWFI5LPUAAAAASUVORK5CYII=',
			'65D9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGaY6IImJTBFpYG10CAhAEgtoAYo1BDqIIIs1iIQgiYGdFBk1denSVVFRYUjuC5nC0OjaEDAVRW8rWKwBVUwEJIZih8gU1lZ0t7AGMIagu3mgwo+KEIv7AKx/zX8q6p9QAAAAAElFTkSuQmCC',
			'7A5F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkMZAlhDHUNDkEVbGUNYGxgdUFS2srZiiE0RaXSdCheDuClq2srUzMzQLCT3MTqINDo0BKLoZW0QDUUXE2kAmocmFgAUc3R0xBBzCEVzywCFHxUhFvcBACJqygR8dCm8AAAAAElFTkSuQmCC',
			'BAEE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QgMYAlhDHUMDkMQCpjCGsDYwOiCrC2hlbcUQmyLS6IoQAzspNGraytTQlaFZSO5DUwc1TzQUUwyLOix6QwOAYmhuHqjwoyLE4j4AI9fLoPqivQgAAAAASUVORK5CYII=',
			'1A03' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB0YAhimMIQ6IImxOjCGMIQyOgQgiYk6sLYyOjo0iKDoFWl0bQhoCEBy38qsaStTV0UtzUJyH5o6qJhoKEgM3TxHLHY4oLslBCiG5uaBCj8qQizuAwDGM8qdaljtLQAAAABJRU5ErkJggg==',
			'3BDF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7RANEQ1hDGUNDkMQCpoi0sjY6OqCobBVpdG0IRBUDqUOIgZ20Mmpq2NJVkaFZyO5DVYfbPCxi2NwCdTOq3gEKPypCLO4DAHlPyrnWsnVAAAAAAElFTkSuQmCC',
			'8305' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANYQximMIYGIImJTBFpZQhldEBWF9DK0Ojo6IgiJjKFoZW1IdDVAcl9S6NWhS1dFRkVheQ+iLqABhE081yxiIHsEMFwC0MAsvsgbmaY6jAIwo+KEIv7ACljy5UuMN7wAAAAAElFTkSuQmCC',
			'058D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGUMdkMRYA0QaGB0dHQKQxESmiDSwNgQ6iCCJBbSKhIDUiSC5L2rp1KWrQldmTUNyX0ArQ6MjQh1czBXNPKAdGGKsAayt6G5hdGAMQXfzQIUfFSEW9wEA983Kf7eRy+kAAAAASUVORK5CYII=',
			'30EA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7RAMYAlhDHVqRxQKmMIawNjBMdUBW2craChQLCEAWmyLS6NrA6CCC5L6VUdNWpoauzJqG7D5UdVDzwGKhIRh2oKqDuAVVDOJmR1TzBij8qAixuA8A833KOhyjY5sAAAAASUVORK5CYII=',
			'3C33' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7RAMYQxlDGUIdkMQCprA2ujY6OgQgq2wVaXBoCGgQQRabAuQ1gkQR7lsZNW3VqqmrlmYhuw9VHdw8BnTzsNiBzS3Y3DxQ4UdFiMV9AL42zj3FxL/eAAAAAElFTkSuQmCC',
			'2E06' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQxmmMEx1QBITmSLSwBDKEBCAJBbQKtLA6OjoIICsGyjG2hDogOK+aVPDlq6KTM1Cdl8AWB2KeYwOEL0iyG5pgNiBLCbSgOmW0FBMNw9U+FERYnEfACI9ypSc9h5fAAAAAElFTkSuQmCC',
			'047E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7GB0YWllDA0MDkMRYAximMjQEOiCrE5nCEIouFtDK6MrQ6AgTAzspaunSpauWrgzNQnJfQKtIK8MURjS9oqEOAYzodrQyOqCKAd3SytqAKgZ2cwMjipsHKvyoCLG4DwCRpckaIy+g7wAAAABJRU5ErkJggg==',
			'705F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDHUNDkEVbGUNYGxgdUFS2srZiiE0RaXSdCheDuClq2srUzMzQLCT3MTqINDo0BKLoZW3AFBNpANmBKhbQwBjC6OiIJsYQwBCK5pYBCj8qQizuAwAO3cjfYx3iUQAAAABJRU5ErkJggg==',
			'E367' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkNYQxhCGUNDkMQCGkRaGR0dGkRQxBgaXRswxFpZITTcfaFRq8KWTl21MgvJfWB1jg6tDBjmBUzBIhbAgOEWRwcsbkYRG6jwoyLE4j4AP1jM2YywG+0AAAAASUVORK5CYII=',
			'EAAE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkMYAhimMIYGIIkFNDCGMIQyOjCgiLG2Mjo6oomJNLo2BMLEwE4KjZq2MnVVZGgWkvvQ1EHFRENdQ9HFsKnDFAsNAYuhuHmgwo+KEIv7ADFpzLXb/21UAAAAAElFTkSuQmCC',
			'1E70' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDA1qRxVgdRIBkwFQHJDFRiFhAAIpeoFijI1gG5r6VWVPDVi1dmTUNyX1gdVMYYeoQYgGYYowODBh2sDYwoLolBOjmBgYUNw9U+FERYnEfADwGyNdF7VwnAAAAAElFTkSuQmCC',
			'6095' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGUMDkMREpjCGMDo6OiCrC2hhbWVtCEQVaxBpdG0IdHVAcl9k1LSVmZmRUVFI7guZItLoEAJUjay3FSjWgC7G2soItEMEwy0OAcjug7iZYarDIAg/KkIs7gMA8iHLZgk/ZZEAAAAASUVORK5CYII=',
			'DAF7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgMYAlhDA0NDkMQCpjCGsAJpEWSxVtZWTDGRRlcQjeS+qKXTVqaGrlqZheQ+qLpWBhS9oqFAsSkMmOYFoIhNAYkxOqC6GVNsoMKPihCL+wD5s82cM3tNEwAAAABJRU5ErkJggg==',
			'9379' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7WANYQ1hDA6Y6IImJTBFpZWgICAhAEgtoZWh0aAh0EEEVA4o6wsTATpo2dVXYqqWrosKQ3MfqClQ3hWEqsl6QTocAoF1IYgJg0xhQ7AC5hbWBAcUtYDc3MKC4eaDCj4oQi/sA6JXLt/xpa0cAAAAASUVORK5CYII=',
			'A960' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGVqRxVgDWFsZHR2mOiCJiUwRaXRtcAgIQBILaAWJMTqIILkvaunSpalTV2ZNQ3JfQCtjoKujI0wdGIaGMgD1BqKIBbSyAMUC0OzAdAvQPAw3D1T4URFicR8ArSzM4ylxbjUAAAAASUVORK5CYII=',
			'1F73' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1EQ11DA0IdkMRYHUSAZKBDAJKYKFgsoEEERS+Q1+jQEIDkvpVZU8NWLV21NAvJfWB1UxgaAtD1BjBgmMfogCnGCiRR3BICEmNAcfNAhR8VIRb3AQC+0coGz+wXtgAAAABJRU5ErkJggg==',
			'0463' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YWhlCGUIdkMRYAximMjo6OgQgiYlMYQhlbXBoEEESC2hldGUF0Ujui1oKBFNXLc1Ccl9Aq0grq6NDQwCKXtFQV6CICKodraxoYkC3tKK7BZubByr8qAixuA8Ao2HL2SjdqIEAAAAASUVORK5CYII=',
			'73E9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkNZQ1hDHaY6IIu2irSyNjAEBKCIMTS6NjA6iCCLTWEAqoOLQdwUtSpsaeiqqDAk9zE6gNQxTEXWC+QDzWNoQBYTgYih2BHQgOmWgAYsbh6g8KMixOI+AJS5yxKDRiTwAAAAAElFTkSuQmCC',
			'E26E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkMYQxhCGUMDkMQCGlhbGR0dHRhQxEQaXRvQxRiAYowwMbCTQqNWLV06dWVoFpL7gOqmsGKYxxDA2hCIJsbogCnG2oDultAQ0VAHNDcPVPhREWJxHwCpR8rxkbYIGQAAAABJRU5ErkJggg==',
			'D0FE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7QgMYAlhDA0MDkMQCpjCGsDYwOiCrC2hlbcUUE2l0RYiBnRS1dNrK1NCVoVlI7kNTh0cMix1Y3AJ2cwMjipsHKvyoCLG4DwBYUMqojCKnQAAAAABJRU5ErkJggg==',
			'0DBD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDGUMdkMRYA0RaWRsdHQKQxESmiDS6NgQ6iCCJBbQCxYDqRJDcF7V02srU0JVZ05Dch6YOIYZmHjY7sLkFm5sHKvyoCLG4DwBTksxWAQKB9QAAAABJRU5ErkJggg==',
			'6DB0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGVqRxUSmiLSyNjpMdUASC2gRaXRtCAgIQBZrAIo1OjqIILkvMmraytTQlVnTkNwXMgVFHURvK8i8QCxiqHZgcws2Nw9U+FERYnEfAK38zjsTK4PkAAAAAElFTkSuQmCC',
			'B08E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QgMYAhhCGUMDkMQCpjCGMDo6OiCrC2hlbWVtCEQVmyLS6IhQB3ZSaNS0lVmhK0OzkNyHpg5qnkijK7p5WO3AdAs2Nw9U+FERYnEfAHu8ytppEu6OAAAAAElFTkSuQmCC'        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>