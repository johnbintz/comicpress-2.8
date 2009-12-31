<?php

function options() {
	$pagehook = add_submenu_page('themes.php','comicpress', __('ComicPress Options','comicpress'), 10, 'comicpress-options', 'comicpress_admin');
	add_action('admin_head-'.$pagehook, 'comicpress_admin_page_head');
}

function comicpress_admin_page_head() { 
	wp_admin_css( 'css/global' );
	wp_admin_css();
	wp_admin_css( 'css/colors' );
	wp_admin_css( 'css/ie' );
	wp_enqueue_script('utils');
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/options/options.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tabbed_pages.js"></script>
<!--[if lt ie 8]> <style> div.show { position: static; margin-top: 1px; } #cpadmin div.off { height: 22px; } </style> <![endif]-->

<?php }

function comicpress_admin() {
	global $upload_path, $blogcat;
	$comicpress_options = get_option('comicpress_options'); 
?>
	
<div class="wrap">
	
	<div id="cpadmin-headericon" style="background: url('<?php echo get_template_directory_uri(); ?>/images/options/comicpress_icon.png') no-repeat;"></div>
	<h2 class="alignleft"><?php _e('ComicPress Options','comicpress'); ?></h2>
	<div class="clear"></div>
	<?php 
	$tab = '';
	if ( wp_verify_nonce($_POST['_wpnonce'], 'update-options') ) {
		
		if ($_REQUEST['action'] == 'comicpress_save_layout') {
			$comicpress_options['cp_theme_layout'] = wp_filter_nohtml_kses($_REQUEST['cp_theme_layout']);
			$tab = 'themestyle';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_general') {
			
			foreach (array(
				'disable_page_restraints', 
				'rascal_says',
				'disable_comment_note',
				'enable_numbered_pagination',
				'enable_comment_count_in_rss',
				'comic_clicks_next',
				'disable_default_comic_nav',
				'enable_widgetarea_use_sidebar_css',
				'disable_lrsidebars_frontpage',
				'disable_footer_text',
				'disable_blogheader',
				'enable_comicpress_debug',
				'enable_full_post_check',
				'enable_scroll_to_top'
				) as $key) {
					$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			foreach (array(
				'graphicnav_directory'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'general';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_index') {
			foreach (array(
				'disable_comic_frontpage',
				'disable_comic_blog_frontpage',
				'disable_comic_blog_single',
				'disable_blog_frontpage'
				) as $key) {
					$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}

			$tab = 'index';
			update_option('comicpress_options',$comicpress_options);		
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_post') {
			foreach (array(
				'transcript_in_posts',
				'enable_related_comics',
				'enable_related_posts',
				'remove_wptexturize',
				'enable_comic_post_author_gravatar',
				'enable_post_author_gravatar',
				'split_column_in_two',
				'enable_comic_post_calendar',
				'enable_post_calendar',
				'disable_tags_in_posts',
				'disable_categories_in_posts',
				'blogposts_with_comic',
				'static_blog',
				'disable_page_titles'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			foreach (array(
				'author_column_one',
				'author_column_two',
				'avatar_directory',
				'moods_directory',
				'calendar_directory'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'post';
			update_option('comicpress_options',$comicpress_options);	
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_archivesearch') {
			foreach (array(
				'archive_display_order',
				'excerpt_or_content_archive',
				'excerpt_or_content_search',
				'category_thumbnail_postcount'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'archivesearch';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_menubar') {
			foreach (array(
				'enable_search_in_menubar',
				'enable_rss_in_menubar',
				'enable_navigation_in_menubar',
				'contact_in_menubar',
				'disable_dynamic_menubar_links',
				'disable_default_menubar',
				'enable_blogroll_off_links'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}			
			$tab = 'menubar';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_customheader') {
			foreach (array(
				'enable_custom_image_header'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			foreach (array(
				'custom_image_header_width',
				'custom_image_header_height'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'customheader';
			update_option('comicpress_options',$comicpress_options);
		}
		
		if ($_REQUEST['action'] == 'comicpress_save_buyprint') {
			foreach (array(
				'buy_print_add_shipping'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			foreach (array(
				'buy_print_email',
				'buy_print_url',
				'buy_print_us_amount',
				'buy_print_int_amount',
				'buy_print_us_ship',
				'buy_print_int_ship'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
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
		if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'comicpress_reset') {
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
		
		<?php
			foreach (glob(get_template_directory() . '/options/*.php') as $file) {
				include($file);
			}
		?>
	</div>
	
</div>

<?php 
}

add_action('admin_menu', 'options');

?>