<?php

add_shortcode( 'version', 'comicpress_ver_shortcode' );

function comicpress_ver_shortcode( $atts, $content = null ) {
	global $comicpress_options;
	return '<div class="comicpress_ver">'.$comicpress_options['comicpress_version'].'</div>';
}

?>