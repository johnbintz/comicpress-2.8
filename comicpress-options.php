<?php

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
	global $upload_path, $blogcat;
	$comicpress_options = get_option('comicpress_options'); ?>
	
<div class="wrap">
	
	<div id="cpadmin-headericon" style="background: url('<?php echo get_template_directory_uri(); ?>/images/options/comicpress_icon.png') no-repeat;"></div>
	<h2 class="alignleft"><?php _e('ComicPress Options','comicpress'); ?></h2>
	<div class="clear"></div>
	<?php 
	$tab = '';
	if ( wp_verify_nonce($_POST['_wpnonce'], 'update-options') ) {
		
		if ($_REQUEST['action'] == 'comicpress_save_layout') {	
			$comicpress_options['cp_theme_layout'] = $_REQUEST['cp_theme_layout'];
			$tab = 'themestyle';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_general') {
			$comicpress_options['disable_page_restraints'] = (bool)( $_REQUEST['disable_page_restraints'] == 1 ? true : false );
			$comicpress_options['rascal_says'] = (bool)($_REQUEST['rascal_says'] == 1 ? true : false );
			$comicpress_options['disable_comment_note'] = (bool)($_REQUEST['disable_comment_note'] == 1 ? true : false );
			$comicpress_options['enable_numbered_pagination'] = (bool)($_REQUEST['enable_numbered_pagination'] == 1 ? true : false );
			$comicpress_options['comic_clicks_next'] = (bool)($_REQUEST['comic_clicks_next'] == 1 ? true : false );
			$comicpress_options['disable_default_comic_nav'] = (bool)($_REQUEST['disable_default_comic_nav'] == 1 ? true : false );
			$comicpress_options['graphicnav_directory'] = wp_filter_nohtml_kses($_REQUEST['graphicnav_directory']);
			$comicpress_options['enable_widgetarea_use_sidebar_css'] = (bool)($_REQUEST['enable_widgetarea_use_sidebar_css'] == 1 ? true : false );
			$comicpress_options['disable_lrsidebars_frontpage'] = (bool)($_REQUEST['disable_lrsidebars_frontpage'] == 1 ? true : false );
			$comicpress_options['disable_footer_text'] = (bool)($_REQUEST['disable_footer_text'] == 1 ? true : false );
			$comicpress_options['disable_blogheader'] = (bool)($_REQUEST['disable_blogheader'] == 1 ? true : false );		
			$tab = 'general';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_index') {
			$comicpress_options['disable_comic_frontpage'] = (bool)($_REQUEST['disable_comic_frontpage'] == 1 ? true : false );
			$comicpress_options['disable_comic_blog_frontpage'] = (bool)($_REQUEST['disable_comic_blog_frontpage'] == 1 ? true : false );
			$comicpress_options['disable_comic_blog_single'] = (bool)($_REQUEST['disable_comic_blog_single'] == 1 ? true : false );
			$comicpress_options['disable_blog_frontpage'] = (bool)($_REQUEST['disable_blog_frontpage'] == 1 ? true : false );
			$tab = 'index';
			update_option('comicpress_options',$comicpress_options);		
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_post') {
			$comicpress_options['transcript_in_posts'] = (bool)($_REQUEST['transcript_in_posts'] == 1 ? true : false );
			$comicpress_options['enable_related_comics'] = (bool)($_REQUEST['enable_related_comics'] == 1 ? true : false );
			$comicpress_options['enable_related_posts'] = (bool)($_REQUEST['enable_related_posts'] == 1 ? true : false );
			$comicpress_options['remove_wptexturize'] = (bool)($_REQUEST['remove_wptexturize'] == 1 ? true : false );
			
			$comicpress_options['split_column_in_two'] = (bool)($_REQUEST['split_column_in_two'] == 1 ? true : false );
			$comicpress_options['author_column_one'] = wp_filter_nohtml_kses($_REQUEST['author_column_one']);
			$comicpress_options['author_column_two'] = wp_filter_nohtml_kses($_REQUEST['author_column_two']);
			
			$comicpress_options['enable_comic_post_author_gravatar'] = (bool)($_REQUEST['enable_comic_post_author_gravatar'] == 1 ? true : false );
			$comicpress_options['enable_post_author_gravatar'] = (bool)($_REQUEST['enable_post_author_gravatar'] == 1 ? true : false );
			$comicpress_options['avatar_directory'] = wp_filter_nohtml_kses($_REQUEST['avatar_directory']);
			$comicpress_options['moods_directory'] = wp_filter_nohtml_kses($_REQUEST['moods_directory']);
			
			$comicpress_options['calendar_directory'] = wp_filter_nohtml_kses($_REQUEST['calendar_directory']);
			$comicpress_options['enable_comic_post_calendar'] = (bool)($_REQUEST['enable_comic_post_calendar'] == 1 ? true : false );
			$comicpress_options['enable_post_calendar'] = (bool)($_REQUEST['enable_post_calendar'] == 1 ? true : false );
			
			$comicpress_options['disable_tags_in_posts'] = (bool)($_REQUEST['disable_tags_in_posts'] == 1 ? true : false );
			$comicpress_options['disable_categories_in_posts'] = (bool)($_REQUEST['disable_categories_in_posts'] == 1 ? true : false );
			
			$comicpress_options['blogposts_with_comic'] = (bool)($_REQUEST['blogposts_with_comic'] == 1 ? true : false );
			$comicpress_options['static_blog'] = (bool)($_REQUEST['static_blog'] == 1 ? true : false );
			$comicpress_options['disable_page_titles'] = (bool)($_REQUEST['disable_page_titles'] == 1 ? true : false );
			
			$tab = 'post';
			update_option('comicpress_options',$comicpress_options);	
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_archivesearch') {	
			$comicpress_options['archive_display_order'] = $_REQUEST['archive_display_order'];
			$comicpress_options['excerpt_or_content_archive'] = $_REQUEST['excerpt_or_content_archive'];
			$comicpress_options['excerpt_or_content_search'] = $_REQUEST['excerpt_or_content_search'];
			$comicpress_options['category_thumbnail_postcount'] = $_REQUEST['category_thumbnail_postcount'];
			$tab = 'archivesearch';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_menubar') {
			$comicpress_options['enable_search_in_menubar'] = (bool)($_REQUEST['enable_search_in_menubar'] == 1 ? true : false );
			$comicpress_options['enable_rss_in_menubar'] = (bool)($_REQUEST['enable_rss_in_menubar'] == 1 ? true : false );
			$comicpress_options['enable_navigation_in_menubar'] = (bool)($_REQUEST['enable_navigation_in_menubar'] == 1 ? true : false );
			$comicpress_options['contact_in_menubar'] = (bool)($_REQUEST['contact_in_menubar'] == 1 ? true : false );
			$comicpress_options['disable_dynamic_menubar_links'] = (bool)($_REQUEST['disable_dynamic_menubar_links'] == 1 ? true : false );
			$comicpress_options['disable_default_menubar'] = (bool)($_REQUEST['disable_default_menubar'] == 1 ? true : false );			
			$tab = 'menubar';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_customheader') {
			$comicpress_options['enable_custom_image_header'] = (bool)($_REQUEST['enable_custom_image_header'] == 1 ? true : false );
			$comicpress_options['custom_image_header_width'] = wp_filter_nohtml_kses($_REQUEST['custom_image_header_width']);
			$comicpress_options['custom_image_header_height'] = wp_filter_nohtml_kses($_REQUEST['custom_image_header_height']);
			$tab = 'customheader';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_buyprint') {
			$comicpress_options['buy_print_email'] = wp_filter_nohtml_kses($_REQUEST['buy_print_email']);
			$comicpress_options['buy_print_url'] = wp_filter_nohtml_kses($_REQUEST['buy_print_url']);
			$comicpress_options['buy_print_us_amount'] = wp_filter_nohtml_kses($_REQUEST['buy_print_us_amount']);
			$comicpress_options['buy_print_int_amount'] = wp_filter_nohtml_kses($_REQUEST['buy_print_int_amount']);
			$comicpress_options['buy_print_add_shipping'] = (bool)($_REQUEST['buy_print_add_shipping'] == 1 ? true : false );
			$comicpress_options['buy_print_us_ship'] = wp_filter_nohtml_kses($_REQUEST['buy_print_us_ship']);
			$comicpress_options['buy_print_int_ship'] = wp_filter_nohtml_kses($_REQUEST['buy_print_int_ship']);
			$tab = 'buyprint';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_members') {
			$comicpress_options['members_post_category'] = wp_filter_nohtml_kses($_REQUEST['members_post_category']);
			$tab = 'members';
			update_option('comicpress_options',$comicpress_options);
		}
		if ($tab) {
			?>
			<div id="message" class="updated fade"><p><strong><?php _e('ComicPress Settings SAVED!','comicpress'); ?></strong></p></div>
			<script>function hidemessage() { document.getElementById('message').style.display = 'none'; }</script>
		<?php }  
		}
		if ($_REQUEST['action'] == 'comicpress_reset') {
			delete_option('comicpress_options');
			$comicpress_options = comicpress_load_options();
		?>
			<div id="message" class="updated fade"><p><strong><?php _e('ComicPress Settings RESET!','comicpress'); ?></strong></p></div>
			<script>function hidemessage() { document.getElementById('message').style.display = 'none'; }</script>
		<?php
	}
	
	?>
	
	<div id="poststuff" class="metabox-holder">

	<div id="cpadmin" onclick="hidemessage();">
		<div class="<?php if ($tab == 'themestyle' || empty($tab)) { ?>on<?php } else { ?>off<?php } ?>" title="themestyle"><span><?php _e('Layout','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'general') { ?>on<?php } else { ?>off<?php } ?>" title="generaloptions"><span><?php _e('General','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'index') { ?>on<?php } else { ?>off<?php } ?>" title="indexoptions"><span><?php _e('Home Page','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'post') { ?>on<?php } else { ?>off<?php } ?>" title="postoptions"><span><?php _e('Posts &amp; Pages','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'archivesearch') { ?>on<?php } else { ?>off<?php } ?>" title="archivesearch"><span><?php _e('Archive &amp; Search','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'menubar') { ?>on<?php } else { ?>off<?php } ?>" title="menubaroptions"><span><?php _e('Menubar','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'customheader') { ?>on<?php } else { ?>off<?php } ?>" title="customheader"><span><?php _e('Custom Header','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'buyprint') { ?>on<?php } else { ?>off<?php } ?>" title="buyprintoptions"><span><?php _e('Buy Print','comicpress'); ?></span></div>
		<div class="<?php if ($tab == 'members') { ?>on<?php } else { ?>off<?php } ?>" title="membersoptions"><span><?php _e('Members','comicpress'); ?></span></div>
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
</div>

<?php 
}

add_action('admin_menu', 'options');

?>