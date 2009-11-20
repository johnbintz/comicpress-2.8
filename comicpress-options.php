<?php

@include(get_template_directory() . '/comicpress-options-config.php');

function options() {
	$pagehook = add_submenu_page('themes.php','comicpress', __('ComicPress Options','comicpress'), 10, 'comicpress-options', 'comicpress_admin');
	add_action('admin_head-'.$pagehook, 'comicpress_admin_page_head');
}

function comicpress_admin_page_head() { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/tabbed/tabbed_pages.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tabbed/tabbed_pages.js"></script>
<!--[if lt ie 8]>
	<style>
		div.show {
			position: static;
			margin-top: 1px;
		}
		#cpadmin div.off {
			height: 22px;
		}		
	</style>
<![endif]-->

<?php }

function comicpress_admin() {
	global $options, $upload_path, $blogcat, $moods_directory, $calendar_directory, $graphicnav_directory; ?>
	
<div class="wrap">
	
	<div id="cpadmin-headericon" style="background: url('<?php echo get_template_directory_uri(); ?>/images/options/comicpress_icon.png') no-repeat;"></div>
	<h2 class="alignleft"><?php _e('ComicPress Options','comicpress'); ?></h2>
	<div class="clear"></div>	
	<?php 
	if ( wp_verify_nonce($_POST['_wpnonce'], 'update-options') ) {
		
		if ('comicpress_save' == $_REQUEST['action']) {
			foreach ($options as $value) {
			if( !isset( $_REQUEST[ $value['id'] ] ) ) {  } else { update_option( $value['id'], stripslashes($_REQUEST[ $value['id']])); } } ?>
			<div id="message" class="updated fade"><p><strong><?php _e('ComicPress Settings SAVED!','comicpress'); ?></strong></p></div>
			<script>function hidemessage() { document.getElementById('message').style.display = 'none'; }</script>
		<?php }
		
		if ('comicpress_reset' == $_REQUEST['action']) {
			foreach ($options as $default) {
				delete_option($default['id'],$default['default']);
			} ?>
			<div id="message" class="updated fade"><p><strong><?php _e('ComicPress Settings RESET!','comicpress'); ?></strong></p></div>
			<script>function hidemessage() { document.getElementById('message').style.display = 'none'; }</script>
		<?php
		}
	}
	
	// set default options

	foreach ($options as $default) {
		if(get_option($default['id'])=="") {
			update_option($default['id'],$default['default']);
		}
	}

	@require(get_template_directory() . '/comicpress-config.php');		
	
	?>
	
	<div id="poststuff" class="metabox-holder">

	<div id="cpadmin" onclick="hidemessage();">
	<div class="on" title="themestyle"><span><?php _e('Layout','comicpress'); ?></span></div>
	<div class="off" title="generaloptions"><span><?php _e('General','comicpress'); ?></span></div>
	<div class="off" title="indexoptions"><span><?php _e('Home Page','comicpress'); ?></span></div>
	<div class="off" title="postoptions"><span><?php _e('Posts &amp; Pages','comicpress'); ?></span></div>
	<div class="off" title="archivesearch"><span><?php _e('Archive &amp; Search','comicpress'); ?></span></div>
	<div class="off" title="menubaroptions"><span><?php _e('Menubar','comicpress'); ?></span></div>
	<div class="off" title="customheader"><span><?php _e('Custom Header','comicpress'); ?></span></div>
	<div class="off" title="buyprintoptions"><span><?php _e('Buy Print','comicpress'); ?></span></div>
	<div class="off" title="membersoptions"><span><?php _e('Members','comicpress'); ?></span></div>
	</div>
	<?php include(get_template_directory() . '/options/themestyle.php'); ?>
	<?php include(get_template_directory() . '/options/generaloptions.php'); ?>
	<?php include(get_template_directory() . '/options/indexoptions.php'); ?>
	<?php include(get_template_directory() . '/options/postoptions.php'); ?>
	<?php include(get_template_directory() . '/options/archivesearchoptions.php'); ?>
	<?php include(get_template_directory() . '/options/menubaroptions.php'); ?>
	<?php include(get_template_directory() . '/options/customheaderoptions.php'); ?>
	<?php include(get_template_directory() . '/options/buyprintoptions.php'); ?>
	<?php include(get_template_directory() . '/options/membersoptions.php'); ?>

	</div>

	<div class="cpadmin-footer">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="cpadmin-donate">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="7827910">
			<input type="image"
			src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif"
			border="0" name="submit" alt="PayPal - The safer, easier way to pay
			online!">
			<img alt="" border="0"
			src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1"
			height="1">
		</form>
		<a href="http://comicpress.org/"><strong>ComicPress 2.9</strong> <small>[ <?php global $comicpress_version; echo $comicpress_version; ?> ]</small></a>. <?php _e('Created by','comicpress'); ?> <a href="http://mindfaucet.com/">Tyler Martin</a> <?php _e('with','comicpress'); ?> <a href="http://www.coswellproductions.com/">John Bintz</a><?php _e(',','comicpress'); ?> <a href="http://webcomicplanet.com/">Philip M. Hofer</a> <small>(<a href="http://frumph.net/">Frumph</a>)</small> <?php _e('and','comicpress'); ?> <a href="http://www.oycomics.com/">Danny Burleson</a>.<br />
		<?php _e('If you like the ComicPress theme, please donate.  It will help in creating new versions.','comicpress'); ?>
		<br />
		<br />
		<form method="post" id="myForm" name="template" enctype="multipart/form-data">
			<?php wp_nonce_field('update-options') ?>		
			<input name="comicpress_reset" type="submit" class="button" value="Reset All Settings" />
			<input type="hidden" name="action" value="comicpress_reset" />	
		</form>
		<div class="clear"></div>
	</div>
</div>

<?php 
}

add_action('admin_menu', 'options');

?>