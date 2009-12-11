<?php

function comicpress_notice_debug() {
	global $current_user, $comiccat, $blogcat;
	if( strpos( $_SERVER[ 'PHP_SELF' ], -'/wp-admin/index.php' ) === false )
		return;
	
	$error = array();

	$comicpress_options = comicpress_load_options();
	if ($comiccat == $blogcat) {
		$error[] = array('header', 'The $comiccat is the same as $blogcat.');
		$error[] = 'Installation instructions on how to set the comicpress-options.php settings and comicpress manager settings here, not to mention the __( for language pack.';
	}
	
	if (!empty($error)) {
	?>
	<div class="error">
  	<h2>ComicPress Installation Problems Detected</h2>
	  <p>ComicPress doesn't seem to be fully installed at this time, check out these messages:</p>
	  <?php
	  	foreach ($error as $info) {
	  	  unset($text);
	  	  if (is_array($info)) {
	  	  	list($type, $text) = $info;
	  	  } else {
	  	  	if (is_string($info)) {
		  	  	$text = $info;
		  	  	$type = 'paragraph';
		  	  }
	  	  }
	  	  if (!empty($text) && !empty($type)) {
	  	  	switch ($type) {
	  	  		case 'header': echo "<h3>${text}</h3>"; break;
	  	  		case 'raw': echo $text; break;
	  	  		default: echo "<p>${text}</p>"; break;
	  	  	}
	  	  }	  	  
			}
		?>
	</div>
<?php 
	}
}

add_action( 'admin_notices', 'comicpress_notice_debug' );

