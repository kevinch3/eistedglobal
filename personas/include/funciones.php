	<?php
function sql_quote($value){
    if(get_magic_quotes_gpc()){
		$value = stripslashes( $value );
		}
    //check if this function exists 
    if( function_exists( "mysqli_real_escape_string" )){
          $value = mysqli_real_escape_string( $link, $value );
		} else {
          $value = addslashes( $value );
		}
    return $value;
}
?>