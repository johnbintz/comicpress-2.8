<?php 

$comicpress_options = comicpress_load_options();
if ($comicpress_options['enable_custom_image_header']) {
	
	// Custom Image Header
	define('HEADER_TEXTCOLOR', '000');
	define('HEADER_IMAGE', '%s/images/header-blank.png'); // %s is theme dir
	define('HEADER_IMAGE_WIDTH', $comicpress_options['custom_image_header_width']);
	define('HEADER_IMAGE_HEIGHT', $comicpress_options['custom_image_header_height']);
	
	function theme_admin_header_style() {
		?>
		<style type="text/css">
		#headimg {
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		background: url(<?php header_image(); ?>) no-repeat center;	
		}
		
		#headimg h1, #headimg .description 
		{
		text-decoration: none;
		<?php	
		if ( 'blank' == get_header_textcolor() ) { ?>
			display: none;
		<?php } else {
			//  Otherwise, set the color to be the user selected one
			?>
			color: #<?php header_textcolor();?>;
		<?php } ?>	
		}
		</style>
		<?php
	}
	
	function theme_header_style() {
		?>
		<style type="text/css">
		#header
		{
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		background: url(<?php header_image(); ?>) no-repeat center;
		}
		
		<?php
		//  Has the text been hidden?
		//  If so, set display to equal none
		if ( 'blank' == get_header_textcolor() ) { ?>
			#header h1, #header .description {
			display: none;
			}	
		<?php } else {
			//  Otherwise, set the color to be the user selected one
			?>
			#header *
			{
			color: #<?php header_textcolor();?>;
			}
			}
		<?php } ?>
		</style>
		<?php
	}
	
	if ( function_exists('add_custom_image_header') ) {
		add_custom_image_header('theme_header_style', 'theme_admin_header_style');
	}
	
}

?>