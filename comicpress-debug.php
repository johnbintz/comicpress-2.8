<?php

function comicpress_notice_debug() {
	global $current_user, $comiccat, $blogcat;
	if( substr( $_SERVER[ 'PHP_SELF' ], -19 ) != '/wp-admin/index.php' )
		return;
	$error = '';
	$comicpress_options = comicpress_load_options();
	if ($comiccat == $blogcat) $error .= '<h3>The $comiccat is the same as $blogcat.</h3>Installation instructions on how to set the comicpress-options.php settings and comicpress manager settings here, not to mention the __( for language pack.';
	if (!empty($error)) {
	?>
	<div class="error">
	<h2>ComicPress Debug</h2>
	ComicPress doesn't seem to be fully installed at this time, check out these messages.<br />
	<br />
	<?php echo $error; ?>
	<br />
	<br />
	</div>
<?php 
	}
}

add_action( 'admin_notices', 'comicpress_notice_debug' );

?>